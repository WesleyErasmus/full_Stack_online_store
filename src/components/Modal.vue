<template>
  <!-- ================================================================================== -->

  <!-- This modal is used to display Zoomed product images in the product image look-book -->

  <!-- ================================================================================== -->


  <!-- Grey background on modal display -->
  <div class="backdrop" @click.self="closeModal">
    <!-- Close modal if click on backdrop click event -->

    <!-- Modal container -->
      <div class="product-modal">

    <!-- Modal close X btn -->
      <div class="actions">
        <slot name="links"></slot>
      </div>

      <!-- Message that will display if slot is not passed in -->
      <slot>Content not found</slot>
    </div>
  </div>
</template>


<script>
export default {
  methods: {
    // Close modal function
    closeModal() {
      this.$emit("close");
    },
  },
};
</script>

<style>
/* Modal styling */
.product-modal {
  display: block !important;
  width: 50vw;
  height: auto;
  padding: var(--card-padding);
  margin: 0 auto;
  border-radius: 5px;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%);
}


/* Modal backdrop styling */
.backdrop {
  z-index: 9999;
  top: 0;
  position: fixed;
  background: rgba(0, 0, 0, 0.5);
  width: 100%;
  height: 100%;
}


/* Modal close btn styling */
.product-modal .actions {
  float: right;
}
</style>
