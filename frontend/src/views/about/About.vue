<template>

  <!-- Page Hero -->
  <div id="main" class="about">
    <v-layout class="mt-3">
      <v-app-bar class="elevation-0" theme="light" density="compact">
        <!-- App bar title -->
        <v-app-bar-title>
          Get to know us.
        </v-app-bar-title>
        <!-- Shop link -->
        <template v-slot:append>
          <RouterLink class="nav-link-item text-decoration-none text-black" :to="{ name: 'Shop' }">
          <v-btn variant="outlined" color="primary" size="small">shop</v-btn>
          </RouterLink>
        </template>
      </v-app-bar>
      <v-main>
        <!-- Page image parallax -->
        <v-parallax class="mt-2"
          src="https://images.unsplash.com/photo-1643988603854-5eb5e1a992a8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80"
          height="70vh">
          <!-- Parallax content -->
          <div class="d-flex flex-column fill-height justify-center align-center text-white">
            <img class="logo-image" src="../../assets/logowords.png" alt="Logo">
            <h2>
              Just Be Yourself.
            </h2>
          </div>
        </v-parallax>
      </v-main>
    </v-layout>
    
    <!-- Company Mission statement -->
    <MissionStatement />

    <!-- Staff Team members -->
    <StaffTeam />

    <!-- Customer Reviews -->
    <CustomerReviews />

  </div>
</template>

<script>
// Page loading spinner component
import Spinner from "/src/components/Spinner.vue";
import StaffTeam from "./StaffTeam.vue";
import MissionStatement from "./MissionStatement.vue";
import CustomerReviews from "./CustomerReviews.vue";
export default {
  components: { Spinner, StaffTeam, MissionStatement, CustomerReviews },
  data() {
    return {
    };
  },
};
</script>

<style scoped>
.about {
  display: block;
  margin: 0 auto;
}
</style>
