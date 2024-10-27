<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { NBreadcrumb, NBreadcrumbItem, NButton, NDivider } from "naive-ui";

interface Props {
    id: string;
}

defineProps<Props>();
</script>

<template>
    <Head :title="`Flow - ${id}`" />

    <AuthenticatedLayout>
        <template #header><span></span></template>
    </AuthenticatedLayout>
</template>

<style scoped></style>
