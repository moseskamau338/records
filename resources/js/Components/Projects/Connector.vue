<script setup lang="ts">
import {createFrontendClient} from "@pipedream/sdk";
import {NButton, NButtonGroup, useNotification} from "naive-ui";
import { usePage } from '@inertiajs/vue3'
import {ref} from "vue";
import axios from "axios";

interface Props {
    connectionOptions: string[]
}

defineProps<Props>()

const page = usePage()
const notification = useNotification()
const loading = ref(false)
function getTempToken(app_slug: string){
    loading.value = true
    //
    axios.post('/pipedream/connect', {
      _token: page.props.csrf_token,
        app: app_slug
    })
    .then(({data}) => {
         console.log('Pipedream connected--->',data)
        notification.success({content:'Account connection initiated successfully', duration: 6000})
        connectToApp(app_slug, data.data.token)
    })
    .catch((e) => {
        console.log('Error connecting--->', e)
        notification.error({content:'Could not create token', duration: 6000})
    })
        .finally(() => loading.value = false)
}

function connectToApp(appSlug: string, token: string) {
  const pd = createFrontendClient()
    pd.connectAccount({
      app: appSlug,
      token,
      onSuccess: ({ id: accountId }) => {
        console.log(`Account successfully connected: ${accountId}`)
      }
    })
}


</script>

<template>
    <n-button-group>
        <n-button v-for="i in connectionOptions" @click="() => getTempToken(i)" :loading="loading">
            <template #icon>
                <j-icon name="material-symbols:charger-outline" />
            </template>
            Connect {{i}}
        </n-button>
    </n-button-group>
</template>

<style scoped>

</style>
