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
    <div class="container mx-auto px-4">
        <form @submit.prevent="update">
            <div>
                <label>Beds</label>
                <input type="text" v-model="form.beds" />
                <div v-if="form.errors.beds">{{ form.errors.beds }}</div>
            </div>

            <div>
                <label>Baths</label>
                <input type="text" v-model="form.baths" />
                <div v-if="form.errors.baths">{{ form.errors.baths }}</div>
            </div>

            <div>
                <label>Area</label>
                <input type="text" v-model="form.area" />
                <div v-if="form.errors.area">{{ form.errors.area }}</div>
            </div>

            <div>
                <label>City</label>
                <input type="text" v-model="form.city" />
                <div v-if="form.errors.city">{{ form.errors.city }}</div>
            </div>

            <div>
                <label>Code</label>
                <input type="text" v-model="form.code" />
                <div v-if="form.errors.code">{{ form.errors.code }}</div>
            </div>

            <div>
                <label>Street</label>
                <input type="text" v-model="form.street" />
                <div v-if="form.errors.street">{{ form.errors.street }}</div>
            </div>

            <div>
                <label>Street number</label>
                <input type="text" v-model="form.street_num" />
                <div v-if="form.errors.street_num">{{ form.errors.street_num }}</div>
            </div>

            <div>
                <label>Price</label>
                <input type="text" v-model="form.price" />
                <div v-if="form.errors.price">{{ form.errors.price }}</div>
            </div>

            <div>
                <button class="p-2 bg-violet-300" type="submit">Edit</button>
            </div>
        </form>
    </div>
</template>

<style scoped>
input[type='text'] {
    @apply mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus-visible:outline-none focus:ring-violet-500 focus-visible:ring-violet-500 focus:border-violet-500 focus-visible:border-violet-500 block w-full p-2.5;
}
</style>
