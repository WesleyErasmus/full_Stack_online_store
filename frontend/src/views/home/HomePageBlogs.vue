<template>
  <!-- Blogs container -->
  <v-container class="">
    <h1>Read Our Blogs</h1>
    <v-row dense>
      <v-col cols="6">
        <v-card color="#385F73" theme="dark">
          <v-img
            src="https://images.pexels.com/photos/6567607/pexels-photo-6567607.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
              aspect-ratio="4/3"
            >

            <v-card-body class="d-flex flex-column fill-height justify-center align-center text-white">
            <v-card-title class="text-h5">
              Winter Trends
            </v-card-title>
            <p class="px-6 py-3 text-center">
              Everything you need to know and shop this winter, from current
              trends, styling tips, outfit ideas, and more.
            </p>
            <v-card-actions>
              <v-btn class="ms-2" variant="outlined" size="small">
                <a class="text-white text-decoration-none" href="https://www.vogue.com/tag/misc/winter-fashion"
                  target="_blank">Read more</a>
              </v-btn>
            </v-card-actions>
            </v-card-body>
          </v-img>
        </v-card>
      </v-col>

      <v-col cols="6">
        <v-card color="#1F7087" theme="dark">
          <v-img
            src="https://images.unsplash.com/photo-1485230895905-ec40ba36b9bc?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80">
              <v-card-body class="d-flex flex-column fill-height justify-center align-center text-white">
                <v-card-title class="text-h5">
                  How to Match your Outfits
                </v-card-title>

                <p class="px-6 py-3 text-center">Good things come in twos—or threes, or fours. This is especially
                  true when it comes to street style.</p>

                <v-card-actions>
                  <v-btn class="ms-2" variant="outlined" size="small">
                    <a class="text-white text-decoration-none"
                      href="https://www.vogue.com/article/matching-summer-street-style" target="_blank">Read more</a>
                  </v-btn>
                </v-card-actions>
              </v-card-body>
          </v-img>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
/* Transparent black filter over blog images */
.card-img-overlay {
  background: rgba(0, 0, 0, 0.54);
  border-radius: 0;
  padding: 2rem;
  display: flex;
  justify-content: center;
  align-content: center;
  flex-direction: column;
}

/* Blog card images */
.card-img {
  border-radius: 0;
}

/* Card column containers */
.col {
  padding: var(--card-padding);
}

/* Card titles that says blogs */
.card-title-1 {
  font-style: italic;
  color: var(--primary-color);
  font-weight: bold;
  font-size: calc(12px + 0.4rem);
}

/* Card blog topic title */
.card-title-2 {
  font-weight: bold;
  font-size: calc(15px + 0.6rem);
}
</style>
