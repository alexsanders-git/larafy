<script setup lang="ts">
import { computed, reactive, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';
import type { RealtorListingFilters } from '@/types';

interface IProps {
    filters: RealtorListingFilters;
}

const props = defineProps<IProps>();

type SortableField = 'created_at' | 'price';
type SortOrder = 'asc' | 'desc';

interface SortOptionItem {
    label: string;
    value: SortOrder;
}

const sortLabels: Record<SortableField, SortOptionItem[]> = {
    created_at: [
        { label: 'Latest', value: 'desc' },
        { label: 'Oldest', value: 'asc' }
    ],
    price: [
        { label: 'Pricey', value: 'desc' },
        { label: 'Cheapest', value: 'asc' }
    ]
};

const sortOption = computed(() => sortLabels[filterForm.by]);

const filterForm = reactive({
    by: props.filters.by ?? 'created_at',
    order: props.filters.order ?? 'desc',
    deleted: props.filters.deleted ?? false
});

const debouncedFilterRequest = debounce(() => {
    router.get(
        route('realtor.listing.index'),
        filterForm,
        {
            preserveState: true,
            preserveScroll: true
        }
    );
}, 1000);

watch(
    filterForm, () => {
        debouncedFilterRequest();
    }
);
</script>

<template>
    <form action="">
        <div class="flex flex-wrap gap-4">
            <div>
                <select v-model="filterForm.by" class="input-filter input-filter-l">
                    <option value="created_at">Added</option>
                    <option value="price">Price</option>
                </select>

                <select v-model="filterForm.order" class="input-filter input-filter-r">
                    <option
                        v-for="option in sortOption"
                        :key="option.value"
                        :value="option.value"
                    >
                        {{ option.label }}
                    </option>
                </select>
            </div>

            <div class="flex flex-nowrap items-center gap-2">
                <input
                    v-model="filterForm.deleted"
                    type="checkbox"
                    id="deleted"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                >
                <label for="deleted">Deleted</label>
            </div>
        </div>
    </form>
</template>
