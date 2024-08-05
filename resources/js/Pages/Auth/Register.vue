<script setup lang="ts">
import { Head, Link, useForm } from "@inertiajs/vue3";

defineOptions({ layout: HomeLayout });
const form = useForm({
    name: "",
    email: "",
    phone: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => {
            form.reset("password", "password_confirmation");
        },
    });
};
</script>

<template>
    <Head title="Register" />

    <form
        action="#"
        @submit.prevent="submit"
        class="grid justify-center justify-items-center grid-cols-2 gap-5 p-5 my-5 w-[80%] self-center text-left"
    >
        <div class="grid flex-wrap w-full grid-cols-1 gap-2">
            <ui-input
                type="text"
                id="name"
                name="name"
                placeholder="Name"
                label="Name"
                :is-required="true"
                v-model="form.name"
                :error="form.errors.name"
            />
        </div>

        <div class="grid w-full grid-cols-1 gap-2">
            <ui-input
                type="text"
                id="phone"
                name="phone"
                placeholder="Phone"
                label="Phone"
                :is-required="true"
                v-model="form.phone"
                :error="form.errors.phone"
            />
        </div>
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
        <div class="grid w-full grid-cols-1 col-span-2 gap-2">
            <ui-input
                type="text"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="Password Confirmation"
                label="Password Confirmation"
                :is-required="true"
                v-model="form.password_confirmation"
                :error="form.errors.password_confirmation"
            />
        </div>

        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 justify-self-start col-span-2"
        >
            Submit
        </button>

        <div class="w-full text-sm font-medium text-white">
            Already have an account?
            <Link
                href="/login"
                class="px-2 py-3 text-red-400 transition-all duration-200 hover:text-white hover:bg-red-300 hover:rounded-md hover:shadow-sm"
            >
                Login</Link
            >
        </div>
    </form>
</template>
