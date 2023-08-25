<template>
    <div>
        <h1 class="text-2xl">CasaOS Toolbox</h1>
        <hr>
        <div class="mt-4">
            <p class="my-2">Just like an ordinary toolbox...</p>
            <div class="text-xs">
                <strong>Current version</strong>: {{ version }}
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


    onBeforeMount(async () => {
        const { data } = await axios.get('/api/settings/current_version');
        version.value = data;
    })



</script>
