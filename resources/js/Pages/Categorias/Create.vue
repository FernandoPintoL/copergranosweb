<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";

const route_model = "categorias"

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
    sigla: '',
    detalle: ''
});


const input_sigla = () => {
    form.sigla = form.sigla.toUpperCase();
};

const input_detalle = () => {
    form.detalle = form.detalle.toUpperCase();
};

const submit = () => {
    form.post('/'+route_model);
};

</script>

<template>
    <AppLayout :title="'Crear'+route_model" >
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Agregar {{ route_model }}</h2>
                <!-- Display flash message -->
                <div v-if="props.flash && props.flash.error" class="mb-4 text-red-600">
                    {{ props.flash.error }}
                </div>

                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="sigla" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sigla</label>
                            <input
                                v-model="form.sigla"
                                @input="input_sigla"
                                type="text" name="sigla" id="sigla"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra una sigla" required="">
                            <div v-if="form.errors.sigla" class="text-red-600 mt-2">{{ form.errors.sigla }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="detalle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detalle</label>
                            <input
                                v-model="form.detalle"
                                @input="input_detalle"
                                type="text" name="detalle" id="detalle"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un detalle">
                            <div v-if="form.errors.detalle" class="text-red-600 mt-2">{{ form.errors.detalle }}</div>
                        </div>
                    </div>
                    <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fa-solid fa-plus pr-2"></i> Agregar {{ route_model }}
                    </button>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
