<script setup lang="ts">
import { NAvatar, NButton, NDivider, NPopover } from "naive-ui";
import { useHelpers } from "@/utils/composables/useHelpers";
</script>

<template>
    <n-popover trigger="click" :show-arrow="false">
        <template #trigger>
            <n-button quaternary>
                <template #icon>
                    <n-avatar size="small" class="grow-0 shrink-0">{{
                        useHelpers().getInitials($page.props.auth.user?.name)
                    }}</n-avatar>
                </template>
                <span class="ml-2">Moses' Team</span>
            </n-button>
        </template>
        <div class="w-[250px]">
            <div class="text-center">{{ $page.props.auth.user?.email }}</div>
            <ul class="mt-4 flex flex-col space-y-2">
                <li class="flex flex-row space-x-2 items-center">
                    <n-avatar color="#FF6928">MT</n-avatar>
                    <span>Mikes Team</span>
                </li>
                <li class="flex flex-row space-x-2 items-center">
                    <n-avatar color="#415BEF">MT</n-avatar>
                    <span>Moses' Team</span>
                </li>
            </ul>
            <n-button block type="primary" class="mt-4">+ Create team</n-button>
            <n-divider />

            <div class="flex flex-col space-y-2">
                <n-button text class="flex justify-start">
                    <template #icon>
                        <i class="icon">settings</i>
                    </template>
                    Manage Team
                </n-button>
                <n-button text class="flex justify-start">
                    <template #icon>
                        <i class="icon">logout</i>
                    </template>
                    Logout
                </n-button>
            </div>
        </div>
    </n-popover>
</template>

<style scoped></style>
