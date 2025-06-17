<template>
  <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col justify-between min-h-[240px] text-gray-800">
    <h2 class="text-lg font-bold text-[#2F3367] mb-2">Acara Sekarang</h2>
    <div class="flex items-center mb-2">
      <span class="mr-2">💍</span>
      <span class="font-semibold">{{ currentEvent }}</span>
    </div>
    <div class="flex items-center mb-2">
      <span class="mr-2">📍</span>
      <span class="font-semibold">{{ location }}</span>
    </div>
    <div class="flex items-center mb-2">
      <span class="mr-2">📅</span>
      <span class="font-semibold">{{ date }}</span>
    </div>
    <div class="mt-2">
      <h3 class="font-bold">Kegiatan Sekarang</h3>
      <div class="flex items-center mt-4">
        <span class="mr-8 font-semibold">{{ currentTask }}</span>
        <span class="ml-2 px-4 py-1 rounded border text-xs font-semibold border-[#2F3367] text-[#2F3367] bg-white">{{ reservationStatus }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  currentEvent: String,
  date: String,
  currentTask: String,
  taskDate: String,
  location: String})
</script>