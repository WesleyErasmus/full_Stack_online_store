<template>
    <!-- Back to top button -->
    <div class="back-to-top-btn">
        <v-btn @click="smoothScrollToTop" icon color="grey" variant="elevated" size="small" v-show="showButton">
            <v-icon size="37px" class="font-weight-thin">mdi-chevron-up</v-icon>
        </v-btn>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showButton: false,
        };
    },
    methods: {
        // Display back to top button
        handleScroll() {
            const position = window.pageYOffset;
            if (position > 300) {
                this.showButton = true;
            } else {
                this.showButton = false;
            }
        },
        // Back to top function
        smoothScrollToTop() {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: "smooth",
            });
        },
    },
    mounted() {
        // Event listener to display back to top button after scrolling down
        window.addEventListener("scroll", this.handleScroll);
    },
};
</script>
<style scoped>
.back-to-top-btn {
    position: fixed;
    right: 40px;
    bottom: 10%;
    z-index: 999;
}
</style>