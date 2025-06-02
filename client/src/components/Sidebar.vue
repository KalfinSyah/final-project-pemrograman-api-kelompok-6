<template>
  <div class="w-64 bg-[#2F3367] text-white flex flex-col h-full p-4">
    <div class="text-2xl font-bold mb-8">Ruang Hati</div>
    <nav class="flex flex-col space-y-4">
      <RouterLink class="hover:underline" to="/">Dashboard</RouterLink>
      <RouterLink class="hover:underline" to="/acara">Acara</RouterLink>
      <RouterLink class="hover:underline" to="/klien">Klien</RouterLink>
      <RouterLink class="hover:underline" to="/laporan">Laporan</RouterLink>
    </nav>
    <div class="mt-auto space-y-2">
      <button class="text-sm hover:underline">Pengaturan</button>
      <button class="text-sm hover:underline">Keluar</button>
    </div>
  </div>
</template>

<script setup>
</script>