<template>
    <div class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm dark:text-gray-300">
        <div class="mb-1 text-gray-500 font-medium">
            <slot name="header" />
        </div>

        <slot />
    </div>
</template>
