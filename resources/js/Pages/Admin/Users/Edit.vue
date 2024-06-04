<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/vue3';
    import VueMultiselect from 'vue-multiselect';
    import {
        onMounted,
        watch
    } from 'vue';


    const props = defineProps({
        user: {
            type: Object,
            required: true
        },
        roles: Array,
        permissions: Array
    })

    const form = useForm({
        name: props.user?.name,
        second_name: props.user?.second_name,
        third_name: props.user?.third_name || 'N/A',
        first_lastname: props.user?.first_lastname,
        second_lastname: props.user?.second_lastname,
        married_surname: props.user?.married_surname || 'N/A',
        username: props.user?.username,
        email: props.user?.email,
        dpi: props.user?.dpi,
        roles: [],
        permissions: []
    });

    const submit = () => {
        form.put(route('users.update', props.user?.id));
    };

    onMounted(() => {
        form.permissions = props.user?.permissions;
        form.roles = props.user?.roles;
    })

    watch(
        () => props.user,
        () => {
            form.permissions = props.user?.permissions,
                form.roles = props.user?.roles
        }
    )
</script>

<template>
    <AdminLayout>

        <Head title="Crear Usuario" />

        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1 class="text-2xl font-semibold text-indigo-700">Crear un nuevo usuario</h1>
                <Link :href="route('users.index')"
                    class="text-white font-semibold bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded">Atras</Link>
            </div>
        </div>
        <div class="mt-2 max-w-7xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
            <form @submit.prevent="submit">
                <div class="flex justify-between">
                    <div class="mx-1 w-full">
                        <InputLabel for="name" value="Name" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                            autofocus autocomplete="name" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="mx-1 w-full">
                        <InputLabel for="second_name" value="Segundo Nombre" />

                        <TextInput id="second_name" type="text" class="mt-1 block w-full" v-model="form.second_name"
                            required autocomplete="second_name" />

                        <InputError class="mt-2" :message="form.errors.second_name" />
                    </div>
                    <div class="mx-1 w-full">
                        <InputLabel for="third_name" value="Tercer Nombre" />

                        <TextInput id="third_name" type="text" class="mt-1 block w-full" v-model="form.third_name"
                            autocomplete="third_name" />

                        <InputError class="mt-2" :message="form.errors.third_name" />
                    </div>
                </div>
                <div class="flex justify-between mt-4">
                    <div class="mx-1 w-full">
                        <InputLabel for="first_lastname" value="Primer Apellido" />

                        <TextInput id="first_lastname" type="text" class="mt-1 block w-full"
                            v-model="form.first_lastname" required autocomplete="first_lastname" />

                        <InputError class="mt-2" :message="form.errors.first_lastname" />
                    </div>
                    <div class="mx-1 w-full">
                        <InputLabel for="second_lastname" value="Segundo Apellido" />

                        <TextInput id="second_lastname" type="text" class="mt-1 block w-full"
                            v-model="form.second_lastname" required autocomplete="second_lastname" />

                        <InputError class="mt-2" :message="form.errors.second_lastname" />
                    </div>
                    <div class="mx-1 w-full">
                        <InputLabel for="married_surname" value="Apellido de Casada" />

                        <TextInput id="married_surname" type="text" class="mt-1 block w-full"
                            v-model="form.married_surname" autocomplete="married_surname" />

                        <InputError class="mt-2" :message="form.errors.married_surname" />
                    </div>
                </div>
                <div class="flex justify-between mt-4">
                    <div class="mx-1 w-full">
                        <InputLabel for="username" value="Usuario" />

                        <TextInput id="username" type="text" class="mt-1 block w-full" v-model="form.username"
                            required autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.username" />
                    </div>
                    <div class="mx-1 w-full">
                        <InputLabel for="dpi" value="DPI" />

                        <TextInput id="dpi" type="text" class="mt-1 block w-full" v-model="form.dpi" required
                            autocomplete="dpi" />

                        <InputError class="mt-2" :message="form.errors.dpi" />
                    </div>
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="roles" value="Roles" />
                    <VueMultiselect v-model="form.roles" :options="roles" :multiple="true"
                        :close-on-select="true" placeholder="Selecciona los permisos" label="name" track-by="id" />

                </div>

                <div class="flex items-center justify-end mt-4">

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        CONFIRMAR
                    </PrimaryButton>
                </div>
            </form>
        </div>

    </AdminLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
