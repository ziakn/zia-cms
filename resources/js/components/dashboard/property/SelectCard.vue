<template>
<div>
    <v-row justify="center">
                    
        <v-col sm="12" md="6" lg="5">
                <v-card
                    :color="colorOne"
                    :flat="flatOne"
                    @click="change(1)"
                    class=""
                    >
                    <v-card-title  class="overline mb-4 ">{{dataOne.title}}</v-card-title>
                        <v-card-text>
                            <v-avatar 
                            tile
                            size="80"
                            >
                        <img
                            :src="dataOne.src"
                            :alt="dataOne.title"
                        >
                        </v-avatar>
                        </v-card-text>
                        <v-card-actions>
                            <!-- <v-icon v-show="!flatOne">check_circle</v-icon> -->
                        
                        </v-card-actions>
                    </v-card>
            
        </v-col>
        <v-col sm="12" md="6" lg="5">
                <v-card
                    :color="colorTwo"
                    :flat="flatTwo"
                    @click="change(2)"
                    class="center"
                    
                    >
                    <v-card-title  class="overline mb-4">{{dataTwo.title}}</v-card-title>
                        <v-card-text>
                            <v-avatar 
                            tile
                            size="80"
                            >
                        <img
                            :src="dataTwo.src"
                            :alt="dataTwo.title"
                        >
                        </v-avatar>
                        </v-card-text>
                        <v-card-actions>
                            <!-- <v-icon v-show="!flatTwo">check_circle</v-icon> -->

                        </v-card-actions>
                    </v-card>
            
        </v-col>                    
    </v-row>
</div>

</template>

<script>
export default {
    data: () => ({
        text: 'data',
		flatOne:true,
		flatTwo:true,
        colorOne:'grey lighten-4',
        colorTwo:'white',
        
	}),

    props:
    {
        dataOne:{},
        dataTwo:{},
        select:'',
    },
    methods:
    {
        change(i)
        {
            if(i==1)
            {
                this.flatOne=false;
                this.flatTwo=true;
                this.colorOne='grey lighten-4';
                this.colorTwo='white';
                

            }
            else if(i==2)
            {
                this.flatOne=true;
                this.flatTwo=false;
                this.colorTwo='grey lighten-4';
                this.colorOne='white';


            }
            this.$emit('send',i)
        }
    },
    watch: {
        select()
        {
            console.log(this.select)
            if(this.select)
            {
            
            
                if(this.dataOne.title==this.select)
                {
                    // console.log(this.dataOne.title)
                    this.change(1);
                }
                else if(this.dataTwo.title==this.select)
                {
                    // console.log(this.dataTwo.title)
                    this.change(2);
                }
                    

            }

        }

    },
    created()
    {
        console.log(this.select)
            if(this.select)
            {
            
            
                if(this.dataOne.title==this.select)
                {
                    // console.log(this.dataOne.title)
                    this.change(1);
                }
                else if(this.dataTwo.title==this.select)
                {
                    // console.log(this.dataTwo.title)
                    this.change(2);
                }
                    

            }
        

    }

}
</script>



<style>

</style>