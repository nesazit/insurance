<script setup lang="ts">
import { Icon } from "@iconify/vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";

defineOptions({ layout: DashboardLayout });

const user = usePage().props.auth.user;

defineProps<{
    canResetPassword?: boolean;
    status?: string;
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
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <div
        class="grid w-full grid-cols-2 row-span-2 row-start-1 gap-2 px-4 py-3 text-gray-800 bg-white rounded-md shadow-md"
    >
        <div class="grid w-full grid-cols-1 gap-3">
            <div class="grid grid-cols-[30px_1fr] items-center gap-2">
                <Icon
                    icon="mdi:account-circle"
                    height="30"
                    class="text-gray-600"
                />
                <h1>{{ user.name }}</h1>
            </div>
            <div class="grid grid-cols-[30px_1fr] items-center gap-2">
                <Icon icon="mdi:email" height="30" class="text-gray-600" />
                <h1>{{ user.email }}</h1>
            </div>
            <div class="grid grid-cols-[30px_1fr] items-center gap-2">
                <Icon icon="mdi:phone" height="30" class="text-gray-600" />
                <h1>{{ user.phone }}</h1>
            </div>
        </div>

        <div class=""></div>
    </div>
</template>
