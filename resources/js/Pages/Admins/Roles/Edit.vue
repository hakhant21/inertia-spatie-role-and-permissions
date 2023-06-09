<script setup>
import { toast } from 'vue3-toastify';
import { onMounted, watch } from 'vue';
import Table from "@/Components/Table.vue";
import VueMultiselect from 'vue-multiselect';
import TableRow from "@/Components/TableRow.vue";
import TextInput from '@/Components/TextInput.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TableDataCell from "@/Components/TableDataCell.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";


const props = defineProps({
    role: {
        type: Object,
        default: {}
    },
    permissions: {
        type: Array,
    default: []
    }
});

const form = useForm({
    name: props.role.name,
    permissions: []
});

onMounted(() => {
    form.permissions = props.role?.permissions
});

watch(
    () => props.role,
    () => (form.permissions = props.role?.permissions)
)

const updateRole = async () => {
    await form.put(route('roles.update', props.role), {
        preserveScroll: true,
        preserveState: true,
        replace: true,
        onSuccess: () => {
            toast('Successfully updated role!', {
                autoClose: 1000,
            });
        }
    });
}

const revokePermission = async ([role, permission]) => {
    await router.delete(route('roles.permissions.revoke', [role, permission]), {
        preserveScroll: true,
        preserveState: true,
        replace: true,
        onSuccess: () => {
            toast('Successfully revoked permission!', {
                autoClose: 1000,
            });
        }
    });
}

</script>

<template>
   <Head title="Update role" />

   <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1 class="font-semibold text-lg">Update Role Form</h1>
                <Link :href="route('roles.index')" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Back
                </Link>
            </div>
            <div class="mt-5">
                <form @submit.prevent="updateRole">
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
                        <PrimaryButton :disabled="form.processing">Update</PrimaryButton>
                    </div>
                </form>
            </div>
            <div class="mt-5">
                <h1 class="font-semibold text-lg">Permission Lists</h1>
                <div class="bg-white rounded-lg shadow-lg mt-4">
                    <Table>
                        <template #header>
                            <TableRow>
                                <TableHeaderCell>ID</TableHeaderCell>
                                <TableHeaderCell>Name</TableHeaderCell>
                                <TableHeaderCell>Action</TableHeaderCell>
                            </TableRow>
                        </template>
                        <template #default>
                            <TableRow
                                v-for="rolePermission in role.permissions"
                                :key="rolePermission.id"
                                class="border-b"
                            >
                                <TableDataCell>{{ rolePermission.id }}</TableDataCell>
                                <TableDataCell>{{ rolePermission.name }}</TableDataCell>
                                <TableDataCell>
                                    <button @click="revokePermission([role, rolePermission])" class="text-red-400 hover:text-red-300">
                                        Revoke
                                    </button>
                                </TableDataCell>
                            </TableRow>
                        </template>
                    </Table>
                </div>
            </div>
        </div>
   </AdminLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
