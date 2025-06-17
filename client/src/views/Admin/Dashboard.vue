<script setup>
import { ref, onMounted, computed } from 'vue'
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

const reservation = ref(null)
const eventName = ref('Belum tersedia')
const eventDate = ref('Belum tersedia')
const currentTask = ref('Belum tersedia')
const taskDate = ref('Belum tersedia')
const cashIn = ref(0)
const cashOut = ref(0)
const eventLocation = ref('Belum tersedia')
const reservationStatus = ref('Belum tersedia')

// Activities for checklist and progress
const allActivities = ref([])

// Only activities that are NOT "Batal"
const filteredActivities = computed(() =>
  allActivities.value.filter(a => a.activity_status !== 'Batal')
)

// Only completed and not "Batal"
const completedActivities = computed(() =>
  filteredActivities.value.filter(a => a.activity_status === 'Selesai')
)

// For checklist display
const checklistItems = computed(() => filteredActivities.value.map(a => a.activity_name))

// Progress calculation (exclude "Batal")
const progressValue = computed(() =>
  filteredActivities.value.length > 0
    ? Math.round((completedActivities.value.length / filteredActivities.value.length) * 100)
    : 0
)

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

async function fetchDashboardData() {
  try {
    const token = localStorage.getItem('token');
    const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/nearestReservation`, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    reservation.value = data.data;

    eventName.value = data.data?.combined_name || 'Belum tersedia';
    eventDate.value = data.data?.wedding_date || 'Belum tersedia';

    // Fill activities for checklist and progress
    allActivities.value = data.data?.activities || [];

    // Show the nearest activity that is not "Selesai"
    if (allActivities.value.length > 0) {
      const nextActivity = allActivities.value.find(a => a.activity_status !== 'Selesai');
      currentTask.value = nextActivity?.activity_name || 'Belum tersedia';
      taskDate.value = nextActivity?.activity_date || 'Belum tersedia';
    } else {
      currentTask.value = 'Belum tersedia';
      taskDate.value = 'Belum tersedia';
    }

    cashIn.value = Number(data.data?.cashflow_in) || 0;
    cashOut.value = Number(data.data?.cashflow_out) || 0;

    // Only show activities that are NOT "Batal" in the calendar
    if (allActivities.value.length > 0) {
      calendarOptions.value.events = allActivities.value
        .filter(item => item.activity_status !== 'Batal')
        .map(item => ({
          title: item.activity_name || item.activity_type,
          date: item.activity_date,
          description: item.activity_desc,
          allDay: true
        }))
    } else {
      calendarOptions.value.events = []
    }

    eventLocation.value = data.data?.wedding_location || 'Belum tersedia'
    reservationStatus.value = data.data?.reservation_status || 'Belum tersedia'
  } catch (err) {
    eventName.value = 'Belum tersedia'
    eventDate.value = 'Belum tersedia'
    currentTask.value = 'Belum tersedia'
    taskDate.value = 'Belum tersedia'
    cashIn.value = 0
    cashOut.value = 0
    calendarOptions.value.events = []
    eventLocation.value = 'Belum tersedia'
    reservationStatus.value = 'Belum tersedia'
    allActivities.value = []
    console.error('Failed to fetch dashboard data:', err)
  }
}

onMounted(() => {
  fetchDashboardData()
})
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <DashboardHeader />
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 items-stretch">
        <ProgressCircle :value="progressValue" />
        <EventCard
          :currentEvent="eventName"
          :date="eventDate"
          :currentTask="currentTask"
          :taskDate="taskDate"
          :location="eventLocation"
          :reservation_status="reservationStatus"
        />
        <CashflowCard :masuk="cashIn" :keluar="cashOut" />
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
        <ChecklistCard :items="checklistItems" :completed-count="completedActivities.length" />
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