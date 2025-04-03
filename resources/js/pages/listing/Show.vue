<script setup lang="ts">
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
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

const interestRate = ref<number>(2.5);
const duration = ref<number>(25);


const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(props.listing.price, interestRate, duration);
</script>

<template>
    <Head :title="listing.city" />
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center justify-center">
            <span class="font-medium text-gray-500">No images</span>
        </Box>

        <div class="md:col-span-5 space-y-4">
            <Box>
                <template #header>Basic info</template>
                <ListingPrice :price="listing.price" class="font-bold text-2xl" />
                <ListingParams :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>

            <Box>
                <template #header>Monthly Payment</template>
                <div>
                    <label class="label">Interest rate ({{ interestRate }}%)</label>
                    <input
                        v-model.number="interestRate"
                        type="range"
                        min="0.1"
                        max="30"
                        step="0.1"
                        class="w-full h-4 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer"
                    />

                    <label class="label">Duration ({{ duration }} years)</label>
                    <input
                        v-model.number="duration"
                        type="range"
                        min="3"
                        max="35"
                        step="1"
                        class="w-full h-4 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer"
                    />

                    <div class="mt-2 text-gray-600 dark:text-gray-300">
                        <div class="text-gray-400">Your monthly payment</div>
                        <ListingPrice :price="monthlyPayment" class="text-2xl" />
                    </div>

                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div class="">Total paid</div>
                            <div>
                                <ListingPrice :price="totalPaid" class="font-medium" />
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div class="">Interest paid</div>
                            <div>
                                <ListingPrice :price="totalInterest" class="font-medium" />
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div class="">Principal paid</div>
                            <div>
                                <ListingPrice :price="listing.price" class="font-medium" />
                            </div>
                        </div>
                    </div>
                </div>
            </Box>
        </div>
    </div>
</template>
