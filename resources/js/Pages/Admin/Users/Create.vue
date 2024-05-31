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
        second_name: '',
        third_name: '' || 'N/A',
        first_lastname: '',
        second_lastname: '',
        married_surname: '' || 'N/A',
        email: '',
        username: '',
        institution_id: '',
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
                <div class="flex justify-between">
                    <div class="mx-1 w-full">
                        <InputLabel for="name" value="Primer Nombre" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                            autofocus autocomplete="name" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="mx-1 w-full">
                        <InputLabel for="second_name" value="Segundo Nombre" />

                        <TextInput id="second_name" type="text" class="mt-1 block w-full" v-model="form.second_name"
                            required autofocus autocomplete="second_name" />

                        <InputError class="mt-2" :message="form.errors.second_name" />
                    </div>
                    <div class="mx-1 w-full">
                        <InputLabel for="third_name" value="Tercer Nombre" />

                        <TextInput id="third_name" type="text" class="mt-1 block w-full" v-model="form.third_name"
                            autofocus autocomplete="third_name" />

                        <InputError class="mt-2" :message="form.errors.third_name" />
                    </div>
                </div>
                <div class="flex justify-between mt-4">
                    <div class="mx-1 w-full">
                        <InputLabel for="first_lastname" value="Primer Apellido" />

                        <TextInput id="first_lastname" type="text" class="mt-1 block w-full"
                            v-model="form.first_lastname" required autofocus autocomplete="first_lastname" />

                        <InputError class="mt-2" :message="form.errors.first_lastname" />
                    </div>
                    <div class="mx-1 w-full">
                        <InputLabel for="second_lastname" value="Segundo Apellido" />

                        <TextInput id="second_lastname" type="text" class="mt-1 block w-full"
                            v-model="form.second_lastname" required autofocus autocomplete="second_lastname" />

                        <InputError class="mt-2" :message="form.errors.second_lastname" />
                    </div>
                    <div class="mx-1 w-full">
                        <InputLabel for="married_surname" value="Apellido de Casada" />

                        <TextInput id="married_surname" type="text" class="mt-1 block w-full"
                            v-model="form.married_surname" autofocus autocomplete="married_surname" />

                        <InputError class="mt-2" :message="form.errors.married_surname" />
                    </div>
                </div>
                <div class="flex justify-between mt-4">
                    <div class="mx-1 w-full">
                        <InputLabel for="username" value="Usuario" />

                        <TextInput id="username" type="text" class="mt-1 block w-full" v-model="form.username"
                            required autofocus autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.username" />
                    </div>

                    <div class="mx-1 w-full">
                        <InputLabel for="email" value="Email" />

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>


                </div>
                <div class="flex justify-between mt-4">
                    <div class="mx-1 w-full">
                        <InputLabel for="password" value="Password" />

                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            required autocomplete="new-password" />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    <div class="mx-1 w-full">
                        <InputLabel for="password_confirmation" value="Confirmar Contraseña" />

                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            v-model="form.password_confirmation" required autocomplete="new-password" />

                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>
                </div>

                <div class="mt-4">
                    <InputLabel for="roles" value="Roles" />
                    <VueMultiselect v-model="form.roles" :options="roles" :multiple="true"
                        :close-on-select="true" placeholder="Selecciona los permisos" label="name"
                        track-by="id" />

                </div>

                <div class="mt-4">
                    <InputLabel for="permissions" value="Permisos" />
                    <VueMultiselect v-model="form.permissions" :options="permissions" :multiple="true"
                        :close-on-select="true" placeholder="Selecciona los permisos" label="name"
                        track-by="id" />

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
