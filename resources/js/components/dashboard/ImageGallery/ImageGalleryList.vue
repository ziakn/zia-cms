<template>
<v-main>
		<v-container fluid>
        <v-card height="90%" >
            <v-toolbar flat color="primary" dark fixed>
                <v-toolbar-title>Image Upload</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn  icon @click="$refs.inputUpload.click()">
                    <v-icon>cloud_upload</v-icon>
                </v-btn>
                <input
                    v-show="false"
                    ref="inputUpload"
                    accept="image/*"
                    type="file"
                    multiple
                    @change="fileChange"
                />
                <v-menu
                    v-model="menu"
                    bottom
                    :close-on-content-click="false"
                    flat
                    max-width="500"
                >
                    <template v-slot:activator="{ on }">
                        <v-btn   v-show="currentFolder.title == 'Root'" icon v-on="on">
                            <v-icon>create_new_folder</v-icon>
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            Create new folder
                        </v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                        v-model="formValue.title"
                                        label="Title"
                                        outlined
                                        dense
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>

                            <v-btn text @click="menu = false">Cancel</v-btn>
                            <v-btn color="green" text @click="saveFolder"
                                >Save</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-menu>
            </v-toolbar>
            <!-- <v-card color="primary" dark tile flat >
                <v-card-title
                class="headline"
                v-text="$t('message.main.imageuploader')"
                ></v-card-title>
                </v-card > -->
            <v-toolbar dense flat>
                <v-toolbar-title>{{ currentFolder.title }} </v-toolbar-title>

                <v-spacer></v-spacer>
<v-text-field
                    v-model="search"
                    append-icon="search"
                    label="Search"
                    hide-details
                     outlined
                    solo
                    dense
                ></v-text-field>
            </v-toolbar>
            <v-breadcrumbs :items="folders">
                <template v-slot:item="{ item }">
                    <v-breadcrumbs-item
                        :disabled="
                            item.id == formValue.parent_id ? true : false
                        "
                        @click="goFolder(item)"
                    >
                        {{ item.title }}
                    </v-breadcrumbs-item>
                </template>
            </v-breadcrumbs>
            <v-card-text>
                <v-container grid-list-md>
                    <v-row>
                        <v-col
                            v-for="(item, index) in dataFolder"
                            :key="item.id + '-' + index"
                            cols="6"
                            lg="2"
                            md="4"
                            @dblclick.stop="enterFolder(item)"
                        >
                            <v-card>
                                <v-img
                                    src="/images/folder.png"
                                    aspect-ratio="1"
                                >
                                    <v-menu flat>
                                        <template v-slot:activator="{ on }">
                                            <v-btn v-on="on" fab icon small>
                                                <v-icon>more_horiz</v-icon>
                                            </v-btn>
                                        </template>

                                        <v-list>
                                            <v-list-item
                                                @click="editItem(item, index)"
                                            >
                                                <v-list-item-title
                                                    >Edit</v-list-item-title
                                                >
                                            </v-list-item>
                                            <v-list-item
                                                @click="removeFolder(item, index)"
                                            >
                                                <v-list-item-title
                                                    >Remove</v-list-item-title
                                                >
                                            </v-list-item>
                                        </v-list>
                                    </v-menu>
                                </v-img>

                                <v-card-subtitle>
                                    <strong>{{ item.title }}</strong>
                                    <br />
                                    {{ item.description }}
                                </v-card-subtitle>
                            </v-card>
                        </v-col>
                        <v-col
                            v-for="(item, i) in dataFile"
                            :key="i"
                            cols="6"
                            lg="2"
                            md="4"
                            @dblclick.stop="selectFile(item)"

                        >
                            <v-card>
                                <v-img :src="item.src" aspect-ratio="1">
                                    <v-menu flat>
                                        <template v-slot:activator="{ on }">
                                            <v-btn
                                                v-on="on"
                                                fab
                                                color="white"
                                                small
                                            >
                                                <v-icon>more_horiz</v-icon>
                                            </v-btn>
                                        </template>

                                        <v-list>
                                            <v-list-item
                                                @click="selectFile(item)"
                                            >
                                                <v-list-item-title
                                                    >select</v-list-item-title
                                                >
                                            </v-list-item>
<!--
                                            <v-list-item
                                                @click="editItem(item, i)"
                                            >
                                                <v-list-item-title
                                                    >Edit</v-list-item-title
                                                >
                                            </v-list-item> -->
                                            <v-list-item
                                                @click="removeFile(item, i)"
                                            >
                                                <v-list-item-title
                                                    >Remove</v-list-item-title
                                                >
                                            </v-list-item>
                                              <!-- <v-list-item
                                                @click.stop.prevent="GenerateUrl(item)"
                                            >
                                                <v-list-item-title
                                                    >Generate Url</v-list-item-title
                                                >
                                            </v-list-item> -->
                                        </v-list>
                                    </v-menu>
                                </v-img>

                                <v-card-subtitle>
                                    {{ item.title }}
                                </v-card-subtitle>
                            </v-card>
                        </v-col>
                    </v-row>
                     <div class="text-center">
                        <v-pagination
                                v-model="filters.page"
                                :length="pageCount"
                                @input="getImages"
                        ></v-pagination>
                    </div>
                </v-container>
            </v-card-text>


        </v-card>
        <DeleteModal
            :trigger="isDelete"
            :title="deleteTitle"
            :body="deleteBody"
            @request="remove"
        ></DeleteModal>
        <v-dialog v-model="isEdit" max-width="500px" persistent>
            <v-card>
                <v-card color="primary" dark tile flat>
                    <v-card-title class="headline">Edit Folder</v-card-title>
                </v-card>
                <v-card-title> </v-card-title>

                <v-card-text>
                    <v-container grid-list-md>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="editFolderItem.title"
                                    label="Title"
                                    :rules="[v => !!v || 'Title is required']"
                                    outlined
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red darken-1" text @click="isEdit = false"
                        >Cancel</v-btn
                    >
                    <v-btn
                        color="primary"
                        :loading="loading"
                        :disabled="loading"
                        text
                        @click="updateFolder"
                        >Save</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
        </v-container>
        	</v-main>
</template>

<script>
import DeleteModal from "./../../common/DeleteModal";
export default {
    props: {

    },
    components: {
        DeleteModal,
    },
    data: () => ({
        absolute: true,
        files: [],
        editedIndex: 0,
        itemsPerPage:1,
        pageCount:2,
        editFolderItem: {},
        folders: [
            {
                title: "Root",
                id: 1
            }
        ],
        currentFolder: {
            title: "Root"
        },
        search: "",
        isDelete: false,
        isEdit: false,
        deleteTitle: "",
        deleteBody: "",
        menu: false,
        dialog: false,
        loading: false,
        dataFolder: [],
        dataFile: [],
        deleteSystem: {
            type: "",
            id: ""
        },
        formValue: {
            title: "",
            parent_id: 1,
        },
        filters:
        {
            show:20,
			page:1,
			image_folder_id:'',
			search:''
        },
    }),
    methods: {
         GenerateUrl (item) {


          this.search = window.location.origin + item.src

        },
        cancel() {
            this.$emit("cancel");
        },

        fileChange(event) {
            let data = event.target.files;
            for (var i = 0; i < data.length; i++) {
                if (data[i].type.indexOf("image") !== -1) {
                    // We need to represent the image as a file
                    this.files.push(data[i]);
                    console.log(data[i]);
                }
            }
            this.upload();
        },
        async upload() {
            this.loading = true;

            try {
                const formData = new FormData();
                console.log(this.formValue.parent_id);
                formData.append("folder_id", this.formValue.parent_id);
                this.files.forEach(file => {
                    formData.append("myFile[]", file, file.name);
                });
                console.log(2);
                let { data } = await axios({
                    method: "post",
                    url: "/app/image",
                    data: formData
                });

                if (data.status) {
                    for (let d of data.data) {
                        this.dataFile.push(d);
                    }
                    this.snacks("Successfully Uploaded", "green");
                } else {
                    this.snacks("Failed! " + data.data, "red");
                }
                this.files = [];
                this.loading = false;
            } catch (e) {
                this.snacks("Operation Failed!" + e, "red");
                this.loading = false;
                this.files = [];
            }
        },
        editItem(item, index) {
            this.editedIndex = index;
            console.log(index);
            this.editFolderItem = Object.assign({}, item);
            this.isEdit = true;
        },
        goFolder(item) {
            this.formValue.parent_id = 1;
            this.currentFolder = item;
            this.dataFile =[];
            this.initialize();
            console.log("folder back");
            let index = this.folders.indexOf(item);
            this.folders.splice(index + 1, this.folders.length - index);
            console.log(index);
        },
        enterFolder(item) {
            this.formValue.parent_id = item.id;
            this.currentFolder = item;
            this.initialize();
            console.log("folder");
            this.folders.push(item);
        },
        selectFile(item) {
            this.$emit("send", item);
        },
        async saveFolder() {
            this.loading = true;
            try {
                let { data } = await axios({
                    method: "post",
                    url: "/app/folder",
                    data: this.formValue
                });
                if (data.status) {
                    this.dataFolder.unshift(data.data);
                    this.snacks("Successfully Added", "green");
                    this.close();
                } else {
                    this.snacks("Failed!! " + data.data, "red");
                    this.loading = false;
                }
            } catch (e) {
                this.snacks("Failed!! " + e, "red");
                this.loading = false;
            }
        },
        removeFolder(item, index) {
            this.deleteSystem.index = index;
            this.deleteSystem.type = "folder";
            this.deleteSystem.id = item.id;
            this.deleteTitle =
                "Are you sure you want to delete folder '" + item.title + "'?";
            this.isDelete = !this.isDelete;
        },
        removeFile(item, index) {
            this.deleteSystem.index = index;
            this.deleteSystem.type = "file";
            this.deleteSystem.id = item.id;
            this.deleteTitle =
                "Are you sure you want to delete folder '" + item.title + "'?";
            this.isDelete = !this.isDelete;
        },
        async updateFolder() {
            this.loading = true;
            try {
                let { data } = await axios({
                    method: "put",
                    url: "/app/folder/" + this.editFolderItem.id,
                    data: this.editFolderItem
                });
                if (data.status) {
                    console.log(data)
                    Object.assign(this.dataFolder[this.editedIndex],  this.editFolderItem);

                    this.snacks("Successfully Added", "green");
                    this.close();
                } else {
                    this.snacks("Failed!! " + data.data, "red");
                    this.loading = false;
                }
            } catch (e) {
                this.snacks("Failed!! " + e, "red");
                this.loading = false;
            }
        },
        async remove() {
            this.loading = true;
            if (this.deleteSystem.type == "folder") {
                try {
                    let { data } = await axios({
                        method: "delete",
                        url: "/app/folder/" + this.deleteSystem.id
                    });
                    if (data.status) {
                        this.snacks("Successfully Removed", "green");
                        this.dataFolder.splice(this.deleteSystem.index, 1);
                        this.close();
                    } else {
                        this.snacks("Failed!! " + data.data, "red");
                        this.loading = false;
                    }
                } catch (e) {
                    this.snacks("Failed!! " + e, "red");
                    this.loading = false;
                }
            } else if (this.deleteSystem.type == "file") {
                try {
                    let { data } = await axios({
                        method: "delete",
                        url: "/app/image/" + this.deleteSystem.id
                    });
                    if (data.status) {
                        this.snacks("Successfully Removed", "green");
                        this.dataFile.splice(this.deleteSystem.index, 1);
                        this.close();
                    } else {
                        this.snacks("Failed!! " + data.data, "red");
                        this.loading = false;
                    }
                } catch (e) {
                    this.snacks("Failed!! " + e, "red");
                    this.loading = false;
                }
            }
        },
        close() {
            this.loading = false;
            this.menu = false;
            this.isDelete = false;
            this.editFolderItem = {};
            this.isEdit = false;
        },
        async initialize() {
            try {
                let { data } = await axios({
                    method: "get",
                    url: "/app/folder",
                    params: {
                        parent_id: this.formValue.parent_id,
                    }
                });
                this.dataFolder = data;
            } catch (e) {
                this.snacks("Failed!! " + e, "red");
            }
            
                
            

        },

        async getImages()
        {
            try {
                    this.filters.image_folder_id= this.formValue.parent_id
                let { data } = await axios({
                    method: "get",
                    url: "/app/image",
                    params:  this.filters
                });
                this.dataFile = data.data;
                 this.itemsPerPage=data.per_page;
                this.pageCount=data.last_page;
                this.filters.page=data.current_page
                } catch (e) {
                    this.snacks("Failed!! " + e, "red");
                }
        },
    },
    watch: {},
    created() {
        this.initialize();
        this.getImages();

    }
};
</script>

<style></style>
