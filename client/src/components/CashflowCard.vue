<template>
  <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col justify-between min-h-[240px] text-gray-800">
    <h2 class="text-lg font-bold text-[#2F3367] mb-2">Cashflow</h2>
    <div>
      <div class="flex justify-between text-sm mb-1">
        <span>Masuk</span>
        <span class="font-semibold text-right">IDR {{ masuk.toLocaleString() }}</span>
      </div>
      <div class="w-full h-3 bg-gray-200 rounded-full mb-2">
        <div
          class="h-3 bg-[#2F3367] rounded-full"
          :style="{ width: masukBar + '%' }"
        ></div>
      </div>
      <div class="flex justify-between text-sm mb-1">
        <span>Keluar</span>
        <span class="font-semibold text-right">-IDR {{ keluar.toLocaleString() }}</span>
      </div>
      <div class="w-full h-3 bg-gray-200 rounded-full">
        <div
          class="h-3 bg-[#2F3367] rounded-full"
          :style="{ width: keluarBar + '%' }"
        ></div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
const props = defineProps({
  masuk: Number,
  keluar: Number
})
const total = computed(() => props.masuk + props.keluar)
const masukBar = computed(() => total.value ? (props.masuk / total.value) * 100 : 0)
const keluarBar = computed(() => total.value ? (props.keluar / total.value) * 100 : 0)
</script>