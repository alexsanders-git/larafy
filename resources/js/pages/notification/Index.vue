<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import ListingPrice from '@/components/ListingPrice.vue';
import EmptyState from '@/components/EmptyState.vue';
import Pagination from '@/components/Pagination.vue';
import { NotificationsResponse } from '@/types';

interface IProps {
    notifications: NotificationsResponse;
}

defineProps<IProps>();
</script>

<template>
    <Head title="Notifications" />
    <h1 class="text-3xl mb-4">Your Notifications</h1>

    <section
        v-if="notifications.data.length"
        class="text-gray-500 dark:text-gray-400"
    >
        <div
            v-for="notification in notifications.data"
            :key="notification.id"
            class="border-b border-gray-200 dark:border-gray-800 py-4 flex justify-between items-center"
        >
            <div>
                <span v-if="notification.type === 'App\\Notifications\\OfferMade'">
                    Offer
                    <ListingPrice :price="notification.data.amount" />
                    for
                    <Link
                        :href="route('realtor.listing.show', {'listing': notification.data.listing_id})"
                        class="text-indigo-600 dark:text-indigo-400"
                    >
                        listing
                    </Link>
                    was made
                </span>
            </div>

            <div>
                <Link
                    v-if="!notification.read_at"
                    :href="route('notification.seen', {notification: notification.id})"
                    as="button"
                    method="put"
                    class="button-outline text-sm font-medium uppercase"
                >
                    Mark as read
                </Link>
            </div>
        </div>
    </section>

    <EmptyState v-else>No notification yet!</EmptyState>

    <div v-if="notifications.data.length > 3" class="w-full flex justify-center mt-8">
        <Pagination :links="notifications.links" />
    </div>
</template>
