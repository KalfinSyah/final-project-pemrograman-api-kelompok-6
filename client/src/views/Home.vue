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
    <ul>
      <li>Photoshoot</li>
      <li>Wedding Organizer</li>
      <li>Event Organizer</li>
    </ul>
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

#carousel img {
  width: 100%;
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
  padding-right: 30px;
}
#services ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  justify-content: space-evenly;
}



</style>
