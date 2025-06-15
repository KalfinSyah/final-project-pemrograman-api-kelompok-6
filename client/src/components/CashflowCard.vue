<template>
  <div class="bg-white p-4 rounded-xl shadow text-gray-800">
    <h2 class="text-md font-bold mb-4">Cashflow</h2>
    <p class="text-sm">Masuk: Rp {{ masuk.toLocaleString() }}</p>
    <p class="text-sm">Keluar: Rp {{ keluar.toLocaleString() }}</p>
    <p class="text-sm font-semibold mt-2">Sisa: Rp {{ sisa.toLocaleString() }}</p>
  </div>
</template>

<script setup>
const props = defineProps({
  masuk: Number,
  keluar: Number
})

const sisa = props.masuk - props.keluar
</script>