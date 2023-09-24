<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import {ref} from "vue";

defineProps({
   all_lga: {
       type: Array,
       required: true,
       default: []
   },
   data: {
       type: Object,
       required: false
   },
   total_lga_vote: {
       type: Number,
       required: false
   },
   total_lga_party_votes: {
       type: Array,
       required: false
   },
});

const form = useForm({
   lga_uniqueid: 0,
});

const selectedLga = ref('');
const onChangeSelectedLga = () => {
    form.post(route('polling_unit.sumOfPollingUnitResults'), {
        // onSuccess: () => form.reset(),
        // onError: () => form.reset()
    });
};
</script>

<template>
    <Head title="View LGA Results" />

    <div>
        <div class="px-6 py-10 bg-slate-100">
            <section class="container px-4 mx-auto">
                <h1 class="text-green-600 font-bold text-2xl">
                    LGA Results
                </h1>

                <Link
                    :href="route('polling_unit.index')"
                    class="w-fit flex items-center space-x-1 mt-4 text-sm text-blue-600 hover:underline font-medium"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
                    </svg>
                    <p>Go Back</p>
                </Link>

                <div class="my-6">
                    <label
                        class="flex items-center text-md font-medium text-gray-800"
                        for="lgaSelectBox"
                    >View total results for...</label>
                    <select
                        v-model="form.lga_uniqueid"
                        @change="onChangeSelectedLga"
                        class="mt-4 w-full rounded-md border focus:border-blue-500 focus:border-none p-3 text-base font-normal outline-none transition ease-in-out focus:outline-none"
                        id="lgaSelectBox">
                        <option selected>Select an LGA...</option>
                        <option v-for="lga in all_lga" :value="lga.uniqueid">{{lga.lga_name}}</option>
                    </select>
                </div>

                <h2 class="text-gray-900 font-semibold text-xl">Results Breakdown</h2>

                <div class="flex flex-col mt-6">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 h-[600px] overflow-scroll">
                            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">

                                <template v-if="data">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                            <tr>
                                                <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Polling Unit Name
                                                </th>

                                                <th
                                                    v-for="party in data.party"
                                                    scope="col"
                                                    class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                                >
                                                    {{party.abbreviation}}
                                                </th>

                                                <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Total Votes
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                            <tr v-for="result in data.polling_unit">
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <h4 class="text-gray-700 dark:text-gray-200">{{result.name}}</h4>
                                                </td>

                                                <td
                                                    v-for="party in data.party"
                                                    class="px-4 py-4 text-sm whitespace-nowrap"
                                                >
                                                    <h4 class="text-gray-700 dark:text-gray-200">{{party.votes}}</h4>
                                                </td>

                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <h4 class="text-gray-700 dark:text-gray-200">{{result.total_votes}}</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <h4 class="text-gray-700 font-bold dark:text-gray-200">Total</h4>
                                                </td>
                                                <td v-for="party in data.party" class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <h4 class="text-gray-700 dark:text-gray-200">{{party.votes}}</h4>
                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <h4 class="text-gray-700 dark:text-gray-200">{{total_lga_vote}}</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </template>
                                <div v-else class="text-center text-lg font-medium text-gray-800 p-5">
                                    No Results found for this polling unit! Please, check again later.
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>
