<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

</script>

<template>
       <Head title="Welcome"/>
        <div>
            <div class="bg-white shadow-sm">
                <div class="max-w-6xl mx-auto py-6 px-8">
                    <div class="flex justify-between items-center">
                        <Link :href="route('welcome')">
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('welcome')">
                                    <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                                </Link>
                            </div>
                        </Link>
                        <div class="flex justify-between items-center">
                            <Link :href="route('login')">
                                <div class="rounded-lg text-slate-800 hover:text-slate-500 mr-2 uppercase">Login</div>
                            </Link>
                            <Link :href="route('register')">
                                <div class="rounded-lg text-slate-800 hover:text-slate-500 uppercase pl-4">Register</div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-12">
                <div class="max-w-md mx-auto shadow-lg rounded-lg py-6 px-6">
                    <slot />
                </div>
            </div>
        </div>
</template>
