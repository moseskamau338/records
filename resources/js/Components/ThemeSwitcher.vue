<template>
    <n-switch
        :value="isDarkMode"
        @update:value="toggleDarkMode"
        size="small"
        :rail-style="railStyle"
    >
        <template #checked-icon> 🌙 </template>
        <template #unchecked-icon> ☀️ </template>
    </n-switch>
</template>

<script setup lang="ts">
import { onMounted } from "vue";
import { NSwitch } from "naive-ui";
import { CSSProperties } from "vue";
import { useThemeStore } from "@/Stores/themeStore";
import { storeToRefs } from "pinia";

const store = useThemeStore();
const { toggleDarkMode, applyDarkMode } = store;

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
function railStyle({ checked }: { checked: boolean }) {
    const style: CSSProperties = {};
    if (checked) {
        style.background = "#1d3452";
    }
    return style;
}
</script>

<style scoped></style>
