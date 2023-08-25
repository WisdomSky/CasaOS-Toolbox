<template>
    <el-container class="main">
        <el-aside>
            <Sidebar></Sidebar>
        </el-aside>
        <el-main><router-view></router-view></el-main>
    </el-container>
</template>
<script lang="ts" setup>
    import { ref } from 'vue'
    import Sidebar from './components/Sidebar.vue'


    const test = ref<string>('world');
</script>

<style lang="scss" scoped>
    .main {
        height: 100vh;
    }
</style>
