<template>
    <v-row justify="center">
        <v-col sm="12" md="12" lg="8">
            <v-card  class="mt-5 pt-5">
                <v-card-title> 
                    <v-icon large left >
                        explore
                    </v-icon>
                    <span class="title font-weight-light">SEO</span>
                </v-card-title>
                <v-card-text>
                    <v-row>
                        <v-col sm="12" md="12" lg="12" >
                            <v-text-field
                                    v-model="formValue.meta_title"
                                    
                                    label="Meta Title*"
                                    
                                    filled
                                    counter
                            ></v-text-field>
                        </v-col>
                        <v-col sm="12" md="12" lg="12" >
                            <v-textarea
                                v-model="formValue.meta_description"
                                filled
                               
                                label="Meta Description*"
                                counter
                                ></v-textarea>
                        </v-col>
                        <v-col sm="12" md="12" lg="12" >
                            <v-text-field
                                v-model="formValue.meta_keyword"
                                label="Meta Keyword"
                                filled
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-col>
  </v-row>
</template>

<script>
export default {
    data: () =>({

        isLoading: false,

        
    }),
    props:{
       formValue:{}
    },
    watch:
    {
        
    },
    methods:
    {

    }


}
</script>

<style>

</style>