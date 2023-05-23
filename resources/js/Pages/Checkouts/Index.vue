<script setup>
import { Head } from "@inertiajs/vue3";

defineProps({
    data: {
        type: Object,
        default: []
    }
});
</script>

<template>
    <Head title="Choose payment provider" />

    <div class="container mx-auto">
        <h1 class="text-center text-xl font-bold text-gray-500 py-12">Choose payment provider</h1>
        <iframe :src="data['webPaymentUrl']" width="100%" height="800"></iframe>
    </div>
</template>
