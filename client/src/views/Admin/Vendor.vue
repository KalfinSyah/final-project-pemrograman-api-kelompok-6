<script setup>
import { ref, onMounted } from 'vue'
import Sidebar from '../../components/Sidebar.vue'
import DashboardHeader from '../../components/DashboardHeader.vue'

// State
const vendors = ref([])
const showForm = ref(false)
const showEditForm = ref(false)

const form = ref({
  type: '',
  name: '',
})

const editForm = ref({
  id: null,
  type: '',
  name: '',
})

const token = localStorage.getItem('token') // Pastikan token disimpan setelah login
const API_URL = 'http://localhost:8000/api/vendors' // Ganti dengan base URL API kamu

// GET data vendor dari API
const fetchVendors = async () => {
  try {
    const res = await fetch(API_URL, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
    const data = await res.json()
    vendors.value = data.data // Sesuaikan dengan struktur respons API
  } catch (error) {
    console.error('Gagal fetch vendors:', error)
  }
}

// POST - Tambah Vendor Baru
const addVendor = async () => {
  try {
    const res = await fetch(API_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`
      },
      body: JSON.stringify({
        vendor_type: form.value.type,
        vendor_brand: form.value.name,
      })
    })
    const data = await res.json()
    if (res.ok) {
      fetchVendors()
      form.value = { type: '', name: '' }
      showForm.value = false
    } else {
      alert('Gagal menambah vendor: ' + data.message)
    }
  } catch (error) {
    console.error(error)
  }
}

// PUT - Simpan perubahan vendor
const updateVendor = async () => {
  try {
    const res = await fetch(`${API_URL}/${editForm.value.id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`
      },
      body: JSON.stringify({
        vendor_type: editForm.value.type,
        vendor_brand: editForm.value.name,
      })
    })
    const data = await res.json()
    if (res.ok) {
      fetchVendors()
      showEditForm.value = false
    } else {
      alert('Gagal update vendor: ' + data.message)
    }
  } catch (error) {
    console.error(error)
  }
}

// Buka form edit
const editVendor = (vendor) => {
  editForm.value = {
    id: vendor.id,
    type: vendor.vendor_type,
    name: vendor.vendor_brand
  }
  showEditForm.value = true
}

// onMounted
onMounted(() => {
  fetchVendors()
})
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <h1 class="text-5xl font-bold text-[#2F3367] mb-8">Vendor</h1>

      <div class="flex justify-end mb-4">
        <button
          @click="showForm = true"
          class="bg-white rounded-xl shadow px-6 py-2 font-semibold border hover:bg-gray-100 text-black">
          Tambah Vendor
        </button>
      </div>

      <!-- Daftar Vendor -->
      <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Vendor Saat Ini</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full text-left border-separate border-spacing-y-2">
            <thead>
              <tr class="bg-[#2F3367] text-white">
                <th class="px-4 py-2 rounded-l-lg">No</th>
                <th class="px-4 py-2">Tipe Vendor</th>
                <th class="px-4 py-2">Nama Vendor</th>
                <th class="px-4 py-2 rounded-r-lg">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(vendor, index) in vendors" :key="vendor.id" class="bg-gray-100 text-black">
                <td class="px-4 py-2">{{ index + 1  }}</td>
                <td class="px-4 py-2">{{ vendor.vendor_type }}</td>
                <td class="px-4 py-2">{{ vendor.vendor_brand }}</td>
                <td class="px-4 py-2">
                  <button
                    @click="editVendor(vendor)"
                    class="bg-orange-500 text-white px-4 py-1 rounded hover:bg-orange-600">
                    Edit
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Tambah Vendor -->
    <div v-if="showForm" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
      <div class="bg-white p-8 rounded-xl w-full max-w-3xl shadow-xl relative">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Tambah Vendor</h2>
        <form @submit.prevent="addVendor">
          <div class="mb-4">
            <label class="block text-gray-700">Tipe Vendor</label>
            <input v-model="form.type" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Nama Vendor</label>
            <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="flex justify-end gap-2">
            <button type="button" @click="showForm = false" class="px-4 py-2 rounded border">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Edit Vendor -->
    <div v-if="showEditForm" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
      <div class="bg-white p-8 rounded-xl w-full max-w-3xl shadow-xl relative">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Edit Vendor</h2>
        <form @submit.prevent="updateVendor">
          <div class="mb-4">
            <label class="block text-gray-700">Tipe Vendor</label>
            <input v-model="editForm.type" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Nama Vendor</label>
            <input v-model="editForm.name" type="text" class="w-full border rounded px-3 py-2" required />
          </div>
          <div class="flex justify-end gap-2">
            <button type="button" @click="showEditForm = false" class="px-4 py-2 rounded border">Batal</button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
