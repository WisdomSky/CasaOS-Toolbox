<template>
    <Head title="Panel Hider" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Hider</h2>
        </template>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <el-row :gutter="20">
                <template v-for="section in panels.reduce((acc, panel) => { acc.indexOf(panel.section) === -1 ? acc.push(panel.section) : ''; return acc}, [])">
                    <el-col :xs="24" class="mt-4">
                        <h3 class="font-bold">{{ section }}</h3>
                    </el-col>
                    <el-col v-for="(panel,index) in panels.filter(panel => panel.section === section)" :xs="24" >
                        <el-card class="casaos-app mt-4">
                            <div class="flex items-center">
                                <div class="ml-4 grow flex flex-col items-left">
                                    <div>
                                        <span>{{ panel.title }}</span>
                                    </div>
                                    <div>
                                        <small>{{ panel.description }}</small>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <el-switch v-model="panel.visible" :loading="panel.loading" @change="hidePanel(panel.name)" :title="panel.visible ? 'Click to hide': 'Click to show'"></el-switch>
                                </div>
                            </div>
                        </el-card>
                    </el-col>
                </template>

            </el-row>
        </div>
    </AuthenticatedLayout>
</template>


<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


import { ref, onBeforeMount } from 'vue'
import axios from "axios";
import _ from 'lodash'

const panels = ref<{
        title: string,
        name: string,
        description: string,
        visible: boolean,
        section: string,
        loading: boolean
    }[]>([
    {
        title: 'Settings Button',
        name: 'settings_button',
        description: 'The settings button in the menu bar',
        visible: true,
        section: 'Menu',
        loading: false
    },{
        title: 'Terminal Button',
        name: 'terminal_button',
        description: 'The terminal button in the menu bar',
        visible: true,
        section: 'Menu',
        loading: false
    },{
        title: 'Storage Manager Button',
        name: 'storage_manager_button',
        description: 'The storage manager button in the storage widget',
        visible: true,
        section: 'Storage',
        loading: false
    },{
        title: 'Add New App Button',
        name: 'app_add_new_button',
        description: 'The add new custom app button',
        visible: true,
        section: 'Apps',
        loading: false
    },{
        title: 'App Menu Button',
        name: 'app_menu_button',
        description: 'The app\'s dropdown menu button',
        visible: true,
        section: 'Apps',
        loading: false
    },{
        title: 'Appstore App',
        name: 'app_appstore_button',
        description: 'The appstore app',
        visible: true,
        section: 'Apps',
        loading: false
    },{
        title: 'Files App',
        name: 'app_files_button',
        description: 'The built-in files app',
        visible: true,
        section: 'Apps',
        loading: false
    },
]);

onBeforeMount(async () => {
    const { data } = await axios.get('/api/panels');
    data.forEach((panel) => {
        try {
            let index = _.findIndex(panels.value, ['name', panel.name]);
            panels.value[index].visible = panel.visible === 1;
        } catch (e) {}
    })
})

async function hidePanel(name) {

    let index = _.findIndex(panels.value, ['name', name]);

    panels.value[index].loading = true;

    await axios.post('/api/panel/update', {
        name: panels.value[index].name,
        visible: panels.value[index].visible
    });

    panels.value[index].loading = false;
}



</script>
