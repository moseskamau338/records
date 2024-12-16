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

                <div class="flex-1 flex flex-row space-x-2 justify-end">
                    <n-button tertiary type="primary">
                        <template #icon>
                            <i class="icon icon-400">list</i>
                        </template>
                        Recon stories
                    </n-button>
                    <AccountDropdown />
                </div>
            </n-layout-header>
        </template>

        <main class="relative">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad
            architecto aspernatur commodi culpa cum ducimus error ex illo porro,
            quidem quis ratione repellat sapiente vel vero vitae voluptas. Hic,
            nemo.
        </main>
    </AuthenticatedLayout>
</template>

<style scoped></style>
