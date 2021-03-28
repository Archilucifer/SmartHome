<template>
    <v-app id="inspire">
        <v-main>
            <v-container>
                <v-row>
                <v-col cols="2">
                    <v-btn
                        fab
                        dark
                        color="indigo"
                        @click="overlay = !overlay"
                    >
                        <v-icon>
                            mdi-plus
                        </v-icon>
                    </v-btn>
                    <v-overlay
                        :z-index="zIndex"
                        :value="overlay"
                    >
                        <template>
                            <v-form
                                method="post" action="/homeCreate" id="nativeForm"
                                ref="form"
                                v-model="valid"
                                lazy-validation
                            >
                                <input type="hidden" name="_token" :value="csrf">
                                <v-text-field
                                    v-model="name"
                                    :counter="10"
                                    :rules="nameRules"
                                    label="Name"
                                    :value="name"
                                    name="name"
                                    required
                                ></v-text-field>

                                <v-select
                                    v-model="types_var"
                                    :items="types"
                                    :rules="[v => !!v || 'Type is required']"
                                    label="Type"
                                    :value="types_var"
                                    name="type"
                                    required
                                    append-icon=false
                                ></v-select>

                                <v-checkbox
                                    v-model="checkbox"
                                    label=" Main home ?"
                                    :value="checkbox"
                                    name="isMain"
                                    required
                                    on-icon="fas fa-check-square"
                                    off-icon="far fa-square"
                                ></v-checkbox>

                                <v-btn
                                    :disabled="!valid"
                                    color="green"
                                    class="mr-4 home-create"
                                    @click="validate"
                                    type="submit"
                                >
                                    Create
                                </v-btn>

                                <v-btn
                                    color="error"
                                    @click="reset"
                                >
                                    Reset Form
                                </v-btn>
                                <v-btn
                                    color="teal"
                                    @click="overlay = false"
                                >
                                    Close
                                </v-btn>
                            </v-form>
                        </template>
                    </v-overlay>
                </v-col>
                    <v-col
                        cols="2"
                        v-for="(home, index) in data"
                    >
                        <v-menu
                            bottom
                            width="auto"
                            offset-y
                        >
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    icon
                                    width='90'
                                    height='90'
                                    v-on="on"
                                >
                                    <i class="fas fa-home"></i>
                                </v-btn>
                                <span bottom>{{ home.name }}</span>
                            </template>
                            <v-card>
                                <v-list-item-content>
                                    <div class=" text-center">
                                        <span class="headline">{{ home.name }}</span>
                                        <h3>{{ home.userName }}</h3>
                                        <p class="caption mt-1">
                                            {{ home.userEmail }}
                                        </p>
                                        <v-btn
                                            depressed
                                            rounded
                                            text
                                            :href="'rooms/' + home.id"
                                        >
                                            Go inside
                                        </v-btn>
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
            </v-container>
        </v-main>
    </v-app>
</template>

<style>
    i {
        font-size: 80px;
    }
</style>

<script>
    export default {
        name: 'HomeComponent',
        props: ['data'],
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            valid: true,
            name: '',
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 10) || 'Name must be less than 10 characters',
            ],
            types_var: null,
            types: [
                'country',
                'flat',
            ],
            checkbox: false,
            overlay: false,
            zIndex: 0,
        }),
        methods: {
            validate() {
                this.$refs.form.validate()
            },
            reset() {
                this.$refs.form.reset()
            },
            submit() {
                nativeForm.submit()
            },
        }
    }
</script>
