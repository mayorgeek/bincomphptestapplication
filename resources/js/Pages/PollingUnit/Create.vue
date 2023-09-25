<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import {ref} from "vue";

const {wards} = defineProps({
   wards: {
       type: Array,
       required: true,
       default: []
   },
   all_lga: {
       type: Array,
       required: true,
       default: []
   }
});

const numberOfResults = ref(1);

const form = useForm({
    polling_unit_id: null,
    lga_id: null,
    ward_id: null,
    uniquewardid: null,
    polling_unit_number: '',
    polling_unit_name: '',
    polling_unit_description: '',
    lat: '',
    long: '',
    results: [
        {
            party_abbreviation: '',
            party_score: null,
        }
    ]
});

const addNewResult = () => {
    form.results.push({
        party_abbreviation: '',
        party_score: null,
    });
    numberOfResults.value++;
};

const removeResult = (index) => {
    const newResultsData = form.results.filter((result,i) => i !== index);
    form.results = newResultsData;
    numberOfResults.value--;
};

const submit = () => {
    const ward = wards.filter(ward => ward.uniqueid === form.uniquewardid);
    form.ward_id = ward[0].ward_id;
    form.post(route('polling_unit.store'), {
        onSuccess: () => {
            form.reset()
            alert("Polling unit was successfully created!")
        },
        onError: () => {
            form.reset()
            alert('An error occurred!')
        }
    })
};

</script>

<template>
    <Head title="New polling unit" />
    <div class="px-20 py-10 bg-slate-100">

        <div class="w-full max-w-4xl mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="p-6">
                <h3 class="my-3 text-xl font-medium text-center text-gray-600 dark:text-gray-200">Create a new polling unit</h3>

                <form @submit.prevent="submit">
                    <h2 class="text-gray-900 font-medium text-lg">Polling Unit Data</h2>
                    <div class="mt-6 px-6">
                        <div class="w-full mt-6">
                            <label for="polling_unit_id">Polling Unit ID</label>
                            <input
                                v-model="form.polling_unit_id"
                                id="polling_unit_id"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300"
                                type="number"
                                required
                            />
                        </div>
                        <div class="mt-6 flex items-center justify-between space-x-10">
                            <div class="w-full">
                                <label for="ward_id">Ward</label>
                                <select
                                    required
                                    v-model="form.uniquewardid"
                                    class="mt-4 w-full rounded-md border focus:border-blue-500 focus:border-none p-3 text-base font-normal outline-none transition ease-in-out focus:outline-none"
                                    id="ward_id">
                                    <option selected>Select a Ward</option>
                                    <option v-for="ward in wards" :value="ward.ward_id">{{ward.ward_name}}</option>
                                </select>
                            </div>
                            <div class="w-full">
                                <label for="lga_id">LGA</label>
                                <select
                                    required
                                    v-model="form.lga_id"
                                    class="mt-4 w-full rounded-md border focus:border-blue-500 focus:border-none p-3 text-base font-normal outline-none transition ease-in-out focus:outline-none"
                                    id="lga_id">
                                    <option selected>Select a LGA</option>
                                    <option v-for="lga in all_lga" :value="lga.lga_id">{{lga.lga_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full mt-6">
                            <label for="polling_unit_number">Polling Unit Number</label>
                            <input
                                v-model="form.polling_unit_number"
                                id="polling_unit_number"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300"
                                type="text"
                            />
                        </div>
                        <div class="w-full mt-6">
                            <label for="polling_unit_name">Polling Unit Name</label>
                            <input
                                v-model="form.polling_unit_name"
                                id="polling_unit_name"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300"
                                type="text"
                            />
                        </div>
                        <div class="w-full mt-6">
                            <label for="polling_unit_description">Polling Unit Description</label>
                            <input
                                v-model="form.polling_unit_description"
                                id="polling_unit_description"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300"
                                type="text"
                            />
                        </div>
                        <div class="mt-6 flex items-center justify-between space-x-10">
                            <div class="w-full">
                                <label for="polling_unit_lat">LAT</label>
                                <input
                                    v-model="form.lat"
                                    id="polling_unit_id"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300"
                                    type="text"
                                />
                            </div>
                            <div class="w-full">
                                <label for="polling_unit_long">LONG</label>
                                <input
                                    v-model="form.long"
                                    id="polling_unit_id"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300"
                                    type="text"
                                />
                            </div>
                        </div>
                    </div>

                    <h2 class="mt-12 text-gray-900 font-medium text-lg">Polling Unit Results</h2>
                    <div class="mt-6 px-6">
                        <button
                            @click="addNewResult"
                            type="button"
                            class="flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white font-normal text-sm rounded-md px-5 py-3 cursor-default transition ease-in-out"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <p>Add another result</p>
                        </button>

                        <div class="mt-6">
                            <div v-for="(result, index) in numberOfResults" class="w-full mt-4">
                                <div class="flex items-center justify-between space-x-10">
                                    <div class="w-full">
                                        <label for="party_abbreviation">Party Abbreviation</label>
                                        <input
                                            v-model="form.results[index].party_abbreviation"
                                            id="party_abbreviation"
                                            class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300"
                                            type="text"
                                        />
                                    </div>
                                    <div class="w-full">
                                        <label for="party_score">Party Score</label>
                                        <input
                                            v-model="form.results[index].party_score"
                                            id="party_score"
                                            class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300"
                                            type="number"
                                        />
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div></div>
                                    <button
                                        @click="removeResult(index)"
                                        type="button"
                                        class="mt-3 flex items-center space-x-2 bg-rose-600 hover:bg-rose-700 text-white font-normal text-sm rounded-md px-5 py-2 cursor-default transition ease-in-out"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        <p>Remove</p>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center space-x-2">
                        <Link
                            :href="route('polling_unit.index')"
                            class="mt-6 shadow-sm bg-gray-200 hover:bg-gray-300 text-gray-900 font-normal text-sm rounded-md px-8 py-2.5 cursor-default transition ease-in-out"
                        >
                            Cancel
                        </Link>
                        <button
                            type="submit"
                            class="mt-6 shadow-sm bg-blue-600 hover:bg-blue-700 text-white font-normal text-sm rounded-md px-8 py-2.5 cursor-default transition ease-in-out"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>
