<script setup lang="ts">
import { DataSource } from "@/types";
import {
    NButton,
    NDivider,
    NFormItem,
    NModal,
    NTreeSelect,
    TreeSelectOption,
} from "naive-ui";
import JIcon from "@/Components/App/JIcon.vue";
import { onMounted, ref } from "vue";
import axios from "axios";

interface Props {
    account: DataSource;
}

const { account } = defineProps<Props>();
const emit = defineEmits(["close"]);

const folder = ref<string | null>(null);
const loading_folders = ref<boolean>(false);
const initialFolders = ref([]);
const options = ref([
    {
        label: "l-0",
        key: "v-0",
        depth: 1,
        isLeaf: false,
    },
]);

const show = defineModel<boolean>("show", { default: false });

function getFolders(name?: string) {
    return new Promise((resolve, reject) => {
        loading_folders.value = true;
        axios
            .get(`/integrations/${account.app.name_slug}/${account.id}/folders`)
            .then(({ data }) => {
                console.log("Fetched folders--->", data);
                initialFolders.value = data;
                resolve(data);
            })
            .catch((e) => {
                console.log(e);
                reject(e);
            })
            .finally(() => (loading_folders.value = false));
    });
}

function getChildren(option: TreeSelectOption) {
    const children = [];
    for (let i = 0; i <= (option as { depth: number }).depth; ++i) {
        children.push({
            label: `${option.label}-${i}`,
            key: `${option.label}-${i}`,
            depth: (option as { depth: number }).depth + 1,
            isLeaf: option.depth === 3,
        });
    }
    return children;
}

function handleLoad(option: TreeSelectOption) {
    return new Promise<void>((resolve) => {
        window.setTimeout(() => {
            option.children = getChildren(option);
            resolve();
        }, 1000);
    });
}

onMounted(() => {
    getFolders();
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
    >
        <n-divider title-placement="left"> 🔥 Setup hot folder </n-divider>
        <n-form-item label="Select folder">
            <n-tree-select
                v-model:value="folder"
                :loading="loading_folders"
                block-line
                checkable
                :options="options"
                cascade
                check-strategy="all"
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
            <n-button size="small" @click="emit('close')"> Done </n-button>
        </div>
    </n-modal>
</template>

<style scoped></style>
