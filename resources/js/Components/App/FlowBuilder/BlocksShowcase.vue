<script setup lang="ts">
import { NIcon, NInput, NScrollbar } from "naive-ui";
</script>

<template>
    <div class="w-[600px]">
        <n-input placeholder="Search blocks" autofocus />
        <n-scrollbar class="max-h-[390px] overflow-y-scroll w-full">
            <ul class="grid grid-cols-4 mt-8 gap-2">
                <li
                    v-for="i in 13"
                    class="w-full bg-neutral-100 dark:bg-dark-400 dark:hover:bg-indigo-950 flex flex-col items-center space-y-6 p-4 rounded hover:bg-indigo-100"
                >
                    <n-icon>GH</n-icon>
                    <span>Title here</span>
                </li>
            </ul>
        </n-scrollbar>
    </div>
</template>

<style scoped></style>
