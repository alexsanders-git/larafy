<script setup lang="ts">
import { computed, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';
import Box from '@/components/Box.vue';
import ListingPrice from '@/components/ListingPrice.vue';

interface IProps {
    listingId: number;
    price: number;
}

const props = defineProps<IProps>();

const form = useForm({
    amount: props.price
});

const makeOffer = () => form.post(
    route('listing.offer.store',
        { listing: props.listingId }
    ), {
        preserveScroll: true,
        preserveState: true
    }
);

const difference = computed(() => form.amount - props.price);
const min = computed(() => Math.round(props.price / 2));
const max = computed(() => Math.round(props.price * 2));

interface IEmits {
    offerUpdated: [value: number | null];
}

const emit = defineEmits<IEmits>();

watch(
    () => form.amount,
    debounce((value: number) => emit('offerUpdated', value), 200)
);
</script>

<template>
    <Box>
        <template #header>
            Make an Offer
        </template>

        <div>
            <form @submit.prevent="makeOffer">
                <input v-model.number="form.amount" type="text" class="input" />

                <input
                    v-model.number="form.amount"
                    type="range"
                    :min="min"
                    :max="max"
                    step="10000"
                    class="w-full h-4 mt-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer"
                />

                <button type="submit" class="button-outline w-full mt-2 text-sm">
                    Make an Offer
                </button>
            </form>
        </div>

        <div class="flex justify-between mt-2 text-gray-500">
            <div>Difference</div>
            <div>
                <ListingPrice :price="difference" />
            </div>
        </div>
    </Box>
</template>
