<script setup>
import { reactive, ref, inject } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";

const Swal = inject('$swal'); // SweetAlert para notificaciones

const props = defineProps({
    model: Object,
    medidas: Array,
    categorias: Array,
    proveedores: Array,
});

const form = useForm({
    id: props.model?.id || '',
    codigo: props.model?.codigo || '',
    nombre: props.model?.nombre || '',
    descripcion: props.model?.descripcion || '',
    precio: props.model?.precio || '',
    categoria_id: props.model?.categoria_id || '',
    medida_id: props.model?.medida_id || '',
    proveedor_id: props.model?.proveedor_id || '',
});

const state = reactive({
    isLoading: false,
    errors: {
        codigo: '',
        nombre: '',
        descripcion: '',
        precio: '',
    },
});

const validateField = (field, value) => {
    switch (field) {
        case 'codigo':
            state.errors.codigo = value.length < 3 ? 'El código debe tener al menos 3 caracteres.' : '';
            form.codigo = value.toUpperCase();
            break;
        case 'nombre':
            state.errors.nombre = value.length < 3 ? 'El nombre debe tener al menos 3 caracteres.' : '';
            form.nombre = value.toUpperCase();
            break;
        case 'descripcion':
            form.descripcion = value.toUpperCase();
            break;
        case 'precio':
            state.errors.precio = isNaN(value) || value <= 0 ? 'El precio debe ser un número positivo.' : '';
            form.precio = value;
            break;
    }
};

const submitForm = async () => {
    if (Object.values(state.errors).some(error => error !== '')) {
        Swal.fire('Error', 'Corrige los errores antes de continuar.', 'error');
        return;
    }

    state.isLoading = true;

    Swal.fire({
        title: 'Confirmar edición',
        text: '¿Estás seguro de guardar los cambios?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'Cancelar',
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                await form.put(`/productos/${form.id}`);
                Swal.fire('Éxito', 'Producto editado correctamente.', 'success');
            } catch (error) {
                console.error(error);
                Swal.fire('Error', 'Hubo un problema al guardar el producto.', 'error');
            }
        }
        state.isLoading = false;
    });
};
</script>
<template>
    <AppLayout title="Editar Producto">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Editar Producto</h2>
                <form @submit.prevent="submitForm">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <!-- Código -->
                        <div class="sm:col-span-2">
                            <label for="codigo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código</label>
                            <input
                                v-model="form.codigo"
                                @input="e => validateField('codigo', e.target.value)"
                                type="text" id="codigo"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Código del producto" required>
                            <p v-if="state.errors.codigo" class="text-red-600 mt-2">{{ state.errors.codigo }}</p>
                        </div>

                        <!-- Nombre -->
                        <div class="sm:col-span-2">
                            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                            <input
                                v-model="form.nombre"
                                @input="e => validateField('nombre', e.target.value)"
                                type="text" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Nombre del producto" required>
                            <p v-if="state.errors.nombre" class="text-red-600 mt-2">{{ state.errors.nombre }}</p>
                        </div>

                        <!-- Descripción -->
                        <div class="sm:col-span-2">
                            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                            <textarea
                                v-model="form.descripcion"
                                @input="e => validateField('descripcion', e.target.value)"
                                id="descripcion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Descripción del producto"></textarea>
                        </div>

                        <!-- Precio -->
                        <div class="sm:col-span-2">
                            <label for="precio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                            <input
                                v-model="form.precio"
                                @input="e => validateField('precio', e.target.value)"
                                type="number" id="precio"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Precio del producto" required>
                            <p v-if="state.errors.precio" class="text-red-600 mt-2">{{ state.errors.precio }}</p>
                        </div>

                        <!-- Categoría -->
                        <div class="sm:col-span-2">
                            <label for="categoria_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
                            <select
                                v-model="form.categoria_id"
                                id="categoria_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                <option v-for="cat in categorias" :key="cat.id" :value="cat.id">{{ cat.sigla }}</option>
                            </select>
                        </div>

                        <!-- Medida -->
                        <div class="sm:col-span-2">
                            <label for="medida_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medida</label>
                            <select
                                v-model="form.medida_id"
                                id="medida_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                <option v-for="med in medidas" :key="med.id" :value="med.id">{{ med.sigla }}</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="proveedor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Seleccione Proveedor
                            </label>
                            <select id="proveedor_id"
                                    class="custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.proveedor_id">
                                <option v-for="item in proveedor" :key="item.persona_id" :value="item.persona_id">
                                    {{item.persona_id}}
                                </option>
                            </select>
                            <div v-if="form.errors.proveedor_id" class="text-red-600 mt-2">{{ form.errors.proveedor_id }}</div>
                        </div>
                    </div>

                    <!-- Botón -->
                    <button type="submit"
                            class="mt-4 w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                        Guardar Cambios
                    </button>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
