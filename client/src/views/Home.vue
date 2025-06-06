<script setup>

import { ref } from 'vue';
const selectedService = ref('');

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
  <img src="../assets/carousel/1.png" alt="">
</div>

<div id="content">
  <div id="services">
    <h2>Our Services</h2>
    
    <div id="service-list">
      <div @click="selectedService = 'PS'">Photoshoot</div>
      <div @click="selectedService = 'WO'">Wedding Organizer</div>
      <div @click="selectedService = 'EO'">Event Organizer</div>
    </div>

    <div id="service-details">
      <div v-if="selectedService === 'PS'">
        <h3>Photoshoot</h3>
        <p>We offer professional photoshoot services for various occasions.</p>
      </div>
      <div v-else-if="selectedService === 'WO'">
        <h3>Wedding Organizer</h3>
        <p>Let us help you plan your perfect wedding day.</p>
      </div>
      <div v-else-if="selectedService === 'EO'">
        <h3>Event Organizer</h3>
        <p>We organize events that leave lasting impressions.</p>
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
  margin-left: 35px;
}
#service-list div:hover {
  transform: translateY(-2px);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#service-details {
  margin-top: 50px;
}

</style>