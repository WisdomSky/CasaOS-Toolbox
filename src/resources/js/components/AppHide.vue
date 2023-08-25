<template>
    <div>
        <h1>App Hide</h1>
        <hr>
        <el-row v-if="apps.length" :gutter="20">
            <el-col v-for="(app,index) in apps" :xs="24" :sm="18" :md="12" :lg="6">
                <el-card class="casaos-app mt-4" :class="{'app-hidden': !app.visible}">
                    <div class="flex items-center">
                        <div class="pr-2 grow flex items-center">
                            <img :src="app.icon" style="max-width: 75px" v-if="app.icon.trim().length"/>
                            <img src="./../../assets/img/default-img.svg" style="max-width: 75px" v-else/>
                            <span class="inline-block ml-4">{{ app.title }}</span>
                        </div>
                        <div class="text-right">
                            <el-switch v-model="app.visible" :loading="app.loading" @change="hideApp(index)" :title="app.visible ? 'Click to hide': 'Click to show'"></el-switch>
                        </div>
                    </div>
                </el-card>
            </el-col>
        </el-row>
        <el-skeleton v-for="i in Array(5)" v-else class="mt-4">
            <template #template>
                <el-row :gutter="20" style="margin-bottom: 20px">
                    <el-col :xs="24" :sm="5">
                        <el-skeleton-item variant="image" style="width: 100%; height: 100%" />
                    </el-col>
                    <el-col :xs="24" :sm="18">
                        <el-skeleton :rows="3" />
                    </el-col>
                </el-row>
            </template>
        </el-skeleton>
    </div>
</template>

<script lang="ts" setup>
    import { ref, onBeforeMount } from 'vue'
    import axios from "axios";

    const apps = ref<App[]>([]);

    onBeforeMount(async () => {
        const { data } = await axios.get('/api/apps');
        apps.value = data;
    })


    async function hideApp(index) {

        let app = apps.value[index];

        if (app.app_id == "casaos-toolbox") {
            const { data } = await axios.get('/api/settings/base_url');
            if (!app.visible) {
                alert(`WARNING:\n\nHiding CasaOS Toolbox means you cannot access this page from CasaOS anymore and have to manually visit the WebUI URL in order access this page again.\n\nCasaOS Toolbox WebUI URL:\n${data}`);
            }
        }

        app.loading = true;

        await axios.post('/api/app/hide', {
            app_id: app.app_id,
            hide: !app.visible
        });

        app.loading = false;
    }


</script>

<style scoped>
    .casaos-app {
        height: 120px;
    }
    .app-hidden {
        opacity: 0.35;
        filter: grayscale(1);
    }
</style>
