<script setup lang="ts">
import type { Listing } from '@/types';

interface IProps {
    listing: Listing;
}

defineProps<IProps>();
</script>

<template>
    <span>{{ listing.street }} {{ listing.street_num }}, {{ listing.city }} - ${{ listing.price }}</span>
</template>
