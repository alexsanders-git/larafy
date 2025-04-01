<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const successMessage = computed(
    () => page.props.flash.success
);
</script>

<template>
    <div>
        <header>
            <nav class="flex gap-2">
                <Link :href="route('home')">Home</Link>
                <Link :href="route('listing.index')">Listing</Link>
                <Link :href="route('listing.create')">New Listing</Link>
            </nav>

            <div v-if="successMessage" class="p-2 bg-green-500 text-white border border-green-800">
                {{ successMessage }}
            </div>
        </header>

        <main>
            <slot />
        </main>
    </div>
</template>
