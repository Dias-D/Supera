<template>
  <header class="header">
    <div class="header-group">
      <div class="flex items-center justify-between py-7">
        <div class="w-28 lg:w-36">
          <h1 class="font-bold text-white">Maintenance's Car</h1>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {};
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
