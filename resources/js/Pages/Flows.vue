<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {NButton} from "naive-ui";

defineProps<{
    foo?: string;
}>();

</script>

<template>
    <Head title="Flows" />
    <div class="bg-gray-50 text-black/50 min-h-[100vh]">
        <n-button type="primary">{{ foo }}</n-button>
       Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque distinctio eos perferendis sequi temporibus tenetur velit? Eligendi, eveniet veritatis! A beatae doloribus, incidunt iusto maiores mollitia odit recusandae similique.
    </div>
</template>
