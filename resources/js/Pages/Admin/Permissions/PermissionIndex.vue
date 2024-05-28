<script setup>
    import {
        Head,
        Link
    } from '@inertiajs/vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';

    import Table from '@/Components/Table.vue';
    import TableRow from '@/Components/TableRow.vue';
    import TableHeaderCell from '@/Components/TableHeaderCell.vue';
    import TableDataCell from '@/Components/TableDataCell.vue';

    defineProps(['permissions']);
</script>

<template>

    <Head title="Dashboard" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Permisos</h1>
                <Link :href="route('permissions.create')"
                    class="text-white font-semibold bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded">Nuevo Permiso
                </Link>
            </div>
            <div class="mt-6">
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
                                <Link :href="route('permissions.destroy', permission.id)" method="delete" as="button"
                                    class="text-red-400 hover:text-red-600">Eliminar</Link>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>

            </div>
        </div>
    </AdminLayout>

</template>
