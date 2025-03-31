<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: null,
    code: null,
    street: null,
    street_num: null,
    price: 0
});

const create = () => form.post(route('listing.store'));
</script>

<template>
    <Head title="Create" />
    <div class="container mx-auto">
        <form @submit.prevent="create">
            <div>
                <label>Beds</label>
                <input type="text" v-model="form.beds" />
            </div>

            <div>
                <label>Baths</label>
                <input type="text" v-model="form.baths" />
            </div>

            <div>
                <label>Area</label>
                <input type="text" v-model="form.area" />
            </div>

            <div>
                <label>City</label>
                <input type="text" v-model="form.city" />
            </div>

            <div>
                <label>Code</label>
                <input type="text" v-model="form.code" />
            </div>

            <div>
                <label>Street</label>
                <input type="text" v-model="form.street" />
            </div>

            <div>
                <label>Street number</label>
                <input type="text" v-model="form.street_num" />
            </div>

            <div>
                <label>Price</label>
                <input type="text" v-model="form.price" />
            </div>

            <div>
                <button class="p-2 bg-violet-300" type="submit">Create</button>
            </div>
        </form>
    </div>
</template>

<style scoped>
input[type='text'] {
    @apply mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus-visible:outline-none focus:ring-violet-500 focus-visible:ring-violet-500 focus:border-violet-500 focus-visible:border-violet-500 block w-full p-2.5;
}
</style>
