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

    const props = defineProps({
        institution: {
            type: Object,
            required: true
        },
    })

    const form = useForm({
        name: props.institution.name,
        address: props.institution.address,
    });
</script>

<template>
    <AdminLayout>

        <Head title="Crear Usuario" />

        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1 class="text-2xl font-semibold text-indigo-700">Editar Instituto</h1>
                <Link :href="route('institutions.index')"
                    class="text-white font-semibold bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded">Atras</Link>
            </div>
        </div>
        <div class="mt-2 max-w-7xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
            <form @submit.prevent="form.put(route('institutions.update', institution.id))">

                <div>
                    <InputLabel for="name" value="Nombre" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                        autofocus autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div>
                    <InputLabel for="address" value="Dirección" />

                    <TextInput id="address" type="text" class="mt-1 block w-full" v-model="form.address"
                        autocomplete="address" />

                    <InputError class="mt-2" :message="form.errors.address" />
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
