<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import {
    NCard,
    NEmpty,
    NImage,
    NInput,
    NPagination,
    NSpin,
    NTag,
    NButton,
    NP,
} from "naive-ui";
import axios from "axios";
import { onMounted, ref } from "vue";
import { useHelpers } from "@/utils/composables/useHelpers";
import JIcon from "@/Components/App/JIcon.vue";
import { DataSource } from "@/types";
import ConfigureConnection from "@/Components/Integrations/ConfigureConnection.vue";

const loading = ref(false);
const accounts = ref<DataSource[]>([]);
const selected_account = ref<DataSource | null>(null);
const show_account_settings = ref<boolean>(false);

function fetchAccounts() {
    loading.value = true;
    //get connection accounts:
    axios
        .get("/integrations/accounts")
        .then(({ data }) => {
            accounts.value = data.data;
        })
        .catch((e) => {
            console.log("Somethigns wrong---->", e);
        })
        .finally(() => (loading.value = false));
}

function toggleShowAccountSettings(account?: DataSource) {
    if (show_account_settings.value) {
        //close
        show_account_settings.value = false;
        selected_account.value = null;
    } else {
        //open
        selected_account.value = account!;
        show_account_settings.value = true;
    }
}

onMounted(() => {
    fetchAccounts();
});
</script>

<template>
    <Head title="Manage Connections" />
    <AuthenticatedLayout>
        <header class="flex flex-row justify-between items-between">
            <n-input placeholder="Search for templates" class="!w-1/3" />
            <n-button size="small" type="primary">+ Connect a source</n-button>
        </header>
        <div class="mt-4">
            <n-spin :show="loading">
                <div class="grid grid-cols-4 gap-2">
                    <template v-for="account in accounts">
                        <n-card size="small" hoverable>
                            <div>
                                <div
                                    class="flex flex-row justify-between items-center"
                                >
                                    <n-image
                                        width="32"
                                        :src="account.app.img_src"
                                        preview-disabled
                                    />
                                    <n-tag
                                        size="tiny"
                                        :bordered="false"
                                        :type="
                                            account.healthy
                                                ? 'success'
                                                : 'error'
                                        "
                                        >{{
                                            account.healthy ? "Healthy" : "Dead"
                                        }}</n-tag
                                    >
                                </div>
                                <h2 class="font-medium">
                                    {{ account.app.name }}
                                </h2>
                                <div>
                                    <n-tag
                                        size="tiny"
                                        :bordered="false"
                                        v-for="category in account.app
                                            .categories"
                                    >
                                        {{ category }}
                                    </n-tag>
                                </div>
                            </div>
                            <template #footer>
                                <div
                                    class="flex flex-row justify-between items-center"
                                >
                                    <small
                                        >Last updated:
                                        <i>{{
                                            useHelpers()
                                                .dayjs(account.updated_at)
                                                .format("DD MMM, YYYY HH:mm")
                                        }}</i></small
                                    >

                                    <n-button
                                        size="tiny"
                                        quaternary
                                        type="primary"
                                        @click="
                                            () =>
                                                toggleShowAccountSettings(
                                                    account,
                                                )
                                        "
                                    >
                                        Settings
                                    </n-button>
                                </div>
                            </template>
                        </n-card>
                    </template>
                </div>

                <n-empty
                    v-if="!accounts.length"
                    description="No connections available yet"
                >
                    <template #icon>
                        <j-icon
                            name="material-symbols-light:power-plug-outline"
                            :size="56"
                        />
                    </template>
                    <div class="flex flex-col">
                        <n-p depth="3"> No connections available yet </n-p>
                        <n-button size="small" ghost type="primary"
                            >+ Connect sources</n-button
                        >
                    </div>
                </n-empty>
            </n-spin>
        </div>
        <ConfigureConnection
            v-if="selected_account"
            :account="selected_account"
            :show="show_account_settings"
            @close="toggleShowAccountSettings"
        />
    </AuthenticatedLayout>
</template>
