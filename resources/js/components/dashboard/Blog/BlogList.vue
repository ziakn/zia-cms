<template>
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
			<v-row justify="center">
				<v-col sm="12" md="12" lg="12">
					<v-data-table  :headers="headers" :items="dataList" :search="search" class="elevation-12" :items-per-page="20" :hide-default-footer="true">>
						<template v-slot:[`item.image`]="{ item }">
							<v-img
								:src="item.image?item.image:'/no_image.png'"
								lazy-src="no_image.png"
								aspect-ratio="1"
								class="grey lighten-2"
								width="80"
								height="80"
							></v-img>
						</template>
							<template v-slot:[`item.category_id`]="{ item }">
                                   {{item.category.title}}
                            </template>
						  <template v-slot:[`item.status`]="{ item }">
                                    <v-switch v-model="item.status" @change="changeStatus(item)" color="primary" inset></v-switch>
                                </template>
						<template v-slot:[`item.action`]="{ item }">
							<v-icon color="blue"  medium @click="editItem(item)" >edit</v-icon>
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
                                @input="getBlog"
                        ></v-pagination>
                    </div>
				</v-col>
			</v-row>
			<DeleteModal :trigger="isDelete" :title="deleteTitle" :body="deleteBody" @request="remove"></DeleteModal>
			<router-link  to="/blog/add">
				<v-btn bottom color="primary" dark fab fixed right>
				<v-icon>add</v-icon>
			</v-btn>
			</router-link>
			
           
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
import ImageModule from "./../../common/ImageModule"
import Breadcrumbs from "./../../common/Breadcrumbs"
import ToolbarLeft from "./../../common/ToolbarLeft"
export default {
	components: {
		DeleteModal,
		NoDataList,
        ImageModule,
        ToolbarLeft,
        Breadcrumbs
	},
	data: () => ({
		isImage:false,
		search: "",
		itemsPerPage:1,
        pageCount:2,
		absolute: true,
		loading: false,
		edit: true,
        dataList: [],
		dataCategory: [],
		headers: 
		[

			{ text: "Image", value: "image" },
			{ text: "Title", value: "title" },
			{ text: "Category", value: "category_id" },
			// { text: "Description", value: "description" },
			{ text: "Viewed", value: "viewed" },
			{ text: "Liked", value: "liked" },
			{ text: "Status", value: "status" },
			{ text: "Action", value: "action" }
		],
		editedIndex: -1,
		editedItem: 
		{
			title: "",
            description: "",
            viewed:"",
            liked:"",
			image:"",
			status: 1,
			meta_title: "",
            meta_tag: "",
            meta_description: "",
			category_id: "",

		},
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete:false,
		defaultItem: 
		{
			title: "",
            description: "",
            viewed:"",
            liked:"",
			image:"",
			status: 1,
			meta_title: "",
            meta_tag: "",
            meta_description: "",
			category_id: "",
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
			return this.editedIndex === -1 ? "New  Blog" : "Edit  Blog";
		}
	},
	
	watch: {},

	created() 
	{
		this.initialize();
	},
	
	methods: {

		titlemonitor()
        {   
            return this.editedItem.meta_title=this.editedItem.title
        },
        descriptionmonitor()
        {
            return this.editedItem.meta_description=this.editedItem.description
        },
		async changeStatus(i)
		{
			this.loading = true;
			try 
			{
				let { data } = await axios({
					method: "get",
					url: "/app/blog/"+i.id+"/edit",
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
		cancel()
		{
			this.isImage=!this.isImage;

		},
		receiveImage(item)
		{
			this.isImage=!this.isImage;
			this.editedItem.image=item.src
		},

		async initialize() 
		{
			try 
			{
				let { data } = await axios({
					method: "get",
					url: "/app/category",
				});
				this.dataCategory=data
				
			} 
			catch (e) 
			{
				this.snacks("Error, Server issue", "red");
				this.loading = false;
			}
			this.getBlog();        
		},

		async getBlog()
		{
			this.start();
			try 
			{
				let { data } = await axios({
					method: "get",
					url: "/app/blog",
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

		editItem(item) 
		{
			this.edit = false;
			this.editedIndex = this.dataList.indexOf(item);
			this.editedItem = Object.assign({}, item);
		},

		deleteItem(item) 
		{
			this.dataIndex = this.dataList.indexOf(item);
			this.deleteTitle = "Are you sure you want to delete this item?";
			this.isDelete = !this.isDelete;
		},

		close() 
		{
			this.loading = false;
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = -1;
			}, 300);
		},
		async save() 
		{
			 if (!this.editedItem.title || !this.editedItem.description ) 
			 {
				return
			 }
			this.loading = true;
			if (this.editedIndex > -1) 
			{
				try 
				{
					let { data } = await axios({
						method: "put",
						url: "/app/blog/" + this.editedItem.id,
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
					
					let { data } = await axios({
						method: "post",
						url: "/app/blog",
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
					url: "/app/blog/" + this.dataList[this.dataIndex].id
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