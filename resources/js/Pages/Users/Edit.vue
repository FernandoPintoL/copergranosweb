<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {ref, inject, reactive, onMounted, computed} from 'vue'
import {Link, router, useForm} from '@inertiajs/vue3'
import SectionBorder from '@/Components/SectionBorder.vue'
import Utils from "@/Utils/Utils.js";

const Swal = inject('$swal')

const route_model = "users"

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
})

onMounted(() => {
    reactives.list_roles = props.roles
    reactives.list_permissions = props.permissions
    if (props.model != null) {
        form.roles = props.model_roles
        form.permissions = props.model_permissions
    }
})

const form = useForm({
    id: props.model != null ? props.model.id : '',
    name: props.model != null ? props.model.name : '',
    email: props.model != null ? props.model.email : '',
    usernick: props.model != null ? props.model.usernick : '',
    password: props.model != null ? props.model.password : '',
    repeat_password: '',
    terms: 'accepted',
    isMobile: true,
    roles: [],
    permissions: []
})

const reactives = reactive({
    isLoad: false,
    isPassword: true,
    list_typedocument: [],
    list_roles: [],
    list_permissions: [],
    nameError: '',
    userNickError: '',
    emailError: '',
    passwordError: '',
    password_confirmation: '',
})

const onValidateName = (e) => {
    if (Utils.onValidateEmail(e.target.value)) {
        reactives.nameError =
            'El campo debe tener al menos 2 caracteres y solo pueden ser letras.'
    } else {
        reactives.nameError = ''
        form.name = e.target.value.toUpperCase()
    }
}



</script>

<template>
    <AppLayout title="Editar Usuario">
        <section class="bg-white dark:bg-gray-900 pt-4">
            <div class="pt-2 mx-auto px-20">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Editar Usuarios #{{
                        props.model.id
                    }}</h2>
                <p class="mb-3 text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                         viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                              d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                              clip-rule="evenodd"/>
                    </svg>
                    Creado {{
                        Utils.fecha(props.model.created_at)
                    }}
                </p>
                <p class="mb-3 text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                         viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                              d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                              clip-rule="evenodd"/>
                    </svg>
                    Actualizado {{
                        Utils.fecha(props.model.updated_at)
                    }}
                </p>
            </div>
        </section>
        <section class="bg-white dark:bg-gray-900">
            <div class="px-20 mx-auto lg:pb-16">
                <form action="#">

                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                            <input type="text" name="name" id="name"
                                   v-model="form.name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Type product name" required="">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="text" name="name" id="name"
                                   v-model="form.email"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Type product name" required="">
                        </div>
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
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        <svg class="w-6 h-6 px-0.5 text-gray-800 dark:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5v14m8-7h-2m0 0h-2m2 0v2m0-2v-2M3 11h6m-6 4h6m11 4H4c-.55228 0-1-.4477-1-1V6c0-.55228.44772-1 1-1h16c.5523 0 1 .44772 1 1v12c0 .5523-.4477 1-1 1Z"/>
                        </svg>
                        Editar
                    </button>
                </form>

            </div>
        </section>
    </AppLayout>
</template>

<style scoped>

</style>
