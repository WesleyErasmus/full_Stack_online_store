<template>
    <v-layout>
        <v-app-bar class="elevation-0" theme="dark" density="compact">
            <v-app-bar-title class="text-center">
                Meet the Team
            </v-app-bar-title>
        </v-app-bar>
        <v-main>
            <div>
                <v-row class="d-flex justify-center align-center">
                    <v-col cols="12" md="2" v-for="member in team" :key="member.id">
                        <div>
                            <v-hover v-slot="{ isHovering, props }">
                                <v-card class="mx-auto text-center rounded-0" color="grey-lighten-4" max-width="600" v-bind="props">
                                    <v-img aspect-ratio="1/1" cover :src="member.portrait">
                                        <v-expand-transition>
                                            <div v-if="isHovering"
                                                class="d-flex transition-fast-in-fast-out bg-black v-card--reveal px-3"
                                                style="height: 100%;">
                                                <div class="text-h6 ma-0 pa-0">{{ member.name }}</div>
                                                <div class="text-overline text-decoration-underline ma-0 pa-0">{{
                                                    member.job_title }}
                                                </div>
                                                <div class="text-caption ma-0 pa-0">{{ member.bio }}</div>
                                            </div>
                                        </v-expand-transition>
                                    </v-img>
                                </v-card>
                            </v-hover>
                        </div>
                    </v-col>
                </v-row>
            </div>
        </v-main>
    </v-layout>

</template>

<script>
export default {
    data() {
        return {
            // Array containing team member info
            "team": [
                {
                    "id": "1",
                    "name": "Carson Olsen",
                    "portrait": "https://images.unsplash.com/photo-1629425733761-caae3b5f2e50?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
                    "job_title": "Designer",
                    "bio": "The leather jacked showed the scars of being his favorite for years. It wore those scars with pride, feeling that they enhanced his presence rather than diminishing it."
                },
                {
                    "id": "2",
                    "name": "Mairead Ferrell",
                    "portrait": "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=688&q=80",
                    "job_title": "Administrator",
                    "bio": "There was no time. He ran out of the door without half the stuff he needed for work, but it didn't matter. He was late and if he didn't make this meeting on time."
                },
                {
                    "id": "3",
                    "name": "Rudra Connolly",
                    "portrait": "https://images.unsplash.com/photo-1573496358961-3c82861ab8f4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=688&q=80",
                    "job_title": "Editor",
                    "bio": "What was beyond the bend in the stream was unknown. Both were curious, but only one was brave enough to want to explore. That was the problem. There was always one that let fear rule her life."
                },
                {
                    "id": "4",
                    "name": "Izzy Salas",
                    "portrait": "https://images.unsplash.com/photo-1543132220-3ec99c6094dc?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
                    "job_title": "Sales",
                    "bio": "t was just a burger. Why couldn't she understand that? She knew he'd completely changed his life around her eating habits, so why couldn't she give him a break this one time? She wasn't even supposed to have found out."
                },
                {
                    "id": "5",
                    "name": "Ben Slade",
                    "portrait": "https://images.unsplash.com/photo-1590086782957-93c06ef21604?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
                    "job_title": "IT Support",
                    "bio": "Why do Americans have so many different types of towels? We have beach towels, hand towels, bath towels, dish towels, camping towels, quick-dry towels, and let’s not forget paper towels."
                },
                {
                    "id": "6",
                    "name": "Justine Estrada",
                    "portrait": "https://images.unsplash.com/photo-1573497161161-c3e73707e25c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1yZWxhdGVkfDJ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60",
                    "job_title": "HR Manager",
                    "bio": "The red line moved across the page. With each millimeter it advanced forward, something changed in the room. The actual change taking place was difficult to perceive, but the change was real."
                }
            ],
        }
    },

}
</script>

<style scoped>
.v-card--reveal {
    align-items: center;
    justify-content: center;
    flex-direction: column;
    bottom: 0;
    opacity: .8;
    position: absolute;
    width: 100%;
}
</style>