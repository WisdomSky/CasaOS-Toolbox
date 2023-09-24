<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl">CasaOS Toolbox</h1>
            <hr>
            <div class="mt-4">
                <p class="my-2">Just like an ordinary toolbox...</p>
                <div class="text-xs">
                    <strong>Current version</strong>:
                    <template v-if="version.trim().length">v{{ version }}</template>
                    <template v-else>Loading...</template>&nbsp;
                    <span v-if="outdated" style="color:red">(New version available. v{{ nversion }})</span>
                </div>
                <div class="text-xs">
                    <strong>Developer</strong>: <a href="https://github.com/WisdomSky">WisdomSky</a>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


import { ref, onBeforeMount } from 'vue'
import axios from "axios";

const version = ref<string>('');
const outdated = ref<boolean>(false);
const nversion = ref<string>('');


onBeforeMount(async () => {
    const current_version = await axios.get('/api/settings/current_version');
    const latest_version = await axios.get('/api/settings/latest_version');
    version.value = String(current_version.data);
    nversion.value = String(latest_version.data);
    outdated.value = current_version.data !== latest_version.data;
})


</script>
