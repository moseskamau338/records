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
} from "naive-ui";
import { useThemeStore } from "@/Stores/themeStore";
import { storeToRefs } from "pinia";
import { colors } from "@/theme/colors";
import { Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import AccountDropdown from "@/Components/App/AccountDropdown.vue";
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";

const store = useThemeStore();

const { isDarkMode } = storeToRefs(store);

const lightThemeOverrides: GlobalThemeOverrides = {
    common: {
        primaryColor: colors.indigo[950],
        primaryColorHover: colors.indigo[800],
        primaryColorPressed: colors.indigo[950],
        borderColor: colors.olive[300],
    },
    Layout: {
        siderColor: "#F8FAF8",
    },
};

const darkThemeOverrides: GlobalThemeOverrides = {
    common: {
        primaryColor: colors.indigo[500],
        primaryColorHover: colors.indigo[600],
        primaryColorPressed: colors.indigo[900],
        borderColor: colors.dark[300],
    },
    Layout: {
        siderColor: colors.dark[800],
        color: colors.dark[900],
        headerColor: colors.dark[900],
    },
    Dropdown: {
        color: colors.dark["300"],
    },
    Popover: {
        color: colors.dark["500"],
    },
    Input: {
        color: colors.dark["50"],
    },
};

const links: { icon: string; name: string; url: string }[] = [
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
                <ApplicationLogo />
                <div class="flex flex-col space-y-8">
                    <template v-for="item in links">
                        <Link
                            :href="item.url"
                            class="group hover:text-brand dark:hover:text-indigo-500 flex flex-col items-center"
                            :class="[
                                $page.url.startsWith(item.url)
                                    ? 'text-brand dark:text-indigo-500'
                                    : 'text-olive-900',
                            ]"
                        >
                            <span
                                class="transition-all icon icon-200 text-3xl group-hover:icon-filled"
                                :class="[
                                    $page.url.startsWith(item.url)
                                        ? 'icon-filled'
                                        : 'icon-nofill',
                                ]"
                                >{{ item.icon }}</span
                            >
                            <span
                                :class="{
                                    'font-medium': $page.url.startsWith(
                                        item.url,
                                    ),
                                }"
                            >
                                {{ item.name }}
                            </span>
                        </Link>
                    </template>
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

                            <ThemeSwitcher />
                            <AccountDropdown />
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
