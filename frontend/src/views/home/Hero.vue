<template>
    <div>
        <!-- Home page Image Banner -->
        <RouterLink :to="{ name: 'FeaturedProducts' }">
                <v-img alt="Image Banner" class="img-banner bg-grey-lighten-2"
                aspect-ratio="1" cover
                    src="https://images.unsplash.com/photo-1508427953056-b00b8d78ebf5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"></v-img>
        </RouterLink>

    </div>
</template>

<style scoped>
/* Home page top banner img */
.img-banner {
    margin-top: 1rem;
    height: 42vh;
    /* width: 90vw; */
}
</style>