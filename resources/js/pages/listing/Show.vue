<script setup lang="ts">
import ListingAddress from '@/components/ListingAddress.vue';
import type { Listing } from '@/types';
import { Head } from '@inertiajs/vue3';

interface IProps {
    listing: Listing;
}

defineProps<IProps>();
</script>

<template>
    <Head :title="listing.city" />
    <div class="container mx-auto">
        <ListingAddress :listing="listing" />
    </div>
</template>
