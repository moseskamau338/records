<script setup lang="ts">
import { DataSource } from "@/types";
import {
    NButton,
    NDivider,
    NForm,
    NFormItem,
    NModal,
    NTreeSelect,
    TreeSelectOption,
    useNotification,
} from "naive-ui";
import JIcon from "@/Components/App/JIcon.vue";
import { onMounted, ref } from "vue";
import axios from "axios";
import FrequencyPicker from "@/Components/App/FrequencyPicker.vue";
import { useNaiveForm } from "@/utils/composables/useNaiveForm";

interface Props {
    account: DataSource;
    selectedFolder?: { key: string; label: string; isLeaf: boolean } | null;
}

interface Model {
    folder: { key: string; label: string } | null;
    cron_string: string | undefined;
}

const { account, selectedFolder } = defineProps<Props>();
const emit = defineEmits(["close"]);

const notification = useNotification();
const model = ref<Model>({
    folder: null,
    cron_string: undefined,
});
const loading_folders = ref<boolean>(false);
const loading = ref<boolean>(false);
const initialFolders = ref<{ key: string; label: string }[]>([]);

const { formRef, rules, onSubmit } = useNaiveForm();

rules.value = {
    folder: {
        type: "object",
        required: true,
        message: "Please select a folder",
    },
    cron_string: {
        type: "string",
        required: true,
        message: "Please select a frequency",
    },
};

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
        if (!model.value.folder) {
            notification.error({
                content: "Please select a folder",
                duration: 6000,
            });
            return;
        }

        loading.value = true;
        axios
            .post("/hot-folder/store", {
                folder: model.value.folder,
                app: account.app.name_slug,
                account_id: account.id,
                cron_string: model.value.cron_string,
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
    // utilize prop if exists
    if (selectedFolder) {
        model.value.folder = {
            key: selectedFolder.key,
            label: selectedFolder.label,
        };
    }

    // get new folders
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
        <n-form
            ref="formRef"
            :model="model"
            :rules="rules"
            @submit.prevent="() => onSubmit(setHotFolder)"
        >
            <n-divider title-placement="left"> 🔥 Setup hot folder </n-divider>
            <n-form-item label="Select folder" path="folder">
                <n-tree-select
                    :value="model.folder?.key"
                    :on-update:value="(v, o) => (model.folder = o)"
                    :loading="loading_folders"
                    block-line
                    :options="initialFolders"
                    cascade
                    show-path
                    :on-load="handleLoad"
                />
            </n-form-item>

            <n-form-item :show-label="false" path="cron_string">
                <FrequencyPicker
                    v-model:cron-expression="model.cron_string"
                    label="Set syncronization frequency"
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
                    type="primary"
                    attr-type="submit"
                    size="small"
                    :disabled="!model.folder || loading"
                    :loading="loading"
                >
                    Save settings
                </n-button>
            </div>
        </n-form>
    </n-modal>
</template>

<style scoped></style>
