<script setup>

import { onMounted, ref, watchEffect } from 'vue';
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import Swal from 'sweetalert2'  

const selectedService = ref('PS'); 
const couruselIndex = ref(0);
const isDragging = ref(false);
const startX = ref(0);
const scrollLeft = ref(0);
const pricelistContainer = ref(null);
const priceListPopup = ref({ isVisible: false, data: null });
const indexTestimonial = ref(0);
const eventData = ref([]);
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
  eventClick: function(info) {
    Swal.fire({
      title: '<strong>📅 Wedding Event</strong>',
      html: `
        <div style="font-size: 15px; color: #334155;">
          ${info.event.start.toLocaleDateString('id-ID', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
          })}<br>
          ${info.event.extendedProps.description}
        </div>
      `,
      icon: 'info',
      showCloseButton: true,
      showConfirmButton: false,
      background: '#f8fafc',
      color: '#1e293b',
      customClass: {
        popup: 'shadow-lg rounded-xl px-6 py-4',
        title: 'text-lg font-semibold',
      },
      showClass: {
        popup: 'animate__animated animate__zoomIn animate__faster'
      },
      hideClass: {
        popup: 'animate__animated animate__zoomOut animate__faster'
      }
    });
  }
})

let intervalTestimonial;

const services = {
  PS: {
    imgPath: new URL('../assets/our-service/service-PS.jpg', import.meta.url).href,
    title: 'Photoshoot',
    desc: 'Abadikan momen spesial Anda dengan sesi pemotretan profesional. Kami menyediakan fotografer berpengalaman yang siap menangkap setiap detail penting dengan hasil yang estetik dan penuh makna. Cocok untuk prewedding, keluarga, hingga produk bisnis.',
  },
  WO: {
    imgPath: new URL('../assets/our-service/service-WO.jpg', import.meta.url).href,
    title: 'Wedding Organizer',
    desc: 'Kami hadir untuk memastikan hari pernikahan Anda berjalan lancar dan tak terlupakan. Tim kami akan membantu Anda mulai dari perencanaan konsep, pemilihan vendor, hingga pelaksanaan acara, agar Anda dan pasangan bisa fokus menikmati hari bahagia.',
  },
  EO: {
    imgPath: new URL('../assets/our-service/service-EO.jpg', import.meta.url).href,
    title: 'Event Organizer',
    desc: 'Percayakan kebutuhan event Anda kepada kami. Baik itu seminar, konser, ulang tahun, atau peluncuran produk, kami siap mengatur segala kebutuhan teknis dan konsep agar acara Anda berjalan sukses dan berkesan.',
  }
};
const courusel = [
  new URL('../assets/carousel/1.png', import.meta.url).href,
  new URL('../assets/carousel/2.jpg', import.meta.url).href,
  new URL('../assets/carousel/3.jpg', import.meta.url).href,
];
const pricelist = [
  {
    imgPath: new URL('../assets/pricelist/1.png', import.meta.url).href,
    title: 'ENGAGEMENT',
    price: 'IDR. 3.500.000',
    details: `
    1 Project manager.
    3 Crew on duty with HT.
    Unlimited konsultasi online.
    1x online meeting vendor dengan klien.
    1x meeting dengan keluarga.
    Konsultasi konsep acara.
    Guidebook.
    Property games.
    `,
  },
  {
    imgPath: new URL('../assets/pricelist/1.png', import.meta.url).href,
    title: 'AKAD INTIMATE',
    price: 'IDR. 4.000.000',
    details: `
    1 Project Manager.
    4 Crew onduty with HT.
    Unlimited konsultasi online.
    1 x TM klien dengan vendor.
    Konsultasi konsep acara.
    5 cetak Guidebook.
    1x meeting WOdengan
    keluarga.
    Handle loading decoration.
    Free buku tamu & ballpoint.
    `,
  },
  {
    imgPath: new URL('../assets/pricelist/1.png', import.meta.url).href,
    title: ' RESEPSI ONLY',
    price: 'IDR. 6.000.000',
    details: `
    1 Project Manager.
    6 Crew onduty with HT.
    Unlimited konsultasi online.
    1 x TM klien dengan vendor.
    Konsultasi konsep acara.
    10 cetak Guidebook.
    1x meeting WO dengan keluarga.
    Pendampingan loading dekor.
    Pendampingan fitting, testfood,
    survey lokasi,prewed (Sby & Sda).
    Free buku tamu & ballpoint.
    Free pengaturan acara panggih.
    Free 2 hadiah games.
    `,
  },
  {
    imgPath: new URL('../assets/pricelist/1.png', import.meta.url).href,
    title: 'AKAD RESEPSI',
    price: 'IDR. 6.500.000',
    details: `
    1 Project Manager.
    8 Crew with HT.
    Unlimited konsultasi.
    1x TM klien dengan vendor.
    Konsultasi konsep acara.
    10 guide book cetak.
    1x meeting klien dengan WO.
    Pendampingan loading dekor. 
    Pendampingan fitting, testfood & survey lokasi.
    Free buku tamu & ballpoint
    Free pembaturan acara panggih - Free 2 hadiah games.
    `,
  },
  {
    imgPath: new URL('../assets/pricelist/1.png', import.meta.url).href,
    title: 'AKAD RESEPSI VIP',
    price: 'IDR. 10.500.000',
    details: `
    1 Project Manager.
    15 Crew onduty with HT.
    Unlimited konsultasi online.
    1 x TM klien dengan vendor.
    Konsultasi konsep acara.
    10 cetak Guidebook.
    1x meeting WO dengan keluarga.
    Pendampingan loading dekor.
    Pendampingan fitting, testfood,
    survey lokasi,prewed (Sby & Sda).
    Free buku tamu & ballpoint.
    Free pengaturan acara panggih.
    Free 2 hadiah games.
    `,
  },
];
const testimonials = [
  {
    imgPath: new URL('../assets/profile/1.jpg', import.meta.url).href,
    username: 'Andi',
    comment: 'Saya benar-benar terkesan dengan pelayanan yang diberikan. Tim sangat profesional dan responsif sejak awal hingga akhir. Semua pertanyaan saya dijawab dengan sabar, dan hasil akhirnya sangat memuaskan. Tidak menyesal memilih layanan ini.',
  },
  {
    imgPath: new URL('../assets/profile/2.jpg', import.meta.url).href,
    username: 'Bella',
    comment: 'Awalnya saya ragu karena ini pertama kalinya saya menggunakan layanan ini, tapi setelah melihat hasilnya, saya benar-benar puas. Prosesnya cepat, komunikatif, dan hasilnya bahkan lebih bagus dari yang saya bayangkan.',
  },
  {
    imgPath: new URL('../assets/profile/3.jpg', import.meta.url).href,
    username: 'Citra',
    comment: 'Pengalaman saya sangat menyenangkan. Mulai dari pemesanan, konsultasi, hingga hasil akhirnya semuanya berjalan lancar. Mereka benar-benar memperhatikan detail dan kebutuhan saya. Saya pasti akan merekomendasikan ke teman-teman saya.',
  },
  {
    imgPath: new URL('../assets/profile/4.jpg', import.meta.url).href,
    username: 'Dedi',
    comment: 'Pelayanan yang ramah dan sangat membantu. Saya merasa dilayani dengan sepenuh hati. Terlihat jelas bahwa tim ini sangat berdedikasi pada pekerjaannya. Terima kasih sudah membuat pengalaman saya begitu berkesan!',
  },
];

function nextCoursel() {
  couruselIndex.value = (couruselIndex.value + 1) % courusel.length;
}
function onMouseDown(e) {
  isDragging.value = true;
  startX.value = e.pageX - e.currentTarget.offsetLeft;
  scrollLeft.value = e.currentTarget.scrollLeft;
}
function onMouseLeave() {
  isDragging.value = false;
}
function onMouseUp() {
  isDragging.value = false;
}
function onMouseMove(e) {
  if (!isDragging.value) return;
  e.preventDefault();
  const x = e.pageX - e.currentTarget.offsetLeft;
  const walk = (x - startX.value) * 1;
  e.currentTarget.scrollLeft = scrollLeft.value - walk;
}
function startAutoScroll(elementRef, speed = 1) {
  if (!elementRef.value) return;

  const scrollWidthHalf = elementRef.value.scrollWidth / 2;

  function autoScroll() {
    if (!elementRef.value) return;

    elementRef.value.scrollLeft += speed;

    if (elementRef.value.scrollLeft >= scrollWidthHalf) {
      elementRef.value.scrollLeft = 0;
    }

    requestAnimationFrame(autoScroll);
  }

  requestAnimationFrame(autoScroll);
}
function setPriceListPopup(isVisible, data = null) {
  priceListPopup.value.isVisible = isVisible;
  priceListPopup.value.data = data;
}
async function fetchEvent() {
  try {
    const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/activities`)
    if (!response.ok) {
      alert('fetch event failed');
    } else {
      eventData.value = await response.json()
      eventData.value.data = eventData.value.data.map(item => ({
        title: "Pernikahan",
        date: item.activity_date,
        description: item.activity_desc
      }))
      calendarOptions.value.events = eventData.value.data
    }
  } catch (err) {
    alert('fetch event failed : ' + err);
  }
}

onMounted(() => {
  setInterval(nextCoursel, 6000);
  startAutoScroll(pricelistContainer, 0.5);
  fetchEvent();
  intervalTestimonial = setInterval(() => indexTestimonial.value++, 4000);
});

watchEffect(() => {
  if (indexTestimonial.value < 0) {
    indexTestimonial.value = testimonials.length - 1;
  } else if (indexTestimonial.value >= testimonials.length) {
    indexTestimonial.value = 0;
  }
});

</script>



<template>
  
<div id="nav">
  <img src="../assets/logo.png" alt="">
  <ul>
    <li><a href="#services">services</a></li>
    <li><a href="#pricelist">pricelist</a></li>
    <li><a href="#testimonials">testimonials</a></li>
    <li><a href="#schedule">schedule</a></li>
    <li><a href="#contact-us">contact us</a></li>
  </ul>
</div>  

<div id="carousel">

  <transition name="fade" mode="out-in">
  
    <img :key="couruselIndex" :src="courusel[couruselIndex]" alt="carousel image" />
  </transition>

</div>

<div id="content">
  <div id="services">
    <h2>Our Services</h2>
    
    <div id="service-list">
      <div 
      @click="selectedService = 'PS'"  
      :class="{ 'active-service' : selectedService === 'PS' }"
      :style="selectedService === 'PS' ? { backgroundColor: 'black', color: 'white' } : {}">Photoshoot</div>

      <div 
      @click="selectedService = 'WO'"  
      :class="{ 'active-service' : selectedService === 'WO' }"
      :style="selectedService === 'WO' ? { backgroundColor: 'black', color: 'white' } : {}">Wedding Organizer</div>
      
      <div 
      @click="selectedService = 'EO'"  
      :class="{ 'active-service' : selectedService === 'EO' }" 
      :style="selectedService === 'EO' ? { backgroundColor: 'black', color: 'white' } : {}">Event Organizer</div>
    </div>

    <div id="service-details">
      <div id="service-details-container">
        <img id="service-img" :src="services[selectedService].imgPath" alt="Service Image">
        <div id="service-desc">
          <h3>{{ services[selectedService].title }}</h3>
          <div>
            <p>{{ services[selectedService].desc }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="pricelist">
    <h2>Pricelist</h2>
    <div id="pricelist-container"
      ref="pricelistContainer"
      @mousedown="onMouseDown"
      @mouseup="onMouseUp"
      @mouseleave="onMouseLeave"
      @mousemove="onMouseMove">

      <div class="pricelist-card" v-for="item in pricelist" :key="item.title">
        <div @click="setPriceListPopup(true, item)" class="pricelist-details" :style="{ backgroundImage: `url(${item.imgPath})` }">
          <div class="pricelist-details-bg"></div>
          <h3>{{ item.title }}</h3>
          <p>{{ item.price }}</p>
        </div>
      </div>

      <!-- duplicated items to create loop -->
      <div class="pricelist-card" v-for="item in pricelist" :key="item.title + '-clone'">
        <div @click="setPriceListPopup(true, item)" class="pricelist-details" :style="{ backgroundImage: `url(${item.imgPath})` }">
          <div class="pricelist-details-bg"></div>
          <h3>{{ item.title }}</h3>
          <p>{{ item.price }}</p>
        </div>
      </div>
    </div>
  </div>

  <div v-if="priceListPopup.isVisible" id="pricelist-popup" @click="setPriceListPopup(false)">
    <div id="pricelist-popup-details" @click.stop>
      <div :style="{ backgroundImage: `url(${priceListPopup.data.imgPath})` }">
        <span @click="setPriceListPopup(false)">✖</span>
      </div>
      <hr>
      <div>
        <h3 id="pricelist-popup-details-title">
          {{ priceListPopup.data.title }}
        </h3>
        <h4 id="pricelist-popup-details-price" >{{ priceListPopup.data.price }}</h4>
        <p id="pricelist-popup-details-desc" v-html="priceListPopup.data.details.replace(/\n/g, '<br>')"></p>
   
        <a href="#contact-us" @click="setPriceListPopup(false)">Contact Us</a>
      </div>
    </div>
  </div>

  <div id="testimonials">
    <div>
      <h2>Testimonials</h2>
      <p>from happy, delighted couples</p>
    </div>
    <div>
      <p @click="indexTestimonial--" >🡨</p>
      <p>{{ testimonials[indexTestimonial].comment }}</p>
      <p @click="indexTestimonial++" >🡪</p>
    </div>
    <div>
      <img :src="testimonials[indexTestimonial].imgPath" alt="profile picture">
      <p>{{testimonials[indexTestimonial].username}}</p>
    </div>
  </div>

  <div id="schedule">
    <h2>Our Schedule</h2>

    <div>
      <FullCalendar :options="calendarOptions" />
    </div>
  </div>

  <div id="contact-us">
    <h2>Contact Us</h2>
    <div>
      <div>
        <img src="../assets/contact-us/wa.png" alt="">
        <a href="https://wa.me/1234567890" target="_blank">1234567890</a>
      </div>
      <div>
        <img src="../assets/contact-us/ig.png" alt="">
        <a href="https://www.instagram.com/ruanghati_eventplanner/" target="_blank">@ruang_hati</a>
      </div>
    </div>
  </div>
</div>

</template>



<style scoped>

#nav {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 30px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1); 
  z-index: 9999;
  height: 60px;
  color: #e3e3e3;
}
#nav img {
  height: 50px;
  width: 100px;
}
#nav ul {
  list-style: none;
  padding: 0;
  margin: left;
}
#nav li {
  display: inline-block; 
  margin-right: 40px; 
}
#nav a {
  font-weight: lighter;
  color: #e3e3e3;
}

#carousel {
  height: 750px;
  overflow: hidden;
  position: relative;
}
#carousel > img:first-child {
  width: 100%;
  height: 100%;
  object-fit: cover; 
 
}
#carousel > img:nth-child(2) {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -65%);
  width: 300px;
}

#content {
  color: #474747;
  background-color: #f0f0f0;
  margin-top: -170px;
  position: relative;
  border-top-left-radius: 100% 150px;
  border-top-right-radius: 100% 150px;
  height: fit-content;
}

#services {
  margin-top: 100px;
}
#services h2 {
  padding-top: 100px;
  margin-bottom: 25px;
  font-weight: bold;
  font-size: 26px;
}

#service-list {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  justify-self: center;
}
#service-list div {
  background-color: white;
  padding: 10px 20px;
  text-align: center;
  border-radius: 20px;
  font-weight: 500;
  font-size: 18px;
  color: #333;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
  width: fit-content;
  margin: auto;
}
#service-list div:last-child {
  margin-left: 33px;
}
#service-list div:hover {
  transform: translateY(-2px);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#service-details {
  margin-top: 50px;
}

#service-details-container {
  display: grid;
  width: 1000px;
  height: 400px;
  background-color: whitesmoke;
  margin: auto;
  grid-template-columns: 300px 1fr;
  grid-template-areas: 
  'img desc desc'
  'img desc desc';
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

#service-img {
  grid-area: img;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

#service-desc {
  grid-area: desc;
  height: 100%;
  overflow: hidden;
}
#service-desc h3 {
  width: fit-content;
  margin-top: 40px;
  margin-left: 40px;
  font-weight: bolder;
}
#service-desc div {
  margin: 20px 40px 20px 40px;
  text-align: justify;
  height: 70%;
  overflow: auto;
}

#pricelist {
  margin-top: 150px;
  height: 290px;
  text-align: center;
}

#pricelist > h2 {
  font-weight: bolder;
  font-size: 26px;
}

#pricelist-container {
  height: 100%;
  overflow-x: auto;
  gap: 50px;
  display: flex;
  scrollbar-width: none;
  padding: 20px;
}

#pricelist-popup {
    background-color: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(1px); 
    display: grid;
    height: 100vh;
    left: 0;
    pointer-events: auto;
    position: fixed;
    place-items: center;
    top: 0;
    width: 100vw;
    z-index: 9999; 
}

#pricelist-popup-details {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(12px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    animation: popupFadeIn 0.3s ease-out;
    border-radius: 10px;
    height: 700px;
    margin: auto;
    overflow: hidden;
    width: 600px;
    flex-direction: column;
}
#pricelist-popup-details > :first-child {
    padding: 10px 15px 0 0;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    text-align: right;
    height: 300px;
}
#pricelist-popup-details > :first-child > :first-child {
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-size: 20px;
    font-weight: bold;
}
#pricelist-popup-details-title {
  margin-top: 20px;
  margin-bottom: 30px;
}
#pricelist-popup-details-price {
  margin-top: 18px;
  margin-bottom: 15px;
}
#pricelist-popup-details hr {
    height: 2px;
    background-color: black;
    border: none;
    margin: 0;
}

#pricelist-popup-details > :last-child {
    overflow-y: auto;
    height: 400px;
    padding: 5px 30px 30px 30px;
    scrollbar-width: thin;         
    scrollbar-color: #999 #f0f0f0;   
}

#pricelist-popup-details > div:last-child > p:first-of-type {
    margin-top: -20px;
    text-align: center;
}
#pricelist-popup-details > div:last-child > a {
  display: inline-block;
  background-color: black;
  color: white;
  padding: 10px 20px;
  border-radius: 8px;
  font-weight: 500;
  text-decoration: none;
  transition: background-color 0.3s ease;
  margin-top: 20px;
}
#pricelist-popup-details > div:last-child > a:hover {
  background-color: #222;
}
#pricelist-popup-details-title {
    font-weight: bolder;
    margin-bottom: -15px;
}

#testimonials {
  margin-top: 200px;
  width: 100%;
  height: 400px;
  display: flex;
  background-color: #585B56;
  padding-top: 35px;
  padding-bottom: 35px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
} 
#testimonials div:first-child h2 {
  color: white;
  font-size: 26px;
  font-weight: bolder;
}
#testimonials div:first-child p {
  color: rgb(195, 195, 195);
  text-align: center;
}
#testimonials > div:nth-of-type(2) {
  display: flex;
  justify-content: center;
  align-items: center;
  color: rgb(227, 227, 227);
  gap: 100px;
}
#testimonials > div:nth-of-type(2) > p {
  margin-top: 20px;
}
#testimonials > div:nth-of-type(2) > p:nth-of-type(1), #testimonials > div:nth-of-type(2) > p:nth-of-type(3) {
  cursor: pointer;
}
#testimonials > div:nth-of-type(2) > p:nth-of-type(2) {
  color: white;
  width: 700px;
}
#testimonials > div:nth-of-type(3) > img {
  margin-top: 20px;
  width: 80px;
  height: 80px;
  border-radius: 100%;
}
#testimonials > div:nth-of-type(3) > p {
  margin-top: 5px;
  color: whitesmoke;
  font-weight: 500;
}

#schedule {
  margin-top: 100px;
  height: fit-content;
}
#schedule > div  {
  width: 950px;
  height: fit-content;
  margin: auto;
}
#schedule > h2 {
  margin-bottom: 20px;
  font-size: 26px;
  font-weight: bolder;
}
#schedule > div > div {
  border: black 5px solid;
  padding: 30px;
}

#contact-us {
  margin-top: 100px;
  background-color: #424242;
  padding: 20px 20px 15px 20px;
  display: flex;
  justify-content: space-between; 
  gap: 20px;
  align-items: center;
}
#contact-us h2 {
  color: white;
  font-weight: 400;
  font-size: small;
}
#contact-us > div {
  display: flex;
  justify-content: center;
  align-items: center;
}
#contact-us div > div {
  width: fit-content;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  padding: 10px 0px 10px 25px;
  border-radius: 9999px;
  cursor: pointer;
  transition: background-color 1s ease, padding 1s ease, margin-left 1s ease;
}
#contact-us > div > div > img {
  width: 32px;
  height: 32px;
}
#contact-us > div > div > a {
  color: whitesmoke;
  font-size: small;
  display: none;
}
#contact-us > div > div:hover > a {
  color: #e3e3e3;
  display: block;
}
#contact-us > div > div:hover {
  background-color: #585B56;
  padding: 10px 25px 10px 25px;
  margin-left: 20px;
}


/* ------------------------------------------------------------- */

.active-service {
  transform: translateY(-2px);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.pricelist-card {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  cursor: pointer;
}

.pricelist-details {
  height: 100%;
  width: 490px;
  border-radius: 10px;
  color: whitesmoke;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  position: relative;
}
.pricelist-details-bg {
  height: 100%;
  width: 100%;
  border-radius: 10px;
  position: absolute;
  backdrop-filter: blur(1px);
}
.pricelist-details h3 {
  font-weight: 500;
  margin: 0 auto 0 auto;
  position: relative;
}
.pricelist-details p {
  margin: 5px auto 0 auto;
  position: relative;
}

/* ------------------------------------------------------------- */

.fade-enter-active, .fade-leave-active {
  transition: opacity 2.5s cubic-bezier(0.25, 1, 0.5, 1), transform 2.5s ease;
}

.fade-enter-from {
  opacity: 0;
  transform: scale(1.2);
}

.fade-leave-to {
  opacity: 0;
  transform: scale(1);
}

@keyframes popupFadeIn {
  from {
    opacity: 0;
    transform: scale(0.5);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

</style>