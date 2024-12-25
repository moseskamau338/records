<script setup lang="ts">
import {NButton, NForm, NFormItem, NInput, NModal, useNotification} from "naive-ui";
import {useForm} from "@inertiajs/vue3";

const notification = useNotification()
const show = defineModel('show', {default: false})
const form = useForm({
  name: null,
})
function createTeam(){
    form.post('/teams', {
        onSuccess(){
            notification.success({content:'Team created successfully', duration: 6000})
            form.name = null
            show.value = false
        },
        onError(args){
            console.log('Args--->', args)
            notification.error({content:'Could not create team', duration: 6000})
        }
    })
}
</script>

<template>
<n-modal v-model:show="show" preset="card" title="Create Team" size="small" closable class="max-w-lg">
    <n-form @submit.prevent="createTeam">
        <n-form-item label="Name" show-feedback :feedback="form.errors?.name" :validation-status="form.errors?.name?.length ? 'error' : undefined">
            <n-input placeholder="Enter team name" v-model:value="form.name" />
        </n-form-item>

        <div class="flex flex-row space-x-2 items-center justify-end">
            <n-button size="small" @click="show = false" :disabled="form.processing">Cancel</n-button>
            <n-button type="primary" attr-type="submit" size="small" :loading="form.processing" :disabled="form.processing">+ Create team</n-button>
        </div>
    </n-form>
</n-modal>
</template>

<style scoped>

</style>
