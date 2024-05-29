<script setup>
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/vue3';
    import {
        ref
    } from 'vue';
    import AdminLayout from '@/Layouts/AdminLayout.vue';

    import Table from '@/Components/Table.vue';
    import TableRow from '@/Components/TableRow.vue';
    import TableHeaderCell from '@/Components/TableHeaderCell.vue';
    import TableDataCell from '@/Components/TableDataCell.vue';
    import Modal from '@/Components/Modal.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import {
        usePermission
    } from '@/composables/permissions.js';

    const props = defineProps(['users']);

    const form = useForm({});

    const showConfirmDeleteUserModal = ref(false)

    const {
        hasPermission
    } = usePermission();

    const confirmDeleteUser = () => {
        showConfirmDeleteUserModal.value = true;
    }
    const closeModal = () => {
        showConfirmDeleteUserModal.value = false;
    }

    const deleteUser = (id) => {
        form.delete(route('users.destroy', id), {
            onSuccess: () => closeModal(),
        });
    }
</script>

<template>

    <Head title="Users Index" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1 class="text-2xl font-semibold text-indigo-700">Usuarios</h1>
                <template v-if="hasPermission('Crear Usuario')">
                <Link :href="route('users.create')"
                    class="text-white font-semibold bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded">Nuevo Usuario
                </Link>
            </template>
            </div>
            <div class="mt-6 max-w mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <div class="bg-white rounded-lg p-1">
                    <Table>
                        <template #header>
                            <TableRow>
                                <TableHeaderCell>ID</TableHeaderCell>
                                <TableHeaderCell>Nombre</TableHeaderCell>
                                <TableHeaderCell>Email</TableHeaderCell>
                                <TableHeaderCell>Accion</TableHeaderCell>

                            </TableRow>
                        </template>
                        <template #default>
                            <TableRow v-for="user in users" :key="user.id" class="border-b">
                                <TableDataCell>{{ user . id }}</TableDataCell>
                                <TableDataCell>{{ user . name }}</TableDataCell>
                                <TableDataCell>{{ user . email }}</TableDataCell>
                                <TableDataCell class="space-x-4">
                                    <template v-if="hasPermission('Editar Usuario')">
                                    <Link :href="route('users.edit', user.id)"
                                        class="text-green-500 hover:text-green-700">
                                    Editar</Link>
                                </template>
                                <template v-if="hasPermission('Borrar Usuario')">
                                    <button @click="confirmDeleteUser"
                                        class="text-red-500 hover:text-red-700">Eliminar</button>
                                </template>
                                    <Modal :show="showConfirmDeleteUserModal" @close="closeModal">
                                        <div class="p-6">
                                            <h2 class="text-lg font-semibold text-slate-800">¿Quieres borrar este
                                                usuario?
                                            </h2>
                                            <div class="mt-6 flex space-x-4">
                                                <DangerButton @click="$event => deleteUser(user.id)">Borrar
                                                </DangerButton>
                                                <SecondaryButton @click="closeModal">Cancelar</SecondaryButton>
                                            </div>
                                        </div>
                                    </Modal>
                            
                                </TableDataCell>
                            </TableRow>
                        </template>
                    </Table>
                </div>
            </div>
        </div>
    </AdminLayout>

</template>
