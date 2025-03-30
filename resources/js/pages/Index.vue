<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Home"/>
    <h1>Hello Laravel!</h1>
    <Link :href="route('show')">Show Page</Link>
</template>
