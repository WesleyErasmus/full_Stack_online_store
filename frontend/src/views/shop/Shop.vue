<template>

<!-- Shopping page -->

  <div id="main" class="shop-page">
    <!-- Page header -->
    <h1>Shop Our Whole Collection</h1>

    <!-- V-if to show spinner component while products load -->
    <div v-if="products.length" class="container">
      <div class="row">
        
        <!-- V-for loop -->
        <div
          class="card col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6 mb-4 mt-4"
          v-for="product in products"
          :key="product.id"
        >
        <!-- Router link to Product gallery page -->
          <router-link :to="{ name: 'Product', params: { id: product.id } }">
            <div class="img-box">
              <img
                :src="
                  'https://source.unsplash.com/random/?fashion/id' + product.id
                "
                class="card-img-top"
                alt="Product Image"
              />
            </div>
          </router-link>


          <div class="card-body">
            <h6 class="card-title">{{ product.title }}</h6>
            <p class="card-text">
              {{ product.category.name }}
            </p>
          </div>
          <div class="card-footer">
            <p class="price">R{{ product.price }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- V-else spinner -->
    <div v-else>
      <Spinner />
    </div>
  </div>
</template>

<script>
import api from "@/services/api.js";
// Components import
import Spinner from "/src/components/Spinner.vue";
export default {
  components: { Spinner },
  data() {
    return {
      products: [],
    };
  },
  mounted() {
    api.get("/display_products.php?action=selectAll&tableName=myTable", { responseType: 'json' }).then((response) => {
      this.products = response.data;
      console.warn(response);
    });
  },
};
</script>
<style scoped>
.shop-page h1 {
  margin-bottom: 3rem;
}
</style>
