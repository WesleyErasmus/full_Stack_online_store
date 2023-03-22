<template>
    <div class="mission-page-container">
        <!-- Mission statement container -->
        <v-container class="my-5 mb-10 text-center">
            <!-- Component heading -->
            <div class="text-h5 ">
                About us
            </div>
        </v-container>

        <!-- Timeline for, mission | vision | about-us -->
        <v-timeline direction="horizontal">
            <!-- Vision -->
            <v-timeline-item dot-color="green-darken-2">
                <template v-slot:opposite>
                    <v-icon size="54" color="green-darken-2">mdi-earth</v-icon>
                </template>
                <div>
                    <div class="text-h6 text-green-darken-2 font-weight-bold">Our Vision</div>
                    <p>
                        Our vision is to be the leading provider of sustainable and innovative fashion solutions,
                        inspiring customers to embrace
                        a more conscious and ethical lifestyle while looking and feeling their best.
                    </p>
                </div>
            </v-timeline-item>
            <!-- Mission -->
            <v-timeline-item dot-color="info">
                <template v-slot:opposite>
                    <v-icon color="info" size="54">mdi-charity</v-icon>
                </template>
                <div>
                    <div class="text-h6 text-info font-weight-bold">Our Mission</div>
                    <p>
                        At Atlas, we strive to make fashion accessible and affordable for everyone. We are committed to
                        offering high-quality clothing that reflects individuality and personal style. Our mission is to
                        empower our customers to express themselves through fashion and feel confident in their own
                        skin.
                    </p>
                </div>
            </v-timeline-item>
            <!-- Who we are -->
            <v-timeline-item dot-color="indigo">
                <template v-slot:opposite>
                    <v-icon size="54" color="indigo">mdi-account-group</v-icon>
                </template>
                <div>
                    <div class="text-h6 text-indigo font-weight-bold">Who We Are</div>
                    <p>
                        Atlas is an online fashion clothing company that offers stylish and affordable clothing for men
                        and women. We aim to provide a seamless shopping experience that caters to different styles and
                        preferences.
                    </p>
                </div>
            </v-timeline-item>
        </v-timeline>
    </div>
</template>

<style scoped>
.mission-page-container {
    padding-bottom: 7rem;
}
</style>