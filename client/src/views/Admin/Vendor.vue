<script setup>
import { ref } from 'vue'
import Sidebar from '../../components/Sidebar.vue'
import DashboardHeader from '../../components/DashboardHeader.vue'

const showForm = ref(false)

const form = ref({
  type: '',
  name: '',
})

const vendors = ref([
  {
    id: 1,
    type: 'Dekorasi',
    name: 'Putra Decoration',
  },
])

const addVendor = () => {
  const newVendor = { ...form.value, id: vendors.value.length + 1 }
  vendors.value.push(newVendor)

  // Reset form
  form.value = {
    type: '',
    name: '',
  }

  showForm.value = false
}
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
                <th class="px-4 py-2 rounded-l-lg">ID</th>
                <th class="px-4 py-2">Type Vendor</th>
                <th class="px-4 py-2 rounded-r-lg">Nama Vendor</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="vendor in vendors" :key="vendor.id" class="bg-gray-100 text-black">
                <td class="px-4 py-2">{{ vendor.id }}</td>
                <td class="px-4 py-2">{{ vendor.type }}</td>
                <td class="px-4 py-2">{{ vendor.name }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Form Tambah Vendor -->
    <div v-if="showForm" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
      <div class="bg-white p-8 rounded-xl w-full max-w-3xl shadow-xl relative">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Tambah Vendor</h2>
        <form @submit.prevent="addVendor">
          <div class="mb-4">
            <label class="block text-gray-700">Type Vendor</label>
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
  </div>
</template>
