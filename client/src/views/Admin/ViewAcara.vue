<script setup>
  import { onMounted, ref } from 'vue'
  import Sidebar from '../../components/Sidebar.vue'
  import {useRoute} from "vue-router";
  import Swal from 'sweetalert2'

  const route = useRoute();

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

  const dataCashFlow = ref([])
  const formAddCashFlow = ref({
    isShowing: false,
    data: {
      cashflow_type: "Pendapatan",
      amount: 0,
      cashflow_date : "",
      cashflow_desc : "",
      reservation_id : route.params.idAcara
    }
  })

  const tambahKegiatanForm = ref({
    isShowing: false,
    data: {
        reservation_id: route.params.idAcara,
        activity_name: '',
        activity_type: 'Pelaksanaan Acara',  
        activity_date: '',
        activity_desc: '',
        activity_status: 'Pending'
    }
  });

 

  const editModalVisible = ref(false);
  const editActivityForm = ref({
  reservation_id: null,
  activity_name: '',
  activity_type: '',
  activity_date: '',
  activity_desc: '',
  activity_status: ''
}); 

 const editCashFlowFormVisibility = ref(false)
  const editCashFlowForm = ref({
  cashflow_type: "Pendapatan",
  amount: 0,
  cashflow_date : "2025-06-12",
  cashflow_desc : "Client Tidak Jadi Uang tambahan",
  reservation_id : null
}); 


  const submitForm = async () => {
      Swal.fire({
      title: "Anda yakin?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Iya"
    }).then(async(result) => {
      if (result.isConfirmed) {
          try {
            const token = localStorage.getItem('token');
            const response = await fetch(${import.meta.env.VITE_BASE_URL_API}/reservations/${route.params.idAcara}, {
              method: "PUT",
              headers: {"Content-Type": "application/json", 'Authorization': Bearer ${token}},
              body: JSON.stringify(
                {
                  wedding_contract_notes: form.value.wedding_contract_notes,
                  reception_notes: form.value.reception_notes,
                  wedding_package: form.value.wedding_package,
                  wedding_date : form.value.wedding_date,
                  reservation_status : form.value.reservation_status,
                  combined_name : form.value.combined_name,
                  groom : form.value.groom,
                  bride : form.value.bride,
                  telephone_num : form.value.telephone_num,
                  wedding_location : form.value.wedding_location
                }
              )
            });
            if (response.ok) {
              Swal.fire({
                title: "Terupdate!",
                text: "Acara berhasil di update",
                icon: "success"
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
    });
  }

  function editKegiatan(id) {
    const target = form.value.activities.find(a => a.activity_id === id);
    if (target) {
      editActivityForm.value = { ...target };
      editModalVisible.value = true;
    }
  }

  function editCashflow(id) { 
    const target = form.value.cashflows.find(a => a.cashflow_id === id);
    if (target) {
      editCashFlowForm.value = { ...target };
      editCashFlowFormVisibility.value = true;
    }
   }

function closeEditModal() {
  editModalVisible.value = false;
  tambahKegiatanForm.value.isShowing = false;
}

function popupTambahKegiatan(isShowing) {
  tambahKegiatanForm.value.isShowing = isShowing
}

function popupTambahCashFlow(isShowing) {
  formAddCashFlow.value.isShowing = isShowing
}

async function fetchAcara() {
  try {
    const token = localStorage.getItem('token');
    const response = await fetch(${import.meta.env.VITE_BASE_URL_API}/reservations/${route.params.idAcara}, {
      headers: {
        'Authorization': Bearer ${token}
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

async function saveActivityChanges(id) {
            try {
            const token = localStorage.getItem('token');
            const response = await fetch(${import.meta.env.VITE_BASE_URL_API}/activities/${id}, {
              method: "PUT",
              headers: {"Content-Type": "application/json", 'Authorization': Bearer ${token}},
              body: JSON.stringify(editActivityForm.value)
            });
            if (response.ok) {
              window.location.reload()
            } else {
              Swal.fire({
                title: "Failed",
                icon: "error",
                text: "Gagal edit kegiatan!"
              });
            }
          } catch (error) {
              Swal.fire({
                title: "Failed",
                icon: "error",
                text: "Gagal edit kegiatan! (system error)"
              });
          }
}

async function addActivity() {
          try {
            const token = localStorage.getItem('token');
            const response = await fetch(${import.meta.env.VITE_BASE_URL_API}/activities, {
              method: "POST",
              headers: {"Content-Type": "application/json", 'Authorization': Bearer ${token}},
              body: JSON.stringify(tambahKegiatanForm.value.data)
            });
            if (response.ok) {
              window.location.reload()
            } else {
              Swal.fire({
                title: "Failed",
                icon: "error",
                text: "Gagal tambah kegiatan!"
              });
            }
          } catch (error) {
              Swal.fire({
                title: "Failed",
                icon: "error",
                text: "Gagal tambah kegiatan! (system error)"
              });
          }
}

async function addCashFlow() {
          try {
            const token = localStorage.getItem('token');
            const response = await fetch(${import.meta.env.VITE_BASE_URL_API}/cashflows, {
              method: "POST",
              headers: {"Content-Type": "application/json", 'Authorization': Bearer ${token}},
              body: JSON.stringify(formAddCashFlow.value.data)
            });
            if (response.ok) {
              window.location.reload()
            } else {
              Swal.fire({
                title: "Failed",
                icon: "error",
                text: "Gagal tambah cashflow!"
              });
            }
          } catch (error) {
              Swal.fire({
                title: "Failed",
                icon: "error",
                text: "Gagal tambah cashflow! (system error)"
              });
          }
}

async function fetchDataCashflow() {
            try {
            const token = localStorage.getItem('token');
            const response = await fetch(${import.meta.env.VITE_BASE_URL_API}/cashflows/${route.params.idAcara}, {
              method: "GET",
              headers: {"Content-Type": "application/json", 'Authorization': Bearer ${token}},
            });
            if (response.ok) {
              const data = await response.json();
              dataCashFlow.value = data.data  
            } else {
              Swal.fire({
                title: "Failed",
                icon: "error",
                text: "Gagal fetch cashflow!"
              });
            }
          } catch (error) {
              Swal.fire({
                title: "Failed",
                icon: "error",
                text: "Gagal fetch cashflow! (system error)"
              });
          }
}

async function updateCashFlow(id) {
              try {
            const token = localStorage.getItem('token');
            const response = await fetch(${import.meta.env.VITE_BASE_URL_API}/cashflows/${id}, {
              method: "PUT",
              headers: {"Content-Type": "application/json", 'Authorization': Bearer ${token}},
              body: JSON.stringify(editCashFlowForm.value)
            });
            if (response.ok) {
              window.location.reload()
            } else {
              Swal.fire({
                title: "Failed",
                icon: "error",
                text: "Gagal edit cashflow!"
              });
            }
          } catch (error) {
              Swal.fire({
                title: "Failed",
                icon: "error",
                text: "Gagal edit cash flow! (system error)"
              });
          }
}

onMounted(() => {
  fetchAcara();
  fetchDataCashflow();
});
</script>

<template>
  <div class="max-w-4xl mx-auto p-6 space-y-8">
    <!-- Back Button -->
    <button
      @click="$router.push('/acara')"
      class="mb-6 flex items-center gap-2 px-4 py-2 rounded bg-[#2F3367] text-white font-semibold hover:bg-[#23265a] transition"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Kembali
    </button>

    <!-- Reservation Form -->
    <div class="bg-white rounded-lg shadow p-6">
      <h2 class="text-2xl font-bold text-[#2F3367] mb-4">Form Reservasi Pernikahan</h2>
      <form @submit.prevent="submitForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="col-span-1 md:col-span-2">
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

        <div class="col-span-1 md:col-span-2">
          <label class="block text-gray-700">Catatan Akad Nikah</label>
          <textarea v-model="form.wedding_contract_notes" class="w-full border rounded px-3 py-2" rows="3"></textarea>
        </div>

        <div class="col-span-1 md:col-span-2">
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
            <option value="Pending">Pending</option>
            <option value="Batal">Batal</option>
            <option value="Selesai">Selesai</option>
          </select>
        </div>

        <div class="col-span-1 md:col-span-2 text-right">
          <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan
          </button>
        </div>
      </form>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
    <div @click="popupTambahCashFlow(true)" class="col-span-1 md:col-span-2 text-right mt-2">
      <button class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        Tambah Cashflow
      </button>
    </div>
    <h2 class="text-xl font-semibold text-[#2F3367] mb-4">Cashflow</h2>

    <div v-if="form.cashflows && form.cashflows.length > 0" class="space-y-4">
      <div
        v-for="cashData in form.cashflows"
        class="relative border-l-4 pl-4 border-blue-500 bg-gray-50 p-4 rounded"
      >
        <!-- Edit Button -->
        <button
          @click="editCashflow(cashData.cashflow_id)"
          class="absolute top-3 right-3 text-sm text-blue-600 hover:underline hover:text-blue-800"
        >
          Edit
        </button>

        <p class="text-gray-700 mt-2">
          Tipe : {{ cashData.cashflow_type }}
        </p>

        <p class="text-gray-700 mt-2">
          Tanggal : {{ cashData.cashflow_date }}
        </p>

        <p class="text-gray-700 mt-2">
          Deskripsi : {{ cashData.cashflow_desc }}
        </p>
        <p class="text-gray-700 mt-2">
          Total : {{ cashData.amount }}
        </p>
      </div>
    </div>

    <div v-else class="text-gray-500 text-sm italic">Belum ada cashflow.</div>
  </div>
  <div class="bg-white rounded-lg shadow p-6">

    <div @click="popupTambahKegiatan(true)" class="col-span-1 md:col-span-2 text-right mt-2">
      <button class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        Tambah Kegiatan
      </button>
    </div>
    <h2 class="text-xl font-semibold text-[#2F3367] mb-4">Jadwal Kegiatan</h2>

    <div v-if="form.activities && form.activities.length > 0" class="space-y-4">
      <div
        v-for="activity in form.activities"
        :key="activity.activity_id"
        class="relative border-l-4 pl-4 border-blue-500 bg-gray-50 p-4 rounded"
      >
        <!-- Edit Button -->
        <button
          @click="editKegiatan(activity.activity_id)"
          class="absolute top-3 right-3 text-sm text-blue-600 hover:underline hover:text-blue-800"
        >
          Edit
        </button>

        <p class="text-sm text-gray-500">
          {{ new Date(activity.activity_date).toLocaleDateString() }}
        </p>
        <h3 class="font-semibold text-lg text-blue-700">
          {{ activity.activity_name }}
        </h3>
        <p class="text-sm text-gray-600 italic">
          {{ activity.activity_type }}
        </p>
        <p class="text-gray-700 mt-2">
          {{ activity.activity_desc }}
        </p>
        <span
          class="inline-block mt-2 px-3 py-1 text-xs rounded-full"
          :class="{
            'bg-yellow-200 text-yellow-800': activity.activity_status === 'Pending',
            'bg-green-200 text-green-800': activity.activity_status === 'Selesai',
            'bg-red-200 text-red-800': activity.activity_status === 'Batal'
          }"
        >
          {{ activity.activity_status }}
        </span>
      </div>
    </div>

    <div v-else class="text-gray-500 text-sm italic">Belum ada kegiatan yang terdaftar.</div>
  </div>


  <!-- Modal -->
<div v-if="editModalVisible" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
  <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-xl">
    <h2 class="text-xl font-semibold text-[#2F3367] mb-4">Edit Kegiatan</h2>

    <div class="space-y-4">
      <div>
        <label class="block text-gray-700">Nama Kegiatan</label>
        <input v-model="editActivityForm.activity_name" type="text" class="w-full border rounded px-3 py-2" />
      </div>

      <div>
        <label class="block text-gray-700">Jenis Kegiatan</label>
        <select v-model="editActivityForm.activity_type" class="w-full border rounded px-3 py-2">
          <option value="Reservasi Lokasi">Reservasi Lokasi</option>
          <option value="Pemesanan Katering">Pemesanan Katering</option>
          <option value="Koordinasi Staff">Koordinasi Staff</option>
          <option value="Pelaksanaan Acara">Pelaksanaan Acara</option>
        </select>
      </div>

      <div>
        <label class="block text-gray-700">Tanggal</label>
        <input v-model="editActivityForm.activity_date" type="date" class="w-full border rounded px-3 py-2" />
      </div>

      <div>
        <label class="block text-gray-700">Deskripsi</label>
        <textarea v-model="editActivityForm.activity_desc" class="w-full border rounded px-3 py-2" rows="3"></textarea>
      </div>

      <div>
        <label class="block text-gray-700">Status</label>
        <select v-model="editActivityForm.activity_status" class="w-full border rounded px-3 py-2">
          <option value="Pending">Pending</option>
          <option value="Selesai">Selesai</option>
          <option value="Batal">Batal</option>
        </select>
      </div>
    </div>

    <div class="mt-6 flex justify-end space-x-2">
      <button @click="closeEditModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
      <button @click="saveActivityChanges(editActivityForm.activity_id)" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
    </div>
  </div>
</div>

<div v-if="tambahKegiatanForm.isShowing" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
  <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-xl">
    <h2 class="text-xl font-semibold text-[#2F3367] mb-4">Tambah Kegiatan</h2>

    <div class="space-y-4">
      <div>
        <label class="block text-gray-700">Nama Kegiatan</label>
        <input v-model="tambahKegiatanForm.data.activity_name" type="text" class="w-full border rounded px-3 py-2" />
      </div>

      <div>
        <label class="block text-gray-700">Jenis Kegiatan</label>
        <select v-model="tambahKegiatanForm.data.activity_type" class="w-full border rounded px-3 py-2">
          <option value="Reservasi Lokasi">Reservasi Lokasi</option>
          <option value="Pemesanan Katering">Pemesanan Katering</option>
          <option value="Koordinasi Staff">Koordinasi Staff</option>
          <option value="Pelaksanaan Acara">Pelaksanaan Acara</option>
        </select>
      </div>

      <div>
        <label class="block text-gray-700">Tanggal</label>
        <input v-model="tambahKegiatanForm.data.activity_date" type="date" class="w-full border rounded px-3 py-2" />
      </div>

      <div>
        <label class="block text-gray-700">Deskripsi</label>
        <textarea v-model="tambahKegiatanForm.data.activity_desc" class="w-full border rounded px-3 py-2" rows="3"></textarea>
      </div>

      <div>
        <label class="block text-gray-700">Status</label>
        <select v-model="tambahKegiatanForm.data.activity_status" class="w-full border rounded px-3 py-2">
          <option value="Pending">Pending</option>
          <option value="Selesai">Selesai</option>
          <option value="Batal">Batal</option>
        </select>
      </div>
    </div>

    <div class="mt-6 flex justify-end space-x-2">
      <button @click="closeEditModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
      <button @click="addActivity" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah</button>
    </div>
  </div>
</div>


<div v-if="formAddCashFlow.isShowing" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
  <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-xl">
    <h2 class="text-xl font-semibold text-[#2F3367] mb-4">Tambah Cashflow</h2>

    <div class="space-y-4">
      <div>
          <label class="block text-gray-700">Tipe</label>
          <select v-model="formAddCashFlow.data.cashflow_type" class="w-full border rounded px-3 py-2">
            <option value="Pendapatan">Pendapatan</option>
            <option value="Pengeluaran">Pengeluaran</option>
          </select>
        <div>
          <label class="block text-gray-700">Jumlah</label>
          <textarea v-model="formAddCashFlow.data.amount" class="w-full border rounded px-3 py-2" rows="3"></textarea>
        </div>
        <div>
          <label class="block text-gray-700">Tanggal</label>
          <input v-model="formAddCashFlow.data.cashflow_date" type="date" class="w-full border rounded px-3 py-2" />
        </div>
        <div>
          <label class="block text-gray-700">Deskripsi</label>
          <textarea v-model="formAddCashFlow.data.cashflow_desc" class="w-full border rounded px-3 py-2" rows="3"></textarea>
        </div>
      </div>
    </div>

    <div class="mt-6 flex justify-end space-x-2">
      <button @click="formAddCashFlow.isShowing = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
      <button @click="addCashFlow" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah</button>
    </div>
  </div>
</div>

<div v-if="editCashFlowFormVisibility" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
  <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-xl">
    <h2 class="text-xl font-semibold text-[#2F3367] mb-4">Edit Cash Flow</h2>

    <div class="space-y-4">
      <div>
          <label class="block text-gray-700">Tipe</label>
          <select v-model="editCashFlowForm.cashflow_type" class="w-full border rounded px-3 py-2">
            <option value="Pendapatan">Pendapatan</option>
            <option value="Pengeluaran">Pengeluaran</option>
          </select>
        <div>
          <label class="block text-gray-700">Jumlah</label>
          <textarea v-model="editCashFlowForm.amount" class="w-full border rounded px-3 py-2" rows="3"></textarea>
        </div>
        <div>
          <label class="block text-gray-700">Tanggal</label>
          <input v-model="editCashFlowForm.cashflow_date" type="date" class="w-full border rounded px-3 py-2" />
        </div>
        <div>
          <label class="block text-gray-700">Deskripsi</label>
          <textarea v-model="editCashFlowForm.cashflow_desc" class="w-full border rounded px-3 py-2" rows="3"></textarea>
        </div>
      </div>
    </div>

    <div class="mt-6 flex justify-end space-x-2">
      <button @click="editCashFlowFormVisibility = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
      <button @click="updateCashFlow(editCashFlowForm.cashflow_id)" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
    </div>
  </div>
</div>

  </div>
</template>
