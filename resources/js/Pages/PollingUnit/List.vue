<script setup>
import {Head,Link} from "@inertiajs/vue3";

defineProps({
    pollingUnits: {
        type: Array,
        required: true,
        default: []
    }
})
</script>

<template>
    <Head title="Polling Units" />
    <div class="px-6 py-10 bg-slate-100">
        <section class="container px-4 mx-auto">
            <h1 class="text-gray-900 font-bold text-2xl">Polling Units</h1>
            <p class="mt-2 text-gray-800 font-medium text-lg">Here are all the polling units for the election.</p>
            <div class="mt-2 flex justify-between">
                <div></div>
                <div class="flex space-x-4">
                    <Link
                        :href="route('polling_unit.sumOfPollingUnitResults')"
                        class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-normal text-sm rounded-md px-7 py-3 cursor-default transition ease-in-out"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p>View Total Results</p>
                    </Link>
                    <Link
                        :href="route('polling_unit.create')"
                        class="flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white font-normal text-sm rounded-md px-7 py-3 cursor-default transition ease-in-out"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <p>Add Polling Unit</p>
                    </Link>
                </div>
            </div>

            <div class="flex flex-col mt-6">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 h-[600px] overflow-scroll">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Polling Unit Number
                                    </th>

                                    <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Polling Unit Name
                                    </th>

                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Polling Unit Description
                                    </th>

                                    <th scope="col" class="relative py-3.5 px-4">
                                        <span class="sr-only">View</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                <tr v-for="unit in pollingUnits">
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <h4 class="text-gray-700 dark:text-gray-200">{{unit.polling_unit_number}}</h4>
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <h4 class="text-gray-700 dark:text-gray-200">{{unit.polling_unit_name}}</h4>
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <h4 class="text-gray-700 dark:text-gray-200">{{unit.polling_unit_description}}</h4>
                                    </td>

                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <Link
                                            :href="route('polling_unit.show', unit.uniqueid)"
                                            class="text-blue-500 hover:underline"
                                        >
                                            View Result
                                        </Link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
