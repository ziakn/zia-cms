property<template>
	<v-main>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
            <ToolbarLeft>
               <v-spacer></v-spacer>
				<v-text-field
					v-model="search"
					append-icon="search"
					label="Search"
					hide-details
					outlined 
					dense
				></v-text-field>
            </ToolbarLeft>
			<Breadcrumbs/>
			    <v-row >
                      <v-col sm="6" md="6" lg="6">
                            <v-select
                                v-model="filters.parent_id"
                                :items="dataCategory"
                                item-text="title"
                                item-value="id"
                                label="Filter Category"
                                required
							    clearable
                                outlined
								dense
								hide-details
						        @change="getCategory"
                            ></v-select>                            
                      </v-col>
                 </v-row>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="12">
					<v-data-table  :headers="headers" :items="dataList" :search="search" class="elevation-12" :items-per-page="20" :hide-default-footer="true">

						  <template v-slot:[`item.status`]="{ item }">
                                    <v-switch v-model="item.status" @change="changeStatus(item)" color="primary" inset></v-switch>
                                </template>
						<template v-slot:[`item.action`]="{ item }">
							<v-icon color="blue"   medium @click="editItem(item)" >edit</v-icon>
							<v-icon color="red"  medium @click="deleteItem(item)" >delete</v-icon>
						</template>
						<template v-slot:no-data>
							<NoDataList :loading="loading" @initialize="initialize"></NoDataList>
						</template>
					</v-data-table>
					 <div class="text-center">
                        <v-pagination
                                v-model="filters.page"
                                :length="pageCount"
                                @input="getCategory"
                        ></v-pagination>
                    </div>
				</v-col>
			</v-row>
			<DeleteModal :trigger="isDelete" :title="deleteTitle" :body="deleteBody" @request="remove"></DeleteModal>
			<v-btn bottom color="primary" dark fab fixed right @click="dialog = !dialog">
				<v-icon>add</v-icon>
			</v-btn>
            <v-dialog v-model="dialog" max-width="700px" persistent>
							<v-card>
								<v-card color="secondary" dark :tile="true" flat >
									<v-card-title
									class="headline"
									v-text="formTitle"
									></v-card-title>
								</v-card >
								<v-card-text>
									<v-container grid-list-md>
										<v-layout wrap>
											  <v-form
												ref="form"
												lazy-validation
											>
											<v-select
												:rules="[v => !!v || 'Category Type is required']"
												v-model="editedItem.parent_id"
												:items="dataCategory"
												item-text="title"
												item-value="id"
												outlined
												label="Select Category Type"
												dense
											></v-select>
												<v-text-field
													:rules="[v => !!v || 'Title is required']"
													v-model="editedItem.title"
													label="Title"
													 outlined 
													 dense
												></v-text-field>
												<ckeditor v-model="editedItem.description" :config="editorConfig" class="pb-3"></ckeditor>
										
												<v-text-field 
                                                    v-model="editedItem.slug" 
                                                    label="Slug(leave empty)"
                                                     outlined 
													dense
                                                ></v-text-field>
												<v-text-field 
                                                    v-model="editedItem.link" 
                                                    label="Link"
                                                     outlined 
													 dense
                                                ></v-text-field>
												<v-text-field 
                                                    v-model="editedItem.sort" 
                                                    label="Sort"
                                                     outlined 
													 dense
													 hide-details
                                                ></v-text-field>
											  </v-form>
										</v-layout>
									</v-container>
								</v-card-text>

								<v-card-actions>
									<v-spacer></v-spacer>
									<v-btn color="error" text @click="close">Cancel</v-btn>
									<v-btn
										color="primary"
										:loading="loading"
										:disabled="loading"
										text
										@click="save"
									>Save</v-btn>
								</v-card-actions>
							</v-card>
						</v-dialog>
		</v-container>
			<v-snackbar
        v-model="snackbar"
        :vertical="snackvertical"
        :timeout="snacktimeout"
        :top="snacktop"
        :right="snackright"
        :color="snackcolor"
      >
        {{ snacktext }}
       <template v-slot:action="{ attrs }">
        <v-btn dark text v-bind="attrs" @click="snackbar = false" > Close</v-btn>
         </template>
      </v-snackbar>
	</v-main>
</template>

<script>
import DeleteModal from "./../../common/DeleteModal";
import NoDataList from "./../../common/NoDataList"
import Breadcrumbs from "./../../common/Breadcrumbs"
import ToolbarLeft from "./../../common/ToolbarLeft"
import TextField from "./../../common/TextField"
export default {
	components: {
		DeleteModal,
		NoDataList,
        ToolbarLeft,
        Breadcrumbs,
		TextField
	},
	data: () => ({
		isImage:false,
		search: "",
		itemsPerPage:1,
        pageCount:2,
		absolute: true,
		loading: false,
		edit: true,
		dialog: false,
        dataList: [],
		dataCategory:[],
		headers: 
		[

			{ text: "ID", value: "id" },
			{ text: "Title", value: "title" },
			{ text: "Sort", value: "sort" },
			{ text: "Status", value: "status" },
			{ text: "Action", value: "action" }
		],
		editedIndex: -1,
		editedItem: 
		{
			title: "",
			description: "",
            parent_id: 1,
            sort: "",
            link: "",
            image_id: "",
            slug: "",
            deleted_at: "",
			status: 1,
		},
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete:false,
		defaultItem: 
		{
			title: "",
			description: "",
            parent_id: 1,
            sort: "",
            link: "",
            image_id: "",
            slug: "",
            deleted_at: "",
			status: 1,
		},
		dataStatus: 
		[
			{ name: "Active", value: 1 },
			{ name: "Disable", value: 0 }
		],
		filters:
        {
            show:20,
			page:1,
			parent_id:'',
			search:''
        },
		editorConfig: {
                    allowedContent:true,
					copyFormatting_allowRules: true,
                    extraPlugins: ['bidi','justify'],
					contentsLangDirection : 'ltr',
                },	
	}),

	props: 
	{
		source: String
	},

	computed: 
	{
		formTitle() 
		{
			return this.editedIndex === -1 ? "New Category" : "Edit Category";
		}
	},
	
	watch: {},

	created() 
	{
		this.initialize();
	},
	
	methods: {
		async changeStatus(i)
		{
			this.loading = true;
			try 
			{
				let { data } = await axios({
					method: "get",
					url: "/app/category/"+i.id+"/edit",
					params:{
						status: i.status
					},
				});
				if (data.status) 
				{
					this.snacks("Successfully Changed", "green");
					this.close();
				} 
				else 
				{
					this.snacks("Failed", "red");
					this.loading = false;
				}
			} 
			catch (e) 
			{
				this.snacks("Error, Server issue", "red");
				this.loading = false;
			}


		},
		
		

		async initialize() 
		{
			this.getCategory();    
			this.getAllCategory();        

		},

		async getCategory()
		{
			this.start();
			try 
			{
				let { data } = await axios({
					method: "get",
					url: "/app/category",
				 params: this.filters
				});
				this.dataList = data.data;
                this.itemsPerPage=data.per_page;
                this.pageCount=data.last_page;
                this.filters.page=data.current_page
			} 
			catch (e) 
			{
				this.fail();
			}
			finally
			{
				this.finish();
			}
		},

		async getAllCategory()
		{
			let { data } = await axios({
					method: "get",
					url: "/app/allcategory",
				});
				this.dataCategory = data.data;
		},

		editItem(item) 
		{
			this.edit = false;
			this.editedIndex = this.dataList.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.dialog = true;
		},

		deleteItem(item) 
		{
			this.dataIndex = this.dataList.indexOf(item);
			this.deleteTitle = "Are you sure you want to delete this item?";
			this.isDelete = !this.isDelete;
		},

		close() 
		{
			this.dialog = false;
			this.loading = false;
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = -1;
			}, 300);
		},
		async save() 
		{
			 
			this.loading = true;
			if (this.editedIndex > -1) 
			{
				try 
				{
					let { data } = await axios({
						method: "put",
						url: "/app/category/" + this.editedItem.id,
						data: this.editedItem
					});
					if (data.status) 
					{
						this.snacks("Successfully Added", "green");
						Object.assign(this.dataList[this.editedIndex], this.editedItem);
						this.close();
					} 
					else 
					{
						this.snacks("Failed", "red");
						this.loading = false;
					}
				} 
				catch (e) 
				{
					this.snacks("Failed", "red");
					this.loading = false;
				}
			} 
			else 
			{
				try 
				{
					console.log(this.editedItem)
					let { data } = await axios({
						method: "post",
						url: "/app/category",
						data: this.editedItem
					});
					if (data.status) 
					{
						this.dataList.unshift(data.data);
						this.snacks("Successfully Added", "green");
						this.close();
					} 
					else 
					{
						this.snacks("Failed", "red");
						this.loading = false;
					}
				} catch (e) {
					this.snacks("Failed", "red");
					this.loading = false;
				}
			}
		},

		async remove() 
		{
			this.loading=true;
			try {
				let { data } = await axios({
					method: "delete",
					url: "/app/category/" + this.dataList[this.dataIndex].id
				});
				if (data.status) {
					this.snacks('Successfully Done','green')
					this.dataList.splice(this.dataIndex, 1);
					this.close();				
				}
				else
				{
					this.snacks(data.data,'red')
					this.loading = false;
				}

			} catch (e) {
				this.snacks('Operation Failed','red')
				this.loading = false;
			}
		}
	}
};
</script>