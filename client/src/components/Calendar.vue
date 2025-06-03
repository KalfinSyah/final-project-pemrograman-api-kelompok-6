<template>
  <div class="bg-white p-4 rounded shadow w-full">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold">May 2025</h2>
      <div class="flex gap-2 text-xl">
        <button @click="prevMonth" class="hover:text-blue-600">&lt;</button>
        <button @click="nextMonth" class="hover:text-blue-600">&gt;</button>
      </div>
    </div>
    
    <!-- Days of the Week -->
    <div class="grid grid-cols-7 gap-2 text-center font-semibold text-gray-600 mb-2">
      <div>Mo</div>
      <div>Tu</div>
      <div>We</div>
      <div>Th</div>
      <div>Fr</div>
      <div>Sa</div>
      <div>Su</div>
    </div>

    <!-- Days -->
    <div class="grid grid-cols-7 gap-2 text-center">
      <div
        v-for="day in daysInMonth"
        :key="day"
        :class="[
          highlightedDays.includes(day)
            ? 'bg-gray-700 text-white'
            : 'text-gray-700',
          'py-2 rounded cursor-pointer hover:bg-gray-200'
        ]"
      >
        {{ day }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Calendar',
  data() {
    return {
      daysInMonth: 31,
      highlightedDays: [1, 3, 13, 14] // custom days to highlight
    };
  },
  methods: {
    nextMonth() {
      // Add logic if needed
      alert('Next month clicked!');
    },
    prevMonth() {
      // Add logic if needed
      alert('Previous month clicked!');
    }
  }
};
</script>

<style scoped>
/* You can add scoped custom styles here if needed */
</style>
