<template>
  <v-container fluid>
    <v-row justify="center">
      <v-col lg="4">
        <v-card max-width="444">
          <v-system-bar lights-out></v-system-bar>
          <v-carousel hide-delimiter-background delimiter-icon="mdi-minus" height="350">
            <v-carousel-item v-for="(img,index) in item.image" :key="index" :src="img.image"></v-carousel-item>
          </v-carousel>
        </v-card>
      </v-col>
      <v-col lg="8">
        <v-card height="100%">
          <v-row justify="center">
            <v-card-title>
              <h4>{{ item.title }}</h4>
            </v-card-title>
          </v-row>
          <v-row>
            <v-col>
              <v-btn text>
                {{item.availability}}
              </v-btn>
            </v-col>
            <v-col>
              <v-btn text>
                <v-icon>calendar_today</v-icon>
                From {{item.availability_date | moment(" MM/DD/YYYY")}}
              </v-btn>
            </v-col>
            <v-col>
              <v-btn text>
                <v-icon>line_style</v-icon>
                {{item.furnish_type}}
              </v-btn>
            </v-col>
            <v-col>
              <v-btn text>
                <v-icon>directions_car</v-icon>
                {{item.parking_space }} Parking
              </v-btn>
            </v-col>
          </v-row>
          <v-divider></v-divider>
          <v-row>
            <v-col>
              <v-list dense>
                <v-list-item>
                  <v-list-item-content>Service Chareges:</v-list-item-content>
                  <v-list-item-content class="align-end">{{item.service_charges}}/Year</v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>Rental Period:</v-list-item-content>
                  <v-list-item-content class="align-end">{{item.price_rent_type}}</v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>User:</v-list-item-content>
                  <v-list-item-content class="align-end">{{item.admin.name}}</v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>Developer:</v-list-item-content>
                  <v-list-item-content class="align-end">{{item.developer}}</v-list-item-content>
                </v-list-item>
              </v-list>
            </v-col>
            <v-col>
              <div class="text-center" >
                <v-btn v-for="(amnty,index) in item.amenity" :key="index" class="ma-2" rounded outlined color="indigo" x-small>{{amnty.name}}</v-btn>
              </div>
            </v-col>
            <v-col>
              <v-list dense>
                <v-list-item>
                  <v-list-item-content>Location:</v-list-item-content>
                  <v-list-item-content class="align-end">
                    <p v-if="item.property_location.length==0">0/3</p>
                    <p v-else>{{ item.property_location.split(',').length }}/3</p>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>Image:</v-list-item-content>
                  <v-list-item-content class="align-end">{{item.image.length}}/10</v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>Title:</v-list-item-content>
                  <v-list-item-content class="align-end">
                    <p v-if="item.title.length >= 50">Too Ok</p>
                    <p v-else-if="item.title.length < 10">Too Short</p>
                    <p v-else>Ok</p>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>Description:</v-list-item-content>
                  <v-list-item-content class="align-end">
                    <p v-if="item.description.length >= 500">Too Ok</p>
                    <p v-else-if="item.title.length < 30">Too Short</p>
                    <p v-else>Ok</p>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {
  data() {
    return {};
  },
  props: {
    item: {}
  },
  //    computed: {
  //     itemsCount () {
  //         // itemsFilters is computed
  //         return this.item.image.length
  //         // or a method
  //         return this.itemsFilters().length
  //     }
  // },
  created() {
    console.log(this.item);
  }
};
</script>