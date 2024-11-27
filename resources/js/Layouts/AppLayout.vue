<script setup>
import {ref, onMounted} from 'vue';
import {Head, Link, router} from '@inertiajs/vue3';
import {initFlowbite} from 'flowbite'
import NavHeader from "@/My_Components/NavHeader.vue";
import Menu from "@/My_Components/Menu.vue";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title"/>
        <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
            <NavHeader :name="$page.props.auth.user.name" :email="$page.props.auth.user.email" :photo-path="$page.props.auth.user.profile_photo_url"/>
            <Menu/>
            <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
                <div id="main-content"
                     class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
                    <slot/>
                </div>
            </div>
        </div>
    </div>
</template>
