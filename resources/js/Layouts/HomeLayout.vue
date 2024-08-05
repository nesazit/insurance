<template>
    <main
        class="w-[100vw] h-[100vh] bg-cover bg-center flex justify-center items-center"
        :style="{ backgroundImage: `url(${BgImg})` }"
    >
        <article
            class="bg-[#454c77ba] border-4 border-yellow-400 ring-yellow-300 p-10 rounded-3xl shadow-md w-4/5 h-[80vh] flex flex-col gap-10"
        >
            <header class="grid items-center content-center w-full grid-cols-2">
                <div class="w-full">
                    <div
                        v-if="store.isLoggedIn"
                        class="flex items-center gap-4 px-4 py-2 bg-white rounded-xl w-[250px]"
                    >
                        <!-- <img
                            class="w-10 h-10 rounded-full"
                            src="/docs/images/people/profile-picture-5.jpg"
                            alt=""
                        /> -->

                        <Link href="/dashboard">
                            <svg
                                class="w-10 h-10 p-1 duration-200 rounded-full text-slate-200 bg-slate-500 hover:text-slate-500 hover:bg-slate-200"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </Link>
                        <div class="font-medium dark:text-white">
                            <div>
                                {{ user.name }}
                            </div>
                            <div
                                class="text-sm text-gray-500 dark:text-gray-400"
                            >
                                {{ user.phone }}
                            </div>
                        </div>

                        <Link href="/logout" method="post" as="button">
                            <Icon
                                icon="mdi:logout"
                                height="34"
                                class="text-gray-600 duration-200 hover:text-red-800"
                            />
                        </Link>
                    </div>
                    <div
                        v-else
                        class="px-4 py-2 text-white rounded-md opacity-100 bg-slate-800 hover:bg-slate-700 w-[150px] text-center"
                    >
                        <Link href="/login" class="hover:text-blue-500"
                            >Login</Link
                        >
                        <span> / </span>
                        <Link href="/register" class="hover:text-blue-500"
                            >Register</Link
                        >
                    </div>
                </div>

                <div class="text-end">
                    <Link
                        href="/"
                        class="px-4 py-2 text-2xl font-bold text-white transition-all duration-200 border-2 border-white rounded-md hover:border-yellow-400 hover:text-yellow-400 hover:ring-yellow-300"
                    >
                        Home
                    </Link>
                </div>
            </header>

            <slot />
        </article>
    </main>
</template>

<script lang="ts" setup>
import BgImg from "@/assets/images/bg-1.png";
import { useUserStore } from "@/stores/UserStore";
import { Icon } from "@iconify/vue";
import { Link, usePage } from "@inertiajs/vue3";

const store = useUserStore();

const user = usePage().props.auth.user;
</script>
