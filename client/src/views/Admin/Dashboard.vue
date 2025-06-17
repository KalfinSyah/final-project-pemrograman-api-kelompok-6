<script setup>
import { ref, onMounted } from 'vue'
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

const showEventModal = ref(false)
const selectedEvent = ref({})

const calendarOptions = ref({
  plugins: [dayGridPlugin, interactionPlugin],
  initialView: 'dayGridMonth',
  dayMaxEventRows: true,
  views: {
    timeGrid: {
      dayMaxEventRows: 3
    }
  },
  locale: 'id',
  headerToolbar: {
    today: 'Hari Ini',
  },
  events: [],
  eventClick: function(info) {
    selectedEvent.value = {
      title: info.event.title,
      date: info.event.startStr,
      description: info.event.extendedProps.description
    }
    showEventModal.value = true
  }
})

async function fetchActivities() {
  try {
    const token = localStorage.getItem('token');
    const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/all-activities`, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    calendarOptions.value.events = (data.data || []).map(item => ({
      title: item.activity_name || item.activity_type,
      date: item.activity_date,
      description: item.activity_desc,
      allDay: true 
    }))
  } catch (err) {
    console.error('Failed to fetch activities:', err)
  }
}

onMounted(() => {
  fetchActivities()
})
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <DashboardHeader />
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 items-stretch">
        <ProgressCircle :value="75" />
        <EventCard
          currentEvent="Putri & Putra"
          date="1 May 2025"
          currentTask="Pelaksanaan Acara"
          taskDate="1 May 2025"
        />
        <CashflowCard :masuk="1500000" :keluar="1000000" />
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
        <ChecklistCard :items="checklistItems" />
        <CalendarCard :options="calendarOptions" />
      </div>
    </div>

    <!-- Event Detail Modal -->
    <div v-if="showEventModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
      <div class="bg-white rounded-xl shadow-lg p-8 min-w-[320px] max-w-md">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">{{ selectedEvent.title }}</h2>
        <div class="mb-2"><span class="font-semibold">Tanggal:</span> {{ selectedEvent.date }}</div>
        <div class="mb-4"><span class="font-semibold">Deskripsi:</span> {{ selectedEvent.description || '-' }}</div>
        <button @click="showEventModal = false" class="mt-4 px-4 py-2 bg-[#2F3367] text-white rounded hover:bg-[#404488]">Tutup</button>
      </div>
    </div>
  </div>
</template>

<style>
.fc-daygrid-event {
  background-color: #2F3367 !important;
  color: #fff !important;
  border-radius: 6px !important;
  border: none !important;
  padding: 2px 6px !important;
  font-size: 13px !important;
}
</style>