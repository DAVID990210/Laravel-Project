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

    const form = useForm({
        name: ""
    });
</script>

<template>

    <Head title="Crear un nuevo Permiso" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">

            <div class="flex justify-between">
                <h1>Crear un nuevo Permiso</h1>
                <Link :href="route('permissions.index')"
                    class="text-white font-semibold bg-indigo-500 hober:bg-indigo-700 px-4 py-2 rounded">Atras</Link>

            </div>

            <div class="mt-6 max-w mx-auto">
                <form @submit.prevent="form.post(route('permissions.store'))">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="flex items-center mt-4">

                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Crear
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>

</template>
