<script setup>
import {Head, Link} from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Bienvenido"/>
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[577px]"
             src="https://laravel.com/assets/img/welcome/background.svg"/>
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full ">
                <header class="grid grid-cols-2 items-center gap-2 py-1.5 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                    </div>
                    <nav v-if="canLogin" class="flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

<!--                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>-->
                        </template>
                    </nav>
                </header>
                <div
                    class="flex flex-col justify-center items-center xl:px-0">
                    <div class="block md:max-w-lg pb-2.5">
                        <img src="/assets/images/copergranos.jpeg" alt="astronaut image"
                             class="h-auto max-w-full rounded-lg">
                    </div>
                    <div class="text-center xl:max-w-4xl">
                        <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">
                            COPERGRANOS</h1>
                        <p class="mb-5 text-base font-normal text-gray-500 md:text-lg dark:text-gray-400">Somos una cooperativa dedicada a impulsar el desarrollo agrícola, conectando agricultores, promoviendo prácticas sostenibles y generando valor para nuestras comunidades. </p>
                        <Link :href="route('dashboard')"
                              class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-3 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg
                                class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                            IR AL DASHBOARD
                        </Link>
                    </div>
                </div>
                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    Copergranos v1.0.0 (GRUPO 02 SA)
                </footer>
            </div>
        </div>
    </div>
</template>
