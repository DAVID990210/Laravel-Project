<script setup>
    import {
        Head
    } from '@inertiajs/vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';

    import Table from '@/Components/Table.vue';
    import TableRow from '@/Components/TableRow.vue';
    import TableHeaderCell from '@/Components/TableHeaderCell.vue';
    import TableDataCell from '@/Components/TableDataCell.vue';

    defineProps(['users']);
</script>

<template>

    <Head title="Dashboard" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <h1>Usuarios</h1>
            <div class="mt-6">
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
                            <TableDataCell>Editar/Borrar</TableDataCell>
                        </TableRow>
                    </template>
                </Table>

            </div>
        </div>
    </AdminLayout>

</template>
