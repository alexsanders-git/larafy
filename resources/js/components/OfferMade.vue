<script setup lang="ts">
import Box from '@/components/Box.vue';
import ListingPrice from '@/components/ListingPrice.vue';
import { computed } from 'vue';
import type { Offer } from '@/types';

interface IProps {
    offer: Offer;
}

const props = defineProps<IProps>();

const offerMadeOn = computed(
    () => new Date(props.offer.created_at).toDateString()
);
</script>

<template>
    <Box>
        <template #header>
            Offer Made
        </template>

        <ListingPrice :price="offer.amount" class="text-3xl" />

        <div class="flex flex-col md:flex-row justify-between mt-2 text-gray-500">
            <div>Made on</div>
            <div class="font-medium">{{ offerMadeOn }}</div>
        </div>
    </Box>
</template>
