<script setup>
import { toast } from 'vue3-toastify';
import { onMounted, watch } from 'vue';
import Table from '@/Components/Table.vue';
import VueMultiselect from 'vue-multiselect';
import TableRow from '@/Components/TableRow.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import TableDataCell from '@/Components/TableDataCell.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';


const props = defineProps({
    user: {
        type: Object,
        default: {}
    },
    roles: {
        type: Array,
        default: []
    },
    permissions: {
        type: Array,
        default: []
    }
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    roles: [],
    permissions: []
});

onMounted(() => {
    form.permissions = props.user?.permissions
    form.roles = props.user?.roles
});

watch(
    () => props.user,
    () => {
        form.roles = props.user?.roles,
        form.permissions = props.user?.permissions
    }
)


const updateUser = async () => {
    await form.put(route('users.update', props.user), {
        preserveScroll: true,
        preserveState: true,
        replace: true,
        onSuccess: () => {
            toast('Successfully updated user!', {
                autoClose: 1000,
            })
        }
    })
}

const revokeUserRole = async ([user, userRole]) => {
    await router.delete(route('users.roles.revoke', [user, userRole]), {
        preserveScroll: true,
        preserveState: true,
        replace: true,
        onSuccess: () => {
            toast('Successfully revoked user role!', {
                autoClose: 1000,
            })
        }
    })
}

const revokeUserPermission = async ([user, userRole]) => {
    await router.delete(route('users.permissions.revoke', [user, userRole]), {
        preserveScroll: true,
        preserveState: true,
        replace: true,
        onSuccess: () => {
            toast('Successfully revoked user permission!', {
                autoClose: 1000,
            })
        }
    })
}

</script>

<template>
   <Head title="Update user" />

   <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Update User Form</h1>
                <Link :href="route('users.index')" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Back
                </Link>
            </div>
            <div class="mt-5">
                <form @submit.prevent="updateUser">
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
                        <InputLabel for="email" value="Email"/>
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                            autocomplete="email"
                        />
                        <InputError class="mt-2" :message="form.errors.email"/>
                    </div>
                    <div class="my-4">
                        <InputLabel for="roles" value="Roles"/>
                        <VueMultiselect
                            v-model="form.roles"
                            :options="roles"
                            :multiple="true"
                            :close-on-select="true"
                            placeholder="Choose roles"
                            label="name"
                            track-by="id"
                        />
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
            <!-- Role Lists Table Start -->
            <div class="mt-5">
                <h1 class="font-semibold text-lg">Roles Lists</h1>
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
                                v-for="userRole in user.roles"
                                :key="userRole.id"
                                class="border-b"
                            >
                                <TableDataCell>{{ userRole.id }}</TableDataCell>
                                <TableDataCell>{{ userRole.name }}</TableDataCell>
                                <TableDataCell>
                                    <button @click="revokeUserRole([user, userRole])" class="text-red-400 hover:text-red-300">
                                        Revoke
                                    </button>
                                </TableDataCell>
                            </TableRow>
                        </template>
                    </Table>
                </div>
            </div>
            <!-- Permission Lists Table Start -->
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
                                v-for="userPermission in user.permissions"
                                :key="userPermission.id"
                                class="border-b"
                            >
                                <TableDataCell>{{ userPermission.id }}</TableDataCell>
                                <TableDataCell>{{ userPermission.name }}</TableDataCell>
                                <TableDataCell>
                                    <button @click="revokeUserPermission([user, userPermission])" class="text-red-400 hover:text-red-300">
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

