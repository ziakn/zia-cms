<template>
    <v-row >
        <v-col sm="12" md="12" lg="6">
            <v-card  class="mt-5 pt-5">
                <v-card-title> 
                    <v-icon large left color="blue">
                        explore
                    </v-icon>
                    <span class="title font-weight-light">Property Address</span>
                </v-card-title>
                <v-card-text>
                    <v-row>
                        <v-col sm="12" md="12" lg="12" >
                                  <v-autocomplete
                                        v-model="address"
                                        :items="items"
                                        :loading="isLoading"
                                        :search-input.sync="search"
                                        @change="changeLocation"
                                        item-text="description"
                                        return-object
                                        label="Location*"
                                        filled
                                    ></v-autocomplete>
                        </v-col>
                        <v-col>
                        	<gmap-autocomplete
									@place_changed="setPlace"
									:select-first-on-enter="true"
									class="inputSearch"
									placeholder="Search Place for Map"
									:options="autocompleteOptions"
									>
								</gmap-autocomplete>
									</v-col>
								<v-col cols="12">
									
								</v-col>
                        <v-col sm="12" md="12" lg="12" >
                            <v-text-field
                                v-model="formValue.project_name"
                                label="Project Name"
                                @change="sendValue"
                                filled
                            ></v-text-field>
                        </v-col>
                        <v-col sm="12" md="12" lg="6" >
                            <v-text-field
                                v-model="formValue.street_name"
                                label="Street Name"
                                @change="sendValue"
                                filled
                            ></v-text-field>
                        </v-col>
                        <v-col sm="6" md="6" lg="3" >
                            <v-text-field
                                v-model="formValue.street_no"
                                label="Street No"
                                @change="sendValue"
                                type="number"
                                filled
                            ></v-text-field>
                        </v-col>
                        <v-col sm="6" md="6" lg="3" >
                            <v-text-field
                                v-model="formValue.unit_no"
                                label="Unit No"
                                @change="sendValue"
                                type="number"
                                filled
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-col>
        <v-col sm="12" md="12" lg="6">
            <v-card  class="mt-5 pt-5">
               <GmapMap
										:center="center"
										:zoom="zoom"
										map-type-id="terrain"
										style="width: auto; height: 300px"
										@click="newmark"
										>
										<GmapMarker
											:position="position"
											:clickable="true"
											:draggable="true"
											@dragend="mapitem"
										/>
									</GmapMap>
            </v-card>
        </v-col>
        <v-col sm="12" md="12" lg="6">
             <v-card  class="mt-5 pt-5">
                <v-card-title> 
                    <v-icon large left >
                        reorder
                    </v-icon>
                    <span class="title font-weight-light">Floor Plan</span>
                </v-card-title>
                <v-card-text>
                <v-file-input
                    v-model="formValue.floor_plan"
                    color="blue accent-4"
                    label="Document"
                    placeholder="Select your file"
                    prepend-icon="mdi-paperclip"
                    filled
                    multiple
                    @change="sendValue"
                    :show-size="1000"
                >
                    <template v-slot:selection="{ index, text }">
                    <v-chip
                        v-if="index < 2"
                        color="blue accent-4"
                        dark
                        label
                        small
                    >
                        {{ text }}
                    </v-chip>

                    </template>
                </v-file-input>
                </v-card-text>
            </v-card>
        </v-col>
  </v-row>
</template>

<script>
export default {
    data: () =>({
        search:'',
        address:'',
          lat:25.2854,
        lng:51.5310,
        zoom:12,
		 center: {
            lat: 25.2854,
            lng: 51.5310
          },
          markers: [ {
            position: {
              lat: 25.2854,
              lng: 51.5310
            }
		  }], 
		  autocompleteOptions:
            {
				componentRestrictions: 
				{ 
                    country: 'qa',
                },
			},
            editedItem: 
      {
        name:"",
        overview: "",
        logo: "",
        banner: "",
        contact: "",
        price:"",
        email:"",
        address:"",
        things_to_be_noted: "",
        safety_precautions: "",
        cuisine:"",
        hours: "",
        payment_options:"",
		seat_capacity:"",
		time_interval:"",
        parking: "",
        lat:25.2854,
        lon:51.5310,
        status: 1,
        start_hour: '07:00',
		end_hour: '23:00',
		delivery:1,
		busy:0
      },
        items:[
            
        ],
        isLoading: false,
        property_location:{},
        formValue:{
            property_location:'Doha',
            place_id:'ChIJe7WIDNvaRT4RB3Yp3t1GCno',
            project_name:'',
            street_name:'',
            street_no:'',
            unit_no:'',
            floor_plan:[],
        }
        
    }),
    computed: {
		formTitle() {
			return this.editedIndex === -1 ? "New Item" : "Edit Item";
		},
		position()
		{
			var position =
			{
				lat: this.editedItem.lat,
				lng: this.editedItem.lon

			}
			return position;

		}
	},
    watch:
    {
        search (val) {


            // Items have already been requested
            if (this.isLoading) return
            if(!val) return
            this.isLoading = true
            this.getdata();
            // Lazily load input items
            
        },
    },
    methods:
    {
        newmark(i)
		{
			this.editedItem.lat=i.latLng.lat();
			this.editedItem.lon=i.latLng.lng();
		},
		mapitem(i)
		{
			this.center.lat=i.latLng.lat();
			this.center.lng=i.latLng.lng();
			this.editedItem.lat=i.latLng.lat();
			this.editedItem.lon=i.latLng.lng();
		},
		 setPlace(place) 
            {
                this.product.address = place.formatted_address
                this.center.lat=place.geometry.location.lat();
                this.center.lng=place.geometry.location.lng();
                this.product.lat=place.geometry.location.lat();
                this.product.lng=place.geometry.location.lng();
                this.zoom=16
            },
        changeLocation(i)
        {
            console.log(i)
            if(i)
            this.formValue.place_id=i.place_id;
            this.formValue.property_location=i.description;
            this.sendValue();
        },
        async getdata()
        {
            try {
                let { data } = await axios({
                    method: "get",
                    url: "/app/map/"+this.search,
                });
                // if(data.status!="OK")
                // {
                //     this.getdata();
                // }
                this.items = data.predictions;
                this.isLoading = false
            } catch (e) {
                this.fail();
                this.isLoading = false
            }
        },
        sendValue()
        {
            this.$emit('send',this.formValue)
        }
    }


}
</script>
<style >
.inputSearch{
	padding: 16px;
	border-bottom: 1px solid grey;
  float: left;
  width: 100%;
  background: #f1f1f1;
}
</style>