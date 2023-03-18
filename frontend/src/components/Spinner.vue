<template>
  <!-- Page loading spinners -->
  <div class="text-center">
     <v-progress-circular
        indeterminate
        color="primary"
      ></v-progress-circular>
  </div>
</template>
<style scoped>
.v-progress-circular {
  margin: 1rem;
  z-index: 99999;
}
</style>