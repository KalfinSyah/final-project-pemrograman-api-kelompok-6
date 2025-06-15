<template>
  <div class="bg-white rounded-2xl shadow-lg p-8 min-h-[320px] text-black">
    <FullCalendar :options="options" />
  </div>
</template>

<script setup>
import FullCalendar from '@fullcalendar/vue3'
const props = defineProps({
  options: Object
})
</script>