<script setup lang="ts">
import { Head, Link, useForm, router, usePage } from "@inertiajs/vue3";

import { useUserStore } from "@/stores/UserStore";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

defineOptions({ layout: HomeLayout });

const store = useUserStore();

const user = usePage().props.auth.user;

const form = useForm({
    insurances: store.userInsurences,
    information_id: "",
});

interface Information {
    id: number;
    address: string;
    zip: string;
    city: string;
    province: string;
}

const props = defineProps({
    informations: {
        type: Array as () => Information[],
        required: true,
    },
});

const submit = () => {
    form.post(route("user.buy.insurance"), {
        onFinish: () => {
            store.userInsurences = [];
            form.reset("information_id");
        },

        onError: (errors: any) => {
            if (form.errors.information_id) {
                toast(form.errors.information_id, {
                    theme: toast.THEME.COLORED,
                    position: "top-center",
                    transition: toast.TRANSITIONS.FLIP,
                    type: toast.TYPE.ERROR,
                });
            }
        },
    });
};

onMounted(() => {
    if (store.userInsurences.length == 0) {
        router.visit("/", {
            method: "get",
            onSuccess: (page: any) => {
                toast("Please select an insurance", {
                    theme: toast.THEME.COLORED,
                    position: "top-center",
                    transition: toast.TRANSITIONS.FLIP,
                    type: toast.TYPE.ERROR,
                });
            },
        });
    }
});
</script>

<template>
    <Head title="User Informations List" />

    <form
        action="#"
        @submit.prevent="submit"
        class="grid justify-center justify-items-center grid-cols-1 gap-5 p-5 my-5 w-[90%] self-center text-left"
    >
        <div
            class="grid w-full grid-cols-1 gap-2 p-5 bg-white border-2 border-gray-200 rounded-md ps-4"
        >
            <div
                class="flex items-center w-full px-6 py-3 bg-gray-400 rounded-sm"
                v-for="(item, index) in informations"
                :key="index"
            >
                <input
                    :id="`info${index}`"
                    type="radio"
                    :value="item.id"
                    v-model="form.information_id"
                    name="bordered-radio"
                    class="text-blue-600 bg-gray-300 border-gray-300 focus:ring-blue-500 focus:ring-2"
                />
                <label
                    :for="`info${index}`"
                    class="w-full py-4 ml-4 text-sm font-medium text-gray-100"
                >
                    <h1 class="font-medium text-md">
                        Address: {{ item.address }}
                    </h1>
                    <h1 class="font-medium text-md">
                        State: {{ item.province.name }} - City: {{ item.city }}
                    </h1>
                    <h1 class="font-medium text-md">Zip: {{ item.zip }}</h1>
                </label>
            </div>
        </div>

        <div class="col-span-2 justify-self-start">
            <Link
                href="/"
                class="text-white bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none"
            >
                Back
            </Link>
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 d focus:outline-none"
            >
                Submit
            </button>
            <Link
                href="/information"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 d focus:outline-none"
            >
                New Info
            </Link>
        </div>
    </form>
</template>
