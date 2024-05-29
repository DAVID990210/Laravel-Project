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

    defineProps(['permissions']);
    
    const form = useForm({});

    const showConfirmDeletePermissionModal = ref(false)

const confirmDeletePermission = () => {
    showConfirmDeletePermissionModal.value = true;
}
const closeModal = () => {
    showConfirmDeletePermissionModal.value = false;
}

const deletePermission = (id) => {
    form.delete(route('permissions.destroy', id), {
        onSuccess: () => closeModal(),
    });
}

</script>

<template>

    <Head title="Dashboard" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1 class="text-2xl font-semibold text-indigo-700">Permisos</h1>
                <Link :href="route('permissions.create')"
                    class="text-white font-semibold bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded">Nuevo Permiso
                </Link>
            </div>
            <div class="mt-6 max-w mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <div class="bg-white rounded-lg p-1">
                <Table>
                    <template #header>
                        <TableRow>
                            <TableHeaderCell>ID</TableHeaderCell>
                            <TableHeaderCell>Nombre</TableHeaderCell>
                            <TableHeaderCell>Accion</TableHeaderCell>
                        </TableRow>
                    </template>
                    <template #default>
                        <TableRow v-for="permission in permissions" :key="permission.id" class="border-b">
                            <TableDataCell>{{ permission . id }}</TableDataCell>
                            <TableDataCell>{{ permission . name }}</TableDataCell>
                            <TableDataCell class="space-x-4">
                                <Link :href="route('permissions.edit', permission.id)"
                                    class="text-green-500 hover:text-green-700">Editar</Link>
                                    <button @click="confirmDeletePermission"
                                        class="text-red-500 hover:text-red-700">Eliminar</button>
                                    <Modal :show="showConfirmDeletePermissionModal" @close="closeModal">
                                        <div class="p-6">
                                            <h2 class="text-lg font-semibold text-slate-800">¿Quieres borrar este
                                                usuario?
                                            </h2>
                                            <div class="mt-6 flex space-x-4">
                                                <DangerButton @click="$event => deletePermission(permission.id)">Borrar</DangerButton>
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
