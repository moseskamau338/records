<script setup lang="ts">
import {
    NLayout,
    NLayoutContent,
    NLayoutHeader,
    NLayoutSider,
    NConfigProvider,
    darkTheme,
    GlobalThemeOverrides,
    NInput,
    NButton,
    NAvatar,
    NPopover,
    NDivider,
} from "naive-ui";
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";
import { useThemeStore } from "@/Stores/themeStore";
import { storeToRefs } from "pinia";
import { colors } from "@/theme/colors";
import { Link } from "@inertiajs/vue3";

const store = useThemeStore();

const { isDarkMode } = storeToRefs(store);

const lightThemeOverrides: GlobalThemeOverrides = {
    common: {
        primaryColor: colors.indigo[950],
        primaryColorHover: colors.indigo[1000],
        primaryColorPressed: colors.indigo[950],
        borderColor: colors.olive[300],
    },
    Layout: {
        siderColor: "#F8FAF8",
    },
};

const darkThemeOverrides: GlobalThemeOverrides = {
    common: {
        primaryColor: colors.indigo[600],
        primaryColorHover: colors.indigo[800],
        primaryColorPressed: colors.indigo[900],
        borderColor: colors.dark[300],
    },
    Layout: {
        siderColor: colors.dark[800],
        color: colors.dark[900],
        headerColor: colors.dark[900],
    },
};

const links: { icon: string; name: string; url: string } = [
    { icon: "home", name: "Home", url: "/dashboard" },
    { icon: "folder_copy", name: "Projects", url: "/projects" },
    { icon: "document_scanner", name: "Templates", url: "/templates" },
];
</script>

<template>
    <n-config-provider
        :theme="isDarkMode ? darkTheme : null"
        :theme-overrides="
            !isDarkMode ? lightThemeOverrides : darkThemeOverrides
        "
    >
        <n-layout has-sider>
            <n-layout-sider
                :width="100"
                bordered
                content-style="padding: 24px;"
                content-class="!h-[100vh] flex flex-col justify-between"
            >
                <h2>LOGO</h2>
                <div class="flex flex-col space-y-8">
                    <Link
                        :href="item.url"
                        class="text-center group text-olive-900 hover:text-brand"
                        :class="{
                            'text-brand': $page.url.startsWith(item.url),
                        }"
                        v-for="item in links"
                    >
                        <span
                            class="transition-all icon icon-200 text-3xl group-hover:icon-filled"
                            :class="{
                                'icon-filled': $page.url.startsWith(item.url),
                            }"
                            >{{ item.icon }}</span
                        >
                        <span
                            :class="{
                                'font-medium': $page.url.startsWith(item.url),
                            }"
                            >{{ item.name }}</span
                        >
                    </Link>
                </div>
                <div class="text-center">
                    <span
                        class="transition-all icon icon-200 text-olive-900 text-3xl icon-nofill"
                        >security</span
                    >
                    <span>Admin</span>
                </div>
            </n-layout-sider>
            <n-layout-content content-class="">
                <slot name="header">
                    <n-layout-header
                        class="px-8 py-4 flex flex-row items-center justify-between"
                    >
                        <n-input
                            class="!w-[400px]"
                            placeholder="Search projects, members and integrations ..."
                        >
                            <template #prefix>
                                <i class="icon icon-300">search</i>
                            </template>
                        </n-input>

                        <div class="flex flex-row space-x-2 items-center">
                            <n-button circle quaternary>
                                <template #icon
                                    ><i class="icon">notifications</i></template
                                >
                            </n-button>

                            <n-popover trigger="click" :show-arrow="false">
                                <template #trigger>
                                    <n-button quaternary>
                                        <template #icon>
                                            <n-avatar
                                                size="small"
                                                class="grow-0 shrink-0"
                                                >MK</n-avatar
                                            >
                                        </template>
                                        <span class="ml-2">Moses' Team</span>
                                    </n-button>
                                </template>
                                <div class="w-[250px]">
                                    <div class="text-center">
                                        mikes@mailinator.com
                                    </div>
                                    <ul class="mt-4 flex flex-col space-y-2">
                                        <li
                                            class="flex flex-row space-x-2 items-center"
                                        >
                                            <n-avatar color="#FF6928"
                                                >MT</n-avatar
                                            >
                                            <span>Mikes Team</span>
                                        </li>
                                        <li
                                            class="flex flex-row space-x-2 items-center"
                                        >
                                            <n-avatar color="#415BEF"
                                                >MT</n-avatar
                                            >
                                            <span>Moses' Team</span>
                                        </li>
                                    </ul>
                                    <n-button block type="primary" class="mt-4"
                                        >+ Create team</n-button
                                    >
                                    <n-divider />

                                    <div class="flex flex-col space-y-2">
                                        <n-button
                                            text
                                            class="flex justify-start"
                                        >
                                            <template #icon>
                                                <i class="icon">settings</i>
                                            </template>
                                            Manage Team
                                        </n-button>
                                        <n-button
                                            text
                                            class="flex justify-start"
                                        >
                                            <template #icon>
                                                <i class="icon">logout</i>
                                            </template>
                                            Logout
                                        </n-button>
                                    </div>
                                    <n-divider />
                                    <span
                                        class="flex flex-row space-x-2 items-center"
                                    >
                                        <ThemeSwitcher
                                            v-model:is-dark-mode="isDarkMode"
                                        />
                                        <span>{{
                                            isDarkMode
                                                ? "Dark Mode"
                                                : "Light Mode"
                                        }}</span>
                                    </span>
                                </div>
                            </n-popover>
                        </div>
                    </n-layout-header>
                </slot>
                <main class="px-8">
                    <slot />
                </main>
            </n-layout-content>
        </n-layout>
    </n-config-provider>
</template>
