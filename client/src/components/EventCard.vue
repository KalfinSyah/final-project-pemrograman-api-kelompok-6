<template>
  <div class="bg-white p-4 rounded-xl shadow">
    <h2 class="text-md font-bold mb-2">Acara Sekarang</h2>
    <p class="text-sm">{{ currentEvent }}<br />{{ date }}</p>
    <h2 class="text-md font-bold mt-4 mb-2">Kegiatan Sekarang</h2>
    <p class="text-sm">{{ currentTask }}<br />{{ taskDate }}</p>
  </div>
</template>

<script setup>
const props = defineProps({
  currentEvent: String,
  date: String,
  currentTask: String,
  taskDate: String
})
</script>