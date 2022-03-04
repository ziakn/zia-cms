<template>
	<v-content>
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
				

						<v-dialog v-model="dialog" max-width="500px">
							<v-card>
								<v-card-title>
									<span class="subtitle-1">{{ formTitle }}</span>
								</v-card-title>

								<v-card-text>
									<v-container grid-list-md>
										<v-layout wrap>
											<v-flex xs12 sm12 md12>
												<v-text-field
													v-model="editedItem.title"
													label="Title"
													:rules="[v => !!v || 'Amenity is required']"
													required
													filled
												></v-text-field>
											</v-flex>
											<v-flex xs12 sm12 md12>
												<v-text-field
													v-model="editedItem.icon"
													label="Icon Code"
													:rules="[v => !!v || 'Icon is required']"
													required
													filled
												></v-text-field>
												<a href="https://fontawesome.com/icons" target="_blank">Font-Awesome Icon List</a>
											</v-flex>
										</v-layout>
									</v-container>
								</v-card-text>

								<v-card-actions>
									<v-spacer></v-spacer>
									<v-btn text color="error" @click="close">Cancel</v-btn>
									<v-btn  :loading="loading" :disabled="loading" text color="primary" @click="save">Save</v-btn>
								</v-card-actions>
							</v-card>
						</v-dialog>
					<v-data-table :headers="headers" :items="dataList" :search="search" class="elevation-12" :items-per-page="20" :hide-default-footer="true">
						<template v-slot:[`item.icon`]="{ item }">
							<v-icon small >{{item.icon}}</v-icon>
						</template>
						<template v-slot:[`item.action`]="{ item }">
								<v-icon color="blue"   medium @click="editItem(item)" >edit</v-icon>
							<v-icon color="red"  medium @click="deleteItem(item)" >delete</v-icon>
						</template>
                        	<template v-slot:no-data>
							<NoDataList :loading="loading" @initialize="initialize"></NoDataList>
						</template>
					</v-data-table >
				</v-col>

			</v-row>
		</v-container>
		<v-snackbar
			v-model="snackbar"
			:vertical="snackvertical"
			:timeout="snacktimeout"
			:top="snacktop"
			:color="snackcolor"
			>
			{{ snacktext }}
			<v-btn
				color="white"
				text
				@click="snackbar = false"
			>
				Close
      		</v-btn>
    	</v-snackbar>
		<DeleteModal :trigger="isDelete" :title="deleteTitle" :body="deleteBody" @request="remove"></DeleteModal>
		<v-btn bottom color="blue darken-3" dark fab fixed right @click="dialog = !dialog">
			<v-icon>mdi-plus</v-icon>
		</v-btn>
	</v-content>
</template>

<script>
import DeleteModal from "./../../common/DeleteModal";
import Breadcrumbs from "./../../common/Breadcrumbs"
import NoDataList from "./../../common/NoDataList"
import ToolbarLeft from "./../../common/ToolbarLeft"
export default {
	components: {
		DeleteModal,
        NoDataList,
        ToolbarLeft,
        Breadcrumbs,
	},
	data: () => ({
		absolute: true,
		loading:false,
		search: "",
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete: false,
		edit: true,
		dialog: false,
		snackBar: {
			text: "",
			color: "red",
			trigger: false
		},
		dataList: [],
		dataParent: [],
		headers: [
			{ text: "ID", value: "id" },
			{ text: "Name", value: "title" },
			{ text: "Icon", value: "icon" },
			{ text: "Action", align: "center", value: "action", sortable: false }
		],

		editedIndex: -1,
		editedItem: {
			title: "",
			icon: ""
		},
		defaultItem: {
			title: "",
			icon: ""
		}
	}),

	computed: {
		formTitle() {
			return this.editedIndex === -1 ? "New Amenity" : "Edit Amenity";
		}
	},
	watch: {},
	created() {
		this.initialize();
	},
	methods: {

		async initialize() {
			this.start();
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/amenity"
				});
				this.dataList = data.data;
			} catch (e) {
				this.fail();
			}
			this.finish();
		},
		editItem(item) {
			this.edit = false;
		    this.editedIndex = this.dataList.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.dialog = true;
		},
		deleteItem(item) {
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
		async save() {
			this.loading = true;
			if (this.editedIndex > -1) 
			{
				try 
				{
					let { data } = await axios({
						method: "put",
						url: "/app/amenity/" + this.editedItem.id,
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
						url: "/app/amenity",
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
		async remove() {
			try {
				let { data } = await axios({
					method: "delete",
					url: "/app/amenity/" + this.dataList[this.dataIndex].id
				});
				this.snacks('Successfully Done','Green')
				this.dataList.splice(this.dataIndex, 1);
				this.close();

			} catch (e) {
				this.snacks('Operation Failed','Red')

			}
		}
	}
};
</script>