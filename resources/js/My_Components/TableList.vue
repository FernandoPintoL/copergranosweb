<script setup>

</script>

<template>
    <!-- Table -->
<!--    <div class="overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">-->
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
<!--            <thead class="bg-gray-50 dark:bg-neutral-800">-->
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <slot name="tbl-header"/>
            </thead>

<!--            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">-->
            <tbody>
                <slot name="tbl-body"/>
            </tbody>
        </table>
    </div>
    <!-- End Table -->
</template>

<style scoped>

</style>
