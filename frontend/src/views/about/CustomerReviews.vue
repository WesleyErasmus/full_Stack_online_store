<template>
    <v-container class="my-10">
        <div class="text-center">
            <h1 class="text-center font-emphasis-high mb-5">Customer Reviews</h1>
        </div>
        <v-row>
            <v-col v-for="review in reviews" :key="review.id" cols="12" sm="6" md="4">
                <v-card color="white" variant="elevated" class="mx-auto" max-width="500">
                    <v-card-title>
                        {{ review.title }}
                    </v-card-title>
                    <v-card-text>
                        <div class="d-flex align-center mb-3">
                            <v-icon v-for="(n, i) in review.rating" :key="i" class="mr-1" color="primary">
                                {{ n <= 0 ? 'mdi-star-outline' : 'mdi-star' }} </v-icon>
                        </div>
                        <p class="text-body-2">{{ review.content }}</p>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            reviews: [
                {
                    id: 1,
                    title: "Great Quality Products",
                    rating: 4,
                    content:
                        "I purchased several items from this store and I am extremely happy with the quality of the products. The colors are vibrant and the fabrics are soft and comfortable to wear. Highly recommend!",
                },
                {
                    id: 2,
                    title: "Fantastic Customer Service",
                    rating: 5,
                    content:
                        "The customer service at this store is absolutely fantastic. I had a small issue with my order and they went above and beyond to resolve it quickly and efficiently. Will definitely be a repeat customer!",
                },
                {
                    id: 3,
                    title: "Beautiful and Unique Pieces",
                    rating: 4,
                    content:
                        "I love the unique pieces offered at this store. They have a great selection of items that you won't find anywhere else. Make sure to check the size charts before ordering. Happy shopping!",
                },
                {
                    id: 4,
                    title: "Quick Shipping and Delivery",
                    rating: 5,
                    content:
                        "I was pleasantly surprised at how quickly my order arrived. The shipping and delivery process was seamless and hassle-free. Plus, the products were just as described on the website.",
                },
                {
                    id: 5,
                    title: "Love Everything About This Store",
                    rating: 5,
                    content:
                        "I can't say enough good things about this store. From the quality of the products to the customer service, everything is top-notch. I especially love the eco-friendly and sustainable options!",
                },
                {
                    id: 6,
                    title: "Unique and Affordable Finds",
                    rating: 4,
                    content:
                        "I always find the most unique and affordable pieces at this store. It's my go to place when i need a few new outfits. The value for money is unbeatable. I recommend this store to everyone.",
                }
            ],

        }
    }
}

</script>

<style scoped>
.v-card {
    background-color: #f7f7f7;
}
</style>