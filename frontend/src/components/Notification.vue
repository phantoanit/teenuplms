<template>
    <transition name="fade">
      <div
        v-if="visible"
        class="fixed top-5 right-5 z-50 px-4 py-3 bg-green-500 text-white rounded-lg shadow-lg flex items-center"
      >
        <span class="mr-2">✅</span>
        <span>{{ message }}</span>
        <button @click="close" class="ml-4 font-bold">×</button>
      </div>
    </transition>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'

  const emit = defineEmits(['close'])
  
  const props = defineProps({
    message: String,
    duration: {
      type: Number,
      default: 3000 // milliseconds
    }
  })
  
  const visible = ref(true)
  
  function close() {
    visible.value = false
    emit('close')
  }
  
  onMounted(() => {
    setTimeout(() => {
      visible.value = false
      close()
    }, props.duration)
  })
  </script>
  
  <style scoped>
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.5s;
  }
  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
  }
  </style>
  