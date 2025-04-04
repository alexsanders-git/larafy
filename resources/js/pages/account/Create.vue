<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null
});

const register = () => form.post(route('account.store'));
</script>

<template>
    <Head title="Registration" />
    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="name" class="label">Username</label>
                <input v-model="form.name" type="text" id="name" class="input" />
                <div v-if="form.errors.name" class="input-error">{{ form.errors.name }}</div>
            </div>

            <div class="mt-4">
                <label for="email" class="label">E-mail</label>
                <input v-model="form.email" type="email" id="email" class="input" />
                <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
            </div>

            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input v-model="form.password" type="password" id="password" class="input" />
                <div v-if="form.errors.password" class="input-error">{{ form.errors.password }}</div>
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="label">Confirm Password</label>
                <input v-model="form.password_confirmation" type="password" id="password_confirmation" class="input" />
            </div>

            <div class="mt-4">
                <button type="submit" class="button-primary w-full">Create Account</button>

                <div class="mt-2 text-center">
                    <Link :href="route('login')" class="text-sm text-gray-500">
                        Already have an account? Click here
                    </Link>
                </div>
            </div>
        </div>
    </form>
</template>
