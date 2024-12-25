<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { lightThemeOverrides, darkThemeOverrides } from "@/theme/colors";
import { useThemeStore } from "@/Stores/themeStore";
import { storeToRefs } from "pinia";
import {darkTheme, NConfigProvider} from "naive-ui";

const store = useThemeStore();
const { isDarkMode } = storeToRefs(store);
</script>

<template>
    <n-config-provider
        :theme="isDarkMode ? darkTheme : null"
        :theme-overrides="
            !isDarkMode ? lightThemeOverrides : darkThemeOverrides
        "
    >
    <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-gray-800"
        >
            <slot />
        </div>
    </div>
    </n-config-provider>
</template>
