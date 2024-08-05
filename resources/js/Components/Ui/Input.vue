<template>
    <label
        :for="id"
        class="block my-2 font-bold text-yellow-300 text-md dark:text-white"
        >{{ label }}
        <span v-if="isRequired" class="text-red-500"> *</span></label
    >
    <input
        v-bind="$attrs"
        :id="id"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
        :placeholder="placeholder"
        v-model="model"
    />

    <p v-if="error" class="my-2 text-sm text-red-600 dark:text-red-500">
        {{ error }}
    </p>
</template>

<script lang="ts" setup>
const props = defineProps({
    modelValue: String,
    error: {
        type: [Boolean, String],
        default: false,
    },
    placeholder: String,
    label: String,
    id: String,
    isRequired: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["update:modelValue"]);

const model = useVModel(props, "modelValue", emit);
</script>
