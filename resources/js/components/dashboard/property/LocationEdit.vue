<template>
    <v-row >
        <v-col sm="12" md="12" lg="6">
            <v-card  class="mt-5 pt-5">
                <v-card-title> 
                    <v-icon large left >
                        explore
                    </v-icon>
                    <span class="title font-weight-light">Property Address</span>
                </v-card-title>
                <v-card-text>
                    <v-row>
                        <v-col sm="12" md="12" lg="12" >
                                  <v-autocomplete
                                        v-model="property_location"
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
                        <v-col sm="12" md="12" lg="12" >
                            <v-text-field
                                v-model="formValue.project_name"
                                label="Project Name"
                                filled
                            ></v-text-field>
                        </v-col>
                        <v-col sm="12" md="12" lg="6" >
                            <v-text-field
                                v-model="formValue.street_name"
                                label="Street Name"
                                filled
                            ></v-text-field>
                        </v-col>
                        <v-col sm="6" md="6" lg="3" >
                            <v-text-field
                                v-model="formValue.street_no"
                                label="Street No"
                                type="number"
                                filled
                            ></v-text-field>
                        </v-col>
                        <v-col sm="6" md="6" lg="3" >
                            <v-text-field
                                v-model="formValue.unit_no"
                                label="Unit No"
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
                <iframe
                    width="600"
                    height="450"
                    frameborder="0" style="border:0"
                    :src="'https://www.google.com/maps/embed/v1/place?key=AIzaSyA0utN-bgpJ_zRHyJr-dob3yFAXIV7TCLM&q=place_id:'+formValue.place_id" allowfullscreen>
                </iframe>
            </v-card>
        </v-col>
        <v-col sm="12" md="12" lg="12">
             <v-card  class="mt-5 pt-5">
                <v-card-title> 
                    <v-icon large left >
                        reorder
                    </v-icon>
                    <span class="title font-weight-light">Floor Plan</span>
                </v-card-title>
                <v-card-text>
                <v-file-input
                    v-model="floor_plan"
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
               
                <v-row>
                    <v-col lg="2" v-for="(data,index) in formValue.floor_plan" :key="index">
                        <v-card
                            >
                                <v-card-text>{{data.name}}</v-card-text>
                                <v-card-actions>
                                <v-btn text small @click="view(data)">View</v-btn>
                                <v-btn text small @click="remove(index)">Remove</v-btn>
                                </v-card-actions>
                            </v-card>
                    </v-col>
                </v-row>
                 </v-card-text>
            </v-card>
            <PDF :trigger="isPDF" :pdf="fileData"></PDF>
        </v-col>
  </v-row>
</template>

<script>
import PDF from './../../common/PDF'
export default {
    components:
    {
        PDF

    },
    props:{
        formValue:null

    },
    data: () =>({
        isPDF:false,
        property_location:{},
        floor_plan:[],
        fileData:'',
        search:'',
        items:[
            
        ],
        isLoading: false,

        
    }),
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
    created()
    {
        this.property_location.place_id=this.formValue.place_id;
        this.property_location.description=this.formValue.property_location;
        this.items.push(this.property_location);

    },
    methods:
    {
        view(item)
        {
            this.isPDF=!this.isPDF;
            this.fileData=item.src;


        },
        remove(item)
        {
            this.formValue.floor_plan.splice(item,1)


        },
        changeLocation(i)
        {
            console.log(i)
            if(i)
            {
            this.formValue.place_id=i.place_id;
            this.formValue.property_location=i.description;
            this.sendValue();
            }

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
            this.$emit('send',this.floor_plan)
        }
    }


}
</script>

<style>

</style>