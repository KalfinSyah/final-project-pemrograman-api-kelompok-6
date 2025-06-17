<script setup>
import { ref } from 'vue'
import Sidebar from '../../components/Sidebar.vue'

const events = [
  {
    date: 'May 1 2025',
    time: '10:00 AM',
    title: 'Pelaksanaan Acara'
  }
]
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <h1 class="text-5xl font-bold text-[#2F3367] mb-8">Acara</h1>
      <div class="flex flex-col md:flex-row gap-8">
        <!-- Calendar Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 flex-1 min-h-[480px] text-black">
          <div class="text-2xl font-bold mb-6">May 2023</div>
          <div class="grid grid-cols-7 gap-2">
            <div class="font-semibold text-center">Mo</div>
            <div class="font-semibold text-center">Tu</div>
            <div class="font-semibold text-center">We</div>
            <div class="font-semibold text-center">Th</div>
            <div class="font-semibold text-center">Fr</div>
            <div class="font-semibold text-center">Sa</div>
            <div class="font-semibold text-center">Su</div>
            <!-- Example: 1st is Monday, so fill 0 for Sunday -->
            <div></div>
            <div class="bg-[#2F3367] text-white rounded-md text-center py-2 font-bold border border-[#2F3367]">1</div>
            <div class="border rounded-md text-center py-2">2</div>
            <div class="border rounded-md text-center py-2">3</div>
            <div class="border rounded-md text-center py-2">4</div>
            <div class="border rounded-md text-center py-2">5</div>
            <div class="border rounded-md text-center py-2">6</div>
            <div class="border rounded-md text-center py-2">7</div>
            <div class="border rounded-md text-center py-2">8</div>
            <div class="border rounded-md text-center py-2">9</div>
            <div class="border rounded-md text-center py-2">10</div>
            <div class="border rounded-md text-center py-2">11</div>
            <div class="border rounded-md text-center py-2">12</div>
            <div class="border rounded-md text-center py-2">13</div>
            <div class="border rounded-md text-center py-2">14</div>
            <div class="border rounded-md text-center py-2">15</div>
            <div class="border rounded-md text-center py-2">16</div>
            <div class="border rounded-md text-center py-2">17</div>
            <div class="border rounded-md text-center py-2">18</div>
            <div class="border rounded-md text-center py-2">19</div>
            <div class="border rounded-md text-center py-2">20</div>
            <div class="border rounded-md text-center py-2">21</div>
            <div class="border rounded-md text-center py-2">22</div>
            <div class="border rounded-md text-center py-2">23</div>
            <div class="border rounded-md text-center py-2">24</div>
            <div class="border rounded-md text-center py-2">25</div>
            <div class="border rounded-md text-center py-2">26</div>
            <div class="border rounded-md text-center py-2">27</div>
            <div class="border rounded-md text-center py-2">28</div>
            <div class="border rounded-md text-center py-2">29</div>
            <div class="border rounded-md text-center py-2">30</div>
            <div class="border rounded-md text-center py-2">31</div>
            <!-- Next month's days (optional, can be grayed out) -->
            <div class="bg-gray-100 rounded-md text-center py-2 text-gray-400">1</div>
            <div class="bg-gray-100 rounded-md text-center py-2 text-gray-400">2</div>
            <div class="bg-gray-100 rounded-md text-center py-2 text-gray-400">3</div>
            <div class="bg-gray-100 rounded-md text-center py-2 text-gray-400">4</div>
          </div>
        </div>
      </div>
    </div>

      <!-- Modal Form Tambah Acara -->
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
    </div>
  </template>
