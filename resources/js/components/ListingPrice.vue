<script setup lang="ts">
import { computed } from 'vue';

interface IProps {
    price: number | string;
}

const props = defineProps<IProps>();

const formattedPrice = computed(
    () => Number(props.price).toLocaleString('en-US', {
        style: 'currency',
        currency: 'USD',
        maximumFractionDigits: 0
    })
);
</script>

<template>
    <span>{{ formattedPrice }}</span>
</template>
