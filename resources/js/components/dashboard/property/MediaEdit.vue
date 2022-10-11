<template>
    <v-row justify="center">
        <v-col sm="12" md="12" lg="12">
            <v-card  class="mt-5 pt-5">
                <v-card-title> 
                    <v-icon large left color="blue" >
                        image
                    </v-icon>
                    <span class="title font-weight-light">Images</span>
                </v-card-title>
                <v-card-text>
                    <v-file-input
                        v-model="files"
                        color="blue accent-4"
                        counter
                        label="Image input"
                        multiple
                        placeholder="Select your images"
                        prepend-icon="mdi-paperclip"
                        filled
                        :show-size="1000"
                        accept="image/*" 
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

                        <span
                            v-else-if="index === 2"
                            class="overline grey--text text--darken-3 mx-2"
                        >
                            +{{ files.length - 2 }} File(s)
                        </span>
                        </template>
                    </v-file-input>
                    <!-- <v-text-field
                        v-model="video_link"
                        :rules="[v => !!v || 'Video Link required']"
                        label="Video Link"
                        required
                        filled
                        prepend-icon="videocam"
                ></v-text-field> -->
                </v-card-text>

                <v-container fluid>
                    <v-row v-if="formValue.image.length!=0">
                        <v-col
                        v-for="(image , index) in formValue.image"
                        :key="index"
                        class="d-flex child-flex"
                        cols="2"
                        >
                            <v-card flat >
                                <v-img
                                :src="image.image"
                                aspect-ratio="1"
                                class="grey lighten-2"
                                >
                                <v-btn color="error" @click="removeOldImage(index)">x</v-btn>
                                <template v-slot:placeholder>
                                    <v-row
                                    class="fill-height ma-0"
                                    align="center"
                                    justify="center"
                                    >
                                    <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                                    </v-row>
                                </template>
                                </v-img>
                                
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-row v-if="images.length!=0">
                        <v-col
                        v-for="(image , index) in images"
                        :key="index"
                        class="d-flex child-flex"
                        cols="2"
                        >
                            <v-card flat >
                                <v-img
                                :src="image"
                                aspect-ratio="1"
                                class="grey lighten-2"
                                >
                                <v-btn color="error" @click="removeImage(index)">x</v-btn>
                                <template v-slot:placeholder>
                                    <v-row
                                    class="fill-height ma-0"
                                    align="center"
                                    justify="center"
                                    >
                                    <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                                    </v-row>
                                </template>
                                </v-img>
                                
                            </v-card>
                        </v-col>
                    </v-row>
                    
                </v-container>
            </v-card>
        </v-col>
        <v-col sm="12" md="12" lg="12">
            <v-card  class="mt-5 pt-5">
                <v-card-title> 
                    <v-icon large left color="blue" >
                        video
                    </v-icon>
                    <span class="title font-weight-light">Video</span>
                </v-card-title>
                <v-card-text>
                    <v-row>
                        <v-col lg="6">
                            <v-row>
                                <v-col lg="12">
                                    <v-file-input
                                        v-model="video"
                                        color="blue accent-4"
                                        counter
                                        label="Video input"
                                        :placeholder="formValue.video?'Update Video':'Add Video'"
                                        prepend-icon="mdi-paperclip"
                                        filled
                                        :show-size="1000"
                                        accept="video/*" 
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

                                        <span
                                            v-else-if="index === 2"
                                            class="overline grey--text text--darken-3 mx-2"
                                        >
                                            +{{ files.length - 2 }} File(s)
                                        </span>
                                        </template>
                                    </v-file-input>
                                </v-col>
                                <v-col lg="12" v-if="formValue.video">
                                    <v-card flat >
                                        <v-card-title>
                                            <v-btn color="red" @click="removeVideo">remove</v-btn>
                                        </v-card-title>
                                        <video width="400" controls>
                                            <source :src="formValue.video" type="video/mp4">
                                            Your browser does not support HTML5 video.
                                        </video>                                
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-col>
                        <v-col lg="6">
                            <v-row >
                                <v-col lg="12">
                                    <v-file-input
                                        v-model="three"
                                        color="blue accent-4"
                                        counter
                                        label="360 input"
                                        
                                        :placeholder="formValue.three?'Update 360':'Add 360'"
                                        prepend-icon="mdi-paperclip"
                                        filled
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

                                        <span
                                            v-else-if="index === 2"
                                            class="overline grey--text text--darken-3 mx-2"
                                        >
                                            +{{ files.length - 2 }} File(s)
                                        </span>
                                        </template>
                                    </v-file-input>
                                </v-col>
                            <v-col md="12"  v-if="formValue.three">
                                <v-card flat >
                                    <v-card-title>
                                        <v-btn color="red" @click="removeThree">remove</v-btn>
                                    </v-card-title>
                                        <Pano
                                            
                                            :source="formValue.three" >
                                        </Pano>
                                </v-card>
                            </v-col>    
                        </v-row>
                    </v-col>
                </v-row>

                </v-card-text>
            </v-card>
        </v-col>
        
        
  </v-row>
</template>

<script>
import ViewThree from './ViewThree'
import { Pano } from 'vuejs-vr'

export default {
    components:
    {
        Pano,
        ViewThree,
    },
    props:{
        formValue: Object,
    },
    data: () =>({
        isThree:false,
        isVideo:false,  

        files:[],
        totalFiles:[],
        images:[],
        pastedImage:'',
        blobFile:'',
        video_link:'',
        video:null,
        three:null,
    }),
    methods:
    {
        _getURLObj(){
            return window.URL || window.webkitURL;
        },
        removeImage(i)
        {
            this.images.splice(i,1)
            this.totalFiles.splice(i,1)
        },
        removeOldImage(i)
        {
            this.formValue.image.splice(i,1)
        },
        removeThree(i)
        {
            this.formValue.three=null
        },
        removeVideo(i)
        {
            this.formValue.video=null
        }

    },
    watch:
    {
        files()
        {
            console.log(this.files)
            var files = this.files;
            for (var i = 0; i < files.length; i++) {
                if (files[i].type.indexOf('image') !== -1) {
                // We need to represent the image as a file
                var blob = files[i];
                var URLObj = this._getURLObj();
                this.pastedImage = URLObj.createObjectURL(blob);
                
                this.images.push(URLObj.createObjectURL(blob))
                this.totalFiles.push(files[i])
                this.blobFile=blob;
                console.log(this.pastedImage)
                // // The URL can then be used as the source of an image
                // this._pasteImageSource(source);

                // // Prevent the image (or URL) from being pasted into the contenteditable element
                // e.preventDefault();
                }
            }
            this.$emit('files',this.totalFiles);
        },
        video()
        {
            this.$emit('video',this.video);
        },
        three()
        {
            this.$emit('three',this.three);
        }
    }

}
</script>

<style>

</style>