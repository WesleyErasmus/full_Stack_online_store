<template>
    <div class="nav-spacing">
        <v-app-bar class="nav-contact-info px-10" theme="dark">
            <v-app-bar-title class="text-start text-caption">

                <div class="sm-links">
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

            </v-app-bar-title>
            <!-- Prevent access to guest users -->
            <RouterLink :to="{ name: 'SignUp' }" class="text-decoration-none">
                <v-btn v-if="!customer_id" variant="outlined" color="primary" size="small"
                    class="give-btn text-overline mb-3 mr-5">Sign-Up</v-btn>
            </RouterLink>
            <!-- Conditionally changing the value of the login/logout button based on the the user is a guest or a signed in customer -->
            <RouterLink :to="{ name: 'Login' }" class="text-decoration-none">
                <v-btn v-if="!customer_id" variant="elevated" color="primary" size="small"
                    class="give-btn text-overline mb-3 mr-5">Login</v-btn>
                <v-btn v-else variant="outlined" color="primary" size="small" class="give-btn text-overline mb-3 mr-5"
                    @click="customerLogout">Logout</v-btn>
            </RouterLink>
        </v-app-bar>
        <nav class="app-top-navbar elevation-0">
            <div class="max-width-container">
                <!-- Navbar App Logo -->
                <RouterLink class="nav-link-item text-decoration-none text-black" :to="{ name: 'Home' }">
                    <div class="app-top-nav-logo-container">
                        <img class="app-top-nav-logo" src="../assets/logowords.png" alt="NLV Top Navigation Logo" />
                    </div>
                </RouterLink>
                <!-- <v-spacer></v-spacer> -->

                <!-- Navbar Meu Links -->
                <div class="top-nav-menu-tabs">
                    <RouterLink class="nav-tab-item" :to="{ name: 'Home' }">
                        HOME
                    </RouterLink>
                    <RouterLink class="nav-tab-item" :to="{ name: 'Shop' }">SHOP</RouterLink>


                    <RouterLink class="nav-tab-item" :to="{ name: 'NewProducts' }">NEW</RouterLink>
                    <RouterLink class="nav-tab-item" :to="{ name: 'FeaturedProducts' }">FEATURED</RouterLink>

                    <!-- Prevent access to guest users -->
                    <RouterLink v-if="customer_id" class="nav-tab-item" :to="{ name: 'Profile' }">PROFILE</RouterLink>

                    <!-- Prevent access to guest users -->
                    <RouterLink v-if="customer_id" class="nav-tab-item" :to="{ name: 'Cart' }">CART</RouterLink>

                    <RouterLink class="nav-tab-item" :to="{ name: 'Contact' }">CONTACT</RouterLink>
                    <RouterLink class="nav-tab-item" :to="{ name: 'About' }">ABOUT</RouterLink>
                </div>

                <!-- Cart icon -->
                <RouterLink v-if="customer_id" class="shopping-cart-icon" :to="{ name: 'Cart' }">

                    <v-btn variant="outlined" size="small" icon color="primary">
                        <v-icon>mdi-cart</v-icon>
                        {{ this.shoppingCart.length }}
                    </v-btn>
                </RouterLink>

                <!-- Back to top btn -->
                <div class="back-to-top-btn">
                    <a @click="smoothScrollToTop" class="">
                        <v-icon>mdi-arrow-up-drop-circle-outline</v-icon>
                        Back to top
                    </a>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import api from "@/services/api.js";
import { useCookies } from "vue3-cookies";
export default {
    props: ["shoppingCart"],
    setup() {
        const { cookies } = useCookies();
        return { cookies };
    },
    data() {
        return {
            cartCount: 0,
            shoppingCart: [],
            fullName: "",
            email: "",
            password: "",
            customer_id: this.cookies.get("customer_id")
        }
    },
    watch: {
        cookies: {
            handler(newCookies) {
                customer_id = newCookies.customer_id;
            },
            deep: true
        }
    },
    methods: {
        // Back redirect button / using router history feature
        back() {
            this.$router.go(-1);
        },
        // Forward redirect button / using router history feature
        forward() {
            this.$router.go(1);
        },
        // Smooth scroll to top of page function
        smoothScrollToTop() {
            window.scrollTo({ top: 0, left: 0, behavior: "smooth" });
        },

        customerLogout() {
            this.cookies.remove("customer_id");

            this.$router.push({ name: 'Login' }).then(() => {
                window.location.reload();
            });

        },

    },
    computed: {
        isLoggedIn() {
            return customer_id;
        },
        // Compute the cart count only if a customer is logged in
        cartCount() {
            if (!customer_id) {
                return 0;
            }
            return this.shoppingCart.length;
        },
    },
    mounted() {

        let customerId = this.cookies.get("customer_id");
        const customer_id = parseInt(customerId);

        console.log(customer_id);

        // Display cart items for a customer only if there is a customer id
        if (customer_id) {
            api.get(`/controllers/CartController.php?action=displayCartItems&tableName=myTable&customerId=${customer_id}`, { responseType: 'json' })
                .then((response) => {
                    this.shoppingCart = response.data;
                    console.warn(response);
                    console.log("customer_id:", customer_id, typeof customer_id);
                });
        } else {
            this.shoppingCart = [];
        }
    },
}
</script>

<style scoped>
.back-to-top-btn {
    cursor: pointer;
}

/* Shopping cart icon and cart item count container */
/* Shopping cart icon */
.shopping-cart-icon {
    /* right: 2vw; */
    color: rgb(78, 78, 78);
    text-decoration: none;
}

.shopping-cart-icon:hover {
    color: var(--primary-color);
}

/* Cart number displayed on dom */
.cart-count-number {
    position: absolute;
    top: -18px;
    right: -10px;
    line-height: 1;
    padding: 6px 8px;
    width: 22px;
    height: 22px;
    border-radius: 99999px;
    background: var(--primary-color);
    color: #fff;
    font-size: 12px;
}

/* Shopping cart icon font styling */
.shopping-cart-icon .material-symbols-outlined {
    font-size: calc(23px + 0.3rem);
    /* font-weight: bold; */
    color: var(--primary-grey);
    color: #000;
}

.nav-contact-info {
    height: 50px;
    box-shadow: none !important;
}

.nav-contact-info div {
    height: 40px;
}

.app-top-navbar {
    z-index: 99999;
    width: 100%;
    height: 85px;
    position: fixed;
    display: flex;
    justify-content: center;
    align-content: center;
    align-items: center;
    top: 50px !important;
    background: linear-gradient(to bottom, var(--secondary-color), var(--primary-color-2));
}

.max-width-container {
    width: 1240px;
    display: flex;
    margin: 0 auto;
    justify-content: space-between;
    align-content: center;
    align-items: center;
}

.app-top-nav-logo {
    width: 125px;
    /* border-radius: 50%; */
}

/* Navbar Logo image container */
.app-top-nav-logo-container {
    display: flex;
    align-items: center;
}

/* Navbar menu buttons spacing */
.top-nav-menu-tabs {}

.nav-tab-item {}

/* Navbar link/button styling */
.top-nav-menu-tabs a {
    margin: 10px 0 0 20px;
    text-decoration: none;
    color: black;
    border-bottom: 2px transparent solid;
}

/* Navbar link hover effects */
.top-nav-menu-tabs a:hover {
    color: #444;
    border-bottom: 2px #385f73 solid;
}

.nav-spacing {
    margin-bottom: 135px !important;
}

/* Social media header icons */

/* Social media header icons */
.sm-icon-item {
    padding: 10px;
}

/* Social media header icons styling */
.fa-brands {
    font-size: calc(10px + 0.4rem);
    -webkit-transition: 0.1s ease-out;
    transition: 0.1s ease-out;
}

/* Social media header icons hover */
.fa-brands:hover {
    transform: scale(1.4);
    background: none;
    color: #fff;
}
</style>
