<template>
    <v-app id="inspire">
        <v-main>
            <v-container>
                <v-row>
                    <v-col
                        cols="2"
                        v-for="(climate, index) in climateData"
                    >
                        <v-card>
                            <v-list-item-content>
                                <div class=" text-center">
                                    <span class="headline">{{ climateData }}</span>
                                    <span class="headline">adafgag</span>
                                    <h3>{{ climate.temp }}</h3>
                                    <p class="caption mt-1">
                                        {{ climate.humidity }}
                                    </p>
                                </div>
                            </v-list-item-content>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
    export default {
        data: () => ({
            timer: '',
            climateData: [{"temp":43.60,"name":"Siren","humidity":26.40}]
        }),
        created: function () {
            this.fetchEventsList();
            this.timer = setInterval(this.fetchEventsList, 500)
        },
        methods: {
            fetchEventsList: function () {
                axios
                    .post('/getFormatedClimateData')
                    .then(response => (this.climateData = response.data))
            },
            cancelAutoUpdate: function () {
                clearInterval(this.timer)
            }
        },
        beforeDestroy() {
            clearInterval(this.timer)
        }
    }
</script>

<style scoped>

</style>
