<template>
  <v-container
    fluid
    style="height: 300px"
  >
    <v-row justify="center">
    <v-col>
    <v-btn
        class="mx-2"
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
            method="post" v-bind:action="'roomCreate/' + homeId" id="nativeForm"
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
              v-model="types"
              :items="types"
              :rules="[v => !!v || 'Type is required']"
              label="Type"
              :value="types"
              name="type"
              required
            ></v-select>

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
              class="mr-4"
              @click="reset"
            >
              Reset Form
            </v-btn>
            <v-btn
                        class="white--text"
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
        v-for="(room, index) in data"
    >
      <v-menu
        bottom
        width="auto"
        offset-y
      >
        <template v-slot:activator="{ on }">
           <v-btn
                icon
                width = '90'
                height = '90'
                v-on="on"
           >
           <i
                v-for="(value, name) in roomsImages"
                v-if="name === room.type"
                v-bind:class="value">
           </i>
          </v-btn>
              <span bottom class="white--text">{{ room.name }}</span>
        </template>
        <v-card>
          <v-list-item-content class="justify-center">
            <div class=" text-center">
                <span class="white--text headline">{{ room.type }}</span>
              <v-divider class="my-3"></v-divider>
              <v-btn
                depressed
                rounded
                text
              >
                Go inside
              </v-btn>
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
  </v-container>
</template>
<style>
i {
font-size: 80px;
}
span.white--text {
padding-left: 10px;
padding-right: 10px
}
</style>

<script>
    export default {
        name: 'HomeComponent',
        props: ['data','homeId'],
        data: () => ({
              csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              valid: true,
              name: '',
              roomType: '',
              nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 10) || 'Name must be less than 10 characters',
              ],
              types: null,
              types: [
                'BedRoom',
                            'BathRoom',
                            'LivingRoom',
                            'Study',
                            'Kitchen',
                            'DiningRoom',
                            'Hall',
                            'Corridor',
                            'Attic',
                            'Garage',
                            'Yard',
              ],
              overlay: false,
              zIndex: 0,
              roomsImages:{
                    BathRoom: 'fas fa-bath',
                    BedRoom: 'fas fa-bed',
                    LivingRoom: 'fas fa-couch',
                    Study: 'fas fa-briefcase' ,
                    Kitchen: 'fas fa-utensils' ,
                     DiningRoom: 'fas fa-utensils' ,
                     Hall: 'fas fa-tv' ,
                     Corridor: 'fas fa-chair' ,
                    Attic: 'fas fa-angle-up' ,
                     Garage: 'fas fa-warehouse' ,
                     Yard: 'fas fa-tree' ,
                }
            }),
        methods: {
              validate () {
                this.$refs.form.validate()
              },
              reset () {
                this.$refs.form.reset()
              },
              submit() {
                nativeForm.submit()
              },
            },
            computed: {
              iconClass: function () {
                switch (this.roomType) {
                  case 'BathRoom': return 'fas fa-bath'
                  case 'BedRoom': return 'fas fa-bed'
                  case 'LivingRoom': return 'fas fa-couch'
                }
              }
            }
    }
</script>