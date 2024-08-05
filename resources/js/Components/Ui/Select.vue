<template>
    <label
        :for="id"
        class="block my-2 font-bold text-yellow-300 text-md dark:text-white"
        >{{ label }}
        <span v-if="isRequired" class="text-red-500"> *</span></label
    >
    <select
        :id="id"
        v-model="model"
        class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    >
        <option selected>Choose a country</option>
        <option v-for="(item, index) in options" :key="index" :value="item.id">
            {{ item.name }}
        </option>
    </select>

    <p v-if="error" class="my-2 text-sm text-red-600 dark:text-red-500">
        {{ error }}
    </p>
</template>

<script lang="ts" setup>
interface Option {
    id: number;
    name: string;
}

const props = defineProps({
    modelValue: [Number, String],
    error: {
        type: [Boolean, String],
        default: false,
    },
    label: String,
    id: String,
    isRequired: {
        type: Boolean,
        default: false,
    },
    options: Array as () => Option[],
});

const emit = defineEmits(["update:modelValue"]);

const model = useVModel(props, "modelValue", emit);
</script>
