<script setup>
import { ref } from 'vue'
  import {useRoute} from "vue-router";
  const route = useRoute();
  console.log(route.params.idAcara)

  // Reactive form state
  const form = ref({
    wedding_contract_notes: "",
    reception_notes: "",
    wedding_package: "A",
    wedding_date: "",
    reservation_status: "Berlangsung",
    combined_name: "",
    groom: "",
    bride: "",
    telephone_num: "",
    wedding_location: ""
  })

  const submitForm = () => {
    console.log("Form submitted:", form.value)
    // TODO: handle API call here
  }

</script>

<template>
  <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Form Reservasi Pernikahan</h2>
    <form @submit.prevent="submitForm" class="space-y-4">

      <div>
        <label class="block text-gray-700">Nama Gabungan</label>
        <input v-model="form.wedding_contract_notes" type="text" class="w-full border rounded px-3 py-2" required />
      </div>

      <div>
        <label class="block text-gray-700">Nama Pengantin Pria</label>
        <input v-model="form.groom" type="text" class="w-full border rounded px-3 py-2" required />
      </div>

      <div>
        <label class="block text-gray-700">Nama Pengantin Wanita</label>
        <input v-model="form.bride" type="text" class="w-full border rounded px-3 py-2" required />
      </div>

      <div>
        <label class="block text-gray-700">No. Telepon</label>
        <input v-model="form.telephone_num" type="text" class="w-full border rounded px-3 py-2" required />
      </div>

      <div>
        <label class="block text-gray-700">Lokasi Pernikahan</label>
        <input v-model="form.wedding_location" type="text" class="w-full border rounded px-3 py-2" required />
      </div>

      <div>
        <label class="block text-gray-700">Tanggal Pernikahan</label>
        <input v-model="form.wedding_date" type="date" class="w-full border rounded px-3 py-2" required />
      </div>

      <div>
        <label class="block text-gray-700">Catatan Akad Nikah</label>
        <textarea v-model="form.wedding_contract_notes" class="w-full border rounded px-3 py-2" rows="3"></textarea>
      </div>

      <div>
        <label class="block text-gray-700">Catatan Resepsi</label>
        <textarea v-model="form.reception_notes" class="w-full border rounded px-3 py-2" rows="3"></textarea>
      </div>

      <div>
        <label class="block text-gray-700">Paket</label>
        <select v-model="form.wedding_package" class="w-full border rounded px-3 py-2">
          <option value="A">Paket A</option>
          <option value="B">Paket B</option>
          <option value="C">Paket C</option>
        </select>
      </div>

      <div>
        <label class="block text-gray-700">Status</label>
        <select v-model="form.reservation_status" class="w-full border rounded px-3 py-2">
          <option value="Berlangsung">Berlangsung</option>
          <option value="Selesai">Selesai</option>
        </select>
      </div>

      <div class="text-right">
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
          Simpan
        </button>
      </div>
    </form>
  </div>
</template>