<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Box from '@/components/Box.vue';
import ListingPrice from '@/components/ListingPrice.vue';
import ListingParams from '@/components/ListingParams.vue';
import ListingAddress from '@/components/ListingAddress.vue';
import type { Listing } from '@/types';

interface IProps {
    listing: Listing;
}

defineProps<IProps>();
</script>

<template>
    <Head :title="listing.city" />
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center justify-center">
            <span class="font-medium text-gray-500">No images</span>
        </Box>

        <div class="md:col-span-5 space-y-4">
            <Box>
                <template #header>Basic info</template>
                <ListingPrice :price="listing.price" class="font-bold text-2xl" />
                <ListingParams :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>

            <Box>
                <template #header>Offer</template>
                Make an offer
            </Box>
        </div>
    </div>
</template>
