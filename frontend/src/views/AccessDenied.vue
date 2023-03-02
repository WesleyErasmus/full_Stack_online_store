<template>
    <div class="mt-5">
        <v-container fluid>
            <v-row align="center" justify="center">
                <v-col class="text-center" cols="12">
                    <h1>Access Denied</h1>
                    <h3 class="sub-heading">You're not authorized to access this page</h3>
                    <p class="body-1 text-medium-emphasis">Looks like you've taken a wrong turn. Either you aren't logged in or you don't have
                        the proper permissions to access this page.</p>
                    <p class="body-1 text-medium-emphasis">Don't worry, we won't judge you. Even the best of us get lost sometimes.</p>
                   <v-card-actions class="mt-4">
                    <v-spacer></v-spacer>
                    <v-btn color="primary" variant="outlined" to="/login">Login</v-btn>
                    <v-btn color="primary" to="/signup">Signup</v-btn>
                    <v-spacer></v-spacer>
                    </v-card-actions>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
    name: 'AccessDenied',
}
</script>

<style scoped>
.sub-heading {
    color: #7b7b7b;
    margin-bottom: 2rem;
}

</style>