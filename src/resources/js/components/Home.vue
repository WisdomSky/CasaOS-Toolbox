<template>
    <div>
        <h1 class="text-2xl">CasaOS Toolbox</h1>
        <hr>
        <div class="mt-4">
            <p class="my-2">Just like an ordinary toolbox...</p>
            <div class="text-xs">
                <strong>Current version</strong>: v{{ version }}&nbsp;
                <span v-if="outdated" style="color:red">(New version available. v{{ nversion }})</span>
            </div>
            <div class="text-xs">
                <strong>Developer</strong>: <a href="https://github.com/WisdomSky">WisdomSky</a>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import { ref, onBeforeMount } from 'vue'
    import axios from "axios";

    const version = ref<string>('');
    const outdated = ref<boolean>(false);
    const nversion = ref<string>('');


    onBeforeMount(async () => {
        const current_version = await axios.get('/api/settings/current_version');
        const latest_version = await axios.get('/api/settings/latest_version');
        version.value = current_version.data;
        outdated.value = current_version.data !== latest_version.data;
        nversion.value = latest_version.data;
    })



</script>
