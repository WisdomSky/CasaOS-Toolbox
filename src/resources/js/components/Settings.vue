<template>
    <div>
        <h1>Settings</h1>
        <hr>
        <div class="mt-4" v-loading="loading">
            <el-form :model="settings" label-width="120px" label-position="left" class="settings-form" @submit.native.prevent="save">
                <el-form-item label="Host">
                    <el-input v-model="settings.base_url" />
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="save">Save</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import { ref, onBeforeMount } from 'vue'
    import axios from "axios";

    const settings = ref<Setting[]>([]);

    const loading = ref<boolean>(false)

    onBeforeMount(async () => {
        const { data } = await axios.get('/api/settings');
        settings.value = data;
    })

    async function save() {
        loading.value = true;
        await axios.post('/api/settings', settings.value);
        loading.value = false;
    }



</script>

<style lang="scss" scoped>
    .settings-form {
        max-width: 500px;
    }
</style>
