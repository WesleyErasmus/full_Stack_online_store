<template>
  <!-- Shop page -->
  <div class="px-0 page-container">
    <!-- Search and filter inputs -->
    <nav class="pt-3 v-app-filter-bar">
      <div id="main" class="filter-nav-inner mx-auto">
        <!-- Search Bar -->
        <div>
          <v-text-field class="search-bar mr-4" v-model="search" variant="outlined" hide-details density="compact"
            prepend-inner-icon="mdi-magnify" label="Search" @keydown.esc="clearSearch">
          </v-text-field>
        </div>
        <!-- Category filter -->
        <div>
          <v-select class="category-filter mr-4" variant="outlined" hide-details density="compact"
            v-model="categoryFilter" :items="categories" label="Search categories" />
        </div>
        <!-- Price filter -->
        <div>
          <v-icon class="filter-icon">mdi-sort-ascending</v-icon>
          <select v-model="sortOrder">
            <option value="">
              Sort by</option>
            <option v-for="order in getSortOrders()" :key="order.value" :value="order.value">{{ order.text }}</option>
          </select>
        </div>
      </div>
    </nav>
    <div class="products-container">
      <!-- Products display -->
      <v-container id="main" class="mt-10 mx-auto" v-if="sortedProducts.length">
        <v-item-group multiple>
          <v-row>
            <!-- Products v-for loop -->
            <v-col v-for="product in sortedProducts" :key="product.id" cols="12" sm="4" md="2" lg="2">
              <v-card class="mx-auto rounded-0" max-width="200" variant="none">
                <!-- Product view link using product id for dynamic routing -->
                <router-link :to="{ name: 'Product', params: { id: product.id } }">
                  <v-img class="product-img-scale" :src="product.image" height="270px" cover aspect-ratio="1/1"></v-img>
                </router-link>
                <!-- Product title -->
                <v-card-title class="text-subtitle-2 font-weight-bold pa-0">
                  {{ product.title }}
                </v-card-title>
                <!-- Product category -->
                <v-card-subtitle class="pa-0">
                  {{ product.category }}
                </v-card-subtitle>
                <v-card-actions class="pa-0 ma-0" style="min-height: 28px !important; height: 28px !important;">
                  <!-- Product price -->
                  <v-card-text class="pa-0 text-subtitle-1 font-italic">
                    R{{ product.price }}
                  </v-card-text>
                  <v-spacer></v-spacer>
                  <div class="my-2">
                    <!-- Link to product view page -->
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
      <!-- No found products message -->
      <div v-else>
        <Spinner />
      </div>
    </div>
  </div>
</template>

<script>
import api from "@/services/api.js";
import Spinner from "/src/components/Spinner.vue";

export default {
  components: { Spinner },
  data() {
    return {
      products: [],
      // Returns list of products that match the customer search term
      search: "",
      // Returns list of products in filtered category
      categoryFilter: "",
      // Displays products in ascending or descending order of product price
      sortOrder: "",
    };
  },
  mounted() {
    // Get products
    api
      .get("/controllers/ProductController.php?action=displayAllProducts&tableName=myTable", {
        responseType: "json",
      })
      .then((response) => {
        this.products = response.data;
      });

    // Event listener to clear search when esc button is pressed
    document.addEventListener("keydown", this.clearSearchOnEscape);
  },

  // Remove the event listener when the component is destroyed
  beforeDestroy() {
    document.removeEventListener("keydown", this.clearSearchOnEscape);

    // This code is ensuring that any existing event listeners are removed when the component is no longer needed to prevent potential memory leaks and unexpected behavior
  },
  computed: {
    // This function returns a filtered array of products based on the search term and category filter
    filteredProducts() {
      // Using filter method on the "products" array to create a new array of products that match the conditions in the code block
      return this.products.filter((product) => {
        //  Declaring a boolean variables called "matchesSearch" to check if the filter term is included in the product's or category
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
        //  No selected sort order, we return the unsorted "filteredProducts" array
        return this.filteredProducts;
      }
    },
    // List of available categories for filter dropdown
    categories() {
      // Creates a new Set containing all the unique categories in the "products" array
      const categoriesSet = new Set(this.products.map((product) => product.category));
      return ["", ...categoriesSet];

      // Code explanation for future reference: 
      /**
       * In the categories() computed property, new Set() is used to create a new Set object. A Set is a built-in object in JavaScript that allows you to store unique values of any type (primitive values or object references) without any duplicates.

        In this code, the products array is being mapped to extract the category property   of each product.

        After the Set is created, a spread syntax is used to convert the Set back into an array, and add an empty string at the beginning to represent the "All Categories" option.
       */
    },

  },
  methods: {
    // Sort from hight to low and low to high
    getSortOrders() {
      return [
        { text: "Price low to high", value: "price-low-to-high" },
        { text: "Price high to low", value: "price-high-to-low" },
      ];
    },
    // Clear search when the escape key is pressed
    clearSearchOnEscape(event) {
      if (event.key === "Escape") {
        this.search = "";
      }
    },
  }
};
</script>

<style scoped>
/* Page container */
.page-container {
  position: relative;
  min-height: 70vh;
}

/* Search bars styling */
.v-app-filter-bar {
  position: fixed;
  background: #fff;
  min-height: 70px;
  width: 100%;
  z-index: 9999;
}

.filter-nav-inner {
  display: flex;
  justify-content: end;
  align-content: end;
  align-items: center;
}
/* Products container */
.products-container {
  margin-top: 100px;
}

.category-filter {
  width: 180px;
}

.search-bar {
  width: 250px;
}

/* Removes the outline from the select element */
select:focus {
  outline: none;
}

select {
  padding: 0px 20px;
  cursor: pointer;
}

.filter-icon {
  position: relative;
}
@media screen and (max-width: 645px) {
  .filter-nav-inner {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
.category-filter {
  width: 40vw;
  margin: 10px 0;
}

.search-bar {
  width: 95vw;
  margin: 10px 0;
}
}
</style>