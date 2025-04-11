<script setup lang="ts">
import Box from '@/components/Box.vue';
import ListingPrice from '@/components/ListingPrice.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

interface IProps {
    listingId: number;
    price: number;
}

const props = defineProps<IProps>();

const form = useForm({
    amount: props.price
});

const difference = computed(() => form.amount - props.price);
const min = computed(() => props.price / 2);
const max = computed(() => props.price * 2);
</script>

<template>
    <Box>
        <template #header>
            Make an Offer
        </template>

        <div>
            <form>
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
