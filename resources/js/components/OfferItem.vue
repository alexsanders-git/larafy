<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import Box from '@/components/Box.vue';
import type { Offer } from '@/types';
import ListingPrice from '@/components/ListingPrice.vue';
import { computed } from 'vue';

interface IProps {
    offer: Offer;
    listingPrice: number;
}

const props = defineProps<IProps>();

const difference = computed(
    () => props.offer.amount - props.listingPrice
);

const madeOn = computed(
    () => new Date(props.offer.created_at).toDateString()
);
</script>

<template>
    <Box>
        <template #header>
            Offer #{{ offer.id }}
        </template>

        <div class="flex items-center justify-between">
            <div>
                <ListingPrice :price="offer.amount" class="text-xl" />

                <div class="text-gray-500">
                    Difference
                    <ListingPrice :price="difference" />
                </div>

                <div class="text-gray-500 text-sm">
                    Made by {{ offer.bidder.name }}
                </div>

                <div class="text-gray-500 text-sm">
                    Made on {{ madeOn }}
                </div>
            </div>

            <div>
                <Link
                    :href="route('realtor.offer.accept', {offer: offer.id})"
                    class="button-outline text-sm font-medium"
                    method="put"
                    as="button"
                >
                    Accept
                </Link>
            </div>
        </div>
    </Box>
</template>
