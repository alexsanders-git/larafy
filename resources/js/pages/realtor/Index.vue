<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Box from '@/components/Box.vue';
import ListingPrice from '@/components/ListingPrice.vue';
import ListingParams from '@/components/ListingParams.vue';
import ListingAddress from '@/components/ListingAddress.vue';
import RealtorFilters from '@/components/RealtorFilters.vue';
import { Listing, RealtorListingFilters } from '@/types';

interface IProps {
    filters: RealtorListingFilters;
    listings: Listing[];
}

defineProps<IProps>();
</script>

<template>
    <Head title="Realtor" />
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <RealtorFilters :filters="filters" class="my-4" />

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings" :key="listing.id">
            <div class="flex flex-col md:flex-row md:items-center gap-2 justify-between">
                <div>
                    <div class="xl:flex items-center gap-2">
                        <ListingPrice :price="listing.price" class="text-2xl font-medium" />
                        <ListingParams :listing="listing" />
                    </div>

                    <ListingAddress :listing="listing" class="text-gray-500" />
                </div>

                <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                    <Link class="button-outline text-sm font-medium">Preview</Link>
                    <Link class="button-outline text-sm font-medium">Edit</Link>
                    <Link
                        :href="route('realtor.listing.destroy', {listing: listing.id})"
                        class="button-outline text-sm font-medium"
                        method="delete"
                        as="button"
                    >
                        Delete
                    </Link>
                </div>
            </div>
        </Box>
    </section>
</template>
