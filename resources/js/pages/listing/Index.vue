<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import ListingAddress from '@/components/ListingAddress.vue';
import type { Listing } from '@/types';

interface IProps {
    listings: Listing[];
}

defineProps<IProps>();
</script>

<template>
    <Head title="Listing" />
    <div class="container mx-auto">
        <div v-for="listing in listings" :key="listing.id">
            <Link :href="`/listing/${listing.id}`">
                <ListingAddress :listing="listing" />
            </Link>
        </div>
    </div>
</template>
