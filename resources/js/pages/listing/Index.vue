<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import type { Listing } from '@/types';
import ListingItem from '@/components/ListingItem.vue';

interface IProps {
    listings: Listing[];
}

defineProps<IProps>();
</script>

<template>
    <Head title="Listing" />
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            <ListingItem v-for="listing in listings" :key="listing.id" :listing="listing" />
        </div>
    </div>
</template>
