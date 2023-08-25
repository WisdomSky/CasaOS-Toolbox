<template>
    <div>
        <h1>App Widgets</h1>
        <hr>
        <div class="mt-4">
            Available soon...
        </div>
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
            alert("");
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
