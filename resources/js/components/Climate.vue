<template>
        <v-main>
            <v-container>
                <v-row>
                    <v-col
                        width="auto"
                        v-for="(climate, index) in climateData"
                    >
                        <v-card>
                            <v-list-item-content>
                                <div class=" text-center">
                                    <span class="headline">{{ climate.name }}</span>
                                    <h3>Temp: {{ climate.temp }}</h3>
                                    <h3>Humidity: {{ climate.humidity }}%</h3>
                                </div>
                            </v-list-item-content>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
</template>

<script>
    export default {
        data: () => ({
            timer: '',
            climateData: [{"temp":43.60,"name":"Siren","humidity":26.40}]
        }),
        created: function () {
            this.fetchEventsList();
            this.timer = setInterval(this.fetchEventsList, 5000)
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
