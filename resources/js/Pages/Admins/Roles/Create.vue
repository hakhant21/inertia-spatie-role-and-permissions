<script setup>
import { toast } from 'vue3-toastify';
import VueMultiselect from 'vue-multiselect';
import TextInput from '@/Components/TextInput.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';


const props = defineProps({
    permissions: {
        type: Array,
        default: []
    }
})

const form = useForm({
    name: '',
    permissions: []
});

const createRole = async () => {
    await form.post(route('roles.store'), {
        preserveScroll: true,
        preserveState: true,
        replace: true,
        onSuccess: () => {
            toast('Successfully created a new role!', {
                autoClose: 1000,
            })
        }
    })
}

</script>

<template>
   <Head title="Create new role" />

   <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Create Role Form</h1>
                <Link :href="route('roles.index')" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Back
                </Link>
            </div>
            <div class="mt-5">
                <form @submit.prevent="createRole">
                    <div class="my-4">
                        <InputLabel for="name" value="Name"/>
                        <TextInput
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                            autocomplete="name"
                        />
                        <InputError class="mt-2" :message="form.errors.name"/>
                    </div>
                    <div class="my-4">
                        <InputLabel for="permissions" value="Permissions"/>
                        <VueMultiselect
                            v-model="form.permissions"
                            :options="permissions"
                            :multiple="true"
                            :close-on-select="true"
                            placeholder="Choose Permissions"
                            label="name"
                            track-by="id"
                        />
                    </div>
                    <div class="my-4">
                        <PrimaryButton :disabled="form.processing">Create</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
   </AdminLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

