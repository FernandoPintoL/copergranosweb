<script setup>

</script>

<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-4" >
        <slot name="header-tbl"/>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <slot name="tbl-header"/>
            </tr>
            </thead>
            <tbody>
            <slot name="tbl-body"/>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
