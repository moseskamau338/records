<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { NAvatar, NButton, NEmpty } from "naive-ui";
import { colors } from "@/theme/colors";

const documentation_links = [
    {
        icon: "rocket",
        link: "",
        title: "Getting Started Guide",
        description: "Set up your first flow and navigate the dashboard.",
    },
    {
        icon: "conversion_path",
        link: "",
        title: "Flow Builder Overview",
        description:
            "Learn how to create and configure flows using various blocks.",
    },
    {
        icon: "electrical_services",
        link: "",
        title: "Integration Setup",
        description:
            "Connect your data sources like Google Drive, OneDrive, SharePoint, and more.",
    },
    {
        icon: "monitoring",
        link: "",
        title: "Reports and Analytics",
        description:
            "Discover how to generate custom reports and analyze your data.",
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 mt-8">
            <div class="col-span-8">
                <h1 class="text-3xl">Welcome Ken</h1>
                <p class="prose mt-4 dark:text-olive-500">
                    Use the shortcuts below to access quick actions revolving
                    around your normal workflow processes. You can also follow
                    the documentation links below for clear guidelines on how to
                    orchestrate your solution.
                </p>
                <div class="flex flex-row space-x-2 py-8">
                    <n-button type="primary" ghost strong>
                        <template #icon>
                            <i class="icon icon-200">add</i>
                        </template>
                        Create templates
                    </n-button>

                    <n-button type="primary" ghost strong>
                        <template #icon>
                            <i class="icon icon-200">document_scanner</i>
                        </template>
                        Create templates
                    </n-button>

                    <n-button type="primary" ghost strong>
                        <template #icon>
                            <i class="icon icon-200">group</i>
                        </template>
                        Manage team
                    </n-button>
                </div>

                <div class="mt-8">
                    <i
                        class="icon text-5xl icon-200 text-indigo-alpha-700 dark:text-indigo-300/60"
                        >support</i
                    >
                    <h2 class="text-md font-bold prose dark:text-olive-400">
                        Documentation
                    </h2>
                    <p class="prose dark:text-olive-500">
                        Get the most out of our platform, access the full
                        documentation to explore all features and maximize your
                        productivity.
                    </p>
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <template v-for="item in documentation_links">
                            <div
                                class="flex flex-row space-x-2 border border-indigo-400 dark:border-indigo-400/40 hover:border-brand dark:hover:border-indigo-400/60 p-3 rounded group transition-all"
                            >
                                <n-avatar
                                    :color="colors.indigo.alpha['200']"
                                    circle
                                    size="large"
                                    class="shrink-0 grow-0"
                                >
                                    <i
                                        class="transition-all icon icon-300 text-indigo-700 group-hover:text-brand dark:group-hover:text-indigo-400/60 text-3xl"
                                        >{{ item.icon }}</i
                                    >
                                </n-avatar>
                                <div>
                                    <h2 class="text-md font-semibold">
                                        {{ item.title }}
                                    </h2>
                                    <p class="text-sm">
                                        {{ item.description }}
                                    </p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <div class="col-span-4">
                <header class="p-2 bg-olive-200 dark:bg-olive-200/20 rounded">
                    Recent updates
                </header>
                <n-empty class="mt-8" :show-icon="false">
                    <div class="flex flex-col items-center space-y-4">
                        <n-avatar
                            circle
                            class="bg-olive-100 dark:bg-olive-100/20"
                            :size="72"
                        >
                            <i
                                class="icon text-olive-1000 dark:text-olive-100 text-4xl opacity-70"
                                >done_all</i
                            >
                        </n-avatar>
                        <span>All caught up</span>
                    </div>
                </n-empty>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
