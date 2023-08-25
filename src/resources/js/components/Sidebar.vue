<template>
    <el-menu
        class="menu"
        text-color="#fff"
        @open="handleOpen"
        @close="handleClose"
    >
        <el-menu-item index="1">
            <router-link to="/">
                <el-icon><document /></el-icon>
                <span>Home</span>
            </router-link>
        </el-menu-item>
        <el-menu-item index="2">
            <router-link to="/apphide">
                <el-icon><hide /></el-icon>
                <span>App Hider</span>
            </router-link>
        </el-menu-item>
        <el-menu-item index="3">
            <router-link to="/diskcleaner" style="cursor: not-allowed">
                <el-icon><brush /></el-icon>
                <span>Disk Cleaner</span>
            </router-link>
        </el-menu-item>
        <el-menu-item index="3">
            <router-link to="/appwidgets" style="cursor: not-allowed">
                <el-icon><cpu /></el-icon>
                <span>App Widgets</span>
            </router-link>
        </el-menu-item>
        <el-menu-item index="4">
            <router-link to="/backup" style="cursor: not-allowed">
                <el-icon><briefcase /></el-icon>
                <span>App Backup</span>
            </router-link>
        </el-menu-item>
        <el-menu-item index="5">
            <router-link to="/settings" >
                <el-icon><setting /></el-icon>
                <span>Settings</span>
            </router-link>
        </el-menu-item>

    </el-menu>
</template>

<script lang="ts" setup>
    import {
        Document,
        Hide,
        Setting,
        Briefcase,
        Brush,
        Cpu
    } from '@element-plus/icons-vue'


    const handleOpen = (key: string, keyPath: string[]) => {
        console.log(key, keyPath)
    }
    const handleClose = (key: string, keyPath: string[]) => {
        console.log(key, keyPath)
    }
</script>

<style lang="scss" scoped>
    .menu {
        height: 100vh;
        background: #333;

        ::v-deep(.el-sub-menu__title):hover,
        ::v-deep(.el-menu-item):hover {
            background: inherit;
        }

        ::v-deep(a) {
            color: #fff;
            text-decoration: none;
        }

        ::v-deep(a.router-link-active) {
            color: #7a7;
        }

    }
</style>
