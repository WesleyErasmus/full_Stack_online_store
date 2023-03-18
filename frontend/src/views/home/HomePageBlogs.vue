<template>
  <!-- Blogs container -->
  <v-layout class="my-15">
    <v-app-bar class="elevation-0" theme="light">
      <template v-slot:prepend>
        <v-app-bar-nav-icon>
          
          <v-btn variant="tonal" size="small" class="mr-5" icon color="primary">
            <v-icon>mdi-hanger</v-icon>
          
          </v-btn>
        </v-app-bar-nav-icon>
        <v-app-bar-title class="">
          Learn how to step up your fashion game
        </v-app-bar-title>
      </template>
      <template v-slot:append>
      </template>
    </v-app-bar>

    <v-main class="">
      <v-row dense>
        <v-col cols="6">
          <v-card theme="dark">
            <v-img height="400px"
              src="https://images.unsplash.com/photo-1618898909019-010e4e234c55?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
              aspect-ratio="4/3" cover>
              <v-card-body class="d-flex flex-column fill-height justify-center align-center text-white">
                <v-card-title class="text-h5">
                  Winter Trends
                </v-card-title>
                <p class="px-6 py-3 text-center">
                  Everything you need to know and shop this winter, from current
                  trends, styling tips, outfit ideas, and more.
                </p>
                <v-card-actions>
                  <v-btn class="ms-2" variant="outlined" color="secondary" size="small">
                    <a class="text-white text-decoration-none elevated-4"
                      href="https://www.vogue.com/tag/misc/winter-fashion" target="_blank">Read more</a>
                  </v-btn>
                </v-card-actions>
              </v-card-body>
            </v-img>
          </v-card>
        </v-col>
        <v-col cols="6">
          <v-card theme="dark">
            <v-img height="400px" cover
              src="https://images.unsplash.com/photo-1594262254144-8a0e068f4215?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1119&q=80">
              <v-card-body class="d-flex flex-column fill-height justify-center align-center text-white">
                <v-card-title class="text-h5">
                  How to Match your Outfits
                </v-card-title>

                <p class="px-6 py-3 text-center">Good things come in twos—or threes, or fours. This is especially
                  true when it comes to street style.</p>

                <v-card-actions>
                  <v-btn class="ms-2" color="primary" variant="outlined" size="small">
                    <a class="text-white text-decoration-none"
                      href="https://www.vogue.com/article/matching-summer-street-style" target="_blank">Read more</a>
                  </v-btn>
                </v-card-actions>
              </v-card-body>
            </v-img>
          </v-card>
        </v-col>
      </v-row>
    </v-main>
  </v-layout>
</template>

<style scoped>

</style>
