<script setup lang="ts">
import { Head, Link, useForm, router, usePage } from "@inertiajs/vue3";

import { useUserStore } from "@/stores/UserStore";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

defineOptions({ layout: HomeLayout });

const store = useUserStore();

const user = usePage().props.auth.user;

const form = useForm({
    address: "",
    city: "",
    zip: "",
    province_id: "",
});

interface Province {
    id: number;
    name: string;
}

const props = defineProps({
    provinces: {
        type: Array as () => Province[],
        required: true,
    },
});

const submit = () => {
    form.post(route("information.store"), {
        onFinish: () => {
            // form.reset("password", "password_confirmation");
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
    <Head title="Set Information" />

    <form
        action="#"
        @submit.prevent="submit"
        class="grid justify-center justify-items-center grid-cols-2 gap-5 p-5 my-5 w-[80%] self-center text-left"
    >
        <div class="grid flex-wrap w-full grid-cols-1 col-span-2 gap-2">
            <ui-input
                type="text"
                id="address"
                name="address"
                placeholder="Address"
                label="Address"
                :is-required="true"
                v-model="form.address"
                :error="form.errors.address"
            />
        </div>

        <div class="grid w-full grid-cols-1 gap-2">
            <ui-input
                type="text"
                id="city"
                name="city"
                placeholder="City"
                label="City"
                :is-required="true"
                v-model="form.city"
                :error="form.errors.city"
            />
        </div>
        <div class="grid flex-wrap w-full grid-cols-1 gap-2">
            <ui-input
                type="text"
                id="zip"
                name="zip"
                placeholder="Zip"
                label="Zip"
                :is-required="true"
                v-model="form.zip"
                :error="form.errors.zip"
            />
        </div>
        <div class="grid w-full grid-cols-1 col-span-2 gap-2">
            <!-- <ui-select v-model="form.state" label="State" :options="states" /> -->
            <ui-select
                v-model="form.province_id"
                label="State"
                :is-required="true"
                :options="provinces"
                :error="form.errors.province_id"
            />
        </div>

        <div class="col-span-2 justify-self-start">
            <Link
                href="/"
                class="text-white bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-amber-600 dark:hover:bg-amber-700 focus:outline-none dark:focus:ring-amber-800"
            >
                Back
            </Link>
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            >
                Submit
            </button>
        </div>
    </form>
</template>
