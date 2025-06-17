<script setup>
import Sidebar from '../../components/Sidebar.vue'
import { ref, computed, onMounted } from 'vue'

const transactionHistory = ref([])

// --- Graph Data ---
const graphRaw = ref({})
const graphData = computed(() => {
  // Flatten and sort by date
  const arr = []
  Object.entries(graphRaw.value).forEach(([bulan, items]) => {
    items.forEach(item => {
      arr.push({
        ...item,
        label: item.cashflow_date,
        value: item.cashflow_type === 'Pendapatan'
          ? Number(item.amount)
          : -Number(item.amount)
      })
    })
  })
  // Sort by date ascending
  return arr.sort((a, b) => new Date(a.label) - new Date(b.label))
})

// --- Cashflow Summary ---
const cashIn = computed(() =>
  transactionHistory.value.filter(t => t.jumlah > 0).reduce((sum, t) => sum + t.jumlah, 0)
)
const cashOut = computed(() =>
  transactionHistory.value.filter(t => t.jumlah < 0).reduce((sum, t) => sum + Math.abs(t.jumlah), 0)
)

// --- Fetch Graph Data ---
async function fetchGraphData() {
  try {
    const token = localStorage.getItem('token')
    const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/recentCashflows`, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    })
    if (!response.ok) throw new Error('Failed to fetch graph')
    const data = await response.json()
    graphRaw.value = data.data || {}
  } catch (err) {
    graphRaw.value = {}
    console.error('Failed to fetch graph:', err)
  }
}

// --- Fetch Transaction History ---
async function fetchTransactions() {
  try {
    const token = localStorage.getItem('token')
    const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/cashflows`, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    })
    if (!response.ok) throw new Error('Failed to fetch')
    const data = await response.json()
    transactionHistory.value = (data.data || []).map(trx => ({
      id: trx.cashflow_id || trx.id,
      tanggal: trx.cashflow_date,
      deskripsi: trx.cashflow_desc,
      jumlah: trx.cashflow_type === 'Pendapatan'
        ? Number(trx.amount)
        : -Number(trx.amount)
    }))
  } catch (err) {
    transactionHistory.value = []
    console.error('Failed to fetch transactions:', err)
  }
}

onMounted(() => {
  fetchGraphData()
  fetchTransactions()
})
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
          <div class="w-full h-64 flex items-end gap-4 px-4 overflow-x-auto" style="max-width:100%;">
            <div v-for="(item, idx) in graphData" :key="idx" class="flex flex-col items-center min-w-[48px]">
              <div
                :class="item.value > 0 ? 'bg-[#2F3367]' : 'bg-red-500'"
                class="w-8 rounded-t transition-all duration-300"
                :style="{ height: Math.abs(item.value) / 20000 + 'px', minHeight: '8px' }"
                :title="item.value"
              ></div>
              <span class="text-xs mt-2 text-gray-600 whitespace-nowrap">{{ item.label }}</span>
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