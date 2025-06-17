import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Register from '../views/Register.vue'
import Login from '../views/Login.vue'
import Dashboard from '../views/Admin/Dashboard.vue'
import Acara from '../views/Admin/Acara.vue'
import Klien from '../views/Admin/Klien.vue'
import Vendor from '../views/Admin/Vendor.vue'
import Laporan from '../views/Admin/Laporan.vue'
import Pengaturan from '../views/Admin/Pengaturan.vue'
import EditAcara from '../views/Admin/EditAcara.vue'
import ViewAcara from '../views/Admin/ViewAcara.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', name: 'home', component: Home },
    { path: '/login', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register },
    { path: '/dashboard', name: 'admin-dashboard', component: Dashboard },
    { path: '/acara', name: 'acara', component: Acara },
    { path: '/klien', name: 'klien', component: Klien },
    { path: '/vendor', name: 'vendor', component: Vendor },
    { path: '/laporan', name: 'laporan', component: Laporan },
    { path: '/view', name: 'view', component: ViewAcara },
    { path: '/edit', name: 'edit', component: EditAcara },
    { path: '/pengaturan', name: 'pengaturan', component: Pengaturan },
    { path: '/editAcara', name: 'edit-acara', component: EditAcara },
    { path: '/viewAcara', name: 'view-acara', component: ViewAcara }
  ]
})

// Add this navigation guard:
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')
  const adminPages = [
    '/dashboard', '/acara', '/klien', '/vendor', '/laporan', '/pengaturan'
  ]
  if (adminPages.includes(to.path) && !token) {
    next({ name: 'login' })
  } else {
    next()
  }
})

export default router