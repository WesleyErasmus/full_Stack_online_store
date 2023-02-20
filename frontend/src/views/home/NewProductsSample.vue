<template>
  <!-- New Products Componente -->

  <!-- New products container -->
  <div class="new-products-container row">

    <!-- Component header -->
    <h1>New Collection</h1>
    <span>

<!-- See all link that routes to the new products page -->
      <RouterLink :to="{ name: 'NewProducts' }" class="see-all">
        see all</RouterLink>
    </span>

    <!-- New products card container -->
    <div class="card-group">
     
     <!-- V-for loop -->
      <div v-for="newin in products" :key="newin.id" class="card">
     
     <!-- Routing to the Product gallery page -->
        <router-link :to="{ name: 'Product', params: { id: newin.id } }">
          <div class="img-box">
            <img :src="'https://source.unsplash.com/random/?fashion/' + newin.id" alt="Just Dropped"
              class="card-img-top" />
          </div>
        </router-link>

        <div class="card-body"></div>
        <div class="card-footer">
          <small class="text-muted">#JustDropped</small>
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
}
</script>

<style scoped>

/* Link colors [used to override universal links colors] */
a,
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

/* Feature and new products cards */
.see-all {
  color: var(--primary-color) !important;
}


/* Card container */
.new-products-container {
  padding: 5rem 0;
}


/* Product cards */
.card {
  padding: var(--card-padding);
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
