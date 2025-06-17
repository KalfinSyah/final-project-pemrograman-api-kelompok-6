<script setup>
import Sidebar from '../../components/Sidebar.vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import { ref } from 'vue'

const events = [
  {
    title: 'Pelaksanaan Acara',
    date: '2025-05-01',
    time: '10:00 AM'
  }
]

const calendarOptions = ref({
  plugins: [dayGridPlugin, interactionPlugin],
  initialView: 'dayGridMonth',
  events: events.map(e => ({ title: e.title, date: e.date })),
  headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: ''
  }
})
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <h1 class="text-5xl font-bold text-[#2F3367] mb-8">Acara</h1>
      <div class="flex flex-col md:flex-row gap-8">
        <!-- Calendar Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 flex-1 min-h-[480px] text-black">
          <FullCalendar :options="calendarOptions" />
        </div>
        <!-- Event List Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 w-full md:w-96 min-h-[480px]">
          <div v-for="event in events" :key="event.title" class="mb-4">
            <div class="font-semibold mb-2">{{ event.date }}</div>
            <div class="flex justify-between items-center bg-[#2F3367] text-white rounded-md px-4 py-2">
              <span>{{ event.title }}</span>
              <span>{{ event.time }}</span>
            </div>
          </div>
        </div>
      </div>
      <!-- Add Event Button -->
      <div class="mt-8">
        <button class="bg-white rounded-xl shadow px-6 py-2 font-semibold border hover:bg-gray-100 text-black">
          Tambah Kegiatan
        </button>
      </div>
    </div>
  </div>
</template>