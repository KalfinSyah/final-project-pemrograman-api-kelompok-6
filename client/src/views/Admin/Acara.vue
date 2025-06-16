<script setup>
import Sidebar from '../../components/Sidebar.vue'

const events = [
  {
    date: 'May 1 2025',
    time: '10:00 AM',
    title: 'Pelaksanaan Acara'
  }
]
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <h1 class="text-5xl font-bold text-[#2F3367] mb-8">Acara</h1>
      <div class="flex flex-col md:flex-row gap-8">
        <!-- Calendar Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 flex-1 min-h-[480px] text-black">
          <div class="text-2xl font-bold mb-6">May 2023</div>
          <div class="grid grid-cols-7 gap-2">
            <div class="font-semibold text-center">Mo</div>
            <div class="font-semibold text-center">Tu</div>
            <div class="font-semibold text-center">We</div>
            <div class="font-semibold text-center">Th</div>
            <div class="font-semibold text-center">Fr</div>
            <div class="font-semibold text-center">Sa</div>
            <div class="font-semibold text-center">Su</div>
            <!-- Example: 1st is Monday, so fill 0 for Sunday -->
            <div></div>
            <div class="bg-[#2F3367] text-white rounded-md text-center py-2 font-bold border border-[#2F3367]">1</div>
            <div class="border rounded-md text-center py-2">2</div>
            <div class="border rounded-md text-center py-2">3</div>
            <div class="border rounded-md text-center py-2">4</div>
            <div class="border rounded-md text-center py-2">5</div>
            <div class="border rounded-md text-center py-2">6</div>
            <div class="border rounded-md text-center py-2">7</div>
            <div class="border rounded-md text-center py-2">8</div>
            <div class="border rounded-md text-center py-2">9</div>
            <div class="border rounded-md text-center py-2">10</div>
            <div class="border rounded-md text-center py-2">11</div>
            <div class="border rounded-md text-center py-2">12</div>
            <div class="border rounded-md text-center py-2">13</div>
            <div class="border rounded-md text-center py-2">14</div>
            <div class="border rounded-md text-center py-2">15</div>
            <div class="border rounded-md text-center py-2">16</div>
            <div class="border rounded-md text-center py-2">17</div>
            <div class="border rounded-md text-center py-2">18</div>
            <div class="border rounded-md text-center py-2">19</div>
            <div class="border rounded-md text-center py-2">20</div>
            <div class="border rounded-md text-center py-2">21</div>
            <div class="border rounded-md text-center py-2">22</div>
            <div class="border rounded-md text-center py-2">23</div>
            <div class="border rounded-md text-center py-2">24</div>
            <div class="border rounded-md text-center py-2">25</div>
            <div class="border rounded-md text-center py-2">26</div>
            <div class="border rounded-md text-center py-2">27</div>
            <div class="border rounded-md text-center py-2">28</div>
            <div class="border rounded-md text-center py-2">29</div>
            <div class="border rounded-md text-center py-2">30</div>
            <div class="border rounded-md text-center py-2">31</div>
            <!-- Next month's days (optional, can be grayed out) -->
            <div class="bg-gray-100 rounded-md text-center py-2 text-gray-400">1</div>
            <div class="bg-gray-100 rounded-md text-center py-2 text-gray-400">2</div>
            <div class="bg-gray-100 rounded-md text-center py-2 text-gray-400">3</div>
            <div class="bg-gray-100 rounded-md text-center py-2 text-gray-400">4</div>
          </div>
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