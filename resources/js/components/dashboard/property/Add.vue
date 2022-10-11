<template>
	<v-main>
		
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="12" >
					
					<v-tabs
					v-model="tab"
					background-color="blue darken-1"
					centered
					dark
					grow
					>
					<v-tabs-slider></v-tabs-slider>
					<v-tab href="#tab-1">
						Propery Details
					</v-tab>

					<v-tab href="#tab-2">
						Media
					</v-tab>
<!-- 
					<v-tab href="#tab-3">
						Location
					</v-tab>
					<v-tab href="#tab-4">
						Documents
					</v-tab>
					<v-tab href="#tab-5">
						Transactions
					</v-tab>
					<v-tab href="#tab-6">
						SEO
					</v-tab> -->
					</v-tabs>

					<v-tabs-items v-model="tab">
						<v-tab-item
							value="tab-1"
						>
							<v-card  class="mt-5">
								<v-card-title> 
									<v-icon large left color="blue" >
										assignment
									</v-icon>
									<span class="title font-weight-light" >Type</span>
								</v-card-title>
							<v-card-text>
								<v-row justify="center">
									<v-col sm="12" md="5" lg="5" >
            							<SelectCard :dataOne="dataSelect[0]" :dataTwo="dataSelect[1]" @send="typeOne"></SelectCard>							
									</v-col>
										<v-divider
										class="mx-4"
										inset
										vertical
										></v-divider>
									<v-col sm="12" md="5" lg="5" >
            							<SelectCard :dataOne="dataSelect[2]" :dataTwo="dataSelect[3]" @send="typeTwo"></SelectCard>							
									</v-col>
								</v-row>

							</v-card-text>
							</v-card>
							<v-card  class="mt-5">
								<v-card-title> 
									<v-icon large left color="blue" >
										dashboard
									</v-icon>
									<span class="title font-weight-light">Specification</span>
								</v-card-title>
								<v-card-text>
									<v-row justify="center">
										<!-- <v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.postplan_id"
												:items="dataPostPlan"
												item-text="name"
												item-value="id"
												:rules="[v => !!v || 'Post Plan is required']"
												label="Post Plan*"
												
												filled
											></v-select>
										</v-col> -->
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.category_id"
												:items="dataCategory"
												item-text="title"
												item-value="id"
												:rules="[v => !!v || 'Property Type is required']"
												label="Property Type*"
												
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="editedItem.size"
													:rules="[v => !!v || 'Size is required']"
													label="Size*"
													:messages="sizeSQM(editedItem.size)"
													suffix="SQM"
													type="number"						
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.room"
												:items="dataBedRoom"
												item-value="value"
												item-text="name"
												label="No. of Bedrooms"
												
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.bathroom"
												:items="dataBathroom"
																						
												label="No. of Washroom"
												
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.toilet"
												:items="dataBathroom"
																					
												label="No. of Toilet"
												
												filled
											></v-select>
										</v-col>	
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="editedItem.parking_space"
													label="No. of Parking Space"
													type="number"						
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.furnish_type"
												:items="dataFurnished"
												label="Furnished Type"
												item-value="value"
												item-text="name"												
												
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="editedItem.developer"
													label="Property Developer"
													
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.tenure"
												:items="dataTenure"
												label="Tenure of Property"
												
												item-value="value"
												item-text="name"																								
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="editedItem.year"
													label="Build Year"
													:counter="4"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="editedItem.plot_size"
													label="Total Plot Size"
													:messages="sizeSQM(editedItem.plot_size)"
													suffix="SQM"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="editedItem.plot_number"
													label="Plot Number"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="editedItem.buildup_area"
													label="Buildup Area"
													:messages="sizeSQM(editedItem.buildup_area)"
													suffix="SQM"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="editedItem.floors"
													label="Building Floor"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="editedItem.floor_number"
													label="Floor Number"
													messages="TH"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.occupancy"
												:items="dataOccupancy"
												label="Occupancy"
												
												item-value="value"
												item-text="name"												
												filled
											></v-select>
										</v-col>											
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.property_status"
												:items="dataProjectStatus"
												label="Project Status"
												
												item-value="value"
												item-text="name"												
												filled
											></v-select>
										</v-col>																			
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.renovation"
												:items="dataRenovation"
												label="Renovation Type"
												
												item-value="value"
												item-text="name"												
												filled
											></v-select>
										</v-col>
									</v-row>
								</v-card-text>
							</v-card>
							<v-card  class="mt-5">
								<v-card-title> 
									<v-icon large left color="blue">
										attach_money
									</v-icon>
									<span class="title font-weight-light">Price</span>
								</v-card-title>
							<v-card-text>
								<v-row justify="center">
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="editedItem.price"
													:rules="[v => !!v || 'Price required']"
													label="Price*"
													type="number"
													suffix="QAR"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.price_rent_type"
												:items="dataRentType"
												label="Rent Type"
												
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="editedItem.service_charges"
													label="Service Charges"
													messages="Monthly"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.cheque"
												:items="dataCheque"
												label="Cheques"
												
												filled
											></v-select>
										</v-col>											
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="editedItem.financial_status"
												:items="dataFinancialStatus"
												label="Financial Status"
												
												item-value="value"
												item-text="name"												
												filled
												
											></v-select>
										</v-col>				
								</v-row>
							</v-card-text>
							</v-card>
							<v-card  class="mt-5">
								<v-card-title> 
									<v-icon large left color="blue">
										description
									</v-icon>
									<span class="title font-weight-light">Description</span>
								</v-card-title>
							<v-card-text>
								<v-row justify="center">
										<v-col sm="12" md="12" lg="8" >
											<v-text-field
													v-model="editedItem.title"
													:rules="[v => !!v || 'Title required',
													v => v.length<=200 || '200 Charecter crossed']"
													label="Title*"
													
													filled
													counter
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="8" >
											<v-textarea
												v-model="editedItem.description"
												filled
												:rules="[v => !!v || 'Description is required']"
												label="Description*"
												counter
												></v-textarea>
										</v-col>
				
								</v-row>
							</v-card-text>
							</v-card>
							<v-card  class="mt-5">
								<v-card-title> 
									<v-icon large left color="blue">
										style
									</v-icon>
									<span class="title font-weight-light">Amenities</span>
								</v-card-title>
							<v-card-text>
								<v-row justify="center">
									<v-col sm="12" md="12" lg="12" >
										<v-combobox
											v-model="editedItem.amenities"
											:items="dataAmenities"
											label="Amenities"
											item-text="title"
											return-object
											multiple
											chips
											filled
										></v-combobox>
									</v-col>
								</v-row>
							</v-card-text>
							</v-card>
							<v-card  class="mt-5">
								<v-card-title> 
									<v-icon large left color="blue">
										event
									</v-icon>
									<span class="title font-weight-light">Availability</span>
								</v-card-title>
							<v-card-text>
								<v-row justify="center">
									<v-col sm="12" md="12" lg="6" >
										<v-select
												v-model="editedItem.availability"
												:items="dataAvailability"
												label="Availability"
												
												item-value="value"
												item-text="name"												
												filled
											></v-select>
									</v-col>
									<v-col sm="12" md="12" lg="6" >
										<v-menu
											v-model="menu2"
											:close-on-content-click="false"
											:nudge-right="40"
											transition="scale-transition"
											offset-y
											min-width="290px"
										>
											<template v-slot:activator="{ on }">
											<v-text-field
												v-model="editedItem.availability_date"
												label="Picker without buttons"
												prepend-icon="event"
												readonly
												filled
												v-on="on"
											></v-text-field>
											</template>
											<v-date-picker v-model="editedItem.availability_date" @input="menu2 = false"></v-date-picker>
										</v-menu>
									</v-col>
								</v-row>
							</v-card-text>
							</v-card>
						</v-tab-item>
						<v-tab-item value="tab-2">
							<Media @send="mediaValue"></Media>
						</v-tab-item>
						 <v-tab-item value="tab-3">
							<Location @send="locationValue"></Location>
						</v-tab-item>
					<!--	<v-tab-item value="tab-4">
							<Doc @send="docValue"></Doc>
						</v-tab-item>
						<v-tab-item value="tab-5">
							<Transaction @send="transactionValue" :price="editedItem.price"></Transaction>
						</v-tab-item>
						<v-tab-item value="tab-6">
							<SEO :editedItem="editedItem" ></SEO>
						</v-tab-item> -->
					</v-tabs-items>

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
		<v-btn bottom color="success" dark fab fixed large right  @click="addData" >
			<v-icon>check</v-icon>
		</v-btn>
	</v-main>
</template>

<script>
import SEO from './SEO'
import Doc from './Doc'
import Media from './Media'
import Location from './Location'
import SelectCard from './SelectCard'
import Transaction from './Transaction'

export default {
	components: {
		SelectCard,
		Media,
		Location,
		Doc,
		Transaction,
		SEO
	},
	data: () => ({
		menu2: false,
		editedItem:
		{
			category_id:'',
			residential_commercial:'residential',
			rent_sale:'rent',
			title:'',
			description:'',
			availability_date: new Date().toISOString().substr(0, 10),
			year:'',
			price:0,
			size:0,
			toilet:0,
			room:0,
			bathroom:0,
			parking_space:0,
			furnish_type:0,
			developer:null,
			tenure:null,
			plot_size:0,
			plot_number:0,
			buildup_area:0,
			floors:null,
			floor_number:null,
			occupancy:null,
			property_status:null,
			renovation:null,
			price:0,
			price_rent_type:null,
			service_charges:0,
			cheque:null,
			financial_status:null,
			amenities:[],
			availability:'',
			meta_keyword:'',
			meta_description:'',
			meta_title:'',
			banner:[],
		},
		dataAmenities:[],
		
		select: ['Vuetify', 'Programming'],
		
		dataBedRoom:[
			{name:'Studio', value:'studio'},
			{name:'1', value:'1'},{name:'2', value:'2'},{name:'3', value:'3'},{name:'4', value:'4'},{name:'5', value:'5'},
			{name:'6', value:'6'},{name:'7', value:'7'},{name:'8', value:'8'},{name:'9', value:'9'},{name:'10', value:'10'},
			{name:'11', value:'11'},{name:'12', value:'12'},{name:'13', value:'13'},{name:'14', value:'14'},{name:'15', value:'15'},
		],
		dataBathroom:[
			1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,20
		],
		dataFurnished:[
			'Furnished', 'Un-Furnished', 'Semi-Furnished'
		],
		dataRentType:[
			'Daily', 'Weekly', 'Monthly','Yearly'
		],
		dataTenure2:[
			'1 Month', '3 Months', '6 Months',
			'1 Year', '2 Year', '3 Year'
		],
		dataTenure:[
			'Freehold', 'Non-Freehold'
		],
		dataCategory:[],
		dataOccupancy:[
			{name:'Owner Occupied', value:'owner'},
			{name:'Investment', value:'investment'},
			{name:'Vacant', value:'vacant'},
			{name:'Tenanted', value:'tenanted'},

		],
		dataProjectStatus:[
			{name:'Completed', value:'completed'},
			{name:'Off-Plan', value:'offplan'},
		],
		dataRenovation:[
			{name:'Fully Upgraded', value:'fully'},
			{name:'Partially Upgraded', value:'partially'},
		],
		dataCheque:[1,2,3,4,5,6,7,8,9,10,11,12],
		dataFinancialStatus:[
			{name:'Mortgaged', value:'mortgaged'},
			{name:'Cash', value:'cash'},

		],
		dataSelect:
		[
			{
				title:'Residential',
				src: '/png/005-cottage.png',
			},
			{
				title:'Commercial',
				src: '/png/006-apartments.png',
			},
			{
				title:'Rent',
				 src: '/png/004-for-rent.png',
			},
			{
				title:'Sell',
				src: '/png/003-house.png',
			},
		],
		dataAvailability:[
			{name:'Available', value:'available'},
			{name:'Under Offer', value:'under-offer'},
			{name:'Reserved', value:'reserved'},
			{name:'Sold', value:'sold'},

		],
			
        absolute: true,
		loading: false,
		editedIndex:null,
		tab: null,
		// dataPostPlan:[],
		selected: [],
		floor_plan:[],
		media:[],
		document:[],
		amenities:[],
		video:{},
		three:{},
      
		
	}),

	computed: {

		accept()
		{
			if(this.editedItem.size && this.editedItem.title && this.editedItem.description &&this.editedItem.postplan_id
				 && this.editedItem.category_id && this.editedItem.price && this.editedItem.property_location 
			)
			return true
			else
			return false
		},
		formTitle() {
			return this.editedIndex === -1 ? "New Category" : "Edit Category";
		},
		filterCategory()
            {
                return this.dataCategory.filter((data)=>{
                    
					return data.residential_commercial.toUpperCase().match(this.editedItem.residential_commercial.toUpperCase()) 
					&& data.rent_sale.toUpperCase().match(this.editedItem.rent_sale.toUpperCase());
                }
                );
            },
	},
	watch: {
		'editedItem.title': function (data)
		{
			this.editedItem.meta_title=data
		},
		'editedItem.description': function (data)
		{
			this.editedItem.meta_description=data
		},
	},
	created() {
		this.initialize();
	},
	methods: {
		sizeSQM(value=0)
		{
			var data=0
			if(value)
			data=value*10.7639;
			data=data.toFixed(0);
			return data+' SQFT';
		},
		// transactionValue(item)
		// {
		// 	this.editedItem.from_owner_commission=item.from_owner_commission;
		// 	this.editedItem.from_tenant_commission=item.from_tenant_commission;
		// 	this.editedItem.total_commission=item.total_commission;
		// },		
		// seoValue(item)
		// {
		// 	this.editedItem.meta_description=item.meta_description;
		// 	this.editedItem.meta_title=item.meta_title;
		// 	this.editedItem.meta_keyword=item.meta_keyword;
		// },
		// docValue(item)
		// {
		// 	this.document=item;
		// },
		// locationValue(item)
		// {
		// 	this.editedItem.property_location=item.property_location;
		// 	this.editedItem.place_id=item.place_id;
			
		// 	this.editedItem.project_name=item.project_name;
		// 	this.editedItem.street_name=item.street_name;
		// 	this.editedItem.street_no=item.street_no;
		// 	this.editedItem.unit_no=item.unit_no;
		// 	this.floor_plan=item.floor_plan;
		// },
		mediaValue(item)
		{
			console.log(item);
			this.editedItem.banner=[...item.bannerId];
		},
		// videoValue(item)
		// {
		// 	this.video=item;
		// },
		// threeValue(item)
		// {
		// 	this.three=item;
		// },
		async initialize() {
			this.loading = true;
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/category"
				});
				this.dataCategory = data.data;
			} catch (e) {
				this.fail();
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/amenity"
				});
				this.dataAmenities = data.data;
			} catch (e) {
				this.fail();
			}
			// try {
			// 	let { data } = await axios({
			// 		method: "get",
			// 		url: "/app/postplan"
			// 	});
			// 	this.dataPostPlan = data;
			// } catch (e) {
			// 	this.fail();
			// }
			this.loading = false;
		},
		typeOne(value)
		{
			if(value==1)
			this.editedItem.residential_commercial='residential';
			else
			this.editedItem.residential_commercial= 'commercial';
		},
		typeTwo(value)
		{
			if(value==1)
			this.editedItem.rent_sale='rent';
			else
			this.editedItem.rent_sale= 'sale';

		},
		async addData()
		{
			console.log(this.media);
			this.loading = true;
			      const formData = new FormData();
					this.amenities.forEach(file => {
						formData.append("amenities[]", JSON.stringify(file));
					});
					this.floor_plan.forEach(file => {
						formData.append("floor_plan[]", file, file.name);
					});
					this.document.forEach(file => {
						formData.append("document[]", file, file.name);
					});
					this.media.forEach(file => {
						formData.append("media[]", file, file.name);
					});
					formData.append("three", this.three);
					formData.append("video", this.video);
					for ( var key in this.editedItem ) {
						formData.append(key, this.editedItem[key]);
					}
			try {
				let { data } = await axios({
					method: "post",
					url: "/app/property",
					data: this.editedItem
				});
				this.snacks('Successfully Done','Green')
				this.$router.push('/dashboard/propertylist')
			} catch (e) {
				this.fail();
				this.snacks('Failed','Red')
				
			}
			this.loading = false;

		}
	}
};
</script>