<template>
  <div>
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ title }}</h1>
  </div>
</template>

<script setup>
const props = defineProps({
  title: String
})
</script>