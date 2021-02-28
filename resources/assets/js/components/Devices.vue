<template>
    <v-container
            fluid
            style="height: 300px"
    >
        <div class="text-center v-application v-application--is-ltr">
            <v-dialog
                    class="v-application v-application--is-ltr"
                    v-model="dialog"
                    hide-overlay
                    persistent
                    width="300"
            >
                <v-card
                        class="v-application v-application--is-ltr"
                        color="primary"
                        dark
                >
                    <v-card-text>
                        Please stand by
                        <v-progress-linear
                                indeterminate
                                color="white"
                                class="mb-0 v-application v-application--is-ltr"
                        ></v-progress-linear>
                    </v-card-text>
                </v-card>
            </v-dialog>
            <v-row justify="center" class="v-application v-application--is-ltr">
                <v-col>
                    <v-btn
                            :disabled="dialog"
                            :loading="dialog"
                            color="purple darken-2"
                            @click="scan()"
                    >
                        Scan for devices
                    </v-btn>
                </v-col>
                <v-col
                        v-for="(device, index) in data"
                        class="v-application v-application--is-ltr"
                >
                    <v-menu
                            class="v-application v-application--is-ltr"
                            bottom
                            width="auto"
                            offset-y
                            :close-on-content-click="closeOnContentClick"
                    >
                        <template v-slot:activator="{ on }">
                            <v-btn
                                    icon
                                    width='90'
                                    height='90'
                                    v-on="on"
                            >
                                <i
                                        v-bind:class="device.icon_class">
                                </i>
                            </v-btn>
                            <span bottom class=" ">{{device.name}}</span>
                        </template>
                        <v-card>
                            <v-list-item-content class="justify-center">
                                <div class=" text-center">
                                    <span class=" headline">{{ device.name }}</span>
                                    <h3>{{ device.userName }}</h3>
                                    <p class="caption mt-1">
                                        {{ device.userEmail }}
                                    </p>
                                    <v-divider class="my-3"></v-divider>
                                    <v-btn
                                            depressed
                                            rounded
                                            text
                                    >
                                        Edit home
                                    </v-btn>
                                </div>
                            </v-list-item-content>
                        </v-card>
                    </v-menu>
                </v-col>
            </v-row>
            <v-dialog
                    v-model="dialog2"
                    max-width="600px"
                    max-height="600px"
            >
                <v-card class="v-application v-application--is-ltr">
                    <v-card-title>
                        Local Devices
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col
                                    v-for="(device, index) in localDevices"
                                    v-if="device.name"
                            >
                                <v-menu
                                        class="v-application v-application--is-ltr"
                                        bottom
                                        offset-y
                                        max-width="10%"
                                        :close-on-content-click="closeOnContentClick"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                                icon
                                                width='90'
                                                height='90'
                                                v-on="on"
                                        >
                                            <i
                                                    v-bind:class="device.icon_class">
                                            </i>
                                        </v-btn>
                                        <span bottom>{{device.name}}</span>
                                    </template>
                                    <v-card>
                                        <v-list-item-content class="justify-center">
                                            <div class="text-center v-application v-application--is-ltr">
                                                <v-form
                                                        id="nativeForm"
                                                        ref="form"
                                                        v-model="valid"
                                                        lazy-validation
                                                >
                                                    <input type="hidden" name="_token" :value="csrf">
                                                    <v-select
                                                            :rules="[v => !!v || 'Home is required']"
                                                            label="Homes"
                                                            name="homes"
                                                            required
                                                            v-model="homeFromSelect"
                                                            :items="homes"
                                                            item-value="id"
                                                            item-text="name"
                                                    >
                                                    </v-select>
                                                    <v-select
                                                            v-model="roomFromSelect"
                                                            :rules="[v => !!v || 'Room is required']"
                                                            label="Rooms"
                                                            name="rooms"
                                                            :items="setRooms"
                                                            item-value="id"
                                                            item-text="name"
                                                            required
                                                    ></v-select>
                                                    <v-btn
                                                            :disabled="!valid"
                                                            @click="addDevice(device)"
                                                            depressed
                                                            rounded
                                                            text
                                                    >
                                                        Add device
                                                    </v-btn>
                                                </v-form>
                                            </div>
                                        </v-list-item-content>
                                    </v-card>
                                </v-menu>
                            </v-col>
                            <v-col v-else>
                                <span class="headline">{{ device.message }}</span>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn
                                color="primary"
                                text
                                @click="dialog2 = false"
                        >
                            Close
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </div>
    </v-container>
</template>
<style>
    i {
        font-size: 80px;
    }

    span {
        padding-left: 10px;
        padding-right: 10px;
        font-size: 13px;
    }

    .v-select {
        padding-left: 10px;
        padding-right: 10px;
    }
</style>
<?php

?>
<script>

    export default {
        name: 'HomeComponent',
        props: {
            data: {
                type: Array,
                required: true
            },
            homes: {
                type: Array,
                required: true
            },
            rooms: {
                type: Object,
                required: true
            },
            homeId: {
                type: Number,
            }
        },

        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

            dialog: false,
            dialog2: false,
            localDevices: '',
            closeOnContentClick: false,
            valid: true,
            homeFromSelect: null,
            homesArray: [
                'country',
                'flat',
            ],
            roomFromSelect: null,
            roomsArray: [
                'country',
                'flat',
            ],
        }),
        computed:
            {
                setRooms: function () {
                    if(this.homeFromSelect){
                        var roomsForSelect = this.rooms[this.homeFromSelect]
                        if (roomsForSelect.length){
                            return roomsForSelect
                        }
                        return ['No rooms in your house']
                    }
                    return ['Choose home first']
                },
                setOptions: function () {
                    if (this.selectbox1 === 'food') {
                        var options = [{val: 'pizza', text: 'Pizza'},
                            {val: 'lasagna', text: 'Lasagna'},
                            {val: 'salad', text: 'Salad'}]
                    } else if (this.selectbox1 === 'drink') {
                        var options = [{val: 'beer', text: 'Beer'},
                            {val: 'wine', text: 'Wine'},
                            {val: 'coke', text: 'Coke'},
                            {val: 'water', text: 'Water'}]
                    } else if (this.selectbox1 === 'desert') {
                        var options = [{val: 'tiramisu', text: 'Tiramisu'},
                            {val: 'icecream', text: 'Icecream'},
                            {val: 'espresso', text: 'Espresso'}]
                    }
                    return options
                }
            }
        ,
        methods: {
            scan() {
                this.dialog = true
                axios
                    .get('http://127.0.0.1:8000/scan/' + this.homeId)
                    .then(response => (this.localDevices = response.data), this.dialog = false, this.dialog2 = true)
            },
            addDevice(device){
                const options = {
                    headers: {'X-CSRF-TOKEN': this.csrf}
                };
                    axios.post('devices/deviceCreate', {
                        ip: device.ip,
                        name: device.name,
                        icon_class: device.icon_class,
                        room: this.roomFromSelect,
                        home: this.homeFromSelect,
                    },options).then(response => {document.location.reload()})
            }
        }
        ,
    }
</script>