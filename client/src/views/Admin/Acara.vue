<script setup>
import { onMounted, ref } from 'vue'
import Sidebar from '../../components/Sidebar.vue'
import router from '../../router'
import Swal from 'sweetalert2'

const selectedDate = ref(null)

const form = ref({
  combined_name: "",
  groom: "",
  bride: "",
  wedding_location: "",
  telephone_num: "",
  wedding_contract_notes: "",
  reception_notes: "",
  wedding_package: "A",
  wedding_date: "",
  reservation_status: "Berlangsung"
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

// Set min date to tomorrow
const today = new Date()
const tomorrow = new Date(today)
tomorrow.setDate(today.getDate() + 2)
const minDate = tomorrow.toISOString().split('T')[0]

const showTambahAcaraSwal = async () => {
  const { value: result } = await Swal.fire({
    title: 'Tambah Acara',
    customClass: {
      popup: 'rounded-2xl',
      title: 'text-[#2F3367] font-bold text-2xl',
      confirmButton: 'bg-[#2F3367] text-white px-6 py-2 rounded-lg font-semibold mx-2',
      cancelButton: 'bg-gray-200 text-[#2F3367] px-6 py-2 rounded-lg font-semibold mx-2'
    },
    html:
      `<input id="swal-combined_name" class="swal2-input" placeholder="Nama Gabungan" style="margin-bottom:8px;">
      <input id="swal-groom" class="swal2-input" placeholder="Nama Pempelai Laki" style="margin-bottom:8px;">
      <input id="swal-bride" class="swal2-input" placeholder="Nama Pempelai Wanita" style="margin-bottom:8px;">
      <input id="swal-wedding_location" class="swal2-input" placeholder="Lokasi Pernikahan" style="margin-bottom:8px;">
      <input id="swal-telephone_num" class="swal2-input" placeholder="No. Telp" style="margin-bottom:8px;">
      <input id="swal-wedding_contract_notes" class="swal2-input" placeholder="Wedding Contract Notes" style="margin-bottom:8px;">
      <input id="swal-reception_notes" class="swal2-input" placeholder="Reception Notes" style="margin-bottom:8px;">
      <select id="swal-wedding_package" class="swal2-input" style="margin-bottom:8px; color:#2F3367; font-weight:bold; background:#e8eaf6;">
        <option value="A">Paket A</option>
        <option value="B">Paket B</option>
        <option value="C">Paket C</option>
      </select>
      <input id="swal-wedding_date" type="date" class="swal2-input" placeholder="Tanggal" style="background:#e8eaf6; margin-bottom:8px;" min="${minDate}">
      <select id="swal-reservation_status" class="swal2-input" style="margin-bottom:8px; color:#2F3367; font-weight:bold; background:#e8eaf6;">
        <option value="Berlangsung">Berlangsung</option>
        <option value="Selesai">Selesai</option>
      </select>`,
    focusConfirm: false,
    showCancelButton: true,
    confirmButtonText: 'Simpan',
    cancelButtonText: 'Batal',
    buttonsStyling: false,
    preConfirm: () => {
      return {
        combined_name: document.getElementById('swal-combined_name').value,
        groom: document.getElementById('swal-groom').value,
        bride: document.getElementById('swal-bride').value,
        wedding_location: document.getElementById('swal-wedding_location').value,
        telephone_num: document.getElementById('swal-telephone_num').value,
        wedding_contract_notes: document.getElementById('swal-wedding_contract_notes').value,
        reception_notes: document.getElementById('swal-reception_notes').value,
        wedding_package: document.getElementById('swal-wedding_package').value,
        wedding_date: document.getElementById('swal-wedding_date').value,
        reservation_status: document.getElementById('swal-reservation_status').value
      }
    }
  })

  if (result) {
    // Validate required fields
    if (!result.combined_name || !result.groom || !result.bride || !result.wedding_location || !result.telephone_num || !result.wedding_date) {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Semua field wajib diisi!',
        confirmButtonColor: '#2F3367'
      })
      return
    }
    // Submit to API
    try {
      const token = localStorage.getItem('token')
      const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/reservations`, {
        method: "POST",
        headers: { "Content-Type": "application/json", 'Authorization': `Bearer ${token}` },
        body: JSON.stringify(result)
      })
      if (response.ok) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Acara berhasil ditambahkan!',
          confirmButtonColor: '#2F3367'
        }).then(() => window.location.reload())
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Gagal tambah acara!',
          confirmButtonColor: '#2F3367'
        })
      }
    } catch (error) {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Gagal tambah acara! (system)',
        confirmButtonColor: '#2F3367'
      })
    }
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
        <button @click="showTambahAcaraSwal"
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
            <input v-model="form.wedding_date" type="date" class="w-full border rounded px-3 py-2" required :min="minDate" />
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