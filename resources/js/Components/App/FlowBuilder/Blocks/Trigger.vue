<script setup lang="ts">
import { NButton } from "naive-ui";
import BlockSelector from "@/Components/App/FlowBuilder/BlockSelector.vue";
</script>

<template>
    <div id="trigger-action" class="w-full relative">
        <n-button block type="primary" ghost>
            <template #icon>
                <i class="icon icon-100">bolt</i>
            </template>
            Trigger
        </n-button>
        <BlockSelector />
    </div>
</template>

<style scoped></style>
