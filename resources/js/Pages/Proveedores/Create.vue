<script setup>
import {useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";

const route_model = "proveedores"

const props = defineProps({
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
    //datos de persona
    persona: {
        nombre: '',
        direccion: '',
        telefono: '',
        correo: ''
    },
    //datos de administrativo
    proveedor: {
        nit: '',
        razon_social: '',
    },
});

const input_name = (e) => {
    form.persona.nombre = e.target.value.toUpperCase();
};


const submit = () => {
    console.log(form)
    form.post('/' + route_model, {
        onError: (errors) => {
            console.log(errors);
        }
    });
};
</script>

<template>
    <AppLayout :title="'Crear '+route_model">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-20 mx-auto lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Agregar {{ route_model }}</h2>
                <!-- Display flash message -->
                <div v-if="props.flash && props.flash.error" class="mb-4 text-red-600">
                    {{ props.flash.error }}
                </div>
                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 pb-8">
                        <div class="w-full">
                            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                            <input
                                v-model="form.persona.nombre"
                                @input="input_name"
                                type="text" name="nombre" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un nombre" required="">
                            <div v-if="form.errors['persona.nombre']" class="text-red-600 mt-2">
                                {{ form.errors['persona.nombre'] }}
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="nit"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIT</label>
                            <input
                                v-model="form.proveedor.nit"
                                type="text" name="nit" id="nit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un nit" required="">
                            <div v-if="form.errors['proveedor.nit']" class="text-red-600 mt-2">
                                {{ form.errors['proveedor.nit'] }}
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="razon_social"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Razon Social</label>
                            <input
                                v-model="form.proveedor.razon_social"
                                type="text" name="razon_social" id="razon_social"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un razon_social" required="">
                            <div v-if="form.errors['proveedor.razonSocial']" class="text-red-600 mt-2">
                                {{ form.errors['proveedor.razonSocial'] }}
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion</label>
                            <input
                                v-model="form.persona.direccion"
                                type="text" name="direccion" id="direccion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un direccion">
                            <div v-if="form.errors['persona.direccion']" class="text-red-600 mt-2">
                                {{ form.errors['persona.direccion'] }}
                            </div>

                        </div>
                        <div class="w-full">
                            <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono</label>
                            <input
                                v-model="form.persona.telefono"
                                type="tel" name="telefono" id="telefono"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un telefono">
                            <div v-if="form.errors['persona.telefono']" class="text-red-600 mt-2">
                                {{ form.errors['persona.telefono'] }}
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="correo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
                            <input
                                v-model="form.persona.correo"
                                type="tel" name="correo" id="correo"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un correo">
                            <div v-if="form.errors['persona.correo']" class="text-red-600 mt-2">
                                {{ form.errors['persona.correo'] }}
                            </div>
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
