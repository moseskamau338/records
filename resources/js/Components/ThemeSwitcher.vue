<template>
    <n-popselect
        :value="isDarkMode"
        @update:value="toggleDarkMode"
        :options="options"
    >
        <n-button quaternary>
            <i v-if="!isDarkMode" class="icon icon-300 text-center"
                >light_mode</i
            >
            <i v-else class="icon icon-300 text-center">dark_mode</i>
        </n-button>
    </n-popselect>
</template>

<script setup lang="ts">
import { h, onMounted, ref } from "vue";
import { NButton, NPopselect } from "naive-ui";
import { useThemeStore } from "@/Stores/themeStore";
import { storeToRefs } from "pinia";

const store = useThemeStore();
const { toggleDarkMode, applyDarkMode } = store;
const options = ref([
    {
        label: () =>
            h(
                "i",
                { class: "icon icon-300 text-center" },
                { default: () => "light_mode" },
            ),
        value: false,
    },
    {
        label: () =>
            h(
                "i",
                { class: "icon icon-300 text-center" },
                { default: () => "dark_mode" },
            ),
        value: true,
    },
]);
const { isDarkMode } = storeToRefs(store);
onMounted(() => {
    // Check local storage for user preference
    if (isDarkMode) {
        applyDarkMode();
    } else if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
        // Optionally check user's system preference
        applyDarkMode();
    }
});
</script>

<style scoped></style>
