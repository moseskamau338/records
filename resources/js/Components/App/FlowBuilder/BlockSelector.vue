<script setup lang="ts">
import { NButton, NPopover } from "naive-ui";
import BlocksShowcase from "@/Components/App/FlowBuilder/BlocksShowcase.vue";
</script>

<template>
    <span
        class="absolute w-[2px] h-16 bg-indigo-alpha-600 top-full left-1/2 flex flex-col justify-end items-center"
    >
        <n-popover trigger="click" :arrow="false" placement="bottom">
            <template #trigger>
                <n-button circle type="primary" class="absolute top-full" ghost
                    >+</n-button
                >
            </template>
            <BlocksShowcase />
        </n-popover>
    </span>
</template>

<style scoped></style>
