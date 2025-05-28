<script setup>
  import { ref } from 'vue';

  const registerForm = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: ""
  });

  const sendRegisterForm = async () => {
    try {
        const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/register`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(registerForm.value)
        });
        const responseData = await response.json();
        alert(responseData.message);
        if (response.ok) {
            // alert("register success")
        }
    } catch (error) {
        // console.log(error);
        alert("system error");
    }
  }

</script>

</script>

<template>
  <div class="bg-wrapper">
    <div class="form-card">
      <div class="avatar-icon">👤</div>
      <h1>Register</h1>
      <form @submit.prevent="sendRegisterForm">

        <label for="name" class="text-sm font-medium text-gray-700 text-left mb-1">Name</label>
        <input id="name" type="text" v-model="registerForm.name" required />

        <label for="email" class="text-sm font-medium text-gray-700 text-left mb-1">E-Mail</label>
        <input id="email" type="email" v-model="registerForm.email" required />

        <label for="password" class="text-sm font-medium text-gray-700 text-left mb-1">Password</label>
        <input id="password" type="password" v-model="registerForm.password" required />

        <label for="password_confirmation" class="text-sm font-medium text-gray-700 text-left mb-1">Password Confirmation</label>
        <input id="password_confirmation" type="password" v-model="registerForm.password_confirmation" required />

        <button type="submit">REGISTER</button>

        <RouterLink :to="{ name: 'login' }" class="router-link">
          Already have an account? Login
        </RouterLink>

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
  background-color: #1e1e1e; /* warna background gelap */
}

.bg-wrapper {
  min-width:100vh;
  
  display: flex;
  justify-content: center;
  align-items: center;
  
}

.form-card {
  position: relative;
  background-color: #f5f5f5;
  padding: 3rem 2rem 2rem; /* sedikit lebih longgar */
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  width: 100%;
  max-width: 360px; 
  text-align: center;
  color: #000; /* teks berwarna hitam */
}


.avatar-icon {
  width: 70px;
  height: 70px;
  background-color: #28a745;
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
  font-size: 1.5rem;
  margin-top: 40px;
  margin-bottom: 24px;
  color: #000;
  font-weight: bold;
}

form {
  display: flex;
  flex-direction: column;
  color: #000;
  font-size: 14px;
}

label {
  text-align: left;
  margin-bottom: 6px;
  font-weight: 500;
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
  color: #000;
}

input::placeholder {
  color: #666;
}

button {
  padding: 10px;
  background-color: #28a745;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s;
}

button:hover {
  background-color: #218838;
}

.router-link {
  margin-top: 10px;
  font-size: 13px;
  color: #28a745;
  text-decoration: none;
}

.router-link:hover {
  text-decoration: underline;
}
</style>
