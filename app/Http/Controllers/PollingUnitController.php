<?php

namespace App\Http\Controllers;

use App\Models\AnnouncedPollingUnitResult;
use App\Models\LGA;
use App\Models\Party;
use App\Models\PollingUnit;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PollingUnitController extends Controller
{

    public function index () {
        return Inertia::render('PollingUnit/List', [
            "pollingUnits" => PollingUnit::whereNot('polling_unit_id', 0)->get(),
        ]);
    }

    public function show ($uniqueid) {
        return Inertia::render('PollingUnit/Read',[
            'pollingUnit' => PollingUnit::where('uniqueid', $uniqueid)->first(),
            "results" => AnnouncedPollingUnitResult::where('polling_unit_uniqueid', $uniqueid)->get()
        ]);
    }

    public function create () {
        return Inertia::render("PollingUnit/Create");
    }

    public function store (Request $request) {

    }

    public function sumOfPollingUnitResults(Request $request) {

        if ($request->lga_uniqueid) {
            $request->validate([
                'lga_uniqueid' => 'required|int'
            ]);

            // Fetch all polling units under any selected LGA
            $polling_units = PollingUnit::where('lga_id', $request->lga_uniqueid)->whereNot('polling_unit_id', 0)->get();

            $party_results = [];
            $pu_total_results = [];

            foreach ($polling_units as $pu) {
                // Fetch all results belonging to a polling unit
                $pu_results = AnnouncedPollingUnitResult::where('polling_unit_uniqueid', $pu->uniqueid)->get();

                // Total votes in a single polling unit (all parties combined)
                $polling_unit_votes = 0;

                foreach ($pu_results as $result) {
                    // Add each party result for a single polling unit to the "party_results" array
                    $party_results[] = [
                        "abbreviation" => $result->party_abbreviation,
                        "votes" => $result->party_score
                    ];

                    // Add the votes for all parties in a single polling unit
                    $polling_unit_votes += $result->party_score;
                }

                $pu_total_results[] = [
                    "name" => $pu->polling_unit_name,
                    "total_votes" => $polling_unit_votes
                ];

            }

            // Total votes for all polling units in the LGA combined
            $total_lga_vote = 0;

            foreach ($pu_total_results as $result) {
                $total_lga_vote += $result['total_votes'];
            }

            // Total votes for each party across all polling units in the LGA combined
            $total_lga_party_votes = [];

//            $parties = Party::get();
//            foreach ($parties as $party) {
//                $party_votes = 0;
//                foreach ($party_results as $result) {
//                    if ($result['abbreviation'] == $re->abbreviation) {
//                        $party_votes += $result['votes'];
//                    }
//                }
//                $total_lga_party_votes[] = [
//                    "party_votes" => $party_votes,
//                    "party_abbreviation" => $party->partyid
//                ];
//            }

            return Inertia::render("LgaResult", [
                "all_lga" => LGA::get(),
                "data" => [
                    "party" => $party_results,
                    "polling_unit" => $pu_total_results
                ],
                "total_lga_vote" => $total_lga_vote,
                "total_lga_party_votes" => $total_lga_party_votes
            ]);
        }

        return Inertia::render("LgaResult", [
            "all_lga" => LGA::get(),
        ]);
    }

}
