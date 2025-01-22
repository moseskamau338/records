<script setup lang="ts">
import { DataSource } from "@/types";
import {
    NButton,
    NDivider,
    NFormItem,
    NModal,
    NTreeSelect,
    TreeSelectOption,
    useNotification,
} from "naive-ui";
import JIcon from "@/Components/App/JIcon.vue";
import { onMounted, ref } from "vue";
import axios from "axios";

interface Props {
    account: DataSource;
}

const { account } = defineProps<Props>();
const emit = defineEmits(["close"]);

const notification = useNotification();
const folder = ref<{ key: string; label: string } | null>(null);
const loading_folders = ref<boolean>(false);
const loading = ref<boolean>(false);
const initialFolders = ref<{ key: string; label: string }[]>([]);

const show = defineModel<boolean>("show", { default: false });

function getFolders(
    folder_id?: string,
): Promise<{ id: string; name: string }[]> {
    return new Promise((resolve, reject) => {
        loading_folders.value = true;
        axios
            .get(
                `/integrations/${account.app.name_slug}/${account.id}/folders`,
                {
                    params: folder_id ? { folder_id } : {},
                },
            )
            .then(({ data }) => {
                resolve(data);
            })
            .catch((e) => {
                console.log(e);
                reject(e);
            })
            .finally(() => (loading_folders.value = false));
    });
}

async function getChildren(option: TreeSelectOption) {
    const children = [];
    const folders = await getFolders(option.key as string);
    for (const folder of folders) {
        children.push({
            label: folder.name,
            key: folder.id,
            isLeaf: false,
        });
    }
    return children;
}

function handleLoad(option: TreeSelectOption) {
    return new Promise<void>(async (resolve) => {
        option.children = await getChildren(option);
        resolve();
    });
}

function setHotFolder(): Promise<void> {
    return new Promise((resolve, reject) => {
        if (!folder.value) {
            notification.error({
                content: "Please select a folder",
                duration: 6000,
            });
            return;
        }
        loading.value = true;
        axios
            .post("/hot-folder/store", {
                folder: folder.value,
                app: account.app.name_slug,
                account_id: account.id,
            })
            .then(({ data }) => {
                notification.success({
                    content: "Hot folder set successfully!",
                    duration: 6000,
                });
                emit("close");
                resolve(data);
            })
            .catch((e) => {
                console.log(e);
                notification.error({
                    content: e.response
                        ? e.response.data.message | e.response.data.error
                        : e.message,
                    duration: 6000,
                });
                reject(e);
            })
            .finally(() => (loading.value = false));
    });
}

onMounted(async () => {
    const _ = await getFolders();
    initialFolders.value = _.map((f) => ({
        key: f.id,
        label: f.name,
        isLeaf: false,
    }));
});
</script>

<template>
    <n-modal
        @close="emit('close')"
        :show="show"
        preset="card"
        title="Configure connection"
        size="small"
        closable
        class="max-w-lg"
        :loading="loading"
    >
        <n-divider title-placement="left"> 🔥 Setup hot folder </n-divider>
        <n-form-item label="Select folder">
            <n-tree-select
                :value="folder?.key"
                :on-update:value="(v, o) => (folder = o)"
                :loading="loading_folders"
                block-line
                :options="initialFolders"
                cascade
                show-path
                :on-load="handleLoad"
            />
        </n-form-item>

        <n-divider title-placement="left"> Danger </n-divider>
        <n-button type="error" ghost size="small">
            <template #icon>
                <j-icon name="material-symbols-light:power-plug-off" />
            </template>
            Delete connection
        </n-button>

        <div class="flex flex-row space-x-2 justify-end">
            <n-button
                size="small"
                :disabled="!folder || loading"
                @click="setHotFolder"
                :loading="loading"
            >
                Save settings
            </n-button>
        </div>
    </n-modal>
</template>

<style scoped></style>
