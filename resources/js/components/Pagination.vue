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
        <template v-for="(link, index) in links" :key="index">
            <Link
                v-if="link.url"
                v-html="link.label"
                :href="link.url"
                :class="{'bg-indigo-500 dark:bg-indigo-800 text-gray-100': link.active}"
                class="py-2 px-4 rounded-md"
            />

            <span
                v-else
                v-html="link.label"
                :class="{'bg-indigo-500 dark:bg-indigo-800 text-gray-100': link.active}"
                class="py-2 px-4 rounded-md"
            />
        </template>
    </div>
</template>
