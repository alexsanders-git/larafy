<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import Box from '@/components/Box.vue';
import ListingPrice from '@/components/ListingPrice.vue';
import ListingParams from '@/components/ListingParams.vue';
import ListingAddress from '@/components/ListingAddress.vue';
import { useMonthlyPayment } from '@/composables/useMonthlyPayment';
import type { Listing } from '@/types';

interface IProps {
    listing: Listing;
}

const props = defineProps<IProps>();

const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25);
</script>

<template>
    <Box>
        <div>
            <Link :href="route('listing.show', listing.id)">
                <div class="flex items-center gap-1">
                    <ListingPrice :price="listing.price" class="font-bold text-2xl" />
                    <div class="text-xs text-gray-500">
                        <ListingPrice :price="monthlyPayment" />
                        pm
                    </div>
                </div>
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
</template>
