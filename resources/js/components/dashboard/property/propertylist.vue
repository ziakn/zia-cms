<template>
	<v-main>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
		
  
			<v-row justify="center" >
				<v-col sm="12" md="12" lg="11" >
				<v-row>
					<v-col cols="6" lg="12">
							<v-text-field
								v-model="search"
								append-icon="search"
								label="Search"
								single-line
								hide-details
								filled
								clearable
							></v-text-field>
					</v-col>
					</v-row>
					<button right v-on:click="show = !show">
						<a>Advance Search</a>
					</button>
			  <transition name="fade">
					<v-row v-if="show">
                        <v-col lg="4" >
							<v-text-field
								v-model="filterValue.id"
								label="Reference ID"
								filled
								@change="filterDataItem"
								clearable
							></v-text-field>
						</v-col>
						<v-col lg="4">
							<v-select
								v-model="filterValue.rent_sale"
								:items="dataTypeOne"
								item-text="name"
								item-value="value"
								label="Rent/Sale"
								required
								filled
								@change="filterDataItem"
								clearable
							></v-select>
						</v-col>
						<v-col lg="4">
							<v-select
								v-model="filterValue.residential_commercial"
								:items="dataTypeTwo"
								item-text="name"
								item-value="value"
								label="Commercial/Residential"
								required
								filled
								@change="filterDataItem"
								clearable
							></v-select>
						</v-col>
						<v-col lg="6">
							<v-select
								v-model="filterValue.location"
								:items="dataTypeTwo"
								item-text="name"
								item-value="value"
								label="Location"
								required
								filled
								@change="filterDataItem"
								clearable
							></v-select>
						</v-col>
						<v-col lg="6">
							<v-select
								v-model="filterValue.category_id"
								:items="dataCategory"
								item-text="name"
								item-value="id"
								label="Property Type"
								required
								filled
								@change="filterDataItem"
								clearable
							></v-select>
						</v-col>						

					</v-row>
					  </transition>
					<v-toolbar flat color="white">
						<v-toolbar-title>Property List</v-toolbar-title>
						<v-divider class="mx-2" inset vertical></v-divider>
						<v-spacer></v-spacer>
						<v-dialog v-model="dialog" max-width="500px">
							<v-card>
								<v-card-title>
									<span class="subtitle-1">{{ formTitle }}</span>
								</v-card-title>
								<v-card-text>
									<v-container grid-list-md>
										<v-layout wrap>
											<v-flex xs12 sm12 md12>
												<v-select
													v-model="editedItem.rent_sale"
													:items="dataTypeOne"
													item-text="name"
													item-value="value"
													label="Rent/Sale"
													required
													filled
												></v-select>
											</v-flex>
											<v-flex xs12 sm12 md12>
												<v-select
													v-model="editedItem.residential_commercial"
													:items="dataTypeTwo"
													item-text="name"
													item-value="value"
													label="Commercial/Residential"
													required
													filled
												></v-select>
											</v-flex>	
											<v-flex xs12 sm12 md12>
												<v-text-field
													v-model="editedItem.name"
													label="Category Name"
													:rules="[v => !!v || 'User type is required']"
													required
													filled
												></v-text-field>
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
					</v-toolbar>
					<List :dataProperty="dataList" :search="search" >
						
					</List>
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
		<v-btn bottom color="blue darken-3" dark fab fixed right :to="handleGoToMenu('/dashboard/addproperty/')">
			<v-icon>mdi-plus</v-icon>
		</v-btn>
		
	</v-main>
</template>

<script>
import List from './List'
export default {
	components: {
		List
	},
	data: () => ({
		show: false,
		absolute: true,
		loading:false,
		search: "",
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete: false,
		edit: true,
		dialog: false,
		filterValue:
		{
			id:'',
			rent_sale:'',
			residential_commercial:'',
			location:'',
			category_id:''

		},
		snackBar: {
			text: "",
			color: "red",
			trigger: false
		},
		dataList: [],
		dataCategory:[],
		dataTypeOne:[
			{ name:'Rent', value:'rent' },
			{ name:'Sale', value:'sale' },

		],
		dataTypeTwo:[
			{ name:'Residential', value:'residential' },
			{ name:'Commercial', value:'commercial' },
		],
		headers: [
			{ text: "ID/User", value: "id" },
			{ text: "Title/Location", value: "title" },
			{ text: "Layout/Size", value: "size" },
			{ text: "Type/Offering", value: "category_id" },
			{ text: "Price/Category", value: "price" },
			{ text: "Updated/Listed", value: "updated_at" },
			{ text: "Action", align: "center", value: "action", sortable: false }
		],

		editedIndex: -1,
		editedItem: {
			name: "",
			parent_id: 0
		},
		defaultItem: {}
	}),

	computed: {
		formTitle() {
			return this.editedIndex === -1 ? "New Category" : "Edit Category";
		}
	},
	watch: {},
	created() {
		this.initialize();
	},
	methods: {
		expand(){
			this.isExpand != this.isExpand
		},

      handleGoToMenu(d){
                return d
            },
		async initialize() {
			this.start();
			this.filterDataItem();
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/category"
				});
				this.dataCategory = data;
			} catch (e) {
				this.fail();
			}

			this.finish();
		},
		async filterDataItem()
		{
			try {
				let { data } = await axios({
					method: "post",
					url: "/app/properties",
					data: this.filterValue
				});
				this.dataList = data;
			} catch (e) {
				this.fail();
			}
		},
		editItem(item) {
			this.edit = false;
			this.editedIndex = this.dataList.indexOf(item);
			this.editedItem.name = item.name;
			this.editedItem.parent_id = item.parent_id;
			this.dialog = true;
		},
		deleteItem(item) {
			this.dataIndex = this.dataList.indexOf(item);
			this.deleteTitle = "Are you sure you want to delete this item?";
			this.isDelete = !this.isDelete;
		},
		close() {
			this.dialog = false;
			this.loading = false;
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = -1;
			}, 300);
		},
		async remove() {
			try {
				let { data } = await axios({
					method: "delete",
					url: "/app/property/" + this.dataList[this.dataIndex].id
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
<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

</style>