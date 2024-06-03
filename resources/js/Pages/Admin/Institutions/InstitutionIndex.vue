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

    defineProps(['institutions']);

    const form = useForm({});

    const showConfirmDeleteInstitutionModal = ref(false)

    const {
        hasPermission
    } = usePermission();

    const confirmDeleteInstitution = () => {
        showConfirmDeleteInstitutionModal.value = true;
    }
    const closeModal = () => {
        showConfirmDeleteInstitutionModal.value = false;
    }

    const deleteInstitution = (id) => {
        form.delete(route('institutions.destroy', id), {
            onSuccess: () => closeModal(),
        });
    }
</script>

<template>

    <Head title="Institutions Index" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1 class="text-2xl font-semibold text-indigo-700">Institutos</h1>
                <template v-if="hasPermission('Crear Usuario')">
                    <Link :href="route('institutions.create')"
                        class="text-white font-semibold bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded">Nuevo
                    Instituto
                    </Link>
                </template>
            </div>
            <div class="mt-6 max-w mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <div class="bg-white rounded-lg p-1">
                    <Table>
                        <template #header>
                            <TableRow>
                                <TableHeaderCell>ID</TableHeaderCell>
                                <TableHeaderCell>Codigo</TableHeaderCell>
                                <TableHeaderCell>Nombre</TableHeaderCell>
                                <TableDataCell>Dirección</TableDataCell>
                                <TableHeaderCell>Accion</TableHeaderCell>
                            </TableRow>
                        </template>
                        <template #default>
                            <TableRow v-for="institution in institutions" :key="institution.id" class="border-b">
                                <TableDataCell>{{ institution . id }}</TableDataCell>
                                <TableDataCell>{{ institution . code }}</TableDataCell>
                                <TableDataCell>{{ institution . name }}</TableDataCell>
                                <TableDataCell>{{ institution . address }}</TableDataCell>
                                <TableDataCell class="space-x-4">
                                    <div class="flex space-x-4">
                                        <template v-if="hasPermission('Editar Usuario')">
                                            <Link :href="route('institutions.edit', institution.id)"
                                                class="text-green-500 hover:text-green-700">
                                            Editar</Link>
                                        </template>
                                        <template v-if="hasPermission('Borrar Usuario')">
                                            <button @click="confirmDeleteInstitution"
                                                class="text-red-500 hover:text-red-700">Eliminar</button>
                                        </template>
                                    </div>
                                    <Modal :show="showConfirmDeleteInstitutionModal" @close="closeModal">
                                        <div class="p-6">
                                            <h2 class="text-lg font-semibold text-slate-800">¿Quieres borrar este
                                                instituto?
                                            </h2>
                                            <DangerButton @click="$event => deleteInstitution(institution.id)">
                                                Borrar
                                            </DangerButton>
                                            <SecondaryButton @click="closeModal">Cancelar</SecondaryButton>
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
