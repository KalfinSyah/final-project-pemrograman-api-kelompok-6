<template>
  <div>
    <!-- Hero Section -->
    <section class="hero">
      <nav class="nav">
        <div class="logo">Ruang Hati</div>
        <ul class="nav-links">
          <li><a href="#">Home</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Testimonials</a></li>
          <li><a href="#">Contact us</a></li>
        </ul>
      </nav>

      <div class="hero-content">
        <h1>Menjalin Cerita Berawal Dari Hati</h1>
        <p>
          Sagitta adipiscing posuere ut iaculis nec aliquam posuere. Aliquet
          faucibus duis accumsan aliquet tempor diam dignissim suscipit. Nibh
          urna ut diam fames.
        </p>
        <div class="scroll-down">↓ Scroll</div>
      </div>

      <!-- Lengkungan SVG -->
      <div class="hero-curve">
        <svg viewBox="0 0 1440 320" preserveAspectRatio="none">
          <path
            fill="#ffffff"
            fill-opacity="1"
            d="M0,160 C360,240 1080,80 1440,160 L1440,320 L0,320 "
          ></path>
        </svg>
      </div>
    </section>

    <!-- Services Section -->
    <section class="services">
      <h2>Pelayanan Kami</h2>
      <p>That you will remember forever</p>

      <div class="service-card">
        <img src="/src/assets/lake.png" alt="Lake Como" />
        <div class="card-content">
          <h3>Fotografi</h3>
          <h5>Lake Como</h5>
          <p>
            The whole complex consists of two residential buildings, a church,
            and a portico (known as Loggia Durini) that can host weddings and
            events in a truly unique setting.
          </p>
          <p>
            But the special feature of Villa Balbianello is above all the vast
            garden that surrounds the dwellings... <a href="#">View more</a>
          </p>
        </div>
      </div>
    </section>
  </div>
</template>


<style scoped>
/* Hero Section */
/* Hero Section */
.hero {
  background: url('/src/assets/Hero-bg.png') no-repeat center center/cover;
  height: 100vh;
  color: white;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.nav {
  display: flex;
  justify-content: space-between;
  padding: 2rem 4rem;
  align-items: center;
  z-index: 2;
  position: relative;
}

.logo {
  font-size: 1.8rem;
  font-weight: bold;
}

.nav-links {
  display: flex;
  gap: 2rem;
  list-style: none;
}

.nav-links a {
  color: white;
  text-decoration: none;
  font-weight: 500;
}

.hero-content {
  text-align: center;
  padding-bottom: 80px;
  z-index: 2;
  position: relative;
}

.hero-content h1 {
  font-size: 2.8rem;
  font-weight: 600;
  margin-bottom: 1rem;
}

.hero-content p {
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.6;
}

.scroll-down {
  margin-top: 2rem;
  font-size: 1.2rem;
  opacity: 0.8;
}

/* Lengkungan Hero Section */
.hero-curve {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  line-height: 0;
  overflow: hidden;
  z-index: 1;
}

.hero-curve svg {
  display: block;
  width: 100%;
  height: 100px;
}

/* Services Section */
.services {
  background: white;
  padding: 5rem 2rem;
  text-align: center;
  position: relative;
  z-index: 2;
}

.services h2 {
  font-size: 2rem;
  margin-bottom: 0.5rem;
  color: black;
}

.services p {
  font-size: 1rem;
  color: #666;
}

.service-card {
  display: flex;
  flex-wrap: wrap;
  max-width: 900px;
  margin: 2rem auto;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  text-align: left;
}

.service-card img {
  width: 100%;
  max-width: 50%;
  object-fit: cover;
}

.card-content {
  padding: 2rem;
  flex: 1;
}

.card-content h3 {
  margin-top: 0;
}

.card-content h5 {
  margin-bottom: 1rem;
  font-weight: 400;
  color: gray;
}

</style>
