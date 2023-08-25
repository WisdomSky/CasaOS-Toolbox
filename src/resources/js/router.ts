import { createRouter, createWebHistory } from 'vue-router';

import Home from './components/Home.vue'
import AppHide from './components/AppHide.vue'
import DiskCleaner from './components/DiskCleaner.vue'
import AppWidgets from './components/AppWidgets.vue'
import Settings from './components/Settings.vue'
import Backup from './components/Backup.vue'

export default createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", name: "home", component: Home },
        { path: "/apphide", name: "apphide", component: AppHide },
        { path: "/diskcleaner", name: "diskcleaner", component: DiskCleaner },
        { path: "/appwidgets", name: "appwidgets", component: AppWidgets },
        { path: "/settings", name: "settings", component: Settings },
        { path: "/backup", name: "backup", component: Backup },
    ]
});
