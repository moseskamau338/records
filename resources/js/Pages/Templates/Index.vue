<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { NInput, NPagination } from "naive-ui";
</script>

<template>
    <Head title="Templates" />
    <AuthenticatedLayout>
        <header>
            <n-input placeholder="Search for templates" class="!w-1/3" />
        </header>
        <div class="grid grid-cols-5 gap-4 mt-4">
            <div
                class="flex flex-col border dark:border-dark-300 hover:border-brand hover:shadow-md transition-all rounded-sm group"
                v-for="i in 10"
            >
                <div
                    class="rounded-full group-hover:text-brand group-hover:bg-brand/10 bg-neutral-100 dark:bg-dark-200 h-12 w-12 grid place-items-center grow-0 shrink-0 m-2"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 512 512"
                    >
                        <path
                            fill="currentColor"
                            d="M453.547 273.449H372.12v-40.714h81.427zm0 23.264H372.12v40.714h81.427zm0-191.934H372.12v40.713h81.427zm0 63.978H372.12v40.713h81.427zm0 191.934H372.12v40.714h81.427zm56.242 80.264c-2.326 12.098-16.867 12.388-26.58 12.796H302.326v52.345h-36.119L0 459.566V52.492L267.778 5.904h34.548v46.355h174.66c9.83.407 20.648-.291 29.197 5.583c5.991 8.608 5.41 19.543 5.817 29.43l-.233 302.791c-.29 16.925 1.57 34.2-1.978 50.892m-296.51-91.256c-16.052-32.57-32.395-64.909-48.39-97.48c15.82-31.698 31.408-63.512 46.937-95.327c-13.203.64-26.406 1.454-39.55 2.385c-9.83 23.904-21.288 47.169-28.965 71.888c-7.154-23.323-16.634-45.774-25.3-68.515c-12.796.698-25.592 1.454-38.387 2.21c13.493 29.78 27.86 59.15 40.946 89.104c-15.413 29.081-29.837 58.57-44.785 87.825c12.737.523 25.475 1.047 38.212 1.221c9.074-23.148 20.357-45.424 28.267-69.038c7.096 25.359 19.135 48.798 29.023 73.051c14.017.99 27.976 1.862 41.993 2.676M484.26 79.882H302.326v24.897h46.53v40.713h-46.53v23.265h46.53v40.713h-46.53v23.265h46.53v40.714h-46.53v23.264h46.53v40.714h-46.53v23.264h46.53v40.714h-46.53v26.897H484.26z"
                        />
                    </svg>
                </div>
                <span class="p-2 w-full">A mighty long name</span>
            </div>
        </div>

        <div class="mt-8 flex flex-row justify-end">
            <n-pagination />
        </div>
    </AuthenticatedLayout>
</template>
