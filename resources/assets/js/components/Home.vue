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
              v-model="types"
              :items="types"
              :rules="[v => !!v || 'Type is required']"
              label="Type"
              :value="types"
              name="type"
              required
            ></v-select>

            <v-checkbox
              v-model="checkbox"
              label=" Main home ?"
              :value="checkbox"
              name="isMain"
              required
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
                width = '90'
                height = '90'
                v-on="on"
           >
                <i class="fas fa-home"></i>
          </v-btn>
              <span bottom class="white--text">{{ home.name }}</span>
        </template>
        <v-card>
          <v-list-item-content class="justify-center">
            <div class=" text-center">
                <span class="white--text headline">{{ home.name }}</span>
              <h3>{{ home.userName }}</h3>
              <p class="caption mt-1">
                {{ home.userEmail }}
              </p>
              <v-divider class="my-3"></v-divider>
              <v-btn
                depressed
                rounded
                text
                :href="'rooms/' + home.id"
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
        props: ['data'],
        data: () => ({
              csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              valid: true,
              name: '',
              nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 10) || 'Name must be less than 10 characters',
              ],
              types: null,
              types: [
                'country',
                'flat',
              ],
              checkbox: false,
              overlay: false,
              zIndex: 0,
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
            }
    }
</script>