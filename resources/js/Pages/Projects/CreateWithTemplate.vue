<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import {NButton, NInput, NPopselect} from "naive-ui";
import {ref} from "vue";
import JIcon from "@/Components/App/JIcon.vue";
import CreateWizard from "@/Components/Projects/CreateWizard.vue";

const template_filter = ref('all')
const show = ref(false)

</script>

<template>
    <Head title="Projects"/>

    <AuthenticatedLayout>
        <h2 class="font-medium text-lg">Choose template</h2>
        <div class="py-1">
            <n-input placeholder="Search templates..." class="max-w-[400px]"/>
        </div>

        <div class="p-2">
            <n-popselect v-model:value="template_filter" :options="[
                {label:'All templates', value:'all'},
                {label:'2-Way Reconciliation', value:'2-way'},
                {label:'N-Way Reconciliation', value:'n-way'},
            ]">
                <n-button size="small" icon-placement="right">
                    <template #icon>
                        <j-icon name="material-symbols-light:keyboard-arrow-down"/>
                    </template>
                    {{ template_filter }}
                </n-button>
            </n-popselect>
        </div>
        <button
            @click="show = true"
            class="block text-left max-w-[250px] border-2 rounded-sm dark:border-neutral-700 hover:shadow-md transition-all hover:border-brand/60 dark:hover:border-brand/60">
            <img src="/images/Bank-Recon.jpg" class="object-cover h-48 w-96"/>
            <div class="p-2 prose">
                <h4 class="font-bold text-md">Bank Account Reconciliation Template</h4>
                <p class="text-neutral-500">Lorem ipsum dolor sit amet, consecte.</p>
            </div>
        </button>
        <CreateWizard v-model:show="show" />
    </AuthenticatedLayout>
</template>
