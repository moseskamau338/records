<script setup lang="ts">
import { useClipboard } from "@vueuse/core";
import { ref, onMounted } from "vue";
import { NButton, NTooltip } from "naive-ui";

const source = defineModel("content", { default: "" });

// Keep a reference so we can show/hide UI based on SSR vs. client
const clipboard = ref<ReturnType<typeof useClipboard> | null>(null);

onMounted(() => {
    clipboard.value = useClipboard({ source });
});
</script>

<template>
    <!-- Don’t even try to render if we haven’t confirmed client environment -->
    <template v-if="clipboard && clipboard.isSupported">
        <n-button size="small" quaternary @click="clipboard.copy(source)">
            <j-icon v-if="!clipboard.copied" name="ph:copy" />
            <j-icon v-else name="ph:check" />
        </n-button>
    </template>

    <!-- Fallback during SSR or if the browser doesn’t support it -->
    <p v-else>
        <n-tooltip trigger="hover" animated>
            <template #trigger>
                <span>
                    <j-icon name="material-symbols:warning-rounded" />
                </span>
            </template>
            <p class="max-w-[200px]">
                This browser does not support clipboard technology. Ensure site
                is HTTPS
            </p>
        </n-tooltip>
    </p>
</template>
