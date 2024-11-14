<script setup lang="ts">
import { Block } from "@/types/blocks";
import BlockSelector from "@/Components/App/FlowBuilder/BlockSelector.vue";
import { NButton } from "naive-ui";

interface Props {
    blocks: Block[];
}

const { blocks } = defineProps<Props>();
</script>

<template>
    <div id="trigger-action" class="w-full relative mt-4">
        <n-button
            block
            type="primary"
            ghost
            class="bg-indigo-50 dark:!bg-dark-500"
        >
            <template #icon>
                <i class="icon icon-100">bolt</i>
            </template>
            {{ blocks[0].displayName }}
        </n-button>
        <BlockSelector />
    </div>
</template>

<style scoped></style>
