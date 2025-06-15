<template>
  <div class="text-gray-800">
    <h2 class="text-lg font-bold text-[#2F3367] mb-2">Kegiatan Sekarang</h2>
    <div class="flex items-center mb-2">
      <span class="mr-2">⏰</span>
      <span class="font-semibold">{{ currentEvent }}</span>
    </div>
    <div class="flex items-center mb-2">
      <span class="mr-2">📍</span>
      <span>Graha Ado</span>
    </div>
    <div class="flex items-center mb-2">
      <span class="mr-2">📅</span>
      <span>{{ date }}</span>
    </div>
    <div class="mt-4">
      <h3 class="font-bold">Acara Sekarang</h3>
      <div class="flex items-center">
        <span class="mr-2">{{ currentTask }}</span>
        <button class="ml-2 px-3 py-1 rounded border text-xs font-semibold border-[#2F3367] text-[#2F3367] bg-white hover:bg-[#e8eaf6]">Berlangsung</button>
      </div>
    </div>
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