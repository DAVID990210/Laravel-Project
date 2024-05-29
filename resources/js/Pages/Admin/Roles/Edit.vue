<script setup>
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';

    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import InputError from '@/Components/InputError.vue';
    import TextInput from '@/Components/TextInput.vue';
    import VueMultiselect from 'vue-multiselect';
    import Table from '@/Components/Table.vue';
    import TableRow from '@/Components/TableRow.vue';
    import TableHeaderCell from '@/Components/TableHeaderCell.vue';
    import TableDataCell from '@/Components/TableDataCell.vue';
    import {
        onMounted,
        watch
    } from 'vue';

    const props = defineProps({
        role: {
            type: Object,
            required: true
        },
        permissions: Array,
    });

    const form = useForm({
        name: props.role.name,
        permissions: [],
    });

    onMounted(() => {
        form.permissions = props.role?.permissions;
    })

    watch(
        () => props.role, 
        () => {form.permissions = props.role?.permissions;}
    )

</script>

<template>

    <Head title="Editar Role" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">

            <div class="flex justify-between">
                <h1 class="text-2xl font-semibold text-indigo-700">Editar Role</h1>
                <Link :href="route('roles.index')"
                    class="text-white font-semibold bg-indigo-500 hober:bg-indigo-700 px-4 py-2 rounded">Atras</Link>

            </div>

            <div class="mt-6 max-w mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <form @submit.prevent="form.put(route('roles.update', role.id))">
                    <div>
                        <InputLabel for="name" value="Nombre" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="permissions" value="Permisos" />
                        <VueMultiselect v-model="form.permissions" :options="permissions" :multiple="true"
                            :close-on-select="true" placeholder="Selecciona los permisos" label="name" track-by="id" />

                    </div>

                    <div class="flex items-center mt-4">

                        <PrimaryButton :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Editar
                        </PrimaryButton>
                    </div>
                </form>
            </div>
            <div class="mt-6 max-w mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-indigo-700">Permisos</h1>
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
                            <TableRow v-for="rolePermission in role.permissions" :key="rolePermission.id"
                                class="border-b">
                                <TableDataCell>{{ rolePermission . id }}</TableDataCell>
                                <TableDataCell>{{ rolePermission . name }}</TableDataCell>
                                <TableDataCell class="space-x-4">
                                    <Link :href="route('roles.permissions.destroy', [role.id,rolePermission.id])" method="delete"
                                        as="button" class="text-red-400 hover:text-red-600">Remover</Link>
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
