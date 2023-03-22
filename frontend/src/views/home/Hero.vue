<template>
    <!-- Home page hero component -->
    <div>
        <!-- Link to featured products -->
        <RouterLink class="text-decoration-none" :to="{ name: 'FeaturedProducts' }">
            <v-parallax class="mt-6"
                src="https://images.unsplash.com/photo-1507553532144-b9df5e38c8d1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1213&q=80"
                height="51vh">
                <!-- Image content -->
                <div class="d-flex flex-column fill-height justify-center align-center text-white">
                    <img class="logo-image" src="../../assets/logofull.png" alt="Logo">
                    <h2>
                        Just Be Yourself.
                    </h2>
                </div>
            </v-parallax>
        </RouterLink>
    </div>
</template>

<style scoped>
/* Logo sizing */
.logo-image {
    width: 130px;
}
</style>