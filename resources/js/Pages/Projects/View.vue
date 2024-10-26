<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { NBreadcrumb, NBreadcrumbItem, NButton } from "naive-ui";

interface Props {
    id: string;
}

defineProps<Props>();
</script>

<template>
    <Head :title="id" />

    <AuthenticatedLayout>
        <div class="flex flex-row items-center">
            <div class="flex flex-row items-center space-x-2">
                <Link href="/projects">
                    <n-button size="small" tertiary>
                        <template #icon>
                            <i class="icon icon-300">chevron_left</i>
                        </template>
                    </n-button>
                </Link>
                <h1
                    class="text-2xl font-semibold text-brand dark:text-indigo-500/60"
                >
                    {{ id }}
                </h1>
                <n-divider vertical />
                <div>
                    <n-breadcrumb>
                        <n-breadcrumb-item> home </n-breadcrumb-item>
                        <n-breadcrumb-item> Projects </n-breadcrumb-item>
                        <n-breadcrumb-item> View </n-breadcrumb-item>
                    </n-breadcrumb>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <header class="flex flex-row justify-between items-center">
                <h2 class="text-xl">Reports</h2>
                <div class="flex flex-row items-center space-x-2">
                    <n-button tertiary type="primary">
                        <template #icon>
                            <i class="icon icon-400">conversion_path</i>
                        </template>
                        Flows
                    </n-button>
                    <n-button tertiary type="primary">
                        <template #icon>
                            <i class="icon icon-400">list</i>
                        </template>
                        Recon stories
                    </n-button>
                </div>
            </header>
            <p class="mt-5">Product View {{ id }}</p>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>
