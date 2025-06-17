<script setup>
import { onMounted, ref } from 'vue'
import Sidebar from '../../components/Sidebar.vue'
import router from '../../router';
import Swal from 'sweetalert2'

// State form tambah
const showForm = ref(false)

// Data form tambah
const form = ref({
  wedding_contract_notes: "",
  reception_notes: "",
  wedding_package: "A",
  wedding_date: "",
  reservation_status : "Berlangsung",
  combined_name: "",
  groom: "",
  bride: "",
  telephone_num : "",
  wedding_location : ""
})

// List client aktif & riwayat
const currentClients = ref([])

const clientHistory = ref([])

// Fungsi tambah client
const addClient = async () => {
    try {
      const token = localStorage.getItem('token');
      const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/reservations`, {
        method: "POST",
        headers: {"Content-Type": "application/json", 'Authorization': `Bearer ${token}`},
        body: JSON.stringify(form.value)
      });
      if (response.ok) {
        Swal.fire({
          title: "Success",
          icon: "success",
          text: "Berhasil tambah acara!"
        });
      } else {
        Swal.fire({
          title: "Failed",
          icon: "error",
          text: "Gagal tambah acara!"
        });
      }
    } catch (error) {
        Swal.fire({
          title: "Failed",
          icon: "error",
          text: "Gagal tambah acara!"
        });
    }
  showForm.value = false
  window.location.reload()
}


async function fetchAcaraSaatIni() {
  try {
    const token = localStorage.getItem('token');
    const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/reservations`, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    if (!response.ok) {
      alert('fetch event failed');
    } else {
      const data = await response.json();
      currentClients.value = data.active_reservations
    }
  } catch (err) {
    alert('error system')
  }
}

async function fetchRiwayatAcara() {
  try {
    const token = localStorage.getItem('token');
    const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/reservations`, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    if (!response.ok) {
      alert('fetch event failed');
    } else {
      const data = await response.json();
      clientHistory.value = data.inactive_reservations
    }
  } catch (err) {
    alert('error system')
  }
}




onMounted(() => {
  fetchAcaraSaatIni();
  fetchRiwayatAcara();
});
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
                <td class="px-4 py-2">{{ client.reservation_id }}</td>
                <td class="px-4 py-2">{{ client.combined_name }}</td>
                <td class="px-4 py-2">{{ client.telephone_num }}</td>
                <td class="px-4 py-2">{{ client.wedding_package }}</td>
                <td class="px-4 py-2">{{ client.wedding_date }}</td>
                <td class="px-4 py-2">{{ client.reservation_status }}</td>
                <td class="px-4 py-2">
                  <!-- <button @click="startEdit(client)" class="bg-orange-500 text-white px-4 py-1 rounded hover:bg-orange-600">
                    Edit
                  </button> -->
                  <button @click='router.push({name: "edit-acara", params: {
                    idAcara: client.reservation_id
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
      <div class="bg-white rounded-2xl shadow-lg p-8 text-black">
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
                <td class="px-4 py-2">{{ client.reservation_id }}</td>
                <td class="px-4 py-2">{{ client.combined_name }}</td>
                <td class="px-4 py-2">{{ client.telephone_num }}</td>
                <td class="px-4 py-2">{{ client.wedding_package }}</td>
                <td class="px-4 py-2">{{ client.wedding_date }}</td>
                <td class="px-4 py-2">{{ client.reservation_status }}</td>
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
            <input v-model="form.combined_name" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
            <div class="mb-4">
            <label class="block text-gray-700">Nama Pempelai Laki</label>
            <input v-model="form.groom" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Nama Pempelai Wanita</label>
            <input v-model="form.bride" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Lokasi Pernikahan</label>
            <input v-model="form.wedding_location" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">No. Telp</label>
            <input v-model="form.telephone_num" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Wedding Contract Notes</label>
            <input v-model="form.wedding_contract_notes" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Reception Notes</label>
            <input v-model="form.reception_notes" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Paket</label>
            <select v-model="form.wedding_package" class="w-full border rounded px-3 py-2">
              <option value="A">Paket A</option>
              <option value="B">Paket B</option>
              <option value="C">Paket C</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Tanggal</label>
            <input v-model="form.wedding_date" type="date" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Status</label>
            <select v-model="form.reservation_status" class="w-full border rounded px-3 py-2">
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