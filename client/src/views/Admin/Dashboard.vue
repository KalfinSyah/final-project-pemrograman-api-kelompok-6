<script setup>
import { ref } from 'vue'
import Sidebar from '../../components/Sidebar.vue'
import DashboardHeader from '../../components/DashboardHeader.vue'
import ProgressCircle from '../../components/ProgresCircle.vue'
import EventCard from '../../components/EventCard.vue'
import CashflowCard from '../../components/CashflowCard.vue'
import ChecklistCard from '../../components/ChecklistCard.vue'
import CalendarCard from '../../components/Calendar.vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

const checklistItems = ref([
  'Reservasi lokasi',
  'Pemesan Katering',
  'Koordinasi Staff',
  'Pelaksanaan Acara'
])

const calendarOptions = ref({
  plugins: [dayGridPlugin, interactionPlugin],
  initialView: 'dayGridMonth',
  events: [
    { title: 'Reservasi Lokasi', date: '2025-05-01' },
    { title: 'Putra & Putri Wedding', date: '2025-05-15' }
  ]
})
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <DashboardHeader />
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 items-stretch">
        <!-- Progress Card -->
          <ProgressCircle :value="75" />
        <!-- Event Card -->
          <EventCard
            currentEvent="Putri & Putra"
            date="1 May 2025"
            currentTask="Pelaksanaan Acara"
            taskDate="1 May 2025"
          />
        <!-- Cashflow Card -->
          <CashflowCard :masuk="1500000" :keluar="1000000" />
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
        <!-- Checklist Card -->
          <ChecklistCard :items="checklistItems" />
        <!-- Calendar Card -->
          <CalendarCard :options="calendarOptions" />
      </div>
    </div>
  </div>
</template>