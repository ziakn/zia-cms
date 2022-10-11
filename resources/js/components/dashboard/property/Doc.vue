<template>
    <v-row justify="center">
        <v-col sm="12" md="12" lg="8">
            <v-card  class="mt-5 pt-5">
                <v-card-text>
                    <v-file-input
                        v-model="document"
                        color="blue accent-4"
                        label="Document"
                        multiple
                        placeholder="Add your file"
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
                    <v-row>
                    <v-col lg="3" v-for="(data,index) in datas" :key="index">
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
    props:
    {
        datas:Array

    },
    data: () =>({
        isPDF:false,
        document:[],
        fileData:''
        
    }),
    methods:
    {
        view(item)
        {
            this.isPDF=!this.isPDF;
            this.fileData=item.src;


        },
        remove(item)
        {
            this.datas.splice(item,1)

        },

    },
    watch:
    {
        document()
        {
            this.$emit('send',this.document)
        }
    }


}
</script>

<style>

</style>