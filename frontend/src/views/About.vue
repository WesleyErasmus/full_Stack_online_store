<template>
  <div id="main" class="about">
    <v-layout class="mt-3">
      <v-app-bar class="elevation-0" density="" theme="light">
        <template v-slot:prepend>
          <v-app-bar-nav-icon>
            <v-icon icon="mdi-message-text" />
          </v-app-bar-nav-icon>
        </template>
        <v-app-bar-title class="">
          Get to know us.
        </v-app-bar-title>
        <template v-slot:append>
          <v-btn variant="outlined" size="small">shop</v-btn>
        </template>
      </v-app-bar>
      <v-main>
        <v-parallax class="mt-2"
          src="https://images.unsplash.com/photo-1643988603854-5eb5e1a992a8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80"
          height="71vh">
          <div class="d-flex flex-column fill-height justify-center align-center text-white">
          <img class="logo-image" src="../assets/logowords.png" alt="Logo">
            <h2>
              Just Be Yourself.
            </h2>
          </div>
        </v-parallax>
      </v-main>
    </v-layout>

    <!-- Endorsements Wrapper -->
    <div class="endorsements-wrapper">
      <div class="logo-container">
        <h1>Customer Reviews</h1>
      </div>

      <div class="endorsement-comment">
        "It's just amazing. Atlas Fashion has got everything I need. The service was
        excellent. I'd be lost without Atlas fashion." <span class="endorser-name"> - Aub P.</span>
      </div>
      <div class="endorsement-comment">
        "It's just amazing. We can't understand how we've been living without
        you." <span class="endorser-name"> - Lurline C.</span>
      </div>
      <div class="endorsement-comment">
        "I can't say enough about your store. It really saves me time and
        effort. Your store is exactly what I have been looking for. I love your
        store." <span class="endorser-name"> - Shanie E.</span>
      </div>
      <div class="endorsement-comment">
        "Great job, I will definitely be ordering again! Your company is truly
        upstanding and is behind its products 100%." <span class="endorser-name"> - Ruby Z.</span>
      </div>
    </div>

    <!-- Team members -->
    <div class="text-center mb-4">
    <h1>Meet The Team</h1></div>
    <v-row class="d-flex justify-center align-center">
      <v-col cols="12" md="2" v-for="member in team" :key="member.id">
        <div>
          <v-hover v-slot="{ isHovering, props }">
            <v-card class="mx-auto text-center" color="grey-lighten-4" max-width="600" v-bind="props">
              <v-img aspect-ratio="1/1" cover :src="member.portrait">
                <v-expand-transition>
                  <div v-if="isHovering" class="d-flex transition-fast-in-fast-out bg-black v-card--reveal px-5"
                    style="height: 100%;">
                    <div class="text-h5 mb-2">{{ member.name }}</div>
                    <div class="text-overline text-decoration-underline mb-2">{{ member.job_title }}</div>
                    <div class="text-caption mb-">{{ member.bio }}</div>
                  </div>
                </v-expand-transition>
              </v-img>
            </v-card>
          </v-hover>
        </div>
      </v-col>
    </v-row>
  </div>
</template>

<script>
// Page loading spinner component
import Spinner from "/src/components/Spinner.vue";
export default {
  components: { Spinner },
  data() {
    return {
      // Array containing team member info
      team: [],
    };
  },
  mounted() {
    // Fetch team members data from local json data file
    fetch("../src/data/team.json")
      .then((res) => res.json())
      .then((data) => (this.team = data.team))
      .catch((err) => console.log(err.message));
  },
};
</script>

<style scoped>
.v-card--reveal {
  align-items: center;
  justify-content: center;
  flex-direction: column;
  bottom: 0;
  opacity: .8;
  position: absolute;
  width: 100%;
}

.about {
  display: block;
  margin: 0 auto;
}

/* Customer endorsements styling */
.endorsements-wrapper {
  text-align: center;
  font-size: calc(13px + 0.3rem);
  padding: 4vw;
}

/* Logo at customer endorsements */
.logo-container {
  margin-bottom: 1rem;
}

/* Endorsement comment containers */
.endorsement-comment {
  border-radius: 7px;
  padding: var(--card-padding);
  font-size: calc(13px + 0.3rem);
}

.endorser-name {
  color: var(--primary-color);
  font-weight: bold;
  font-size: calc(12px + 0.3rem);
}
</style>
