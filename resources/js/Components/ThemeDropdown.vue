<template>
    <div class="fixed top-4 right-32">
        <!-- Botón del menú desplegable -->
        <div class="relative">
            <button
                @click="toggleDropdown"
                class="w-11 h-11 flex items-center justify-center rounded-full border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 shadow-md focus:outline-none"
            >
                <i class="fas fa-tools text-gray-700 dark:text-gray-300"></i> <!-- Ícono del menú -->
            </button>

            <!-- Menú Desplegable -->
            <div
                v-show="isDropdownOpen"
                @click.away="closeDropdown"
                class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10"
            >
                <!-- Opción: Modo Oscuro -->
                <div
                    @click="toggleDarkMode"
                    class="p-4 flex items-center gap-2 hover:bg-gray-700 dark:hover:bg-gray-600 cursor-pointer"
                >
                    <template v-if="isDarkMode">
                        <i class="fas fa-sun text-yellow-400 text-lg"></i> <!-- Ícono Sol -->
                        <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Modo Claro</span>
                    </template>
                    <template v-else>
                        <i class="fas fa-moon text-blue-500 text-lg"></i> <!-- Ícono Luna -->
                        <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Modo Oscuro</span>
                    </template>
                </div>

                <!-- Opción: Normal -->
                <div
                    @click="setFontSize('normal')"
                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                >
                    <i class="fas fa-font text-gray-400"></i> <!-- Ícono de fuente -->
                    <span class="ml-2">Normal</span>
                </div>

                <!-- Opción: Adulto -->
                <div
                    @click="setFontSize('large')"
                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                >
                    <i class="fas fa-user text-gray-400"></i> <!-- Ícono de usuario -->
                    <span class="ml-2">Adulto</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isDarkMode: false, // Modo oscuro
            isDropdownOpen: false, // Estado del menú desplegable
            fontSize: "normal", // Tamaño de la fuente
        };
    },
    computed: {
        fontSizeClass() {
            return {
                normal: "text-base", // Tamaño predeterminado
                large: "text-2xl", // Tamaño aumentado (más grande para adultos)
            }[this.fontSize];
        },
    },
    mounted() {
        // Leer preferencias de tamaño de fuente y modo oscuro
        const storedFontSize = localStorage.getItem("font-size");
        const storedTheme = localStorage.getItem("color-theme");

        if (storedFontSize) {
            this.fontSize = storedFontSize;
            this.applyFontSize();
        }

        if (storedTheme) {
            this.isDarkMode = storedTheme === "dark";
        }

        this.applyTheme();
    },
    methods: {
        toggleDarkMode() {
            this.isDarkMode = !this.isDarkMode;
            localStorage.setItem("color-theme", this.isDarkMode ? "dark" : "light");
            this.applyTheme();
        },
        applyTheme() {
            if (this.isDarkMode) {
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }
        },
        setFontSize(size) {
            this.fontSize = size; // Cambiar tamaño de fuente
            localStorage.setItem("font-size", size); // Guardar preferencia
            this.applyFontSize();
        },
        applyFontSize() {
            // Asegurar que solo se aplique la clase correspondiente
            document.documentElement.classList.remove("text-base", "text-2xl");
            document.documentElement.classList.add(this.fontSizeClass);
        },
        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
        },
        closeDropdown() {
            this.isDropdownOpen = false;
        },
    },
};
</script>

<style scoped>
button:hover {
    transform: scale(1.1);
    transition: transform 0.2s ease-in-out;
}
</style>
