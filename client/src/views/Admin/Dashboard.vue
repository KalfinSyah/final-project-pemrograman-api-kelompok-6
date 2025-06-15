<script setup>
import { ref } from 'vue'
import Sidebar from '../../components/Sidebar.vue'
import DashboardHeader from '../../components/DashboardHeader.vue'
import ProgressCircle from '../../components/ProgresCircle.vue'
import EventCard from '../../components/EventCard.vue'
import CashflowCard from '../../components/CashflowCard.vue'
import ScheduleChecklist from '../../components/ScheduleChecklist.vue'
import FullCalendar from '@fullcalendar/vue3'
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
    <div class="ml-64 p-10">
      <h1 class="text-4xl font-bold text-[#2F3367] mb-10 text-center">Admin Dashboard</h1>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <!-- Progress Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center min-h-[240px]">
          <ProgressCircle :value="75" />
        </div>
        <!-- Event Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col justify-between min-h-[240px] text-gray-800">
          <h2 class="text-lg font-bold text-[#2F3367] mb-2">Kegiatan Sekarang</h2>
          <div class="flex items-center mb-2">
            <span class="mr-2">⏰</span>
            <span class="font-semibold">Putri & Putra</span>
          </div>
          <div class="flex items-center mb-2">
            <span class="mr-2">📍</span>
            <span>Graha Ado</span>
          </div>
          <div class="flex items-center mb-2">
            <span class="mr-2">📅</span>
            <span>1 May 2025</span>
          </div>
          <div class="mt-4">
            <h3 class="font-bold">Acara Sekarang</h3>
            <div class="flex items-center">
              <span class="mr-2">Pelaksanaan Acara</span>
              <button class="ml-2 px-3 py-1 rounded border text-xs font-semibold border-[#2F3367] text-[#2F3367] bg-white hover:bg-[#e8eaf6]">Berlangsung</button>
            </div>
          </div>
        </div>
        <!-- Cashflow Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col justify-between min-h-[240px] text-gray-800">
          <h2 class="text-lg font-bold text-[#2F3367] mb-2">Cashflow</h2>
          <div>
            <div class="flex justify-between text-sm mb-1">
              <span>Masuk</span>
              <span class="font-semibold text-right">IDR 1.500.000</span>
            </div>
            <div class="w-full h-3 bg-gray-200 rounded-full mb-2">
              <div class="h-3 bg-[#2F3367] rounded-full" style="width: 75%"></div>
            </div>
            <div class="flex justify-between text-sm mb-1">
              <span>Keluar</span>
              <span class="font-semibold text-right">-IDR 1.000.000</span>
            </div>
            <div class="w-full h-3 bg-gray-200 rounded-full">
              <div class="h-3 bg-[#2F3367] rounded-full" style="width: 50%"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Checklist Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 min-h-[320px] flex flex-col text-gray-800">
          <h2 class="text-lg font-bold text-[#2F3367] mb-4">Jadwal Kegiatan</h2>
          <div class="space-y-4 flex-1">
            <div v-for="(item, idx) in checklistItems" :key="item" class="flex items-center space-x-3">
              <input type="checkbox" :checked="idx < 3" class="w-6 h-6 rounded border-2 border-[#2F3367] checked:bg-[#2F3367] checked:border-[#2F3367] accent-[#2F3367]" />
              <label class="text-lg font-medium" :class="idx < 3 ? 'text-[#2F3367]' : 'text-gray-700'">{{ item }}</label>
            </div>
          </div>
          <div class="flex items-center mt-6">
            <span class="text-base font-semibold mr-2">{{ 3 }}/{{ checklistItems.length }} Tugas Selesai</span>
            <div class="flex-1 h-3 bg-gray-200 rounded-full ml-2">
              <div class="h-3 bg-[#2F3367] rounded-full" style="width: 75%"></div>
            </div>
          </div>
          <button class="mt-4 px-4 py-2 border rounded text-[#2F3367] border-[#2F3367] hover:bg-[#e8eaf6] text-sm font-semibold self-end">Tambah Kegiatan</button>
        </div>
        <!-- Calendar Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 min-h-[320px]">
          <FullCalendar :options="calendarOptions" />
        </div>
      </div>
    </div>
  </div>
</template>