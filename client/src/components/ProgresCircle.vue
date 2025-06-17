<template>
  <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center min-h-[240px] text-gray-800">
    <h2 class="text-lg font-bold mb-4">Progress</h2>
    <div class="relative w-24 h-24 mx-auto">
      <svg class="w-full h-full" viewBox="0 0 36 36">
        <!-- Background circle -->
        <path class="text-gray-300" stroke="currentColor" d="M18 2.0845 a 15.9155 15.9155 0 1 0 0.00001 0" fill="none" stroke-width="4" />
        <!-- Progress circle/arc -->
        <circle
          v-if="value === 100"
          class="text-indigo-600"
          stroke="currentColor"
          fill="none"
          stroke-width="4"
          stroke-linecap="round"
          cx="18"
          cy="18"
          r="15.9155"
        />
        <path
          v-else
          class="text-indigo-600"
          stroke="currentColor"
          :d="arcPath"
          fill="none"
          stroke-width="4"
          stroke-linecap="round"
        />
      </svg>
      <div class="absolute inset-0 flex items-center justify-center text-xl font-bold">
        {{ value }}%
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  value: Number
})

const arcPath = computed(() => {
  const radius = 15.9155
  const angle = (props.value / 100) * 360

  const rads = (Math.PI / 180) * angle
  const x = 18 + radius * Math.cos(rads - Math.PI / 2)
  const y = 18 + radius * Math.sin(rads - Math.PI / 2)
  const largeArc = angle > 180 ? 1 : 0

  return `M18 2.0845 A 15.9155 15.9155 0 ${largeArc} 1 ${x} ${y}`
})
</script>
