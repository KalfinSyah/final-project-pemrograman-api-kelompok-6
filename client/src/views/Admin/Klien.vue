<script setup>
import { ref } from 'vue'
import Sidebar from '../../components/Sidebar.vue'

// Data Klien
const currentClients = ref([
  {
    id: 1,
    name: 'Putra & Putri',
    nama_cpp: 'Putra',
    nama_cpw: 'Putri',
    phone: '+62 811 1111 1111',
    status: 'Berlangsung'
  }
])

const clientHistory = ref([])

// Form & Modal
const showForm = ref(false)
const form = ref({
  name: '',
  nama_cpp: '',
  nama_cpw: '',
  phone: '',
  status: 'Berlangsung'
})

// Fungsi Tambah Klien
const addClient = () => {
  const newClient = {
    id: currentClients.value.length + 1,
    ...form.value
  }
  currentClients.value.push(newClient)
  resetForm()
}

const resetForm = () => {
  form.value = {
    name: '',
    nama_cpp: '',
    nama_cpw: '',
    phone: '',
    status: 'Berlangsung'
  }
  showForm.value = false
}
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <h1 class="text-5xl font-bold text-[#2F3367] mb-8">Klien</h1>
      <div class="flex justify-end mb-4">
        <button
          @click="showForm = true"
          class="bg-white rounded-xl shadow px-6 py-2 font-semibold border hover:bg-gray-100 text-black">
          Tambah Klien
        </button>
      </div>

      <!-- Tabel Klien Saat Ini -->
      <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Klien Saat Ini</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full text-left border-separate border-spacing-y-2">
            <thead>
              <tr class="bg-[#2F3367] text-white">
                <th class="px-4 py-2 rounded-l-lg">ID</th>
                <th class="px-4 py-2">Nama Gabungan</th>
                <th class="px-4 py-2">Nama CPP</th>
                <th class="px-4 py-2">Nama CPW</th>
                <th class="px-4 py-2">No. Telp</th>
                <th class="px-4 py-2 rounded-r-lg">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="client in currentClients" :key="client.id" class="bg-gray-100 text-black">
                <td class="px-4 py-2">{{ client.id }}</td>
                <td class="px-4 py-2">{{ client.name }}</td>
                <td class="px-4 py-2">{{ client.nama_cpp }}</td>
                <td class="px-4 py-2">{{ client.nama_cpw }}</td>
                <td class="px-4 py-2">{{ client.phone }}</td>
                <td class="px-4 py-2">{{ client.status }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Tabel Riwayat Klien -->
      <div class="bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Riwayat Klien</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full text-left border-separate border-spacing-y-2">
            <thead>
              <tr class="bg-[#2F3367] text-white">
                <th class="px-4 py-2 rounded-l-lg">ID</th>
                <th class="px-4 py-2">Nama Gabungan</th>
                <th class="px-4 py-2">Nama CPP</th>
                <th class="px-4 py-2">Nama CPW</th>
                <th class="px-4 py-2">No. Telp</th>
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
                <td class="px-4 py-2">{{ client.nama_cpp }}</td>
                <td class="px-4 py-2">{{ client.nama_cpw }}</td>
                <td class="px-4 py-2">{{ client.phone }}</td>
                <td class="px-4 py-2">{{ client.status }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Tambah Klien -->
   <transition name="fade">
  <div v-if="showForm" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl w-full max-w-3xl shadow-xl relative transition-all transform scale-100">
      <h2 class="text-2xl font-bold text-[#2F3367] mb-6">Tambah Klien</h2>
      <form @submit.prevent="addClient" class="space-y-4">
        <div>
          <label class="block text-gray-700 mb-1">Nama Gabungan</label>
          <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" required />
        </div>
        <div>
          <label class="block text-gray-700 mb-1">Nama CPP</label>
          <input v-model="form.nama_cpp" type="text" class="w-full border rounded px-3 py-2" />
        </div>
        <div>
          <label class="block text-gray-700 mb-1">Nama CPW</label>
          <input v-model="form.nama_cpw" type="text" class="w-full border rounded px-3 py-2" />
        </div>
        <div>
          <label class="block text-gray-700 mb-1">No. Telp</label>
          <input v-model="form.phone" type="text" class="w-full border rounded px-3 py-2" required />
        </div>
        <div>
          <label class="block text-gray-700 mb-1">Status</label>
          <select v-model="form.status" class="w-full border rounded px-3 py-2">
            <option value="Berlangsung">Berlangsung</option>
            <option value="Selesai">Selesai</option>
          </select>
        </div>
        <div class="flex justify-end gap-3 pt-4">
          <button type="button" @click="showForm = false" class="px-4 py-2 rounded border">Batal</button>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</transition>

  </div>
</template>

<style scoped>
/* Transisi Modal Fade */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}

/* Transisi Skala untuk konten modal */
@keyframes scale-in {
  0% {
    transform: scale(0.95);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

.animate-scale-in {
  animation: scale-in 0.3s ease;
}
</style>
