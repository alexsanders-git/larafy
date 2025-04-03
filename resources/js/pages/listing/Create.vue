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
    <form class="grid grid-cols-1 md:grid-cols-2 gap-4" @submit.prevent="create">
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
