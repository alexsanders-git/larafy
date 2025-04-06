<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Filters from '@/components/Filters.vue';
import ListingItem from '@/components/ListingItem.vue';
import Pagination from '@/components/Pagination.vue';
import type { ListingFilters, ListingsResponse } from '@/types';

interface IProps {
    filters: ListingFilters;
    listings: ListingsResponse;
}

defineProps<IProps>();
</script>

<template>
    <Head title="Listing" />
    <div class="container mx-auto">
        <Filters :filters="filters" />

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            <ListingItem v-for="listing in listings.data" :key="listing.id" :listing="listing" />
        </div>

        <div v-if="listings.data.length" class="w-full flex justify-center mt-8">
            <Pagination :links="listings.links" />
        </div>
    </div>
</template>
