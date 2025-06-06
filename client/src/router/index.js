import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Register from '../views/Register.vue'
import Login from '../views/Login.vue'
import Dashboard from '../views/admin/Dashboard.vue'

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
    {
      path: "/admin/dashboard",
      name: "admin-dashboard",
      component: Dashboard,
    },
  ],
})

export default router