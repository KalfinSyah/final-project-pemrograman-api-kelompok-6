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
        console.log(import.meta.env.VITE_BASE_URL_API)
        const response = await fetch(`${import.meta.env.VITE_BASE_URL_API}/register`, {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(registerForm.value)
      });
      const responseData = await response.json();
      alert(responseData.message);
      if (response.ok) {
        console.log(responseData.user)
      }
    } catch (error) {
      // console.log(error);
      alert("system error");
    }
  }

//     const sendLoginForm = async (email, password) => {
//     try {
//       const response = await fetch("http://127.0.0.1:8000/api/login", {
//         method: "POST",
//         headers: {"Content-Type": "application/json"},
//         body: JSON.stringify({
//           email: email,
//           password: password
//         })
//       });
//       const responseData = await response.json();
//       if (response.ok) {
//         localStorage.setItem("token", responseData.token);
//         router.push({name: "barang"});
//       }
//     } catch (error) {
//       // console.log(error);
//       alert("Kesalahan Sistem");
//     }
//   }

</script>

<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 py-10">
    <h1 class="text-2xl font-semibold mb-6">Register</h1>
    <form @submit.prevent="sendRegisterForm" class="flex flex-col w-full max-w-xs">

      <label for="name" class="mb-1 text-sm font-medium text-gray-700">Name</label>
      <input id="name" type="text" v-model="registerForm.name" placeholder="" class="mb-4 px-4 py-2 border border-gray-300 rounded-full shadow-inner bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300" required>

      <label for="email" class="mb-1 text-sm font-medium text-gray-700">E-Mail</label>
      <input id="email" type="email" v-model="registerForm.email" placeholder="" class="mb-4 px-4 py-2 border border-gray-300 rounded-full shadow-inner bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300" required>

      <label for="password" class="mb-1 text-sm font-medium text-gray-700">Password</label>
      <input id="password" type="password" v-model="registerForm.password" placeholder="" class="mb-4 px-4 py-2 border border-gray-300 rounded-full shadow-inner bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300" required>

      <label for="password_confirmation" class="mb-1 text-sm font-medium text-gray-700">Password Confirmation</label>
      <input id="password_confirmation" type="password" v-model="registerForm.password_confirmation" placeholder="" class="mb-6 px-4 py-2 border border-gray-300 rounded-full shadow-inner bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300" required>

      <button type="submit" class="w-full py-2 px-4 bg-green-300 text-gray-800 font-semibold rounded-full shadow-md hover:bg-green-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
        REGISTER
      </button>

      <div class="mt-4 text-center">
        <RouterLink :to="{name: 'login'}" class="text-sm text-green-600 hover:text-green-800">Already have an account? Login</RouterLink>
      </div>

    </form>
  </div>
</template>