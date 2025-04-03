<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: null,
    password: null
});

const login = () => form.post(route('login.store'));
</script>

<template>
    <Head title="Login" />
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">E-mail (username)</label>
                <input v-model="form.email" type="email" id="email" class="input" />
                <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
            </div>

            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input v-model="form.password" type="password" id="password" class="input" />
                <div v-if="form.errors.password" class="input-error">{{ form.errors.password }}</div>
            </div>

            <div class="mt-4">
                <button type="submit" class="button-primary w-full">Login</button>
            </div>
        </div>
    </form>
</template>
