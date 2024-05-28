<!-- resources/js/Components/PagesButton.vue -->
<template>
  <button @click="handleClick" class="mx-2 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
    <slot />
  </button>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
  href: {
    type: String,
    required: false
  }
});

const emit = defineEmits(['click']);

const handleClick = (event) => {
  if (props.href) {
    event.preventDefault(); // Prevenir la redirección si href está presente
  }
  emit('click', event); // Emitir el evento de clic
};
</script>