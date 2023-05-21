<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});
</script>

<template>
    <Head title="Welcome Page" />
    <div class="bg-white shadow">
        <div class="max-w-6xl mx-auto py-6 px-8">
            <div class="flex justify-between items-center">
                <Link :href="route('welcome')">
                    <div class="py-1 px-4 rounded-lg shadow-lg bg-slate-700 text-slate-50 hover:bg-slate-600 hover:text-slate-100">Welcome</div>
                </Link>
                <div class="flex justify-between items-center">
                    <Link :href="route('login')">
                        <div class="py-1 px-4 rounded-lg shadow-lg bg-slate-700 text-slate-50 hover:bg-slate-600 hover:text-slate-100 mr-2">Login</div>
                    </Link>
                    <Link :href="route('register')">
                        <div class="py-1 px-4 rounded-lg shadow-lg bg-slate-700 text-slate-50 hover:bg-slate-600 hover:text-slate-100">Register</div>
                    </Link>
                </div>
            </div>
        </div>
    </div>

</template>
