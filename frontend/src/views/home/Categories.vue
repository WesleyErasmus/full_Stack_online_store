<template>
    <v-container>
        <h1 class="">Categories</h1>
        <v-card max-width="" class="mx-auto" variant="none">
            <v-container class="pa-1">
                <v-item-group multiple>
                    <v-row>
                        <v-col v-for="(item, i) in items" :key="i" cols="12" md="3">
                            <v-item>
                                <v-img :src="item.src" cover height="250" class="text-right pa-2" @click="toggle">
                                    <v-btn class="text-white" variant="text">{{ item.title }}</v-btn>
                                </v-img>
                            </v-item>
                        </v-col>
                    </v-row>
                </v-item-group>
            </v-container>
        </v-card>
    </v-container>
</template>

<script>
export default {
    data: () => ({
        items: [
            {
                src: 'https://images.unsplash.com/photo-1545194828-a1cf868f1b2b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80',
                title: 'Shirts',
            },
            {
                src: 'https://images.unsplash.com/photo-1535530705774-695729778c55?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80',
                title: 'Pants',
            },
            {
                src: 'https://images.unsplash.com/photo-1536640387894-cbc452a79a86?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=730&q=80',
                title: 'Shoes',
            },
            {
                src: 'https://images.unsplash.com/photo-1588117260148-b47818741c74?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80',
                title: 'Accessories',
            },
        ],

    }),
}
</script>

<style></style>