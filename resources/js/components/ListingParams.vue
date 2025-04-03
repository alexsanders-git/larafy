<script setup lang="ts">
import { BedSingle, Bath, House } from 'lucide-vue-next';
import type { Listing } from '@/types';

interface IProps {
    listing: Listing;
}

defineProps<IProps>();
</script>

<template>
    <div class="flex items-center gap-2">
        <div class="flex items-center gap-2">
            <BedSingle :size="16" />
            {{ listing.beds }}
        </div>
        <span class="text-gray-400"> | </span>
        <div class="flex items-center gap-2">
            <Bath :size="16" />
            {{ listing.baths }}
        </div>
        <span class="text-gray-400"> | </span>
        <div class="flex items-center gap-2">
            <House :size="16" />
            {{ listing.area }} m²
        </div>
    </div>
</template>
