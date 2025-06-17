<script setup>
import Sidebar from '../../components/Sidebar.vue'
</script>

<template>
  <div class="bg-[#e8eaf6] min-h-screen">
    <Sidebar />
    <div class="ml-64 p-8">
      <h1 class="text-5xl font-bold text-[#2F3367] mb-8">Pengaturan</h1>
      <div class="bg-white rounded-2xl shadow-lg p-8 max-w-2xl">
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Akun</h2>
        <div class="mb-6">
          <label class="block mb-2 font-semibold text-gray-700">Nama</label>
          <input type="text" class="w-full border rounded px-4 py-2 mb-4" placeholder="Nama Anda" />
          <label class="block mb-2 font-semibold text-gray-700">Email</label>
          <input type="email" class="w-full border rounded px-4 py-2 mb-4" placeholder="Email Anda" />
          <label class="block mb-2 font-semibold text-gray-700">Password</label>
          <input type="password" class="w-full border rounded px-4 py-2 mb-4" placeholder="Password Baru" />
          <button class="bg-[#2F3367] text-white px-6 py-2 rounded font-semibold hover:bg-[#404488] transition">
            Simpan Perubahan
          </button>
        </div>
        <hr class="my-6" />
        <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Preferensi</h2>
        <div>
          <label class="block mb-2 font-semibold text-gray-700">Tema</label>
          <select class="w-full border rounded px-4 py-2 mb-4">
            <option>Terang</option>
            <option>Gelap</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</template>