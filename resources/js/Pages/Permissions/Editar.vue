<script setup>
import { defineProps } from 'vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Utils from '@/Utils/Utils.js';

const route_model = "permissions"

const props = defineProps({
    model: Object,
    crear: {
        type: Boolean,
        default: false, // Valor por defecto puede ser true o false
    },
    editar: {
        type: Boolean,
        default: false, // Valor por defecto puede ser true o false
    },
    eliminar: {
        type: Boolean,
        default: false, // Valor por defecto puede ser true o false
    },
    flash: Object // Define flash prop
})

const form = useForm({
    name: props.model.name,
});

const input_name = () => {
    form.name = form.name.toUpperCase();
};

const submit = () => {
    form.put(route(route_model+'.update', props.model.id));
};
</script>

<template>
    <AppLayout :title="'Editar '+route_model">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Editar {{ route_model }} #{{ props.model.id }}</h2>
                <!-- Display flash message -->
<!--                <div v-if="props.flash && props.flash.error" class="mb-4 text-red-600">
                    {{ props.flash.error }}
                </div>-->
                <p class="mb-4 text-gray-900 dark:text-white">Fecha Creado: {{ Utils.fecha(props.model.created_at) }}</p>
                <p class="mb-4 text-gray-900 dark:text-white">Fecha Actualizado: {{ Utils.fecha(props.model.updated_at) }}</p>
                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                            <input
                                v-model="form.name"
                                @input="input_name"
                                type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra una name" required="">
                            <div v-if="form.errors.name" class="text-red-600 mt-2">{{ form.errors.name }}</div>
                        </div>
                    </div>
                    <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                            <path fill-rule="evenodd"
                                  d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        Editar {{ route_model }}
                    </button>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
