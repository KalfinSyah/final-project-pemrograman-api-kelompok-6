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
        <span
          v-if="reservation_status"
          class="ml-2 px-4 py-1 rounded border text-xs font-semibold"
          :class="{
            'border-[#2F3367] text-[#2F3367] bg-white': reservation_status === 'Berlangsung',
            'border-green-600 text-green-600 bg-white': reservation_status === 'Selesai',
            'border-yellow-500 text-yellow-500 bg-white': reservation_status === 'Pending',
            'border-red-500 text-red-500 bg-white': reservation_status === 'Batal'
          }"
        >
          {{ reservation_status }}
        </span>
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
  location: String,
  reservation_status: String // <-- fetch and pass this from Dashboard.vue
})
</script>