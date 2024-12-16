<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    NBreadcrumb,
    NBreadcrumbItem,
    NButton,
    NDivider,
    NInput,
    NPopover,
} from "naive-ui";
import AccountDropdown from "@/Components/App/AccountDropdown.vue";
import BlockRenderer from "@/Components/App/FlowBuilder/BlockRenderer.vue";
import { Block } from "@/types/blocks";

interface Props {
    id: string;
}

defineProps<Props>();
// Example usage of the interfaces
const exampleBlock: Block = {
    id: "block-001",
    type: "data-source",
    displayName: "Google Drive Data Source",
    description: "Fetch data from a specified Google Drive folder.",
    image: "/assets/images/google-drive.png",
    category: "Data Sources",
    schema: [
        {
            name: "integration",
            label: "Integration",
            type: "integration",
            required: true,
            helpText: "Select your Google Drive integration.",
        },
        {
            name: "folderPath",
            label: "Folder Path",
            type: "text",
            required: true,
            placeholder: "/path/to/folder",
            validations: [
                { type: "required", message: "Folder path is required." },
                {
                    type: "regex",
                    value: "^/.*",
                    message: 'Folder path must start with a "/" character.',
                },
            ],
        },
        {
            name: "fileTypes",
            label: "File Types",
            type: "select",
            options: [
                { label: "CSV", value: "csv" },
                { label: "Excel", value: "excel" },
                { label: "JSON", value: "json" },
            ],
            defaultValue: "csv",
            required: true,
            multiple: true,
        },
        {
            name: "includeSubfolders",
            label: "Include Subfolders",
            type: "checkbox",
            defaultValue: false,
        },
        {
            name: "schedule",
            label: "Schedule",
            type: "datetime",
            required: true,
            helpText: "Set the time to fetch data automatically.",
        },
    ],
};
</script>

<template>
    <Head :title="`Flow - ${id}`" />

    <AuthenticatedLayout>
        <template #header>
            <n-layout-header
                class="px-8 py-4 flex flex-row items-center justify-between"
            >
                <div class="flex-1 text-center">
                    <div class="flex flex-row items-center space-x-2">
                        <Link href="/projects">
                            <n-button size="small" tertiary>
                                <template #icon>
                                    <i class="icon icon-300">chevron_left</i>
                                </template>
                            </n-button>
                        </Link>
                        <div>
                            <n-breadcrumb>
                                <n-breadcrumb-item> Home </n-breadcrumb-item>
                                <n-breadcrumb-item>
                                    Projects
                                </n-breadcrumb-item>
                                <n-breadcrumb-item> View </n-breadcrumb-item>
                            </n-breadcrumb>
                        </div>
                    </div>
                </div>

                <div class="flex-1 text-center">
                    <n-popover :arrow="false">
                        <template #trigger>
                            <n-button text icon-placement="right">
                                Project 1 - flow
                                <template #icon>
                                    <i class="icon icon-300"
                                        >keyboard_arrow_down</i
                                    >
                                </template>
                            </n-button>
                        </template>
                        <div class="w-[400px]">
                            <n-input placeholder="Re-name project" />

                            <div
                                class="mt-2 flex justify-end items-center space-x-2"
                            >
                                <n-button type="primary">Save</n-button>
                                <n-button>Close</n-button>
                            </div>
                        </div>
                    </n-popover>
                </div>
                <div class="flex-1 flex flex-row space-x-2 justify-end">
                    <Link :href="`/projects/${id}/recon-stories`">
                        <n-button tertiary type="primary">
                            <template #icon>
                                <i class="icon icon-400">list</i>
                            </template>
                            Recon stories
                        </n-button>
                    </Link>
                    <AccountDropdown />
                </div>
            </n-layout-header>
        </template>

        <main class="relative h-screen bg-dot-pattern">
            <div
                id="flow"
                class="mx-auto w-[367px] flex flex-row justify-center"
            >
                <!--<Trigger />-->
                <BlockRenderer :blocks="[exampleBlock]" />
            </div>
        </main>
    </AuthenticatedLayout>
</template>

<style scoped></style>
