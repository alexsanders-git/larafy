<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Box from '@/components/Box.vue';
import ListingPrice from '@/components/ListingPrice.vue';
import ListingParams from '@/components/ListingParams.vue';
import ListingAddress from '@/components/ListingAddress.vue';
import type { Listing } from '@/types';
import { computed } from 'vue';
import OfferItem from '@/components/OfferItem.vue';

interface IProps {
    listing: Listing;
}

const props = defineProps<IProps>();

const hasOffers = computed(
    () => props.listing.offers.length
);
</script>

<template>
    <Head title="Listing Offers" />

    <div class="mb-4">
        <Link :href="route('realtor.listing.index')">← Go back to Listings</Link>
    </div>

    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <div v-if="hasOffers" class="flex flex-col gap-4 md:col-span-7 items-center">
            <OfferItem
                v-for="offer in listing.offers"
                :key="offer.id"
                :offer="offer"
                :listing-price="listing.price"
                :is-sold="listing.sold_at != null"
                class="w-full"
            />
        </div>

        <Box v-else class="flex md:col-span-7 items-center">
            <div class="w-full text-center font-medium text-gray-500">
                No Offers
            </div>
        </Box>

        <div class="md:col-span-5">
            <Box>
                <template #header>Basic Info</template>

                <ListingPrice :price="listing.price" class="text-2xl font-bold" />

                <ListingParams :listing="listing" class="text-lg" />

                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>
        </div>
    </section>
</template>
