<script setup lang="ts">
import {NButton, NFormItem, NInput, NModal} from "naive-ui";
import JIcon from "@/Components/App/JIcon.vue";
import Connector from "@/Components/Projects/Connector.vue";

const show  = defineModel('show', {default: false})
</script>

<template>
<n-modal v-model:show="show" title="Create project"  preset="card" class="max-w-2xl">
    <h2 class="font-semibold">Start by selecting data sources</h2>
    <n-form-item label="Bank statement equivalent" class="mt-4">
        <Connector :connection-options="['google_drive']" />
    </n-form-item>
    <n-form-item label="Internal records equivalent" >
        <Connector :connection-options="['excel', 'drive']" />
    </n-form-item>
    <div class="mt-8 flex flex-row space-x-4 justify-end">
        <n-button size="small">Cancel</n-button>
        <n-button size="small" type="primary" icon-placement="right">Next <template #icon><j-icon name="material-symbols:arrow-right-alt" /></template></n-button>
    </div>
</n-modal>
</template>

<style scoped>

</style>
