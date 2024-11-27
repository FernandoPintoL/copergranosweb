<script setup>
import {defineProps, onMounted, reactive, ref} from 'vue';
import {useForm, usePage} from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Utils from '@/Utils/Utils.js';
import SectionBorder from "@/Components/SectionBorder.vue";

const route_model = "administrativos"

const props = defineProps({
    model: Object,
    roles: Object,
    permissions: Object,
    model_roles: Object,
    model_permissions: Object,
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
});

const reactives = reactive({
    isPassword: true,
    list_roles: [],
    list_permissions: [],
})

onMounted(() => {
    console.log('model', props.model)
    reactives.list_roles = props.roles
    reactives.list_permissions = props.permissions
})

const form = useForm({
    //datos de persona
    persona: {
        nombre: props.model.persona.nombre ?? '',
        direccion: props.model.persona.direccion ?? '',
        telefono: props.model.persona.telefono ?? '',
        correo: props.model.persona.correo ?? ''
    },
    //datos de administrativo
    administrativo: {
        ci: props.model.ci ?? '',
        departamento: props.model.departamento ?? '',
        puesto: props.model.puesto ?? '',
        salario: props.model.salario ?? '',
    },
    //datos de user
    user: {
        name: props.model.user.name ?? '',
        email: props.model.user.email ?? '',
        password: props.model.user.password ?? '',
    },
    roles: props.model_roles ?? [],
    permissions: props.model_permissions ?? []
});

const input_name = (e) => {
    form.persona.nombre = e.target.value.toUpperCase();
    form.user.name = form.persona.nombre;
};

const input_email = (e) => {
    form.persona.correo = e.target.value;
    form.user.email = form.persona.correo;
};

const submit = () => {
    form.put(route(`${route_model}.update`, props.model.persona_id), {
        preserveScroll: true,
        onSuccess: () => {
            Utils.swal('Eliminado!', 'Registro actualizado correctamente', 'success');
        },
        onError: () => {
            Utils.swal('Error!','Error al actualizar el registro', 'error');
        }
    });
};

</script>

<template>
    <AppLayout :title="'Editar '+route_model">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-20 mx-auto lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Editar {{ route_model }}</h2>
                <!-- Display flash message -->
                <div v-if="props.flash && props.flash.error" class="mb-4 text-red-600">
                    {{ props.flash.error }}
                </div>
                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 pb-8">
                        <div class="sm:col-span-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                Datos Personales
                            </h3>
                        </div>
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
                            <label for="ci"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CI</label>
                            <input
                                v-model="form.administrativo.ci"
                                type="text" name="ci" id="ci"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un ci" required="">
                            <div v-if="form.errors['administrativo.ci']" class="text-red-600 mt-2">
                                {{ form.errors['administrativo.ci'] }}
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
                        <div class="sm:col-span-2">
                            <SectionBorder/>
                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                Datos Administrativos
                            </h3>
                        </div>
                        <div class="w-full">
                            <label for="departamento"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
                            <input
                                v-model="form.administrativo.departamento"
                                type="text" name="departamento" id="departamento"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un departamento" required="">
                            <div v-if="form.errors['administrativo.departamento']" class="text-red-600 mt-2">
                                {{ form.errors['administrativo.departamento'] }}
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="puesto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Puesto</label>
                            <input
                                v-model="form.administrativo.puesto"
                                type="text" name="puesto" id="puesto"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un puesto" required="">
                            <div v-if="form.errors['administrativo.puesto']" class="text-red-600 mt-2">
                                {{ form.errors['administrativo.puesto'] }}
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="salario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salario</label>
                            <input
                                v-model="form.administrativo.salario"
                                type="number" name="salario" id="salario"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Registra un salario" required="">
                            <div v-if="form.errors['administrativo.salario']" class="text-red-600 mt-2">
                                {{ form.errors['administrativo.salario'] }}
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <SectionBorder/>
                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                Controles de acceso
                            </h3>
                        </div>
                        <div class="sm:col-span-2">

                            <label for="correo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
                            <p class="mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ form.user.email }}</p>
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 pb-8">
                        <div class="w-full">
                            <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">
                                Roles
                            </h3>
                            <div class="grid grid-cols-2 gap-2">
                                <div v-for="item in reactives.list_roles" :key="item.id">
                                    <label :for="item.name + '-' + item.id"
                                           class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                <span class="text-sm text-gray-500 dark:text-neutral-400">
                                    {{ item.name }}
                                </span>
                                        <input type="checkbox" v-model="form.roles"
                                               class="shrink-0 ms-auto mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                               :id="item.name + '-' + item.id" :value="item.name"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">
                                Permisos
                            </h3>
                            <div class="grid grid-cols-2 gap-2">
                                <div v-for="item in reactives.list_permissions" :key="item.id">
                                    <label :for="item.name + '-' + item.id"
                                           class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                <span class="text-sm text-gray-500 dark:text-neutral-400">
                                    {{ item.name }}
                                </span>
                                        <input type="checkbox" v-model="form.permissions"
                                               class="shrink-0 ms-auto mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                               :id="item.name + '-' + item.id" :value="item.name"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                        </svg>
                        Editar {{ route_model }}
                    </button>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
