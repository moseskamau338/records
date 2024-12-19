<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {NFormItem, NInput} from "naive-ui";

const form = useForm({
    company: '',
    domain: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <n-form-item label="Company" :feedback="form.errors.company" feedback-style="color: red">
                <n-input v-model:value="form.company" placeholder="Enter company name" :input-props="{name:'company'}" />
            </n-form-item>

            <n-form-item label="Domain" :feedback="form.errors.domain" feedback-style="color: red">
                <n-input v-model:value="form.domain" placeholder="Enter domain" :input-props="{name:'url'}">
                    <template #suffix>records-2.test</template>
                </n-input>
            </n-form-item>

            <n-form-item label="Name" :feedback="form.errors.name" feedback-style="color: red">
                <n-input v-model:value="form.name" placeholder="Enter a name" :input-props="{name:'name'}" />
            </n-form-item>

            <n-form-item label="Email" :feedback="form.errors.email" feedback-style="color: red">
                <n-input v-model:value="form.email" placeholder="Provide an email" :input-props="{name:'email'}" />
            </n-form-item>

            <n-form-item label="Password" :feedback="form.errors.password" feedback-style="color: red">
                <n-input type="password" show-password-on="click" v-model:value="form.password" placeholder="Enter password" />
            </n-form-item>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
