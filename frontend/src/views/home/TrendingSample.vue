<template>
  <!-- Featured Products Component -->

  <!-- Featured products container -->
  <div class="featured-products-container row">
    <h1>Trending Collection</h1>

    <!-- See all link that routes to featured products page -->
    <span>
      <RouterLink :to="{ name: 'FeaturedProducts' }" class="see-all">
        see all</RouterLink>
    </span>

    <!-- Product cards container -->
    <div class="card-group">    
      
      <!-- V-for loop -->
      <div v-for="featured in products" :key="featured.id" class="card">

        <!-- Routing to the Product gallery page -->
        <router-link :to="{ name: 'Product', params: { id: featured.id } }">
          <div class="img-box">
            <img :src="
              'https://source.unsplash.com/random/?fashion/id' + featured.id
            " alt="Just Dropped" class="card-img-top" />
          </div>
        </router-link>

        <div class="card-body"></div>
        <div class="card-footer">
          <small class="text-muted">#Featured</small>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      products: [],
    };
  },
  mounted() {
    axios
      .get("https://api.escuelajs.co/api/v1/products?offset=0&limit=5")
      .then((response) => {
        this.products = response.data;
        console.warn(response);
      });
  },
};
</script>

<style scoped>

/* Default link override */
.green {
  text-decoration: none;
  color: #000 !important;
  transition: 0.4s;
}

/* Link Hover color */
@media (hover: hover) {
  a:hover {
    color: #000;
  }
}


/* See all button */
.see-all {
  color: var(--primary-color) !important;
}


/* Feature products cards container */
.featured-products-container {
  padding: 5rem 0;
}


/* MEDIA QUERIES */
@media screen and (min-width: 481px) and (max-width: 661px) {

  .card-group {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    align-content: center;
    align-items: center;
  }

  .card {
    width: 45%;

  }
}


@media screen and (min-width: 0) and (max-width: 480px) {
  .card-group {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    align-content: center;
    align-items: center;
  }

  .card {
    width: 40%;

  }
}
</style>