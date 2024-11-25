<script setup>
import {ref, onMounted, reactive} from 'vue'
import {Link} from '@inertiajs/vue3'
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Table_To_Categorias from "@/My_Components/Table_To_Categorias.vue";
import Utils from '@/Utils/Utils.js';
import Swal from 'sweetalert2';

const props = defineProps({
    listado: {
        type: Array,
        default: [],
    },
    crear: {
        type: Boolean,
        default: true, // Valor por defecto puede ser true o false
    },
    editar: {
        type: Boolean,
        default: true, // Valor por defecto puede ser true o false
    },
    eliminar: {
        type: Boolean,
        default: true, // Valor por defecto puede ser true o false
    },
});

onMounted(() => {
    console.log(props.listado)
    datas.list = props.listado
})

const form = useForm({
    id: 0,
});

const route_model = "categorias"

const query = ref('')

const datas = reactive({
    list: [],
    isLoad: false,
    dateStart: '',
    dateEnd: '',
    messageList: 'NO EXISTEN DATOS REGISTRADOSS',
    metodoList: '',
})

const search = async () => {
    try {
        const response = await axios.get(`/api/${route_model}/search`, { params: { query: query.value.toString().toUpperCase() } });
        datas.list = response.data;
    } catch (error) {
        console.error(error);
    }
};

const destroyMessage = (id) => {
    Swal.fire({
        title: 'Estas seguro de eliminar esta información?',
        text: '',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, estoy seguro!',
    }).then((result) => {
        if (result.isConfirmed) {
            datas.isLoad = true
            destroyData(id)
            datas.isLoad = false
        }
    })
}

const destroyData = async (id) => {
    form.id = id;
    form.delete(route(route_model+".destroy", form.id), {
        onSuccess: () => {
            console.log("Eliminado")
            //datas.list = datas.list.filter(item => item.id !== id)
            Swal.fire(
                'Eliminado!',
                'La información ha sido eliminada.',
                'success'
            )
        },
        onError: () => {
            console.log("Error")
            Swal.fire(
                'Error!',
                'La información no ha sido eliminada.',
                'error'
            )
        }
    })
}
</script>

<template>
    <AppLayout :title=route_model.toUpperCase()>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="max-w-screen-lg text-gray-500 sm:text-lg dark:text-gray-400 pb-4">
                        <div class="flex justify-between items-center">
                            <h1 class="text-2xl font-bold text-gray-700 px-4">{{ route_model.toUpperCase() }}</h1>
                            <Link :href="route(route_model+'.create')" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <i class="fa-solid fa-plus"></i>
                                Agregar {{ route_model }}
                            </Link>
                        </div>
                </div>
                <Table_To_Categorias>
                    <template #header-tbl>
                        <div class="px-4 py-2 bg-white dark:bg-gray-900">
                            <label :for="'table-search-'+route_model" class="sr-only">Busqueda de {{ route_model }}</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="text" v-model="query" @input="search" :id="'table-search-'+route_model"
                                       class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :placeholder="'Busqueda de '+route_model">
                            </div>
                        </div>
                    </template>
                    <template #tbl-header>
                        <th scope="col" class="px-6 py-3">
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Detalle
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Creado/Actualizado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </template>
                    <template #tbl-body>
                        <tr v-for="item in datas.list" :key="item.id"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                                {{ item.id }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                                {{ item.sigla }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                                {{ item.detalle }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                                <p>Creado: {{ Utils.fecha(item.created_at) }}</p>
                                <p>Actualizado: {{ Utils.fecha(item.updated_at) }}</p>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                                <Link :href="route(route_model+'.edit', item.id)"
                                      class="py-1 px-2 bg-blue-600 hover:bg-blue-700 focus:bg-red-700 inline-flex items-center gap-x-2 -ms-px first:rounded-s-lg first:ms-0 last:rounded-e-lg text-sm font-medium focus:z-10 border border-gray-200 text-white shadow-sm focus:outline-none disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                    Editar
                                    <i class="fa-solid fa-pencil"></i>
                                </Link>
                                <button type="button" v-if="props.eliminar" @click="destroyMessage(item.id)"
                                        class="py-1 px-2 bg-red-600 hover:bg-red-700 focus:bg-red-700' inline-flex items-center gap-x-2 -ms-px first:rounded-s-lg first:ms-0 last:rounded-e-lg text-sm font-medium focus:z-10 border border-gray-200 text-white shadow-sm focus:outline-none disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                    Eliminar
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                </Table_To_Categorias>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>

</style>
