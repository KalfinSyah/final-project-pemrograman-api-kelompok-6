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
import Swal from 'sweetalert2'

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
    Swal.fire({
      title: `<span style="color:#2F3367">${info.event.title}</span>`,
      html: `
        <div style="text-align:left">
          <b>Tanggal:</b> ${info.event.startStr}<br>
          <b>Deskripsi:</b> <span style="color:#222">${info.event.extendedProps.description || '-'}</span>
        </div>
      `,
      confirmButtonText: 'Tutup',
      confirmButtonColor: '#2F3367',
      background: '#fff',
      customClass: {
        popup: 'rounded-xl'
      }
    });
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