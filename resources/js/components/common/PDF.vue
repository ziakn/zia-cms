<template>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
        <v-card>
            <v-toolbar dark color="primary">
            <v-btn icon dark @click="dialog = false">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>File View</v-toolbar-title>
            <div class="flex-grow-1"></div>
            <v-toolbar-items>
                <v-btn dark text @click="dialog = false">Close</v-btn>
            </v-toolbar-items>
            </v-toolbar>
            <v-card-text v-if="ext=='pdf'">
                    <iframe width="100%" height="500px" :src="pdf" >
                        
                    </iframe>
            </v-card-text>
            <v-card-text v-else-if="ext=='jpg'  ||ext=='jpeg' ||ext=='png' ||ext=='gif'">
                    <v-img aspect-ratio="1" :src="pdf" max-width="700" max-height="700" >
                        
                    </v-img>
            </v-card-text>
            <v-card-text v-else>
                No Preview Avalaile
                    <v-btn :href="pdf">Download</v-btn>
                        
                    </v-img>
            </v-card-text>
            
            
        </v-card>
    </v-dialog>

</template>

<script>
export default {
    data : () =>({
      dialog:false,
      ext:'pdf'  
    }),
    
	components: {

    },
    props:
    {
        trigger:false,
        pdf:null,
    },
    watch:
    {
        trigger(){
            this.dialog=true;
            var re = /(?:\.([^.]+))?$/;
            this.ext = re.exec(this.pdf)[1]; 
            this.ext = this.ext.toLowerCase();
            

        }

    }
}
</script>

<style>

</style>