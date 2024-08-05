<template>
    <Head title="Home" />
    <section class="grid grid-cols-1 gap-2 px-5 my-2 w-[70%] self-center">
        <div class="w-full">
            <h3 class="mb-5 text-3xl font-medium text-white">
                Let's get started
            </h3>
            <p class="text-lg text-gray-200">
                Please select one or more options below that you'd like to have
                qouted for insurance.
            </p>
        </div>
        <section class="grid w-full grid-cols-1 gap-6">
            <div v-for="(item, index) in insurances" :key="index">
                <input
                    type="checkbox"
                    :id="`insurance${index}`"
                    value=""
                    class="hidden peer"
                    :checked="store.userInsurences.includes(item.id)"
                />
                <label
                    @click="handleSelectInsurance(item.id)"
                    :style="{
                        backgroundImage: `linear-gradient(90deg, rgba(0, 0, 0, 0.85) 0%, rgba(33, 33, 33, 0.3) 100%), url(${item.image})`,
                    }"
                    :for="`insurance${index}`"
                    :class="
                        store.userInsurences.includes(item.id)
                            ? ' border-blue-600 text-sky-400 '
                            : ' text-white border-gray-200 '
                    "
                    class="inline-flex items-center justify-between w-full px-5 py-3 bg-white bg-center bg-cover border-2 rounded-lg cursor-pointer hover:text-sky-300 hover:border-sky-500 hover:bg-gray-50"
                >
                    <div class="block">
                        <Icon
                            :icon="item.icon"
                            height="34"
                            class="text-white hover:text-sky-300"
                        />
                        <div class="w-full text-lg font-semibold">
                            {{ item?.title }}
                        </div>
                        <div class="w-full text-sm">
                            {{ item?.description }}
                        </div>
                    </div>
                </label>
            </div>
        </section>

        <button
            @click="handleSubmit"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none justify-self-center col-span-1 w-[70%]"
        >
            Agree and Continue
        </button>
    </section>
</template>

<script lang="ts" setup>
import { router, usePage, Head } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

import { useUserStore } from "@/stores/UserStore";

defineOptions({ layout: HomeLayout });

const user = usePage().props.auth.user;

const store = useUserStore();
interface Insurance {
    id: number;
    title: string;
    description: string;
    icon: string;
    image: string;
    price: number;
    duration: number;
}

const handleSelectInsurance = (insuranceId: number) => {
    store.selectInsurance(insuranceId);
};

const handleSubmit = () => {
    if (store.userInsurences.length > 0) {
        if (user) {
            router.get("/information/lists");
        } else {
            router.visit("/login", {
                method: "get",
                onSuccess: (page: any) => {
                    toast("You Need to Login First", {
                        theme: toast.THEME.COLORED,
                        position: "top-center",
                        transition: toast.TRANSITIONS.FLIP,
                        type: toast.TYPE.ERROR,
                    });
                },
            });
        }
    } else {
        toast("Please select an insurance", {
            theme: toast.THEME.COLORED,
            position: "top-center",
            transition: toast.TRANSITIONS.FLIP,
            type: toast.TYPE.ERROR,
            //   toastStyle: {
            //     fontFamily: "font-primary",
            //   },
        });
    }
};

const props = defineProps<{
    insurances?: Insurance[];
}>();
</script>
