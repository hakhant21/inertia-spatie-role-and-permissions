<script setup>
import { toast } from 'vue3-toastify';
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import TableDataCell from "@/Components/TableDataCell.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";

const props = defineProps({
    roles: {
        type: Object,
        default: {},
    },
});

const deleteRole = async (role) => {
    router.delete(route('roles.destroy', role), {
        preserveState: true,
        replace: true,
        onSuccess: () => {
            toast('Successfully deleted role!', {
                autoClose: 1000
            })
        }
    })
}

</script>

<template>
    <Head title="Dashboard" />
    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Role Lists</h1>
                <Link :href="route('roles.create')" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Add Role
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
                            v-for="role in roles"
                            :key="role.id"
                            class="border-b"
                        >
                            <TableDataCell>{{ role.id }}</TableDataCell>
                            <TableDataCell>{{ role.name }}</TableDataCell>
                            <TableDataCell>
                                <Link :href="route('roles.edit', role)" class="text-green-400 hover:text-green-300 pr-2">
                                    Edit
                                </Link>
                                <button @click="deleteRole(role)" class="text-red-400 hover:text-red-300">
                                    Delete
                                </button>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
