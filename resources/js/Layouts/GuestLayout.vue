<script setup>
import { Head, Link } from "@inertiajs/vue3";

</script>

<template>
       <Head title="Welcome"/>
        <div>
            <div class="bg-white shadow-sm">
                <div class="max-w-6xl mx-auto py-6 px-8">
                    <div class="flex justify-between items-center">
                        <Link :href="route('welcome')">
                            <div class="rounded-lg text-slate-800 hover:text-slate-500 font-bold uppercase">G I G I</div>
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
            <div class="max-w-6xl mx-auto py-6 px-8">
                <slot />
            </div>
        </div>
</template>
