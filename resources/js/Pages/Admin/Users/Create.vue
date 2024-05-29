<script setup>
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import VueMultiselect from 'vue-multiselect';

    defineProps({
        roles: Array,
        permissions: Array
    });

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        roles: [],
        permissions: [],
    });

    const submit = () => {
        form.post(route('users.store'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };
</script>

<template>

    <Head title="Crear Usuario" />

    <AdminLayout>

        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1 class="text-2xl font-semibold text-indigo-700">Crear un nuevo Usuario</h1>
                <Link :href="route('users.index')"
                    class="text-white font-semibold bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded">Atras</Link>
            </div>
        </div>
        <div class="mt-2 max-w-7xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                        autofocus autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirmar Contraseña" />

                    <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                        v-model="form.password_confirmation" required autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="mt-4">
                    <InputLabel for="roles" value="Roles" />
                    <VueMultiselect v-model="form.roles" :options="roles" :multiple="true"
                        :close-on-select="true" placeholder="Selecciona los permisos" label="name" track-by="id" />

                </div>

                <div class="mt-4">
                    <InputLabel for="permissions" value="Permisos" />
                    <VueMultiselect v-model="form.permissions" :options="permissions" :multiple="true"
                        :close-on-select="true" placeholder="Selecciona los permisos" label="name" track-by="id" />

                </div>

                <div class="flex items-center justify-end mt-4">

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        CREAR
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
