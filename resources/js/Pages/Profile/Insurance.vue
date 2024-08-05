<script setup lang="ts">
import { Icon } from "@iconify/vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";

defineOptions({ layout: DashboardLayout });

const user = usePage().props.auth.user;
const props = defineProps<{
    insurances: [];
}>();
console.log(props.insurances);
</script>

<template>
    <Head title="User Insurances List" />

    <div
        class="grid w-full grid-cols-1 row-span-2 row-start-1 gap-2 px-4 py-3 text-gray-800 bg-white rounded-md shadow-md"
    >
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table
                class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input
                                    id="checkbox-all-search"
                                    type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                />
                                <label for="checkbox-all-search" class="sr-only"
                                    >checkbox</label
                                >
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Insurance Name</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Duration</th>
                        <th scope="col" class="px-6 py-3">Buy Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                        v-for="(item, index) in insurances"
                        :key="index"
                    >
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input
                                    id="checkbox-table-search-1"
                                    type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                />
                                <label
                                    for="checkbox-table-search-1"
                                    class="sr-only"
                                    >checkbox</label
                                >
                            </div>
                        </td>
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ index + 1 }}
                        </th>
                        <td class="px-6 py-4">{{ item.insurance.title }}</td>
                        <td class="px-6 py-4">{{ item.insurance.price }}$</td>
                        <td class="px-6 py-4">
                            {{ item.insurance.duration }} Month
                        </td>
                        <td class="px-6 py-4">{{ item.created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
