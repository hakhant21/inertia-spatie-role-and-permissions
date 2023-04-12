<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify';
import AdminLayout from '@/Layouts/AdminLayout.vue'
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';


const props = defineProps({
    permission: {
        type: Object,
        default: {}
    }
})

const form = useForm({
    name: props.permission.name,
});

const updatePermission = async () => {
    await form.put(route('permissions.update', props.permission), {
        preserveState: true,
        replace: true,
        onSuccess: () => {
            toast('Successfully updated permission!', {
                autoClose: 1000,
            })
        }
    })
}

</script>

<template>
   <Head title="Update permission" />

   <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Update Permission Form</h1>
                <Link :href="route('permissions.index')" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Back
                </Link>
            </div>
            <div class="mt-5">
                <form @submit.prevent="updatePermission">
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
                        <PrimaryButton :disabled="form.processing">Update</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
   </AdminLayout>
</template>
