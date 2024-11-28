<script setup>
import {useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionBorder from "@/Components/SectionBorder.vue";
import {onMounted, reactive} from "vue";

const route_model = "roles"

const props = defineProps({
    model: Object,
    permissions: Object,
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
})

onMounted(() => {
    console.log("roles asignados mi rol")
    console.log(props.model_permissions)
    reactives.list_permissions = props.permissions
})

const reactives = reactive({
    list_permissions: [],
})

const form = useForm({
    name: props.model.name ?? '',
    permissions: props.model_permissions ?? [],
});


const input_name = () => {
    form.name = form.name.toUpperCase();
};

const input_detalle = () => {
    form.detalle = form.detalle.toUpperCase();
};

const submit = () => {
    form.put(route(route_model + '.update', props.model.id));
};

</script>

<template>
    <AppLayout :title="'Editar '+route_model">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Editar {{ route_model }} #{{ props.model.id}}</h2>
                <!-- Display flash message -->
                <div v-if="props.flash && props.flash.error" class="mb-4 text-red-600">
                    {{ props.flash.error }}
                </div>

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
                        <div class="sm:col-span-2">
                            <section-border/>
                            <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">
                                Permisos para asignar
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
                        <i class="fa-solid fa-plus pr-2"></i> Agregar {{ route_model }}
                    </button>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
