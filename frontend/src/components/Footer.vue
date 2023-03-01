<template>
  <div>
    <div id="footer" class="footer">
      <!-- Footer wrapper -->
      <div class="footer-wrapper">
        <div class="footer-inner">
          <main>
            <div class="footer-links">
              <ul class="footer-links-container">
                <li class="link-heading">Shipping</li>
                <li>Online Store</li>
                <li>Terms and conditions</li>
                <li>Campaigns and flash sales</li>
                <li>Retail outlets</li>
              </ul>


              <!-- Emulation footer links -->
              <ul class="footer-links-container">
                <li class="link-heading">Partners</li>
                <li>Customer service</li>
                <li>Faqs</li>
                <li>Account details</li>
                <li>Returns policy</li>
              </ul>

              <!-- Emulation footer links -->
              <ul class="footer-links-container">
                <li class="link-heading">Buy gift vouchers</li>
                <li>Orders</li>
                <li>Careers</li>
                <li>Privacy policy</li>
                <li>Credit</li>
              </ul>


              <!-- Footer logo container -->
              <section class="logo-container">

                <!-- link to home page -->
                <RouterLink :to="{ name: 'Home' }">

                  <div><img class="logo" src="../assets/logoatlas.png" alt="Logo-Image"></div>


                </RouterLink>
              </section>
            </div>
            <!-- End of footer links container -->


            <!-- The footer's subscription container -->
            <div class="subscription-container">
              <div class="newsletter">Become a MEMBER of our fashion community</div>


              <!-- Container for subscription header and form -->
              <div class="signup-container">

                <!-- V-for used to display validation error in DOM -->
                <div v-show="errors.length">
                  <ul>
                    <li class="error-message" v-for="error in errors" :key="error">{{ error }}</li>
                  </ul>
                </div>

                <!-- Subs form -->
                <v-form @submit.prevent="addSubscriber" style="width:500px;">
                  <v-text-field v-model="newSubscriber" type="email" label="Subscribe"
                    placeholder="Enter your email address"></v-text-field>
                </v-form>
                <div class="blogs">
                  <v-btn class="signup-btn" @click="addSubscriber">SIGNUP</v-btn>
                </div>
              </div>
            </div>
          </main>

          <!-- Footer social media links -->
          <div class="sm-links">
            <a href="https://www.facebook.com/" target="_blank" alt="Facebook"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.twitter.com/" target="_blank" alt="Twitter"><i class="fa-brands fa-twitter"></i></a>
            <a href="https://www.instagram.com/" target="_blank" alt="Instagram"><i
                class="fa-brands fa-instagram"></i></a>
            <a href="https://www.linkedin.com/" target="_blank" alt="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
            <a href="https://www.tiktok.com/" target="_blank" alt="TikTok"><i class="fa-brands fa-tiktok"></i></a>
            <a href="https://www.youtube.com/" target="_blank" alt="YouTube"><i class="fa-brands fa-youtube"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Subscription success message -->
    <Toasts />
  </div>
</template>

<script>
// Import toast component
import Toasts from "/src/components/Toasts.vue";
export default {
  components: { Toasts },
  data() {
    return {
      subscriberList: [],
      newSubscriber: null,
      errors: [],
    };
  },
  // Storing subs emails to local storage
  mounted() {
    if (localStorage.getItem("subscriberList")) {
      try {
        this.subscriberList = JSON.parse(
          localStorage.getItem("subscriberList")
        );
      } catch (e) {
        localStorage.removeItem("subscriberList");
      }
    }
  },
  methods: {
    // Subscription success message
    subscribedSuccess() {
      var x = document.getElementById("snackbar4");
      x.className = "show";
      setTimeout(function () {
        x.className = x.className.replace("show", "");
      }, 3000);
    },


    // Email Validation
    validEmail() {
      var re =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(this.newSubscriber);
    },


    // Add subscriber data to local storage
    addSubscriber() {
      // Form validation errors array - errors get pushed to this array depending on validation type
      this.errors = [];



      // ensure they actually typed something
      if (!this.newSubscriber) {
        this.errors.push("Please enter your email address");
        return;
      }

      // endure that the email address is a valid email address
      if (!this.validEmail(this.email)) {
        this.errors.push(
          "Please enter a valid email address (e.g. johndoe@mail.com)"
        );
        return;
      }


      // Push data to local storage array
      this.subscriberList.push(this.newSubscriber);


      // form reset
      this.newSubscriber = "";


      // Calling this method to save to local storage
      this.saveSubscriber();


      // Subscription Toast message trigger
      this.subscribedSuccess()
    },

    // Saves data to local storage
    saveSubscriber() {
      const parsed = JSON.stringify(this.subscriberList);
      localStorage.setItem("subscriberList", parsed);
    },
  },
};
</script>

<style scoped>
/* Withing the footer container */
.footer-wrapper {
  margin-top: 5vw;
  /* background: #2f3131; */
  background-color: rgb(241, 241, 241) !important;
  color: #9d9d9d;
}

/* Inner container */
.footer-inner {
  display: block;
  margin: 0 auto;
}


/* Container limiting max width to footer contents */
.subscription-container {
  max-width: 1280px;
  display: flex;
  flex-direction: column;
  margin: 0 auto;
  padding: 1.5rem 2rem;
  align-content: center;
  align-items: center;
}


/* Form validation message styling */
.error-message {
  list-style-type: none;
  color: red;
  font-size: calc(10px + 0.35rem);
  padding-bottom: 0;
  margin-bottom: 0;
}


/* Email input */
input {
  padding: 0.25rem;
  min-width: 18rem;
  width: 100%;
}


/* Input Placeholder text */
::placeholder {
  font-size: calc(8px + 0.3rem);
}

/* Contains subs input form, including submit btn */
.signup-container {
  display: flex;
  flex-direction: column;
}


/* Subs form submit btn */
.signup-btn {
  border: none;
  margin-top: 7px;
  padding: 0.5rem 0.75rem;
  border-radius: 2px;
  font-size: calc(8px + 0.3rem);
  float: right;
}


/* Subs header text */
.newsletter {
  padding-bottom: 5px;
  /* color: #fff; */
  font-weight: 600;
}

/* All footer contents except for footer's header and s.media links */
main {
  display: block;
  margin: 0 auto;
  max-width: 1280px;
  padding: 0 0 2rem 0;
}

.logo-container {
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
}

.logo {
  width: calc(100px + 10vw);
  border-radius: 2px;
  padding: 0.5rem 1.5rem;
}

.footer-links {
  padding: 1rem;
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
}

.footer-links-container {
  list-style-type: none;
  padding: 1rem;
}


/* All footer emulated links / not including s.media links */
li {
  margin: 0.25rem 0;
  font-size: 12px;
}

li:hover {
  opacity: 0.8;
  cursor: pointer;
  color: #fff;
}


/* first link on each column */
.link-heading {
  color: #000;
  font-size: 13px;
}


/* Social media links */
.sm-links {
  padding: 1rem;
  display: flex;
  flex-direction: row;
  justify-content: center;
  background: #242626;
}


/* Overriding universal a tag styling */
.fa-brands {
  color: #fff;
  padding: 1rem;
  -webkit-transition: 0.3s ease-in-out;
  transition: 0.3s ease-in-out;
}

.fa-brands:hover {
  transform: scale(1.5);
  background: none;
  color: var(--primary-color);
}
</style>
