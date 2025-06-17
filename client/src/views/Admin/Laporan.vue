<script setup>
import Sidebar from '../../components/Sidebar.vue'
import { ref, computed } from 'vue'

// Dummy transaction data
const transactionHistory = [
  { id: 1, tanggal: '2025-06-01', deskripsi: 'Pembayaran DP', jumlah: 1500000 },
  { id: 2, tanggal: '2025-06-05', deskripsi: 'Pembayaran Vendor', jumlah: -500000 },
  { id: 3, tanggal: '2025-06-10', deskripsi: 'Pembayaran Pelunasan', jumlah: 2000000 },
  { id: 4, tanggal: '2025-06-12', deskripsi: 'Pembelian Dekorasi', jumlah: -750000 },
]

const cashIn = computed(() =>
  transactionHistory.filter(t => t.jumlah > 0).reduce((sum, t) => sum + t.jumlah, 0)
)
const cashOut = computed(() =>
  transactionHistory.filter(t => t.jumlah < 0).reduce((sum, t) => sum + Math.abs(t.jumlah), 0)
)

const graphData = [
  { label: '1 Jun', value: 1500000 },
  { label: '5 Jun', value: -500000 },
  { label: '10 Jun', value: 2000000 },
  { label: '12 Jun', value: -750000 },
]
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <h1 class="text-5xl font-bold text-[#2F3367] mb-8">Laporan</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <!-- Dummy Graph -->
        <div class="bg-white rounded-2xl shadow-lg p-8 min-h-[320px] flex flex-col justify-between">
          <h2 class="text-xl font-bold text-[#2F3367] mb-4">Grafik Cashflow</h2>
          <div class="w-full h-64 flex items-end gap-4 px-4">
            <div v-for="(item, idx) in graphData" :key="idx" class="flex flex-col items-center">
              <div
                :class="item.value > 0 ? 'bg-[#2F3367]' : 'bg-red-500'"
                class="w-8 rounded-t transition-all duration-300"
                :style="{ height: Math.abs(item.value) / 20000 + 'px' }"
                :title="item.value"
              ></div>
              <span class="text-xs mt-2 text-gray-600">{{ item.label }}</span>
            </div>
          </div>
        </div>
        <!-- Cashflow Summary -->
        <div class="bg-white rounded-2xl shadow-lg p-8 min-h-[320px] flex flex-col justify-between">
          <h2 class="text-xl font-bold text-[#2F3367] mb-4">Ringkasan Cashflow</h2>
          <div class="flex flex-col gap-4 text-lg">
            <div class="flex justify-between">
              <span class="font-semibold text-[#2F3367]">Total Masuk</span>
              <span class="font-bold text-[#2F3367]">IDR {{ cashIn.toLocaleString() }}</span>
            </div>
            <div class="flex justify-between">
              <span class="font-semibold text-red-500">Total Keluar</span>
              <span class="font-bold text-red-500">IDR {{ cashOut.toLocaleString() }}</span>
            </div>
            <div class="flex justify-between border-t pt-2 mt-2">
              <span class="font-semibold">Saldo Akhir</span>
              <span class="font-bold" :class="(cashIn-cashOut)>=0 ? 'text-[#2F3367]' : 'text-red-500'">
                IDR {{ (cashIn - cashOut).toLocaleString() }}
              </span>
            </div>
          </div>
        </div>
      </div>
      <!-- Transaction History -->
      <div class="bg-white rounded-2xl shadow-lg p-8 mt-8">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-2xl font-bold text-[#2F3367]">Riwayat Transaksi</h2>
          <button class="bg-white rounded-xl shadow px-6 py-2 font-semibold border hover:bg-[#e8eaf6] text-[#2F3367]">
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
                <td class="px-4 py-2 text-black">{{ trx.id }}</td>
                <td class="px-4 py-2 text-black">{{ trx.tanggal }}</td>
                <td class="px-4 py-2 text-black">{{ trx.deskripsi }}</td>
                <td class="px-4 py-2 font-bold"
                  :class="trx.jumlah > 0 ? 'text-[#2F3367]' : 'text-red-500'">
                  {{ trx.jumlah > 0 ? '+' : '-' }}IDR {{ Math.abs(trx.jumlah).toLocaleString() }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>