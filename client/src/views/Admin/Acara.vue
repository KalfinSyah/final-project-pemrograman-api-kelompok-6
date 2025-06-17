<script setup>
import { ref } from 'vue'
import Sidebar from '../../components/Sidebar.vue'
import DashboardHeader from '../../components/DashboardHeader.vue'
import router from '../../router';

// State form tambah
const showForm = ref(false)

// State form edit
const isEditing = ref(false)
const editingClient = ref({
  id: null,
  name: '',
  phone: '',
  paket: 'A',
  tanggal: '',
  status: 'Berlangsung'
})

// Data form tambah
const form = ref({
  name: '',
  phone: '',
  paket: 'A',
  tanggal: '',
  status: 'Berlangsung'
})

// List client aktif & riwayat
const currentClients = ref([
  {
    id: 1,
    name: 'Putra & Putri',
    phone: '+62 811 1111 1111',
    paket: 'A',
    tanggal: '2025-05-25',
    status: 'Berlangsung'
  }
])

const clientHistory = ref([])

// Fungsi tambah client
const addClient = () => {
  const newClient = { ...form.value, id: Date.now() }
  currentClients.value.push(newClient)
  form.value = {
    name: '',
    phone: '',
    paket: 'A',
    tanggal: '',
    status: 'Berlangsung'
  }
  showForm.value = false
}

// Fungsi mulai edit
const startEdit = (client) => {
  editingClient.value = { ...client }
  isEditing.value = true
}

// Fungsi update client
const updateClient = () => {
  const index = currentClients.value.findIndex(c => c.id === editingClient.value.id)
  if (index !== -1) {
    currentClients.value[index] = { ...editingClient.value }
  }
  isEditing.value = false
}
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <h1 class="text-5xl font-bold text-[#2F3367] mb-8">Acara</h1>

      <!-- Tombol tambah -->
      <div class="flex justify-end mb-4">
        <button @click="showForm = true"
          class="bg-white rounded-xl shadow px-6 py-2 font-semibold border hover:bg-gray-100 text-black">
          Tambah Acara
        </button>
      </div>

      <!-- Acara Saat Ini -->
      <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Acara Saat Ini</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full text-left border-separate border-spacing-y-2">
            <thead>
              <tr class="bg-[#2F3367] text-white">
                <th class="px-4 py-2 rounded-l-lg">ID</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">No. Telp</th>
                <th class="px-4 py-2">Paket</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2 rounded-r-lg">Aksi</th>
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
                <td class="px-4 py-2">
                  <!-- <button @click="startEdit(client)" class="bg-orange-500 text-white px-4 py-1 rounded hover:bg-orange-600">
                    Edit
                  </button> -->
                  <button @click='router.push({name: "edit-acara", params: {
                    
                  }})' class="bg-orange-500 text-white px-4 py-1 rounded hover:bg-orange-600">
                    Edit
                  </button>
                 
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Riwayat Acara -->
      <div class="bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Riwayat Acara</h2>
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

    <!-- Modal Tambah -->
    <div v-if="showForm" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
      <div class="bg-white p-8 rounded-xl w-full max-w-3xl shadow-xl relative">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Tambah Acara</h2>
        <form @submit.prevent="addClient">
          <div class="mb-4">
            <label class="block text-gray-700">Nama</label>
            <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">No. Telp</label>
            <input v-model="form.phone" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Paket</label>
            <select v-model="form.paket" class="w-full border rounded px-3 py-2">
              <option value="A">Paket A</option>
              <option value="B">Paket B</option>
              <option value="C">Paket C</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Tanggal</label>
            <input v-model="form.tanggal" type="date" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Status</label>
            <select v-model="form.status" class="w-full border rounded px-3 py-2">
              <option value="Berlangsung">Berlangsung</option>
              <option value="Selesai">Selesai</option>
            </select>
          </div>
          <div class="flex justify-end gap-2">
            <button type="button" @click="showForm = false" class="px-4 py-2 rounded border">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Edit -->
    <div v-if="isEditing" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
      <div class="bg-white p-8 rounded-xl w-full max-w-3xl shadow-xl relative">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Edit Acara</h2>
        <form @submit.prevent="updateClient">
          <div class="mb-4">
            <label class="block text-gray-700">Nama</label>
            <input v-model="editingClient.name" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">No. Telp</label>
            <input v-model="editingClient.phone" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Paket</label>
            <select v-model="editingClient.paket" class="w-full border rounded px-3 py-2">
              <option value="A">Paket A</option>
              <option value="B">Paket B</option>
              <option value="C">Paket C</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Tanggal</label>
            <input v-model="editingClient.tanggal" type="date" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Status</label>
            <select v-model="editingClient.status" class="w-full border rounded px-3 py-2">
              <option value="Berlangsung">Berlangsung</option>
              <option value="Selesai">Selesai</option>
            </select>
          </div>
          <div class="flex justify-end gap-2">
            <button type="button" @click="isEditing = false" class="px-4 py-2 rounded border">Batal</button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>