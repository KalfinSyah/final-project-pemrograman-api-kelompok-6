<template>
  <div class="flex min-h-screen">
    <Sidebar />
    <div class="flex-1 bg-gray-50 p-6">
      <DashboardHeader title="Admin Dashboard" />

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-6">
        <ProgressCircle :value="75" />
        <EventCard 
          currentEvent="Putra & Putri Wedding" 
          date="15 May 2025"
          currentTask="Reservasi Lokasi" 
          taskDate="1 May 2025"
        />
        <CashflowCard masuk="200000000" keluar="50000000" />
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <ScheduleChecklist :items="checklistItems" />
        <Calendar />
      </div>
    </div>
  </div>
</template>

<script setup>
import Sidebar from '../../components/Sidebar.vue'
import DashboardHeader from '../../components/DashboardHeader.vue'
import ProgressCircle from '../../components/ProgresCircle.vue'
import EventCard from '../../components/EventCard.vue'
import CashflowCard from '../../components/CashflowCard.vue'
import ScheduleChecklist from '../../components/ScheduleChecklist.vue'
import Calendar from '../../components/Calendar.vue'


const checklistItems = [
  'Reservasi lokasi',
  'Pemesan Katering',
  'Koordinasi Staff',
  'Pelaksanaan Acara'
]
</script>
