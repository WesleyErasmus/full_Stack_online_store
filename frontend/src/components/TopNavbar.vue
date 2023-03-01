<template>
    <div class="nav-spacing">
        <v-app-bar class="nav-contact-info" color="black">
            <v-app-bar-title class="text-center text-overline">Email us: info@atlas.org.za | Call us: 021
                2305808</v-app-bar-title>
            <RouterLink :to="{ name: 'SignUp' }" class="text-decoration-none">
                <v-btn variant="outlined" size="small" class="give-btn text-overline mb-3 mr-5">SIGN-UP</v-btn>
            </RouterLink>
            <RouterLink :to="{ name: 'Login' }" class="text-decoration-none">
                <div>
                    <v-btn variant="outlined" size="small" class="give-btn text-overline mb-3 mr-5"
                        v-if="loggedIn == 'true'" @click="customerLogout">LOGOUT</v-btn>
                    <v-btn variant="outlined" size="small" class="give-btn text-overline mb-3 mr-5" v-else>Login</v-btn>
                </div>
            </RouterLink>
        </v-app-bar>
        <v-app-bar class="app-top-navbar elevation-0">
            <!-- Navbar App Logo -->
            <RouterLink class="nav-link-item text-decoration-none text-black" :to="{ name: 'Home' }">
                <div class="app-top-nav-logo-container">
                    <img class="app-top-nav-logo" src="../assets/logowords.png" alt="NLV Top Navigation Logo" />
                </div>
            </RouterLink>

            <v-spacer></v-spacer>

            <!-- Navbar Meu Links -->
            <div class="top-nav-menu-tabs">
                <RouterLink class="nav-tab-item" :to="{ name: 'Home' }">
                    <v-icon icon="mdi-home" class="mb-1" />
                    HOME
                </RouterLink>
                <RouterLink class="nav-tab-item" :to="{ name: 'Shop' }">SHOP</RouterLink>
                <RouterLink class="nav-tab-item" :to="{ name: 'Cart' }">CART</RouterLink>
                <RouterLink class="nav-tab-item" :to="{ name: 'FeaturedProducts' }">FEATURED</RouterLink>
                <RouterLink class="nav-tab-item" :to="{ name: 'NewProducts' }">NEW</RouterLink>
                <RouterLink class="nav-tab-item" :to="{ name: 'Profile' }">PROFILE</RouterLink>
                <RouterLink class="nav-tab-item" :to="{ name: 'About' }">ABOUT</RouterLink>
                <RouterLink class="nav-tab-item" :to="{ name: 'Contact' }">CONTACT</RouterLink>
            </div>
            <!-- End of Navbar Meu Links -->

            <!-- <div>
                <a @click="smoothScrollToTop" class="back-to-top-btn mr-5">Back to top</a>
            </div> -->
            <!-- Shopping Cart Icon in header -->
            <RouterLink class="shopping-cart-icon" :to="{ name: 'Cart' }">
                    <!-- Shopping cart icon & link to cart -->
                    CART
                    <span class="material-symbols-outlined">
                        add_shopping_cart
                    </span>
                    <!-- Shopping cart count display -->
                    <div class="cart-count-number">{{ this.shoppingCart.length }}</div>
                    <!-- Cart length count -->
            </RouterLink>
        </v-app-bar>
        <!-- <div class="nav-spacing"></div> -->
    </div>
</template>

<script>
import { mapMutations } from 'vuex';
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
            loggedIn: null,
            shoppingCart: [],
            fullName: "",
            email: "",
            password: "",
            customerId: null
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

        ...mapMutations(["customerLogout"]),
        customerLogout() {
            this.$store.commit('customerLogout')
            localStorage.removeItem('isLoggedIn');
            this.$router.push({ name: 'Login' }).then(() => {
                window.location.reload();
            });

        },

    },
    computed: {
        isLoggedIn() {
            return this.loggedIn;
        },
    },
    mounted() {
        if (localStorage.getItem("isLoggedIn")) {
            try {
                this.loggedIn = localStorage.getItem("isLoggedIn");
            } catch (e) {
                localStorage.removeItem("isLoggedIn");
            }
        }
        console.log(this.$store.state.isLoggedIn)
        console.log(localStorage.getItem('isLoggedIn'))
        console.log(this.loggedIn);

        let customerId = this.cookies.get("customer_id");
        const customer_id = parseInt(customerId);

        // Display cart items for a customer
        api.get(`/controllers/CartController.php?action=displayCartItems&tableName=myTable&customerId=${customer_id}`, { responseType: 'json' })
            .then((response) => {
                this.shoppingCart = response.data;

                console.warn(response);
                // console.log(this.shoppingCart)
                console.log("customer_id:", customer_id, typeof customer_id);
            });

    },
}
</script>

<style scoped>
/* Shopping cart icon and cart item count container */
/* Shopping cart icon */
.shopping-cart-icon {
    right: 2vw;
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
    height: 85px;
    position: fixed;
    top: 50px !important;
    display: flex;
    justify-content: center;
    align-content: center;
    align-items: center;
    padding-left: 15rem;
    background-color: rgb(241, 241, 241) !important;
    border-bottom: solid 0.1px rgba(211, 211, 211, 0.301);
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
.top-nav-menu-tabs {
    padding: 20px 0 0;
    display: flex;
    align-items: center;
    right: 15rem;
}

/* Navbar link/button styling */
.top-nav-menu-tabs a {
    margin: 10px 0 0 40px;
    text-decoration: none;
    color: black;
    margin-bottom: 20px;
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

.give-btn {
    color: #fff;
}

.give-btn:hover {
    color: var(--primary-color);
    background: #fff;
}
</style>
