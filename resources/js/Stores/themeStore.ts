import { defineStore } from "pinia";
import { ref } from "vue";

export const useThemeStore = defineStore(
    "theme-store",
    () => {
        const isDarkMode = ref(false);
        const applyDarkMode = () => {
            if (isDarkMode.value) {
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }
        };

        const toggleDarkMode = () => {
            isDarkMode.value = !isDarkMode.value;
            applyDarkMode();
        };

        return { isDarkMode, toggleDarkMode, applyDarkMode };
    },
    { persist: true },
);
