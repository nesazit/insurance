import { usePage } from "@inertiajs/vue3";
import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useUserStore = defineStore("user", () => {
    const userInsurences = ref([]);

    const selectInsurance = (insurance) => {
        if (userInsurences.value.find((ins) => ins === insurance)) {
            userInsurences.value = userInsurences.value.filter(
                (ins) => ins !== insurance
            );
        } else {
            userInsurences.value.push(insurance);
        }

        // console.log(userInsurences.value);
    };

    const isLoggedIn = computed(() => !!usePage().props.auth.user);

    return { userInsurences, isLoggedIn, selectInsurance };
});
