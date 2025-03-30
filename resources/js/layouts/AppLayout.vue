<script setup lang="ts">
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const counter = ref(0);

setInterval(() => counter.value++, 1000);
</script>

<template>
    <div>
        <header>
            <nav class="flex gap-2">
                <Link :href="route('home')">Home Page</Link>
                <Link :href="route('show')">Show Page</Link>
            </nav>

            <div>{{ counter }}</div>
        </header>

        <main>
            <slot/>
        </main>
    </div>
</template>
