<script setup>
import Sidebar from '../../components/Sidebar.vue'
import DashboardHeader from '../../components/DashboardHeader.vue'

const currentClients = [
  {
    id: 1,
    name: 'Putra & Putri',
    phone: '+62 811 1111 1111',
    paket: 'A',
    tanggal: '25-05-2025',
    status: 'Berlangsung'
  }
]

const clientHistory = [
  // Example: Fill with past clients if needed
]
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <h1 class="text-5xl font-bold text-[#2F3367] mb-8">Klien</h1>
      <div class="flex justify-end mb-4">
        <button class="bg-white rounded-xl shadow px-6 py-2 font-semibold border hover:bg-gray-100 text-black">
          Tambah Klien
        </button>
      </div>
      <!-- Klien Saat Ini -->
      <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Klien Saat Ini</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full text-left border-separate border-spacing-y-2">
            <thead>
              <tr class="bg-[#2F3367] text-white">
                <th class="px-4 py-2 rounded-l-lg">ID</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">No. Telp</th>
                <th class="px-4 py-2">Paket</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2 rounded-r-lg">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="client in currentClients" :key="client.id" class="bg-gray-100 text-black">
                <td class="px-4 py-2">{{ client.id }}</td>
                <td class="px-4 py-2">{{ client.name }}</td>
                <td class="px-4 py-2">{{ client.phone }}</td>
                <td class="px-4 py-2">{{ client.paket }}</td>
                <td class="px-4 py-2">{{ client.tanggal }}</td>
                <td class="px-4 py-2">{{ client.status }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Riwayat Klien -->
      <div class="bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Riwayat Klien</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full text-left border-separate border-spacing-y-2">
            <thead>
              <tr class="bg-[#2F3367] text-white">
                <th class="px-4 py-2 rounded-l-lg">ID</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">No. Telp</th>
                <th class="px-4 py-2">Paket</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2 rounded-r-lg">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="clientHistory.length === 0">
                <td colspan="6" class="px-4 py-2 text-center text-gray-400">Belum ada riwayat klien.</td>
              </tr>
              <tr v-for="client in clientHistory" :key="client.id" class="bg-gray-100">
                <td class="px-4 py-2">{{ client.id }}</td>
                <td class="px-4 py-2">{{ client.name }}</td>
                <td class="px-4 py-2">{{ client.phone }}</td>
                <td class="px-4 py-2">{{ client.paket }}</td>
                <td class="px-4 py-2">{{ client.tanggal }}</td>
                <td class="px-4 py-2">{{ client.status }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>