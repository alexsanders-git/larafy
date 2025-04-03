<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import type { Listing } from '@/types';

interface IProps {
    listing: Listing;
}

const props = defineProps<IProps>();

const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    code: props.listing.code,
    street: props.listing.street,
    street_num: props.listing.street_num,
    price: props.listing.price
});

const update = () => form.put(route('listing.update', props.listing.id));
</script>

<template>
    <Head title="Update" />
    <form class="grid grid-cols-1 md:grid-cols-2 gap-4" @submit.prevent="update">
        <div>
            <label class="label">Beds</label>
            <input v-model="form.beds" type="text" class="input" />
            <div v-if="form.errors.beds" class="input-error">{{ form.errors.beds }}</div>
        </div>

        <div>
            <label class="label">Baths</label>
            <input v-model="form.baths" type="text" class="input" />
            <div v-if="form.errors.baths" class="input-error">{{ form.errors.baths }}</div>
        </div>

        <div>
            <label class="label">Area</label>
            <input v-model="form.area" type="text" class="input" />
            <div v-if="form.errors.area" class="input-error">{{ form.errors.area }}</div>
        </div>

        <div>
            <label class="label">City</label>
            <input v-model="form.city" type="text" class="input" />
            <div v-if="form.errors.city" class="input-error">{{ form.errors.city }}</div>
        </div>

        <div>
            <label class="label">Code</label>
            <input v-model="form.code" type="text" class="input" />
            <div v-if="form.errors.code" class="input-error">{{ form.errors.code }}</div>
        </div>

        <div>
            <label class="label">Street</label>
            <input type="text" class="input" v-model="form.street" />
            <div v-if="form.errors.street" class="input-error">{{ form.errors.street }}</div>
        </div>

        <div>
            <label class="label">Street number</label>
            <input v-model="form.street_num" type="text" class="input" />
            <div v-if="form.errors.street_num" class="input-error">{{ form.errors.street_num }}</div>
        </div>

        <div>
            <label class="label">Price</label>
            <input v-model="form.price" type="text" class="input" />
            <div v-if="form.errors.price" class="input-error">{{ form.errors.price }}</div>
        </div>

        <div>
            <button type="submit" class="button-primary">Create</button>
        </div>
    </form>
</template>

<style scoped>
input[type='text'] {
    @apply mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus-visible:outline-none focus:ring-violet-500 focus-visible:ring-violet-500 focus:border-violet-500 focus-visible:border-violet-500 block w-full p-2.5;
}
</style>
