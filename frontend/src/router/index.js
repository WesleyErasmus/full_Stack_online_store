// Routing history
import { createRouter, createWebHistory } from 'vue-router'


// Pages and component imports
import Home from '../views/home/Home.vue'
import Shop from '../views/shop/Shop.vue'
import Product from "../views/shop/Product.vue";
import Cart from "../views/shop/Cart.vue";
import About from "../views/about/About.vue";
import Contact from "../views/contact/Contact.vue";
import FeaturedProducts from "../views/Shop/FeaturedProducts.vue";
import NewProducts from "../views/Shop/NewProducts.vue";
import NotFound from "../views/NotFound.vue";
import AccessDenied from "../views/AccessDenied.vue";
import Login from "../views/signIn/Login.vue";
import SignUp from "../views/signIn/SignUp.vue";
import Profile from "../views/profile/CustomerProfilePage.vue";


// Array for routing directories
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "Home",
      component: Home,
    },
    {
      path: "/featured",
      name: "FeaturedProducts",
      component: FeaturedProducts,
    },
    {
      path: "/shop",
      name: "Shop",
      component: Shop,
    },
    {
      path: "/shop/:id",
      name: "Product",
      component: Product,
      props: true,
    },
    {
      path: "/cart",
      name: "Cart",
      component: Cart,
    },
    {
      path: "/about",
      name: "About",
      component: About,
    },
    {
      path: "/contact",
      name: "Contact",
      component: Contact,
    },
    {
      path: "/newproducts",
      name: "NewProducts",
      component: NewProducts,
    },
    // Sends a 404 message to pages that can't be found
    {
      path: "/:catchAll(.*)",
      name: "NotFound",
      component: NotFound,
    },
    {
      path: "/access-denied",
      name: "AccessDenied",
      component: AccessDenied,
    },
    {
      path: "/login",
      name: "Login",
      component: Login,
      // Defining metadata to login page so that it is only accesable to users that are not logged in. In the mounted lifecycle hook there is a check to see if the user is logged in
      meta: {
        requiresGuest: true,
      },
    },
    {
      path: "/sign-up",
      name: "SignUp",
      component: SignUp,
      meta: {
        requiresGuest: true,
      },
    },
    {
      path: "/profile",
      name: "Profile",
      component: Profile,
      // Defining metadata to profile page so that it is only accesable to users that are not logged in. In the mounted lifecycle hook there is a check to see if the user is logged in
      meta: {
        requiresGuest: true,
      },
    },
  ],
  scrollBehavior(to, from, savedPosition) {
    return { top: 0 };
  },
});

export default router
