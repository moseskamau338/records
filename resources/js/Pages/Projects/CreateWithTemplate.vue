<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { NButton, NDivider } from "naive-ui";
import JIcon from "@/Components/App/JIcon.vue";

const projects = [
    { name: "Sample bank reconciliation", id: "76543567-87654" },
    { name: "Transactions mapping", id: "76500937-87654" },
    { name: "Charges report", id: "776543567-87654" },
];
</script>

<template>
    <Head title="Projects" />

    <AuthenticatedLayout>
        <div class="flex flex-row items-center justify-between mt-4">

            <n-button type="primary" ghost size="small"
                >+ Create project</n-button
            >
        </div>
        <div>
         templates
            {{$page.props.breadcrumbs}}
        </div>
    </AuthenticatedLayout>
</template>
