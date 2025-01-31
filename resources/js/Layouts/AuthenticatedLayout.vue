<script setup lang="ts">
import {
    NLayout,
    NLayoutContent,
    NLayoutHeader,
    NLayoutSider,
    NConfigProvider,
    darkTheme,
    NMessageProvider,
    NButton,
    NNotificationProvider,
    NDialogProvider,
} from "naive-ui";
import { useThemeStore } from "@/Stores/themeStore";
import { storeToRefs } from "pinia";
import { lightThemeOverrides, darkThemeOverrides } from "@/theme/colors";
import { Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import AccountDropdown from "@/Components/App/AccountDropdown.vue";
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";
import JIcon from "@/Components/App/JIcon.vue";
import BreadCrumb from "@/Components/App/BreadCrumb.vue";

const store = useThemeStore();

const { isDarkMode } = storeToRefs(store);

const links: { icon: string; name: string; url: string }[] = [
    { icon: "home", name: "Home", url: "/dashboard" },
    { icon: "folder-copy", name: "Projects", url: "/projects" },
    { icon: "power-plug", name: "Connections", url: "/connections" },
];
</script>

<template>
    <n-dialog-provider>
        <n-message-provider>
            <n-notification-provider>
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
                                        <j-icon
                                            :name="`material-symbols-light:${item.icon}${$page.url.startsWith(item.url) ? '' : '-outline'}`"
                                            classes="transition-all"
                                            :size="32"
                                        />
                                        <span
                                            :class="{
                                                'font-medium':
                                                    $page.url.startsWith(
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
                                <j-icon
                                    name="material-symbols-light:security"
                                    classes="transition-all text-olive-900"
                                    :size="32"
                                />
                                <span>Admin</span>
                            </div>
                        </n-layout-sider>
                        <n-layout-content content-class="">
                            <slot name="header">
                                <n-layout-header
                                    class="px-8 py-4 flex flex-row items-center justify-between"
                                >
                                    <BreadCrumb />
                                    <div
                                        class="flex flex-row space-x-2 items-center"
                                    >
                                        <n-button circle quaternary>
                                            <template #icon>
                                                <j-icon
                                                    name="material-symbols-light:notifications-outline"
                                                />
                                            </template>
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
            </n-notification-provider>
        </n-message-provider>
    </n-dialog-provider>
</template>
