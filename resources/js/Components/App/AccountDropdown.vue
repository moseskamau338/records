<script setup lang="ts">
import { NAvatar, NButton, NDivider, NPopover } from "naive-ui";
import { useHelpers } from "@/utils/composables/useHelpers";
import { router, usePage } from '@inertiajs/vue3'
import JIcon from "@/Components/App/JIcon.vue";
import CreateTeam from "@/Components/Teams/CreateTeam.vue";
import {ref} from "vue";

const page = usePage()

function logout(){
    router.post('/logout', {
      _token: page.props.csrf_token,
    })
}
const show_create_team = ref(false)
</script>

<template>
    <n-popover trigger="click" :show-arrow="false">
        <template #trigger>
            <n-button quaternary>
                <template #icon>
                    <n-avatar size="small" :size="24" :color="useHelpers().colorFromInitials($page.props.auth.user?.name)" class="grow-0 shrink-0">{{
                        useHelpers().getInitials($page.props.auth.user?.name)
                    }}</n-avatar>
                </template>
                <span class="ml-2">{{ $page.props.auth.user?.current_team?.name }}</span>
            </n-button>
        </template>
        <div class="w-[250px]">
            <div class="text-center">{{ $page.props.auth.user?.email }}</div>
            <ul class="mt-4 flex flex-col space-y-2">
                <li :key="team.id" v-for="team in $page.props.auth.user.teams" class="flex flex-row space-x-2 items-center">
                    <n-avatar :color="useHelpers().colorFromInitials(team.name)" :size="24">{{useHelpers().getInitials(team.name)}}</n-avatar>
                    <span>{{ team.name }}</span>
                </li>
            </ul>
            <n-button block type="primary" class="mt-4" @click="show_create_team = true">+ Create team</n-button>
            <n-divider />

            <div class="flex flex-col space-y-2">
                <n-button text class="flex justify-start">
                    <template #icon>
                        <j-icon name="material-symbols-light:settings" />
                    </template>
                    Manage Team
                </n-button>
                <n-button @click="logout" text class="flex justify-start">
                    <template #icon>
                        <j-icon name="material-symbols-light:logout" />
                    </template>
                    Logout
                </n-button>
            </div>
        </div>
    </n-popover>

    <CreateTeam v-model:show="show_create_team" />
</template>

<style scoped></style>
