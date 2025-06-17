<script setup>
import Sidebar from '../../components/Sidebar.vue'
import DashboardHeader from '../../components/DashboardHeader.vue'
import CalendarCard from '../../components/Calendar.vue'
import { ref } from 'vue'

const calendarOptions = ref({
  // You can configure FullCalendar options here if needed
})

const transactionHistory = [
  // Example data
  // { id: 1, tanggal: '2025-06-15', deskripsi: 'Pembayaran DP', jumlah: 1500000 }
]
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <h1 class="text-5xl font-bold text-[#2F3367] mb-8">Laporan</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <!-- Grafik/Chart Placeholder -->
        <div class="bg-white rounded-2xl shadow-lg p-8 min-h-[320px] flex flex-col justify-between">
          <!-- Replace this with your chart component -->
          <div class="w-full h-64 flex items-center justify-center text-gray-400 border border-gray-300">
            Grafik Laporan (Chart)
          </div>
        </div>
        <!-- Filter Tabs Placeholder -->
        <div class="bg-white rounded-2xl shadow-lg p-8 min-h-[320px] flex flex-col">
          <div class="flex space-x-4 mb-4">
            <button class="px-6 py-2 rounded-xl shadow bg-[#e8eaf6] text-[#2F3367] font-semibold border border-[#e8eaf6]">Hari</button>
            <button class="px-6 py-2 rounded-xl shadow bg-white text-[#2F3367] font-semibold border border-[#e8eaf6]">Minggu</button>
            <button class="px-6 py-2 rounded-xl shadow bg-white text-[#2F3367] font-semibold border border-[#e8eaf6]">Bulan</button>
          </div>
          <div class="flex-1"></div>
        </div>
      </div>
      <!-- Transaction History -->
      <div class="bg-white rounded-2xl shadow-lg p-8 mt-8">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-2xl font-bold text-[#2F3367]">Riwayat Transaksi</h2>
          <button class="bg-white rounded-xl shadow px-6 py-2 font-semibold border hover:bg-gray-100">
            Tambah Transaksi
          </button>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full text-left border-separate border-spacing-y-2">
            <thead>
              <tr class="bg-[#2F3367] text-white">
                <th class="px-4 py-2 rounded-l-lg">ID</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Deskripsi</th>
                <th class="px-4 py-2">Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="transactionHistory.length === 0">
                <td colspan="4" class="px-4 py-2 text-center text-gray-400">Belum ada transaksi.</td>
              </tr>
              <tr v-for="trx in transactionHistory" :key="trx.id" class="bg-gray-100">
                <td class="px-4 py-2">{{ trx.id }}</td>
                <td class="px-4 py-2">{{ trx.tanggal }}</td>
                <td class="px-4 py-2">{{ trx.deskripsi }}</td>
                <td class="px-4 py-2">IDR {{ trx.jumlah.toLocaleString() }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>