<template>
  <div class="bg-white rounded-2xl shadow-lg p-8 min-h-[320px] flex flex-col text-gray-800">
    <h2 class="text-lg font-bold text-[#2F3367] mb-4">Jadwal Kegiatan</h2>
    <div class="space-y-4 flex-1">
      <div v-for="(item, idx) in items" :key="item" class="flex items-center space-x-3">
        <input
          type="checkbox"
          :checked="idx < completedCount"
          class="w-6 h-6 rounded border-2 border-[#2F3367] checked:bg-[#2F3367] checked:border-[#2F3367] accent-[#2F3367]"
          disabled
        />
        <label
          class="text-lg font-medium"
          :class="idx < completedCount ? 'text-[#2F3367]' : 'text-gray-700'"
        >{{ item }}</label>
      </div>
    </div>
    <div class="flex items-center mt-6">
      <span class="text-base font-semibold mr-2">{{ completedCount }}/{{ items.length }} Tugas Selesai</span>
      <div class="flex-1 h-3 bg-gray-200 rounded-full ml-2">
        <div class="h-3 bg-[#2F3367] rounded-full" :style="{ width: progressBar + '%' }"></div>
      </div>
    </div>
    <button class="mt-4 px-4 py-2 border rounded text-[#2F3367] border-[#2F3367] bg-white hover:bg-[#e8eaf6] text-sm font-semibold self-end">
      Tambah Kegiatan
    </button>
  </div>
</template>

<script setup>
import { computed } from 'vue'
const props = defineProps({
  items: Array
})
// For demo, mark first 3 as completed
const completedCount = 3
const progressBar = computed(() => props.items.length ? (completedCount / props.items.length) * 100 : 0)
</script>