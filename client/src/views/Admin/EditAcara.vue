<script setup>
  import { onMounted, ref } from 'vue'
  import {useRoute} from "vue-router";
  import Swal from 'sweetalert2'
  const route = useRoute();

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

  const submitForm = async () => {
    try {
      const token = localStorage.getItem('token');
      const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/reservations/${route.params.idAcara}`, {
        method: "PUT",
        headers: {"Content-Type": "application/json", 'Authorization': `Bearer ${token}`},
        body: JSON.stringify(form.value)
      });
      if (response.ok) {
        Swal.fire({
          title: "Success",
          icon: "success",
          text: "Berhasil edit acara!"
        });
      } else {
        Swal.fire({
          title: "Failed",
          icon: "error",
          text: "Gagal edit acara!"
        });
      }
    } catch (error) {
        Swal.fire({
          title: "Failed",
          icon: "error",
          text: "Gagal edit acara! (system error)"
        });
    }
  }

async function fetchAcara() {
  try {
    const token = localStorage.getItem('token');
    const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/reservations/${route.params.idAcara}`, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    if (!response.ok) {
        Swal.fire({
          title: "Failed",
          icon: "error",
          text: "Gagal fetch acara!"
        });
    } else {
      const data = await response.json();
      form.value = data.data
    }
  } catch (err) {
    Swal.fire({
      title: "Failed",
      icon: "error",
      text: "Gagal fetch acara! (system)"
    });
  }
}

onMounted(() => {
  fetchAcara();
});
</script>

<template>
  <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Form Reservasi Pernikahan</h2>
    <form @submit.prevent="submitForm" class="space-y-4">

      <div>
        <label class="block text-gray-700">Nama Gabungan</label>
        <input v-model="form.combined_name" type="text" class="w-full border rounded px-3 py-2" required />
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