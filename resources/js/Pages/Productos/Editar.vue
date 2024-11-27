<script setup>
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Utils from '@/Utils/Utils.js';

const route_model = "productos"
const props = defineProps({
    model: Object
});

const form = useForm({
    codigo: props.model.codigo,
    nombre: props.model.nombre,
    descripcion: props.model.descripcion,
    precio: props.model.precio,
    categoria_id: props.model.categoria_id,
    medida_id: props.model.medida_id,
    proveedor_id: props.model.proveedor_id
});

const input_codigo = () => {
    form.codigo = form.codigo.toUpperCase();
};

const input_nombre= () => {
    form.detalle = form.detalle.toUpperCase();
};

const input_descripcion = () => {
    form.descripcion = form.descripcion.toUpperCase();
};
const submit = () => {
    form.put(`/${route_model}/${props.model.id}`);
};

// const fecha = (fechaData) => {
//     return moment.tz(fechaData, 'America/La_Paz').format('YYYY-MM-DD HH:MM a')
// }

</script>

<template>
    <AppLayout :title="'Crear'+route_model">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Editar producto</h2>
                <p class="mb-4 text-gray-900 dark:text-white">Fecha Creado: {{ Utils.fecha(props.model.created_at) }}</p>
                <p class="mb-4 text-gray-900 dark:text-white">Fecha Actualizado: {{ Utils.fecha(props.model.updated_at) }}</p>
                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="codigo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código</label>
                            <input
                                v-model="form.codigo"
                                @input="input_codigo"
                                type="text" name="codigo" id="codigo"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un codigo" required="">
                            <div v-if="form.errors.codigo" class="text-red-600 mt-2">{{ form.errors.codigo }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                            <input
                                v-model="form.nombre"
                                @input="input_nombre"
                                type="text" name="nombre" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un nombre">
                            <div v-if="form.errors.nombre" class="text-red-600 mt-2">{{ form.errors.nombre }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                            <input
                                v-model="form.descripcion"
                                @input="input_descripcion"
                                type="text" name="descripcion" id="descripcion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra una descripcion">
                            <div v-if="form.errors.descripcion" class="text-red-600 mt-2">{{ form.errors.descripcion }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="precio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                            <input
                                v-model="form.nombre"
                                @input="input_nombre"
                                type="text" name="nombre" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un nombre">
                            <div v-if="form.errors.nombre" class="text-red-600 mt-2">{{ form.errors.nombre }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="categoria_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria</label>
                            <input
                                v-model="form.categoria_id"
                                @input="input_categoria_id"
                                type="text" name="categoria_id" id="categoria_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra una categoria">
                            <div v-if="form.errors.categoria_id" class="text-red-600 mt-2">{{ form.errors.categoria_id }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="medida_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medida</label>
                            <input
                                v-model="form.medida_id"
                                @input="input_medida_id"
                                type="text" name="medida_id" id="medida_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra una medida">
                            <div v-if="form.errors.medida_id" class="text-red-600 mt-2">{{ form.errors.medida_id }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="proveedor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Proveedor</label>
                            <input
                                v-model="form.proveedor_id"
                                @input="input_proveedor_id"
                                type="text" name="proveedor_id" id="proveedor_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un proveedor">
                            <div v-if="form.errors.proveedor_id" class="text-red-600 mt-2">{{ form.errors.proveedor_id }}</div>
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
