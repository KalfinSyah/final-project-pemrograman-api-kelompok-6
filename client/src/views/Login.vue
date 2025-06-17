<script setup>
  import router from '../router';
  import { ref } from 'vue';
  import Swal from 'sweetalert2'  

  const loginForm = ref({
    email: "",
    password: ""
  });

  const sendLoginForm = async () => {
    try {
      const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/login`, {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(loginForm.value)
      });
      const responseData = await response.json();
      if (response.ok) {
        localStorage.setItem('token', responseData.token); // Save token
        Swal.fire({
          title: "Success",
          icon: "success",
          text: "Login success!"
        });
        router.push({name: "admin-dashboard"});
      } else if (response.status === 401) {
        localStorage.removeItem('token');
        window.location.href = '/login';
        return;
      } else {
        Swal.fire({
          title: "Oops...",
          icon: "error",
          text: "Wrong credential!"
        });
      }
    } catch (error) {
      // console.log(error);
      Swal.fire({
        title: "Oops...",
        icon: "error",
        text: "Something went wrong!"
      });
    }
  }
</script>

<template>
  <div class="bg-wrapper">
    <div class="form-card">
      <div class="avatar-icon">🤵</div>
      <h1>Login Admin</h1>
      <form @submit.prevent="sendLoginForm">
        <input type="text" v-model="loginForm.email" placeholder="E-Mail" required>
        <input type="password" v-model="loginForm.password" placeholder="Password" required>
        <button type="submit">LOGIN</button>
        <!-- <RouterLink :to="{ name: 'register' }" class="router-link">
          Don't have an account yet? Register
        </RouterLink> -->
      </form>
    </div>
  </div>
</template>


<style scoped>
body, html {
  margin: 0;
  padding: 0;
  height: 100%;
  width: 100%;
  font-family: Arial, sans-serif;
  
}



.bg-wrapper {
  min-width:100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.form-card {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #f5f5f5;
  padding: 2.5rem 2rem 2rem;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
  text-align: center;
}

.form-card > h1 {
  font-weight: bolder;
  margin-top: 20px;
}

.avatar-icon {
  width: 70px;
  height: 70px;
  background-color: #313B66;
  border-radius: 50%;
  color: white;
  font-size: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  top: -35px;
  left: 50%;
  transform: translateX(-50%);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

h1 {
  font-size: 1.2rem;
  margin-top: 40px;
  margin-bottom: 20px;
  color: #333;
}

form {
  display: flex;
  flex-direction: column;
}
input[type="text"],
input[type="email"],
input[type="password"] {
  padding: 10px 12px;
  margin-bottom: 16px;
  border: none;
  border-radius: 6px;
  background-color: #d3d3d3;
  font-size: 14px;
  color: #000; /* ✅ Tambahkan/ubah ini agar teks input jadi hitam */
}

button {
  padding: 10px;
  background-color: #313b66df;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s;
}

button:hover {
  background-color: #313B66;
}

.router-link {
  margin-top: 10px;
  font-size: 13px;
  color: #a5a5a5;
  text-decoration: none;
}

.router-link:hover {
  color: #6d6d6d;
  text-decoration: underline;
}
</style>
