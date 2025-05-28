<script setup>
  import { ref } from 'vue';

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
        console.log(responseData)
        alert("login success")
      }
    } catch (error) {
      // console.log(error);
        alert("system error");
    }
  }
</script>

<template>
   <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <h1 class="text-2xl font-semibold mb-6">Tes Login</h1>
    <form @submit.prevent="sendLoginForm" class="flex flex-col w-full max-w-xs">
      <label for="username" class="mb-1 text-sm font-medium text-gray-700">
        E-Mail
      </label>
      <input id="username" type="text" v-model="loginForm.email" placeholder="" class="mb-4 px-4 py-2 border border-gray-300 rounded-full shadow-inner bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300" required>

      <label for="password" class="mb-1 text-sm font-medium text-gray-700">
        Password
      </label>
      <input id="password" type="password" v-model="loginForm.password" placeholder="" class="mb-6 px-4 py-2 border border-gray-300 rounded-full shadow-inner bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300" required>

      <button type="submit" class="w-full py-2 px-4 bg-green-300 text-gray-800 font-semibold rounded-full shadow-md hover:bg-green-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
        LOGIN
      </button>

      <div class="mt-4 text-center">
        <RouterLink :to="{name: 'register'}" class="text-sm text-green-600 hover:text-green-800">Don't have an account yet? Register</RouterLink>
      </div>
    </form>
  </div>
</template>