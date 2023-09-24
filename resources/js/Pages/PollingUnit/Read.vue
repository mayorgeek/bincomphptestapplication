<script setup>
import {Head,Link} from "@inertiajs/vue3";

defineProps({
   results: {
       type: Array,
       required: true,
       default: []
   },
   pollingUnit: {
       type: Object,
       required: true,
       default: {}
   }
});
</script>

<template>
    <Head :title="`#${pollingUnit.polling_unit_number} Results`" />
    <div>
        <div class="px-6 py-10 bg-slate-100">
            <section class="container px-4 mx-auto">
                <h1 class="text-gray-900 font-bold text-2xl">
                    <span class="text-green-600">#{{pollingUnit.polling_unit_number}}</span> - Results
                </h1>
                <p class="mt-2 text-gray-800 font-medium text-lg">
                    Here are all the results for <i class="text-red-600">{{pollingUnit.polling_unit_name}}</i> polling unit.
                </p>

                <Link
                    :href="route('polling_unit.index')"
                    class="w-fit flex items-center space-x-1 mt-4 text-md text-blue-600 hover:underline font-medium"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
                    </svg>
                    <p>Go Back</p>
                </Link>

                <div class="flex flex-col mt-6">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 h-[600px] overflow-scroll">
                            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">

                                <template v-if="results.length > 0">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                            <tr>
                                                <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Party Abbreviation
                                                </th>

                                                <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Party Score
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                            <tr v-for="result in results">
                                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                <h4 class="text-gray-700 dark:text-gray-200">{{result.party_abbreviation}}</h4>
                                            </td>
                                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                <h4 class="text-gray-700 dark:text-gray-200">{{result.party_score}}</h4>
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
