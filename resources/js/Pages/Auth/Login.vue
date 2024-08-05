<script setup lang="ts">
import { Head, Link, useForm } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

defineOptions({ layout: HomeLayout });

const props = defineProps<{
    message?: string;
}>();

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => {
            form.reset("password");
        },

        // onError: (errors: any) => {
        //     if (form.errors.email) {
        //         toast(form.errors.email, {
        //             theme: toast.THEME.COLORED,
        //             position: "top-center",
        //             transition: toast.TRANSITIONS.FLIP,
        //             type: toast.TYPE.ERROR,
        //         });
        //     }

        //     if (form.errors.password) {
        //         toast(form.errors.password, {
        //             theme: toast.THEME.COLORED,
        //             position: "top-center",
        //             transition: toast.TRANSITIONS.FLIP,
        //             type: toast.TYPE.ERROR,
        //         });
        //     }
        // },
    });
};
</script>

<template>
    <Head title="Login" />

    <form
        action="#"
        @submit.prevent="submit"
        class="grid justify-center justify-items-center grid-cols-2 gap-5 p-5 my-5 w-[80%] self-center"
    >
        <div class="grid flex-wrap w-full grid-cols-1 col-span-2 gap-2">
            <ui-input
                type="text"
                id="email"
                name="email"
                placeholder="Email"
                label="Email"
                :is-required="true"
                v-model="form.email"
                :error="form.errors.email"
            />
        </div>
        <div class="grid w-full grid-cols-1 col-span-2 gap-2">
            <ui-input
                type="text"
                id="password"
                name="password"
                placeholder="Password"
                label="Password"
                :is-required="true"
                v-model="form.password"
                :error="form.errors.password"
            />
        </div>

        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 justify-self-start col-span-2"
        >
            Login
        </button>

        <div class="w-full text-sm font-medium text-white">
            Not registered?
            <Link
                href="/register"
                class="px-2 py-3 text-red-400 transition-all duration-200 hover:text-white hover:bg-red-300 hover:rounded-md hover:shadow-sm"
            >
                Create account</Link
            >
        </div>
    </form>
</template>
