<template>
    <div>
        <!-- Spacer to align content main page content below navbar  -->
        <div class="nav-spacing">

            <!-- App Navbar -->
            <v-app-bar class="nav-contact-info px-10" theme="dark">
                <v-app-bar-title class="text-start text-caption">

                    <!-- Social media links -->
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

                <!-- Navbar login and sign-up links -->
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

            <!-- Navbar page links -->
            <nav class="app-top-navbar elevation-0">
                <div class="max-width-container">
                    <!-- Navbar Logo -->
                    <RouterLink class="nav-link-item text-decoration-none text-black" :to="{ name: 'Home' }">
                        <div class="app-top-nav-logo-container">
                            <img class="app-top-nav-logo" src="../assets/logowords.png" alt="NLV Top Navigation Logo" />
                        </div>
                    </RouterLink>
                    <!-- Navbar Meu Links -->
                    <div class="top-nav-menu-tabs">
                        <!-- Home -->
                        <RouterLink class="nav-tab-item" :to="{ name: 'Home' }">HOME</RouterLink>
                        <!-- Shop -->
                        <RouterLink class="nav-tab-item" :to="{ name: 'Shop' }">SHOP</RouterLink>
                        <!-- New -->
                        <RouterLink class="nav-tab-item" :to="{ name: 'NewProducts' }">NEW</RouterLink>
                        <!-- Featured -->
                        <RouterLink class="nav-tab-item" :to="{ name: 'FeaturedProducts' }">FEATURED</RouterLink>
                        <!-- Profile -->
                        <!-- Prevent access to guest users -->
                        <RouterLink v-if="customer_id" class="nav-tab-item" :to="{ name: 'Profile' }">PROFILE</RouterLink>
                        <!-- Cart -->
                        <!-- Prevent access to guest users -->
                        <RouterLink v-if="customer_id" class="nav-tab-item" :to="{ name: 'Cart' }">CART</RouterLink>
                        <!-- Contact -->
                        <RouterLink class="nav-tab-item" :to="{ name: 'Contact' }">CONTACT</RouterLink>
                        <!-- About -->
                        <RouterLink class="nav-tab-item" :to="{ name: 'About' }">ABOUT</RouterLink>
                    </div>

                    <!-- Cart icon -->
                    <RouterLink v-if="customer_id" class="shopping-cart-icon" :to="{ name: 'Cart' }">
                        <v-btn variant="outlined" size="small" icon color="primary">
                            <v-icon>mdi-cart</v-icon>
                            {{ this.shoppingCart.length }}
                        </v-btn>
                    </RouterLink>
                </div>
            </nav>
            <!-- Mobile Navbar view -->
            <v-toolbar app class="mobile-toolbar">
                <!-- Mobile nav logo -->
                <RouterLink class="nav-link-item text-decoration-none text-black" :to="{ name: 'Home' }">
                    <div class="app-top-nav-logo-container ml-5">
                        <img class="app-top-nav-logo" src="../assets/logowords.png" alt="NLV Top Navigation Logo" />
                    </div>
                </RouterLink>
                <!-- Mobile nav cart icon -->
                <RouterLink v-if="customer_id" class="shopping-cart-icon ml-7" :to="{ name: 'Cart' }">
                            <v-btn variant="outlined" size="small" icon color="primary">
                                <v-icon>mdi-cart</v-icon>
                                {{ this.shoppingCart.length }}
                            </v-btn>
                        </RouterLink>
                <v-spacer></v-spacer>
                <!-- Mobile vie menu toggler -->
                <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
                    <template v-slot:activator="{ props }">
                        <v-btn size="small" icon variant="tonal" color="primary" v-bind="props">
                            <v-icon>mdi-menu</v-icon>
                        </v-btn>
                    </template>
                    <!-- Mobile nav body -->
                    <v-card>
                        <!-- Mobile nav toolbar image -->
                        <v-toolbar extended flat color="grey"
                            image="https://images.unsplash.com/photo-1508427953056-b00b8d78ebf5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80">
                            <v-spacer></v-spacer>
                            <!-- Atlas logo and home page link -->
                            <RouterLink class="nav-link-item text-decoration-none text-black" :to="{ name: 'Home' }">
                                <div class="app-top-nav-logo-container ml-10 mt-10">
                                    <img class="app-top-nav-logo" src="../assets/logoatlas.png" alt="Top Navigation Logo" />
                                </div>
                            </RouterLink>
                            <v-spacer></v-spacer>
                            <v-btn icon @click="dialog = false">
                                <v-icon>mdi-close</v-icon>
                            </v-btn>
                        </v-toolbar>
                        <!-- Mobile nav menu items -->
                        <v-list density="compact" class="mobile-navbar">
                            <!-- Home -->
                            <v-list-item>
                                <RouterLink @click="dialog = false" :to="{ name: 'Home' }">
                                    <v-btn block variant="tonal">
                                    HOME
                                    </v-btn>
                                </RouterLink>
                            </v-list-item>
                            <!-- Shop -->
                            <v-list-item>
                                <RouterLink @click="dialog = false" :to="{ name: 'Shop' }">
                                    <v-btn block variant="tonal">
                                    SHOP
                                    </v-btn>
                                </RouterLink>
                            </v-list-item>
                            <!-- New -->
                            <v-list-item>
                                <RouterLink @click="dialog = false" :to="{ name: 'NewProducts' }">
                                    <v-btn block variant="tonal">
                                    NEW
                                    </v-btn>
                                </RouterLink>
                            </v-list-item>
                            <!-- Featured -->
                            <v-list-item>
                                <RouterLink @click="dialog = false" :to="{ name: 'FeaturedProducts' }">
                                    <v-btn block variant="tonal">
                                    FEATURED
                                    </v-btn>
                                </RouterLink>
                            </v-list-item>
                            <!-- Contact -->
                            <v-list-item>
                                <RouterLink @click="dialog = false" :to="{ name: 'Contact' }">
                                    <v-btn block variant="tonal">
                                    CONTACT
                                    </v-btn>
                                </RouterLink>
                            </v-list-item>
                            <!-- About -->
                            <v-list-item>
                                <RouterLink @click="dialog = false" :to="{ name: 'About' }">
                                    <v-btn block variant="tonal">
                                    ABOUT
                                    </v-btn>    
                                </RouterLink>
                            </v-list-item>
                            <!-- Profile -->
                            <v-list-item v-if="customer_id">
                                <RouterLink @click="dialog = false" :to="{ name: 'Profile' }">
                                    <v-btn block variant="tonal">
                                    PROFILE
                                    </v-btn>
                                </RouterLink>
                                <!-- Cart -->
                            </v-list-item>
                            <v-list-item v-if="customer_id">
                                <RouterLink @click="dialog = false" :to="{ name: 'Cart' }">
                                    <v-btn block variant="tonal">
                                    CART
                                    </v-btn>
                                </RouterLink>
                            </v-list-item>
                        </v-list>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </div>
    </div>
</template>
<script>
import api from "@/services/api.js";
import { useCookies } from "vue3-cookies";
export default {
    // Using props for items in cart
    props: ["shoppingCart"],
    // Cookies used to set and unset customer id when user logs in or logs out
    setup() {
        const { cookies } = useCookies();
        return { cookies };
    },
    data() {
        return {
            // Navbar mobile and tablet breakpoints
            dialog: false,
            // Cart icon count
            cartCount: 0,
            shoppingCart: [],
            fullName: "",
            email: "",
            password: "",
            // Customer ID cookies
            customer_id: this.cookies.get("customer_id")
        }
    },
    // Watching for customer id to display or hide navbar links when user logs in and out
    watch: {
        cookies: {
            handler(newCookies) {
                customer_id = newCookies.customer_id;
            },
            deep: true
        }
    },
    methods: {
        // Customer logout function
        customerLogout() {
            // Remove cookies and send them back to the login page
            this.cookies.remove("customer_id");
            this.$router.push({ name: 'Login' }).then(() => {
            // Reload page
            window.location.reload();
            });

        },

    },
    computed: {
        // Checks customer id when a customer logs in
        isLoggedIn() {
            return customer_id;
        },
        // Checks the cart count only if a customer is logged in
        cartCount() {
            if (!customer_id) {
                return 0;
            }
            return this.shoppingCart.length;
        },
    },
    // This method is called when the component is mounted to the DOM - lifecycle hook
    mounted() {
        let customerId = this.cookies.get("customer_id");
        const customer_id = parseInt(customerId);
        // console.log(customer_id);

        // Display cart items for a customer only if there is a customer id
        if (customer_id) {
            api.get(`/controllers/CartController.php?action=displayCartItems&tableName=myTable&customerId=${customer_id}`, { responseType: 'json' })
                .then((response) => {
                    this.shoppingCart = response.data;
                    // console.warn(response);
                    // console.log("customer_id:", customer_id, typeof customer_id);
                });
        } else {
            this.shoppingCart = [];
        }
    },
}
</script>

<style scoped>
/* Back to top button */
.back-to-top-btn {
    cursor: pointer;
}
/* Shopping cart icon and cart item count container */
.shopping-cart-icon {
    color: rgb(78, 78, 78);
    text-decoration: none;
}
.shopping-cart-icon:hover {
    color: var(--primary-color);
}

/* Shopping cart icon font styling */
.shopping-cart-icon .material-symbols-outlined {
    font-size: calc(23px + 0.3rem);
    color: var(--primary-grey);
    color: #000;
}

/* Top navbar with social media icons and login/logout button */
.nav-contact-info {
    height: 50px;
    box-shadow: none !important;
}

.nav-contact-info div {
    height: 40px;
}

/* Styling for top v-app navbar */
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

/* Styling for navbar inner */
.max-width-container {
    width: 1200px;
    padding: 0 0.5rem;
    display: flex;
    margin: 0 auto;
    justify-content: space-between;
    align-content: center;
    align-items: center;
}

.app-top-nav-logo {
    width: 125px;
}

/* Navbar Logo image container */
.app-top-nav-logo-container {
    display: flex;
    align-items: center;
}

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
    border-bottom: 2px #6e14ef solid;
}

.nav-spacing {
    margin-bottom: 135px !important;
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
}

/* Social media header icons hover */
.fa-brands:hover {
    transform: scale(1.4);
    background: none;
    color: #fff;
}

/* Mobile navigation */
.mobile-toolbar {
    position: fixed;
    display: none;
    background: #fff;
}

.mobile-navbar {
    height: 100%;
    text-align: center;
}
/* Mobile app nav links */
.v-list-item {
    margin: 0.5rem 0rem;
}

.v-list-item a {
    text-decoration: none;
    color: #000;
}

@media screen and (max-width: 800px) {

    .nav-spacing {
        margin-bottom: 112px !important;
    }

    .app-top-navbar {
        display: none;
    }

    .mobile-toolbar {
        display: block;
        margin-top: 50px;
        z-index: 9999;
    }
}

@media screen and (max-width: 530px) {
    .sm-links {
        display: none;
    }
}
</style>
