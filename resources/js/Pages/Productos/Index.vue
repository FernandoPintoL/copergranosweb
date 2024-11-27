<script setup>
import {ref, onMounted, reactive} from 'vue'
import {Link} from '@inertiajs/vue3'
import {useForm} from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Utils from '@/Utils/Utils.js';
import Swal from 'sweetalert2';
import NavBody from "@/My_Components/NavBody.vue";
import TableList from "@/My_Components/TableList.vue";

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

const route_model = "productos"

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
        const response = await axios.get(`/api/${route_model}/search`, {params: {query: query.value.toString().toUpperCase()}});
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
    form.delete(route(route_model + ".destroy", form.id), {
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
        <div
            class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
            <div class="w-full mb-1">
                <NavBody :name="route_model"/>
                <div
                    class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <form class="sm:pr-3" action="#" method="GET">
                            <label :for="'table-search-'+route_model" class="sr-only">Busqueda de {{
                                    route_model
                                }}</label>
                            <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                                <input v-model="query" @input="search" :id="'table-search-'+route_model" type="text"
                                       name="email"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       :placeholder="'Busqueda de '+route_model">
                            </div>
                        </form>
                    </div>
                    <Link  :href="route(route_model+'.create')"
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <i class="fa-solid fa-plus"></i>
                        Agregar {{ route_model }}
                    </Link>
                </div>
            </div>
        </div>
        <TableList>
            <template #tbl-header>
                <th scope="col"
                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Id
                </th>
                <th scope="col"
                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Codigo
                </th>
                <th scope="col"
                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Nombre
                </th>
                <th scope="col"
                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Descripcion
                </th>
                <th scope="col"
                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Precio
                </th>
                <th scope="col"
                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Categoria
                </th>
                <th scope="col"
                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Medida
                </th>
                <th scope="col"
                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Proveedor
                </th>
                <th scope="col"
                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Creado/Actualizado
                </th>
                <th scope="col"
                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Acciones
                </th>
            </template>
            <template #tbl-body>
                <tr v-for="item in datas.list" :key="item.id"
                    class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                        {{ item.id }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                        {{ item.codigo }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                        {{ item.nombre }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                        {{ item.descripcion }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                        {{ item.precio }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                        {{ item.categoria_id }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                        {{ item.medida_id }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                        {{ item.proveedor_id }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap dark:text-white">
                        <p>Creado: {{ Utils.fecha(item.created_at) }}</p>
                        <p>Actualizado: {{ Utils.fecha(item.updated_at) }}</p>
                    </td>

                    <td class="p-4 space-x-2 whitespace-nowrap">
                        <Link :href="route(route_model+'.edit', item.id)"
                              class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                <path fill-rule="evenodd"
                                      d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            Editar
                        </Link>
                        <button type="button" v-if="props.eliminar" @click="destroyMessage(item.id)"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            Eliminar
                        </button>
                    </td>
                </tr>
            </template>
        </TableList>
    </AppLayout>
</template>

<style scoped>

</style>
