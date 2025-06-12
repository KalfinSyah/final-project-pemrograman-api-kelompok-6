<script setup>

import { onMounted, ref, watchEffect } from 'vue';

const selectedService = ref('PS'); 
const couruselIndex = ref(0);
const isDragging = ref(false);
const startX = ref(0);
const scrollLeft = ref(0);
const pricelistContainer = ref(null);
const priceListPopup = ref({ isVisible: false, data: null });
const indexTestimonial = ref(0);

const services = {
  PS: {
    imgPath: new URL('../assets/our-service/service-PS.jpg', import.meta.url).href,
    title: 'Photoshoot',
    desc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus iure, laboriosam maiores quo sed voluptate tempora ratione distinctio velit magni rerum officiis sapiente aut omnis eaque libero. Alias, delectus sunt!',
  },
  WO: {
    imgPath: new URL('../assets/our-service/service-WO.jpg', import.meta.url).href,
    title: 'Wedding Organizer',
    desc: 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus, ullam ab. Minima cumque esse sunt nisi nulla, repudiandae consequatur veniam, ex tempora saepe optio totam ut maxime eligendi dolor impedit? Beatae possimus alias autem odio ipsam nulla! Minus rem iure fugiat facilis corrupti cumque sunt sint error, tempore quis alias vero deserunt excepturi aliquam quibusdam eos, animi nobis totam dignissimos.',
  },
  EO: {
    imgPath: new URL('../assets/our-service/service-EO.jpg', import.meta.url).href,
    title: 'Event Organizer',
    desc: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid, ad asperiores! Earum, explicabo numquam quas itaque a ut voluptas modi harum illo similique exercitationem reiciendis! Ipsum ab blanditiis quam est!',
  }
};
const courusel = [
  new URL('../assets/carousel/1.png', import.meta.url).href,
  new URL('../assets/carousel/2.jpg', import.meta.url).href,
  new URL('../assets/carousel/3.png', import.meta.url).href,
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
    username: 'username1',
    comment: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam culpa id quasi reiciendis delectus aspernatur veritatis atque temporibus maiores? Laboriosam quibusdam inventore ipsa recusandae sed amet doloribus quisquam ut veritatis!',
  },
  {
    imgPath: new URL('../assets/profile/2.jpg', import.meta.url).href,
    username: 'username2',
    comment: 'Lorem kasum ipsum dolor sit amet consectetur adipisicing elit. Ullam culpa id quasi reiciendis delectus aspernatur veritatis atque temporibus maiores? Laboriosam quibusdam inventore ipsa recusandae sed amet doloribus quisquam ut veritatis!',
  },
  {
    imgPath: new URL('../assets/profile/3.jpg', import.meta.url).href,
    username: 'username3',
    comment: 'Lorem wesum ipsum dolor sit amet consectetur adipisicing elit. Ullam culpa id quasi reiciendis delectus aspernatur veritatis atque temporibus maiores? Laboriosam quibusdam inventore ipsa recusandae sed amet doloribus quisquam ut veritatis!',
  },
  {
    imgPath: new URL('../assets/profile/4.jpg', import.meta.url).href,
    username: 'username4',
    comment: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam culpa id quasi reiciendis delectus aspernatur veritatis atque temporibus maiores? Laboriosam quibusdam inventore ipsa recusandae sed amet doloribus quisquam ut veritatis!, Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam culpa id quasi reiciendis delectus aspernatur veritatis atque temporibus maiores? Laboriosam quibusdam inventore ipsa recusandae sed amet doloribus quisquam ut veritatis!",
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

onMounted(() => {
  setInterval(nextCoursel, 6000);
  startAutoScroll(pricelistContainer, 0.5);
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
  <div>Ruang Hati</div>
  <ul>
    <li><a href="#services">services</a></li>
    <li><a href="#pricelist">pricelist</a></li>
    <li><a href="#testimonials">testimonials</a></li>
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
          <h3>{{ item.title }}</h3>
          <p>{{ item.price }}</p>
        </div>
      </div>

      <!-- duplicated items to create loop -->
      <div class="pricelist-card" v-for="item in pricelist" :key="item.title + '-clone'">
        <div @click="setPriceListPopup(true, item)" class="pricelist-details" :style="{ backgroundImage: `url(${item.imgPath})` }">
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
        <h4>{{ priceListPopup.data.price }}</h4>
        <p v-html="priceListPopup.data.details.replace(/\n/g, '<br>')"></p>
   
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

  <div id="contact-us">
    <h2>Contact Us</h2>
    <p>Coming soon...</p>
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
}
#nav div {
  color: #e3e3e3;
}
#nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
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
#carousel img {
  width: 100%;
  height: 100%;
  object-fit: cover; 
}

#content {
  color: #474747;
  background-color: #f0f0f0;
  margin-top: -150px;
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

#pricelist-popup-details hr {
    height: 2px;
    background-color: black;
    border: none;
    margin: 0;
}

#pricelist-popup-details > :last-child {
    overflow-y: auto;
    height: 353px;
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
}

#testimonials div:first-child p {
  color: rgb(195, 195, 195);
  text-align: center;
  margin-top: -10px;
}

#testimonials > div:nth-of-type(2) {
  display: flex;
  justify-content: center;
  align-items: center;
  color: rgb(227, 227, 227);
  gap: 100px;
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
  margin-top: 0;
  color: whitesmoke;
}

#contact-us {
  margin-top: 100px;

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
}
.pricelist-details h3 {
  font-weight: 500;
  margin: 0 auto 0 auto;
}
.pricelist-details p {
  margin: 5px auto 0 auto;
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