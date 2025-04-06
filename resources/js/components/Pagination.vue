<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { PaginationLink } from '@/types';

interface IProps {
    links: PaginationLink[];
}

defineProps<IProps>();
</script>

<template>
    <div class="flex gap-1">
        <Link
            v-for="(link, index) in links"
            :key="index"
            :href="link.url"
            v-html="link.label"
            :class="{'bg-indigo-500 dark:bg-indigo-800 text-gray-100': link.active}"
            class="py-2 px-4 rounded-md"
        />
    </div>
</template>
