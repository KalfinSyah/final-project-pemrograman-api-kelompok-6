<template>
  <div class="p-8">
    <h1 class="text-3xl font-bold mb-4">Detail Acara</h1>
    <div class="bg-white rounded-lg shadow p-6">
      <p><strong>Nama Acara:</strong> {{ client.name }}</p>
      <p><strong>CPP:</strong> {{ client.cpp }}</p>
      <p><strong>CPW:</strong> {{ client.cpw }}</p>
      <p><strong>No. Telp:</strong> {{ client.phone }}</p>
      <p><strong>Paket:</strong> {{ client.paket }}</p>
      <p><strong>Tanggal:</strong> {{ client.tanggal }}</p>
      <p><strong>Status:</strong> {{ client.status }}</p>

      <h2 class="text-xl font-semibold mt-6 mb-2">Agenda</h2>
      <ul>
        <li v-for="item in client.agenda" :key="item.id">
          {{ item.kegiatan }} - {{ item.waktu }}
        </li>
      </ul>

      <h2 class="text-xl font-semibold mt-6 mb-2">Pembayaran</h2>
      <ul>
        <li v-for="bayar in client.pembayaran" :key="bayar.id">
          {{ bayar.keterangan }} - Rp {{ bayar.nominal.toLocaleString() }}
        </li>
      </ul>

      <router-link :to="`/edit/${client.id}`" class="mt-6 inline-block bg-blue-500 text-white px-4 py-2 rounded">Edit Acara</router-link>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const clientId = Number(route.params.id)
const clients = ref(JSON.parse(localStorage.getItem('clients') || '[]'))
const client = clients.value.find(c => c.id === clientId)
</script>
