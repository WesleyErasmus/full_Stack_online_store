<template>
    <div class="mt-15">
        <v-card class="mb-10 text-center elevated-0" color="black" variant="elevated">
                <v-card-title class="text-center text-">
                    About us</v-card-title>
        </v-card>
        <v-timeline direction="horizontal">
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

