import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Register from '../views/Register.vue'
import Login from '../views/Login.vue'
import Dashboard from '../views/Admin/Dashboard.vue'
import Acara from '../views/Admin/Acara.vue'
import Klien from '../views/Admin/Klien.vue'
import Laporan from '../views/Admin/Laporan.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { 
      path: '/', 
      name: 'home',
      component: Home 
    },
    { 
      path: "/login", 
      name: "login", 
      component: Login 
    },
    { 
      path: "/register", 
      name: "register", 
      component: Register
    },
    {path: "/dashboard", name: "admin-dashboard", component: Dashboard },
    { path: '/acara', name: 'acara', component: Acara },
    { path: '/klien', name: 'klien', component: Klien },
    { path: '/laporan', name: 'laporan', component: Laporan },
  ],
})

export default router