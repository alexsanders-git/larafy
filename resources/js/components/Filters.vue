<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ListingFilters } from '@/types';

interface IProps {
    filters: ListingFilters;
}

const props = defineProps<IProps>();

const form = useForm({
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    beds: props.filters.beds ?? null,
    baths: props.filters.baths ?? null,
    areaFrom: props.filters.areaFrom ?? null,
    areaTo: props.filters.areaTo ?? null
});

const filter = () => {
    form.get(route('listing.index'), {
        preserveState: true,
        preserveScroll: true
    });
};

const reset = () => {
    form.priceFrom = null;
    form.priceTo = null;
    form.beds = null;
    form.baths = null;
    form.areaFrom = null;
    form.areaTo = null;

    filter();
};
</script>

<template>
    <form @submit.prevent="filter">
        <div class="mt-4 mb-8 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input
                    v-model.number="form.priceFrom"
                    type="text"
                    placeholder="Price from"
                    class="input-filter input-filter-l"
                />
                <input
                    v-model.number="form.priceTo"
                    type="text"
                    placeholder="Price to"
                    class="input-filter input-filter-r"
                />
            </div>

            <div class="flex flex-nowrap items-center">
                <select v-model="form.beds" class="input-filter input-filter-l">
                    <option :value="null">Beds</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option>6+</option>
                </select>

                <select v-model="form.baths" class="input-filter input-filter-r">
                    <option :value="null">Baths</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option>6+</option>
                </select>
            </div>

            <div class="flex flex-nowrap items-center">
                <input
                    v-model.number="form.areaFrom"
                    type="text"
                    placeholder="Area from"
                    class="input-filter input-filter-l"
                />
                <input
                    v-model.number="form.areaTo"
                    type="text"
                    placeholder="Area to"
                    class="input-filter input-filter-r"
                />
            </div>

            <button type="submit" class="button-normal">Filter</button>
            <button type="reset" @click="reset">Clear</button>
        </div>
    </form>
</template>
