<template>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
        <v-card>
            <v-toolbar dark color="primary">
            <v-btn icon dark @click="dialog = false">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>360 Image view</v-toolbar-title>
            <div class="flex-grow-1"></div>
            </v-toolbar>
            <v-card-text >
                <Pano
                    
                    :source="'/storage/uploads/three/pano.png'">
                </Pano>
            </v-card-text>
            
            
        </v-card>
    </v-dialog>

</template>

<script>
import { Pano } from 'vuejs-vr'
export default {
    data : () =>({
      dialog:false,
    }),
    
	components: {
        Pano 
    },
    props:
    {
        trigger:false,
        file:null,
    },
    watch:
    {
        trigger(){
            this.dialog=true;
        }

    }
}
</script>

<style>

</style>