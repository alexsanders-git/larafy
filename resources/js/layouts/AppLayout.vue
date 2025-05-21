<script setup lang="ts">
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Bell } from 'lucide-vue-next';

const page = usePage();
const successMessage = computed(
    () => page.props.flash.success
);

const user = computed(
    () => page.props.user
);

const notificationCount = computed(
    () => Math.min(page.props.user.notificationCount, 9)
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
                        <div class="text-gray-500 relative pr-2 py-2 text-lg">
                            <Bell />

                            <div
                                v-if="notificationCount"
                                class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-500 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center"
                            >
                                {{ notificationCount }}
                            </div>
                        </div>

                        <Link :href="route('realtor.listing.index')" class="text-sm text-gray-500">
                            {{ user.name }}
                        </Link>
                        <Link :href="route('realtor.listing.create')" class="button-primary">+ New Listing</Link>
                        <Link :href="route('logout')" method="delete" as="button">Logout</Link>
                    </div>

                    <div v-else class="flex items-center gap-2">
                        <Link :href="route('login')">Login</Link>
                        <Link :href="route('account.create')">Register</Link>
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
