<template>
  
  <div id="nav">
    <div>Ruang Hati</div>
    <ul>
      <li><a href="#home">home</a></li>
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

</style>
