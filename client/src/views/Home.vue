<script setup>

import { onMounted, ref } from 'vue';

const selectedService = ref('PS');
const services = {
  PS: {
    imgPath: new URL('../assets/service-PS.jpg', import.meta.url).href,
    title: 'Photoshoot',
    desc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus iure, laboriosam maiores quo sed voluptate tempora ratione distinctio velit magni rerum officiis sapiente aut omnis eaque libero. Alias, delectus sunt!',
  },
  WO: {
    imgPath: new URL('../assets/service-WO.jpg', import.meta.url).href,
    title: 'Wedding Organizer',
    desc: 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus, ullam ab. Minima cumque esse sunt nisi nulla, repudiandae consequatur veniam, ex tempora saepe optio totam ut maxime eligendi dolor impedit? Beatae possimus alias autem odio ipsam nulla! Minus rem iure fugiat facilis corrupti cumque sunt sint error, tempore quis alias vero deserunt excepturi aliquam quibusdam eos, animi nobis totam dignissimos.',
  },
  EO: {
    imgPath: new URL('../assets/service-EO.jpg', import.meta.url).href,
    title: 'Event Organizer',
    desc: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid, ad asperiores! Earum, explicabo numquam quas itaque a ut voluptas modi harum illo similique exercitationem reiciendis! Ipsum ab blanditiis quam est!',
  }
};
const couruselIndex = ref(0);
const courusel = [
  new URL('../assets/carousel/1.png', import.meta.url).href,
  new URL('../assets/carousel/2.png', import.meta.url).href,
];

function nextCoursel() {
  couruselIndex.value = (couruselIndex.value + 1) % courusel.length;
}

onMounted(() => {
  setInterval(nextCoursel, 6000);
});
</script>



<template>
  
<div id="nav">
  <div>Ruang Hati</div>
  <ul>
    <li><a href="#services">services</a></li>
    <li><a href="#price-list">price list</a></li>
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
      <div @click="selectedService = 'PS'"  :class="{ 'active-service' : selectedService === 'PS' }">Photoshoot</div>
      <div @click="selectedService = 'WO'"  :class="{ 'active-service' : selectedService === 'WO' }">Wedding Organizer</div>
      <div @click="selectedService = 'EO'"  :class="{ 'active-service' : selectedService === 'EO' }">Event Organizer</div>
    </div>

    <div id="service-details">
      <div id="service-details-container" v-if="selectedService === 'WO'">
        <img id="service-img" :src="services.WO.imgPath" alt="Service Image">
        <div id="service-desc">
          <h3>{{ services.WO.title }}</h3>
          <div>
            <p>{{ services.WO.desc }}</p>
          </div>
        </div>
      </div>
      <div id="service-details-container" v-else-if="selectedService === 'EO'">
        <img id="service-img" :src="services.EO.imgPath" alt="Service Image">
        <div id="service-desc">
          <h3>{{ services.EO.title }}</h3>
          <div>
            <p>{{ services.EO.desc }}</p>
          </div>
        </div>
      </div>
      <div id="service-details-container" v-else="selectedService === 'PS'">
        <img id="service-img" :src="services.PS.imgPath" alt="Service Image">
        <div id="service-desc">
          <h3>{{ services.PS.title }}</h3>
          <div>
            <p>{{ services.PS.desc }}</p>
          </div>
        </div>
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
  height: 900px;
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
  padding: 20px;
  background-color: #f0f0f0;
  margin-top: -150px;
  position: relative;
  height: 100px;
  border-top-left-radius: 100% 150px;
  border-top-right-radius: 100% 150px;
  height: fit-content;
}

#services {
  margin-top: 100px;
}
#services h2 {
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

.active-service {
  transform: translateY(-2px);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

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


</style>