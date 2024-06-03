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


    const form = useForm({
        code: '',
        name: '',
        address: '',
    });
</script>

<template>

    <Head title="Crear Instituto" />

    <AdminLayout>

        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1 class="text-2xl font-semibold text-indigo-700">Crear un nuevo Instituto</h1>
                <Link :href="route('institutions.index')"
                    class="text-white font-semibold bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded">Atras</Link>
            </div>
        </div>
        <div class="mt-2 max-w-7xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
            <form @submit.prevent="form.post(route('institutions.store'))">

                <div class="mx-1 w-full">
                    <InputLabel for="code" value="Codigo" />

                    <TextInput id="code" type="text" class="mt-1 block w-full" v-model="form.code" required
                        autofocus autocomplete="code" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mx-1 w-full">
                    <InputLabel for="name" value="Nombre" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                        required autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mx-1 w-full">
                    <InputLabel for="address" value="Dirección" />

                    <TextInput id="address" type="text" class="mt-1 block w-full" v-model="form.address"
                        required autocomplete="address" />

                    <InputError class="mt-2" :message="form.errors.address" />
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
