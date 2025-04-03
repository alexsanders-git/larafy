<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Box from '@/components/Box.vue';
import ListingAddress from '@/components/ListingAddress.vue';
import ListingParams from '@/components/ListingParams.vue';
import ListingPrice from '@/components/ListingPrice.vue';
import type { Listing } from '@/types';

interface IProps {
    listings: Listing[];
}

defineProps<IProps>();
</script>

<template>
    <Head title="Listing" />
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            <Box v-for="listing in listings" :key="listing.id">
                <div>
                    <Link :href="route('listing.show', listing.id)">
                        <ListingPrice :price="listing.price" class="font-bold text-2xl" />
                        <ListingParams :listing="listing" class="text-lg" />
                        <ListingAddress :listing="listing" class="text-gray-500" />
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
            </Box>
        </div>
    </div>
</template>
