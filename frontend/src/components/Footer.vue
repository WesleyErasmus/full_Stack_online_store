<template>
  <div class="footer-component mt-15">
    <main class="footer-content">
      <v-row>
        <v-col>
          <ul class="footer-links">
            <li>
              <div class="text-h6">Our Address</div>
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
              <div class="text-h6">Shipping</div>
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
              <div class="text-h6">Partners</div>
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
              <div class="text-h6">Buy gift vouchers</div>
            </li>
            <li>Orders</li>
            <li>Careers</li>
            <li>Privacy policy</li>
            <li>Credit</li>

          </ul>
        </v-col>
      </v-row>
    </main>

    <div class="copyright-container">
      © 2023 atlas.co.za. All rights reserved.
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
      dialog: false,
    };
  },
};
</script>

<style scoped>
.footer-component {
  padding: 4rem 7rem;
  background: rgba(211, 211, 211, 0.37);
}

.footer-content {
  max-width: 1440px !important;
  display: block;
  margin: 0 auto;
}

li {
  font-size: small;
}


.footer-links li {
  list-style-type: none;
  padding: 0.25rem 3vw;
}

.copyright-container {
  text-align: center;
  padding: 8rem 4rem 4rem 4rem;
}

.directions-btn {
  background: #000;
  color: #fff;
}

.get-directions-btn-icon {
  margin-right: 7px;
}
</style>
