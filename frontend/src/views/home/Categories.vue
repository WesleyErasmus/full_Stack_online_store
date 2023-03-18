<template>
    <!-- Categories component -->
    <v-layout class="mt-15">
        <v-app-bar color="transparent" class="elevation-0" theme="light">
            <template v-slot:prepend>
                <v-app-bar-nav-icon>
                    <v-btn size="small" variant="tonal" class="mr-5" icon color="primary">
                        <v-icon>mdi-grid-large</v-icon>
                    </v-btn>
                </v-app-bar-nav-icon>
                <!-- Component heading -->
                <v-app-bar-title class="">
                    Shop categories
                </v-app-bar-title>
            </template>
            <template v-slot:append>
            </template>
        </v-app-bar>
        <v-main>
            <!-- Category cards -->
            <v-card max-width="" class="mx-auto" variant="none">
                <v-container class="pa-1">
                    <v-item-group multiple>
                        <v-row>
                            <!-- V for loop -->
                            <v-col v-for="(item, i) in items" :key="i" cols="12" md="3">
                                <v-item>
                                    <!-- Images -->
                                    <v-img :src="item.src" cover height="250" class="text-right pa-2" @click="toggle">
                                        <v-card-body
                                            class="d-flex flex-column fill-height justify-center align-center text-white">
                                            <!-- Card button -->
                                            <v-btn class="ms-2" variant="outlined" color="secondary" size="small">
                                                <span class="text-white">
                                                    {{ item.title }}
                                                </span>
                                            </v-btn>
                                        </v-card-body>
                                    </v-img>
                                </v-item>
                            </v-col>
                        </v-row>
                    </v-item-group>
                </v-container>
            </v-card>
        </v-main>
    </v-layout>
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
                src: 'https://images.unsplash.com/photo-1654894887475-765708cf11a7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=708&q=80',
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