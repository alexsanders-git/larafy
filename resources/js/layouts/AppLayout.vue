<script setup lang="ts">
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const successMessage = computed(
    () => page.props.flash.success
);

const user = computed(
    () => page.props.user
);
</script>

<template>
    <div>
        <header class="w-full py-4 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
            <div class="container mx-auto px-4">
                <nav class="flex items-center justify-between gap-2">
                    <Link :href="route('listing.index')" class="font-medium text-lg">Listing</Link>

                    <Link :href="route('home')"
                          class="font-bold text-xl text-center text-indigo-600 dark:text-indigo-300">Larafy
                    </Link>

                    <div v-if="user" class="flex items-center gap-2">
                        <div class="text-sm text-gray-500">{{ user.name }}</div>
                        <Link :href="route('listing.create')" class="button-primary">+ New Listing</Link>
                        <Link :href="route('logout')" method="delete" as="button">Logout</Link>
                    </div>

                    <div v-else>
                        <Link :href="route('login')">Login</Link>
                    </div>
                </nav>
            </div>
        </header>

        <main class="py-4">
            <div class="container mx-auto px-4">
                <div
                    v-if="successMessage"
                    class="mb-4 p-2 bg-green-50 dark:bg-green-900 rounded-md border border-green-200 dark:border-green-800 shadow-sm"
                >
                    {{ successMessage }}
                </div>

                <slot />
            </div>
        </main>
    </div>
</template>
