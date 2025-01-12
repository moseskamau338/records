<script setup lang="ts">
import {NButton, NDivider, NFormItem, NInput, NModal} from "naive-ui";
import JIcon from "@/Components/App/JIcon.vue";
import Connector from "@/Components/Projects/Connector.vue";

const show  = defineModel('show', {default: false})
</script>

<template>
<n-modal v-model:show="show" title="Create project"  preset="card" class="max-w-2xl">
    <h2 class="font-semibold">Start by selecting data sources</h2>
    <p>
        You will need to <b>connect a storage location <u>(🔥hot folder)</u></b> for each required data type.
        Note that in some cases, <b>you might need to consolidate data</b> for specific files to match required pattern.
    </p>
    <br>
    <br>
    <p>
        <b>Supported file types:</b> <br>
        Only the following files are supported. <br>
        <p>Watch this guide to convert large PDF files to Excel or CSV formats</p>
        <ul class="font-bold">
            <li>- Excel (.xls, .xlsx)</li>
            <li>- CSV</li>
        </ul>
    </p>
    <n-divider title-placement="left">
        Choose hot folder sources
    </n-divider>
    <n-form-item label="Bank statement equivalent" class="mt-4">
        <Connector :connection-options="['google_drive','dropbox', 'microsoft_onedrive']" />
    </n-form-item>
    <n-form-item label="Internal records equivalent" >
        <Connector :connection-options="['google_drive','dropbox', 'microsoft_onedrive']" />
    </n-form-item>
    <div class="mt-8 flex flex-row space-x-4 justify-end">
        <n-button size="small">Cancel</n-button>
        <n-button size="small" type="primary" icon-placement="right">Next <template #icon><j-icon name="material-symbols:arrow-right-alt" /></template></n-button>
    </div>
</n-modal>
</template>

<style scoped>

</style>
