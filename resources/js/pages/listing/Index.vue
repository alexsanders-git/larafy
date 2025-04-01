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
            <div>
                <Link :href="route('listing.show', listing.id)">
                    <ListingAddress :listing="listing" />
                </Link>
            </div>
            <div>
                <Link :href="route('listing.edit', listing.id)">
                    Edit
                </Link>

                <Link :href="route('listing.destroy', listing.id)" method="delete" as="button">
                    Delete
                </Link>
            </div>
        </div>
    </div>
</template>
