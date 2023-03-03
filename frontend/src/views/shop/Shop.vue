<template>
  <v-layout class="px-0 page-container">
    <!-- Search and filter inputs -->
    <v-app-bar class="pt-3 v-app-filter-bar" theme="dark">
      <v-app-bar-nav-icon class="ml-10"><v-icon>mdi-grid-large</v-icon></v-app-bar-nav-icon>
      <v-toolbar-subtitle>Shop All Products</v-toolbar-subtitle>
      <v-spacer></v-spacer>
      <!-- Category search -->
      <v-select class="category-filter mr-4" variant="outlined" hide-details density="compact" v-model="categoryFilter"
        :items="categories" label="Search categories" />
      <!-- Search Bar -->
      <v-text-field class="search-bar mr-0" v-model="search" variant="outlined" hide-details density="compact"
        prepend-inner-icon="mdi-magnify" label="Search" @keydown.esc="clearSearch">
      </v-text-field>
      <!-- Price filter -->
      <v-icon class="filter-icon">mdi-filter</v-icon>
      <select v-model="sortOrder">
        <option value="">
          Sort by</option>
        <option v-for="order in getSortOrders()" :key="order.value" :value="order.value">{{ order.text }}</option>
      </select>
    </v-app-bar>

    <!-- Products display -->
    <v-container id="main" class="mt-16 pt-16 mx-auto" v-if="sortedProducts.length">
      <v-item-group multiple>
        <v-row>
          <v-col v-for="product in sortedProducts" :key="product.id" cols="12" md="2">
            <v-card class="mx-auto rounded-0" max-width="200" variant="none">
              <router-link :to="{ name: 'Product', params: { id: product.id } }">
                <v-img class="product-img-scale" :src="product.image" height="270px" cover aspect-ratio="1/1"></v-img>
              </router-link>
              <v-card-title class="text-subtitle-2 font-weight-bold pa-0">
                {{ product.title }}
              </v-card-title>
              <v-card-subtitle class="pa-0">
                {{ product.category }}
              </v-card-subtitle>
              <v-card-actions class="pa-0 ma-0" style="min-height: 28px !important; height: 28px !important;">
                <v-card-text class="pa-0 text-subtitle-1 font-italic">
                  R{{ product.price }}
                </v-card-text>
                <v-spacer></v-spacer>
                <div class="my-2">
                  <router-link class="text-decoration-none" :to="{ name: 'Product', params: { id: product.id } }">
                    <v-btn size="small" color="surface-variant" variant="text" icon="mdi-heart"></v-btn>
                  </router-link>
                </div>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-item-group>
    </v-container>
    <div v-else>
      No products found.
    </div>
  </v-layout>
</template>

<script>
import api from "@/services/api.js";
import Spinner from "/src/components/Spinner.vue";

export default {
  components: { Spinner },
  data() {
    return {
      products: [],
      search: "",
      categoryFilter: "",
      sortOrder: "",
    };
  },
  mounted() {
    api
      .get("/controllers/ProductController.php?action=displayAllProducts&tableName=myTable", {
        responseType: "json",
      })
      .then((response) => {
        this.products = response.data;
      });

    // event listener for escape key press
    document.addEventListener("keydown", this.clearSearchOnEscape);
  },

  // remove the event listener when the component is destroyed
  beforeDestroy() {
    document.removeEventListener("keydown", this.clearSearchOnEscape);
  },
  computed: {
    // Filter products by search input and category filter
    filteredProducts() {
      return this.products.filter((product) => {
        const matchesSearch =
          product.title.toLowerCase().includes(this.search.toLowerCase()) ||
          product.category.toLowerCase().includes(this.search.toLowerCase());
        const matchesCategory =
          !this.categoryFilter || product.category === this.categoryFilter;
        return matchesSearch && matchesCategory;
      });
    },
    // Sort products by selected sort order
    sortedProducts() {
      if (this.sortOrder === "price-low-to-high") {
        return this.filteredProducts.sort((a, b) => a.price - b.price);
      } else if (this.sortOrder === "price-high-to-low") {
        return this.filteredProducts.sort((a, b) => b.price - a.price);
      } else {
        return this.filteredProducts;
      }
    },
    // List of available categories for filter dropdown
    categories() {
      const categoriesSet = new Set(this.products.map((product) => product.category));
      return ["", ...categoriesSet];
    },

  },
  methods: {
    getSortOrders() {
      return [
        { text: "Price low to high", value: "price-low-to-high" },
        { text: "Price high to low", value: "price-high-to-low" },
      ];
    },
    clearSearchOnEscape(event) {
      if (event.key === "Escape") {
        this.search = "";
      }
    },
  }
};
</script>

<style scoped>
.page-container {
  min-height: 70vh;
}

.v-app-filter-bar {
  position: fixed !important;
  top: 135px !important;
}

.category-filter {
  max-width: 220px;
}

.search-bar {
  max-width: 220px;
}

/* Remove the outline from the select element */
select:focus {
  outline: none;
}

select {
  padding: 13px 35px;
  cursor: pointer;
}

.filter-icon {
  position: relative;
  right: -30px;
}
</style>