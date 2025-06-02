<template>
  <div class="bg-white p-4 rounded-xl shadow">
    <h2 class="text-md font-bold mb-4">Jadwal Kegiatan</h2>
    <div class="space-y-2">
      <div v-for="item in items" :key="item" class="flex items-center space-x-2">
        <input type="checkbox" class="w-5 h-5 rounded border-gray-300" />
        <label class="text-sm">{{ item }}</label>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  items: Array
})
</script>