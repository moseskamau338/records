<template>
    <n-popselect
        :value="isDarkMode"
        @update:value="toggleDarkMode"
        :options="options"
    >
        <n-button quaternary>
            <j-icon v-if="!isDarkMode" name="material-symbols-light:light-mode-outline" classes="text-center" />
            <j-icon v-else name="material-symbols-light:dark-mode" classes="text-center" />
        </n-button>
    </n-popselect>
</template>

<script setup lang="ts">
import { h, onMounted, ref } from "vue";
import { NButton, NPopselect } from "naive-ui";
import { useThemeStore } from "@/Stores/themeStore";
import { storeToRefs } from "pinia";
import JIcon from "@/Components/App/JIcon.vue";

const store = useThemeStore();
const { toggleDarkMode, applyDarkMode } = store;
const options = ref([
    {
        label: () =>
            h('div', {class:'flex flex-row space-x-2 items-center'}, [
                h(
                    JIcon,
                    { name: "material-symbols-light:light-mode", classes:'text-center' },
                ),
                h(
                    'p',
                    undefined,
                    { default: () => "Light" },
                ),
            ]),
        value: false,
    },
    {
        label: () =>
            h('div', {class:'flex flex-row space-x-2 items-center'}, [
                h(
                    JIcon,
                    { name: "material-symbols-light:dark-mode", classes:'text-center' },
                ),
                h(
                    'p',
                    undefined,
                    { default: () => "Dark" },
                ),
            ]),
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
