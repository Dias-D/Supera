<template>
  <header class="header">
    <div class="header-group">
      <div class="flex items-center justify-between py-7">
        <div class="w-28 lg:w-36">
          <h1 class="font-bold text-white">Maintenance's Car</h1>
        </div>
        <div class="flex">
          <button
            @click="() => emit('create-account')"
            class="px-6 py-2 font-bold rounded-full text-white focus:outline"
          >
            Registrar-se
          </button>
          <button
            @click="() => emit('login')"
            class="px-6 py-2 font-bold bg-white rounded-full text-black focus:outline"
          >
            Entrar
          </button>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  setup({}, { emit }) {
    return { emit };
  },
};
</script>

<style lang="postcss" scoped>
.header {
  @apply bg-black w-full h-1/6 flex justify-center items-center;
}

.header-group {
  @apply flex flex-col w-4/5 max-w-5xl;
}

@media (min-width: 640px) {
  .header-group {
    background-size: 628px;
    background-position: 90% 100%;
    background-repeat: no-repeat;
  }
}
</style>
