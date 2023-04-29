<script setup>
import { ref } from 'vue';
import { toast } from 'vue3-toastify';
import Table from "@/Components/Table.vue";
import Modal from '@/Components/Modal.vue';
import TableRow from "@/Components/TableRow.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import DangerButton from '@/Components/DangerButton.vue';
import TableDataCell from "@/Components/TableDataCell.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import SecondaryButton from '@/Components/SecondaryButton.vue';


const showConfirmDeletePermissionModal = ref(false);

const form = useForm({});

const props = defineProps({
    permissions: {
        type: Object,
        default: {},
    },
});

const deletePermission = async (permission) => {
    showConfirmDeletePermissionModal.value = true;
    form.delete(route('permissions.destroy', permission), {
        preserveState: true,
        replace: true,
        onSuccess: () => {
            closeModal();
            toast('Successfully deleted permission!', {
                autoClose: 1000,
            });
        }
    })
}

const closeModal = () => {
    showConfirmDeletePermissionModal.value = false;
}
</script>

<template>
    <Head title="Dashboard" />
    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Permission Lists</h1>
                <Link :href="route('permissions.create')" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Add Permission
                </Link>
            </div>
            <div class="mt-5">
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
                            v-for="permission in permissions"
                            :key="permission.id"
                            class="border-b"
                        >
                            <TableDataCell>{{ permission.id }}</TableDataCell>
                            <TableDataCell>{{ permission.name }}</TableDataCell>
                            <TableDataCell>
                                <Link :href="route('permissions.edit', permission)" class="text-green-400 hover:text-green-300 pr-2">
                                    Edit
                                </Link>
                                <button @click="deletePermission" class="text-red-400 hover:text-red-300">
                                    Delete
                                </button>
                                <Modal :show="showConfirmDeletePermissionModal" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-slate-800">
                                            Are you sure to delete this permission?
                                        </h2>
                                        <div class="mt-6 flex justify-start space-x-4">
                                            <DangerButton @click="deletePermission(permission)">Delete</DangerButton>
                                            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
