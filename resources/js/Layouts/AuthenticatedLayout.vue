<script setup lang="ts">
import {
    NLayout,
    NLayoutContent,
    NLayoutHeader,
    NLayoutSider,
    NConfigProvider,
    darkTheme,
} from "naive-ui";
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";
import { useThemeStore } from "@/Stores/themeStore";
import { storeToRefs } from "pinia";

const store = useThemeStore();

const { isDarkMode } = storeToRefs(store);
</script>

<template>
    <n-config-provider :theme="isDarkMode ? darkTheme : null">
        <n-layout has-sider>
            <n-layout-sider
                :width="100"
                content-style="padding: 24px;"
                content-class="!h-[100vh]"
            >
                amsbj
                {{ isDarkMode }}
            </n-layout-sider>
            <n-layout-content content-class="">
                <n-layout-header class="p-4">
                    <ThemeSwitcher v-model:is-dark-mode="isDarkMode" />
                </n-layout-header>
                <slot />
            </n-layout-content>
        </n-layout>
    </n-config-provider>
</template>
