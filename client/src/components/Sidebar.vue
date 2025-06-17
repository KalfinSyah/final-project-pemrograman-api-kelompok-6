<script setup>
import logo from '../assets/logo.png'
import { useRoute } from 'vue-router'
const route = useRoute()

function handleLogout() {
  localStorage.removeItem('token')
}
</script>

<template>
  <div class="fixed top-0 left-0 w-64 h-screen bg-[#2F3367] text-white flex flex-col p-2 z-20">
    <div class="mb-4 flex flex-col items-center">
      <img :src="logo" alt="Ruang Hati" class="h-12 mb-2" />
    </div>
    <nav class="flex flex-col space-y-2">
      <router-link
        to="/dashboard"
        class="flex items-center px-4 py-2 rounded transition"
        :class="route.path === '/dashboard' ? 'bg-white text-[#2F3367] font-semibold shadow' : 'hover:bg-[#404488]'"
      >
        <span class="mr-2">🏠</span> Dashboard
      </router-link>
      <router-link
        to="/acara"
        class="flex items-center px-4 py-2 rounded transition"
        :class="route.path === '/acara' ? 'bg-white text-[#2F3367] font-semibold shadow' : 'hover:bg-[#404488]'"
      >
        <span class="mr-2">📅</span> Acara
      </router-link>
      <router-link
        to="/klien"
        class="flex items-center px-4 py-2 rounded transition"
        :class="route.path === '/klien' ? 'bg-white text-[#2F3367] font-semibold shadow' : 'hover:bg-[#404488]'"
      >
        <span class="mr-2">🧰</span> Vendor
      </router-link>
      <router-link
        to="/laporan"
        class="flex items-center px-4 py-2 rounded transition"
        :class="route.path === '/laporan' ? 'bg-white text-[#2F3367] font-semibold shadow' : 'hover:bg-[#404488]'"
      >
        <span class="mr-2">📄</span> Laporan
      </router-link>
    </nav>
    <div class="mt-auto mb-4 flex flex-col space-y-2">
      <router-link
        to="/pengaturan"
        class="flex items-center px-4 py-2 rounded transition"
        :class="route.path === '/pengaturan' ? 'bg-white text-[#2F3367] font-semibold shadow' : 'hover:bg-[#404488]'"
      >
        <span class="mr-2">⚙️</span> Pengaturan
      </router-link>
      <router-link
        to="/"
        class="flex items-center px-4 py-2 rounded transition hover:bg-[#404488]"
        @click="handleLogout"
      >
        <span class="mr-2">🚪</span> Keluar
      </router-link>
    </div>
  </div>
</template>

<style scoped>
.font-script {
  font-family: 'Dancing Script', cursive, sans-serif;
  font-size: 0.9rem;
  color: #fff;
  opacity: 0.8;
}
</style>