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
                <video width="400" controls>
                    <source :src="'/storage/uploads/video/'+file" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
            </v-card-text>
            
            
        </v-card>
    </v-dialog>

</template>

<script>

export default {
    data : () =>({
      dialog:false,
    }),
    

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