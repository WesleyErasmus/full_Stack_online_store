<template>
  <div class="footer-component mt-15">
    <main class="footer-content">
      <v-row class="text-caption">
        <v-col>
          <!-- Footer list items -->
          <ul class="footer-links">
            <li>
              <div class="text-body-2 font-weight-bold">Our Address</div>
            </li>
            <li>123 Loop Street</li>
            <li>City Center,</li>
            <li>CBD,</li>
            <li>Cape Town</li>
            <li>South Africa</li>
            <li>8080</li>
            <li>
              <v-btn variant="tonal" block class="directions-btn mt-5">
                <v-icon icon="mdi-map-marker" class="get-directions-btn-icon" />
                Get Directions

                <!-- Google Maps Modal -->
                <v-dialog v-model="dialog" activator="parent" theme="light">
                  <v-card width="50%" height="620px" variant="flat" color="white" theme=""
                    class="mx-auto text-center pa-5">
                    <GoogleMapsEmbed style="width: 100%" />

                    <v-card-actions class="px-0">
                      <v-btn variant="elevated" color="black" block @click="dialog = false">Close Maps</v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
                <!-- End of Modal -->
              </v-btn>
            </li>
          </ul>
        </v-col>
        <v-col>
          <ul class="footer-links">
            <li>
              <div class="text-body-2 font-weight-bold">Shipping</div>
            </li>
            <li>Online Store</li>
            <li>Terms and conditions</li>
            <li>Campaigns and flash sales</li>
            <li>Retail outlets</li>
          </ul>
        </v-col>
        <v-col>
          <ul class="footer-links">
            <li>
              <div class="text-body-2 font-weight-bold">Partners</div>
            </li>
            <li>Customer service</li>
            <li>Faqs</li>
            <li>Account details</li>
            <li>Returns policy</li>
          </ul>
        </v-col>
        <v-col>
          <ul class="footer-links">
            <li>
              <div class="text-body-2 font-weight-bold">Buy gift vouchers</div>
            </li>
            <li>Orders</li>
            <li>Careers</li>
            <li>Privacy policy</li>
            <li>Credit</li>
          </ul>
        </v-col>
      </v-row>
    </main>
  <!-- Copyright container + social media links  -->
    <div class="copyright-container">
      <div class="sm-links mb-4">
          <a class="sm-icon-item" href="https://www.facebook.com/" target="_blank" alt="Facebook"><i
              class="fa-brands fa-facebook"></i></a>
          <a class="sm-icon-item" href="https://www.twitter.com/" target="_blank" alt="Twitter"><i
              class="fa-brands fa-twitter"></i></a>
          <a class="sm-icon-item" href="https://www.instagram.com/" target="_blank" alt="Instagram"><i
              class="fa-brands fa-instagram"></i></a>
          <a class="sm-icon-item" href="https://www.linkedin.com/" target="_blank" alt="LinkedIn"><i
              class="fa-brands fa-linkedin"></i></a>
          <a class="sm-icon-item" href="https://www.tiktok.com/" target="_blank" alt="TikTok"><i
              class="fa-brands fa-tiktok"></i></a>
          <a class="sm-icon-item" href="https://www.youtube.com/" target="_blank" alt="YouTube"><i
              class="fa-brands fa-youtube"></i></a>
        </div>
        <div>
      © 2023 atlas.co.za. All rights reserved.
      </div>
    </div>

  </div>
</template>

<script>
import GoogleMapsEmbed from "../views/contact/GoogleMaps.vue";
export default {
  components: {
    GoogleMapsEmbed,
  },
  data() {
    return {
      // Google Maps modal
      dialog: false,
    };
  },
};
</script>

<style scoped>
/* Footer page container */
.footer-component {
  padding: 4rem;
  background: rgba(211, 211, 211, 0.37);
}

/* Footer inner */
.footer-content {
  max-width: 1200px !important;
  display: block;
  margin: 0 auto;
}
/* Footer list items */
.footer-links li {
  list-style-type: none;
  padding: 0.25rem 3vw;
}

.copyright-container {
  text-align: center;
  padding: 4rem 2rem 2rem 2rem;
}
/* Google maps dialog activator button */
.directions-btn {
  background: #000;
  color: #fff;
}

.get-directions-btn-icon {
  margin-right: 7px;
}

/* Social media header icons */
.sm-icon-item {
    padding: 10px;
}

/* Social media header icons styling */
.fa-brands {
    font-size: calc(10px + 0.4rem);
    -webkit-transition: 0.1s ease-out;
    transition: 0.1s ease-out;
    color: #000;
}

/* Social media header icons hover */
.fa-brands:hover {
    transform: scale(1.4);
    background: none;
    color: #6e14ef;
}
</style>
