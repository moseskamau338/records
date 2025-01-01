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
            <Link href="/projects/create">
                <n-button type="primary" ghost size="small">
                    + Create project
                </n-button>
            </Link>
        </div>
        <div>
            <ul class="mt-8">
                <li v-for="project in projects">
                    <Link
                        :href="`/projects/${project.id}`"
                        class="flex flex-row justify-between hover:bg-indigo-100 dark:hover:bg-indigo-100/10 p-2 group hover:text-brand cursor-pointer"
                    >
                        <div
                            class="flex flex-row items-center space-x-2 group-hover:text-brand dark:group-hover:text-indigo-500"
                        >
                            <j-icon name="material-symbols-light:folder-outline" />
                            <span>{{ project.name }}</span>
                        </div>
                        <n-button
                            tertiary
                            size="small"
                            class="invisible group-hover:visible"
                        >
                            <i class="icon text-md icon-300">delete</i>
                        </n-button>
                    </Link>
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>
