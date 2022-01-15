<template>
	<v-main >
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
					 filled 
					dense
				></v-text-field>
			</ToolbarLeft>
			<Breadcrumbs/>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="12">
					<v-data-table color="white" :headers="headers" :items="dataList" :search="search"  class="elevation-12" :items-per-page="20" :hide-default-footer="true">>
						
							<template v-slot:[`item.action`]="{ item }">
								<v-icon color="blue"   medium @click="editItem(item)" >edit</v-icon>
							<v-icon color="red" v-if="$can('category-delete')"   medium @click="deleteItem(item)" >delete</v-icon>
						</template>
						<template v-slot:no-data>
							<NoDataList :loading="loading" @initialize="initialize"></NoDataList>
						</template>
					</v-data-table>
					<div class="text-center">
                                <v-pagination
                                v-model="filters.page"
                                :length="pageCount"
                                @input="getRole"
                                ></v-pagination>
                            </div>
				</v-col>
			</v-row>
			<v-btn bottom  color="primary" dark fab fixed right @click="dialog = !dialog">
				<v-icon>mdi-plus</v-icon>
			</v-btn>
		</v-container>
        <v-dialog v-model="dialog" max-width="700px" persistent>
            <v-card>
				<v-card color="secondary" dark :tile="true" flat >
					<v-card-title
					class="headline"
					v-text="formTitle"
					></v-card-title>
         		 </v-card >
                <v-card-title>
                </v-card-title>

                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12 sm12 md12>
                                <v-text-field
                                    v-model="editedItem.name"
                                    label="Role Name*"
                                    :rules="[v => !!v || 'Role Name is required']"
                                    required
                                    filled 
                                    
                                ></v-text-field>
                            </v-flex>
                           
                        </v-layout>
                    </v-container>
                </v-card-text>
				<v-card-text>
               <v-simple-table>
				<template v-slot:default>
				<thead>
					<tr>
					<th class="text-left">
						Page Name
					</th>
					<th class="text-left">
						List
					</th>
					<th class="text-left">
						Create
					</th>
					<th class="text-left">
						Edit
					</th>
					<th class="text-left">
						Delete
					</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(data, index) in dataPermission" :key="index">
						<td>
							<v-checkbox
								v-model="editedItem.permission"
								:label="data.name"
								:value="data.id"
								></v-checkbox>
						</td>
						
					</tr>
					
				</tbody>
				</template>
			</v-simple-table>
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
			<DeleteModal :trigger="isDelete" :title="deleteTitle" :body="deleteBody" @request="remove"></DeleteModal>
	</v-main>
</template>

<script>
import Breadcrumbs from "./../../common/Breadcrumbs"
import ToolbarLeft from "./../../common/ToolbarLeft"
import NoDataList from "./../../common/NoDataList"
import DeleteModal from "./../../common/DeleteModal";
export default {
	components:{ Breadcrumbs, ToolbarLeft, NoDataList,DeleteModal },
	data: () => ({
		search: "",
		absolute: true,
		loading: false,
		singleSelect: false,
		edit: true,
		dialog: false,
		dataList: [],
		dataPermission: [],
		rolePermissions:[],
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete: false,
        itemsPerPage:1,
		pageCount:2,
	 	filters:
        {
			page: 1,
			show: 20,
        },
		headers: 
		[
			{ text: "ID", align: "left", value: "id" },
			{ text: "Name", value: "name" },
			{ text: "Action", value: "action" }
		],
		pageHeaders: 
		[
			{ text: "ID", align: "left", value: "id" },
			{ text: "Name", value: "name" },
			{ text: "Action", value: "action" }
		],

		editedIndex: -1,
		editedItem: 
		{
			name: "",
			id:"",
			permission: [],
			rolePermissions:[],
		},

		defaultItem: 
		{
			name: "",
			id:"",
			permission: [],
			rolePermissions:[],
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
			return this.editedIndex === -1 ? "New Role" : "Edit Role";
		}
	},
	watch: {},

	created() 
	{
		this.initialize();
		this.getPermission();
	},

	methods: {
		async initialize() 
		{
			this.getRole();
			this.getPage();
		},

		async getPage()
		{
			this.start();
			try 
			{
				let { data } = await axios({
					method: "get",
					url: "/app/page",
				});
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

		async getRole()
		{
			this.start();
			try 
			{
				let { data } = await axios({
					method: "get",
					url: "/app/roles",
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

		async getPermission()
		{
			try 
			{
				let { data } = await axios({
					method: "get",
					url: "/app/permission",
				});
				this.dataPermission = data;
				
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
			this.editedItem.name = item.name;
			this.editedItem.id = item.id;
			this.getRoleValues(item);
			this.dialog = true;
		},


		async getRoleValues(item)
		{
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/roles/"+item.id+"/edit",
				
				});
				 this.editedItem.permission =  Object.values(data.rolePermissions);
				
			} 
			catch (e) 
			{
				console.log(e);
			}
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
				this.getPage();
				this.editedIndex = -1;
			}, 300);
		},
		
		

		async save() 
		{
			if (!this.editedItem.name ) 
			 {
				return true
			 }
			this.loading = true;
			if (this.editedIndex > -1) 
			{
				try 
				{
					let { data } = await axios({
						method: "put",
						url: "/app/roles/" + this.editedItem.id,
						data: this.editedItem
					});
					if (data.status) 
					{
						this.snacks("Successfully Added", "green");
						Object.assign(this.dataList[this.editedIndex], data.data);
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
						url: "/app/roles",
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
				} 
				catch (e) 
				{
					this.snacks("Failed", "red");
					this.loading = false;
				}
			}
		},
		async remove() {
			try {
				let { data } = await axios({
				method: "delete",
				url: "/app/roles/" + this.dataList[this.dataIndex].id
				});
				if (data.status) {
					this.snacks('Successfully Done','green')
					this.dataList.splice(this.dataIndex, 1);
					this.close();				
				}
				else
				{
					this.snacks(data.data,'yellow darken-4')
					this.loading = false;
				}
			} catch (e) {
				this.snacks('Operation Failed','red')

			}
		}
	}
};
</script>