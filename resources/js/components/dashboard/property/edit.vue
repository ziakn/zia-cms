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
					</v-tab>
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
            							<SelectCard :select="formValue.residential_commercial" :dataOne="dataSelect[0]" :dataTwo="dataSelect[1]" @send="typeOne"></SelectCard>							
									</v-col>
										<v-divider
										class="mx-4"
										inset
										vertical
										></v-divider>
									<v-col sm="12" md="5" lg="5" >
            							<SelectCard :select="formValue.rent_sale" :dataOne="dataSelect[2]" :dataTwo="dataSelect[3]" @send="typeTwo"></SelectCard>							
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
                                        <v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.postplan_id"
												:items="dataPostPlan"
												item-text="name"
												item-value="id"
												:rules="[v => !!v || 'Post Plan is required']"
												label="Post Plan*"
												
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.category_id"
												:items="filterCategory"
												item-text="name"
												item-value="id"
												:rules="[v => !!v || 'Property Type is required']"
												label="Property Type*"
												
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="formValue.size"
													:rules="[v => !!v || 'Size is required']"
													label="Size*"
													:messages="sizeSQM"
													suffix="SQM"
													type="number"						
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.room"
												:items="dataBedRoom"
												item-value="value"
												item-text="name"
												label="No. of Bedrooms"
												
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.bathroom"
												:items="dataBathroom"
												
												label="No. of Washroom"
												
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.toilet"
												:items="dataBathroom"
												
												label="No. of Toilet"
												
												filled
											></v-select>
										</v-col>	
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="formValue.parking_space"
													label="No. of Parking Space"
													type="number"						
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.furnish_type"
												:items="dataFurnished"
												label="Furnished Type"
												item-value="value"
												item-text="name"												
												
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="formValue.developer"
													label="Property Developer"
													
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.tenure"
												:items="dataTenure"
												label="Tenure of Property"
												
												item-value="value"
												item-text="name"																								
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="formValue.year"
													label="Build Year"
													:counter="4"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="formValue.plot_size"
													label="Total Plot Size"
													messages="SQM"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="formValue.plot_number"
													label="Plot Number"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="formValue.buildup_area"
													label="Buildup Area"
													messages="SQM"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="formValue.floors"
													label="Building Floor"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="formValue.floor_number"
													label="Floor Number"
													messages="TH"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.occupancy"
												:items="dataOccupancy"
												label="Occupancy"
												
												item-value="value"
												item-text="name"												
												filled
											></v-select>
										</v-col>											
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.property_status"
												:items="dataProjectStatus"
												label="Project Status"
												
												item-value="value"
												item-text="name"												
												filled
											></v-select>
										</v-col>																			
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.renovation"
												:items="dataRenovation"
												label="Renovation Type"
												
												item-value="value"
												item-text="name"												
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="formValue.view"
													label="View"
													
													filled
											></v-text-field>
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
													v-model="formValue.price"
													:rules="[v => !!v || 'Price required']"
													label="Price*"
													type="number"
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.price_rent_type"
												:items="dataRentType"
												:rules="[v => !!v || 'Rent Type is required']"
												label="Rent Type*"
												
												filled
											></v-select>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-text-field
													v-model="formValue.service_charges"
													label="Service Charges"
													messages="Monthly"
													
													filled
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.cheque"
												:items="dataCheque"
												label="Cheques"
												
												filled
											></v-select>
										</v-col>											
										<v-col sm="12" md="12" lg="6" >
											<v-select
												v-model="formValue.financial_status"
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
													v-model="formValue.title"
													:rules="[v => !!v || 'Title required']"
													label="Title*"
													
													filled
													counter
											></v-text-field>
										</v-col>
										<v-col sm="12" md="12" lg="8" >
											<v-textarea
												v-model="formValue.description"
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
											v-model="formValue.amenity"
											:items="dataAmenities"
											label="Amenities"
											item-text="name"
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
												v-model="formValue.availability"
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
											full-width
											min-width="290px"
										>
											<template v-slot:activator="{ on }">
											<v-text-field
												v-model="formValue.availability_date"
												label="Picker without buttons"
												prepend-icon="event"
												readonly
												filled
												v-on="on"
											></v-text-field>
											</template>
											<v-date-picker v-model="formValue.availability_date" @input="menu2 = false"></v-date-picker>
										</v-menu>
									</v-col>
								</v-row>
							</v-card-text>
							</v-card>
							<v-card  class="mt-5">
								<v-card-title> 
									<v-icon large left color="blue">
										check
									</v-icon>
									<span class="title font-weight-light">Status</span>
								</v-card-title>
							<v-card-text>
								<v-row justify="center">
									<v-col sm="12" md="12" lg="6" >
										<v-select
												v-model="formValue.status"
												:items="dataStatus"
												label="Post Status"
												
												item-value="value"
												item-text="name"												
												filled
											></v-select>
									</v-col>
								</v-row>
							</v-card-text>
							</v-card>
						</v-tab-item>
						<v-tab-item value="tab-2">
							<MediaEdit :formValue="formValue"  @files="filesValue" @video="videoValue"  @three="threeValue"></MediaEdit>
						</v-tab-item>
						<v-tab-item value="tab-3">
							<Location :formValue="formValue" @send="locationValue"></Location>
						</v-tab-item>
						<v-tab-item value="tab-4">
							<Doc @send="docValue" :datas="formValue.document"></Doc>
						</v-tab-item>
						<v-tab-item value="tab-5">
							<Transaction @send="transactionValue" :price="formValue.price"></Transaction>
						</v-tab-item>
						<v-tab-item value="tab-6">
							<SEO :formValue="formValue"></SEO>
						</v-tab-item>
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
		<!-- <v-speed-dial
      v-model="fab"
      :top="top"
      :bottom="bottom"
      :right="right"
      :left="left"
      :direction="direction"
      :open-on-hover="hover"
      :transition="transition"
    >
      <template v-slot:activator>
        <v-btn
          v-model="fab"
          color="blue darken-2"
          dark
          fab
        >
          <v-icon v-if="fab">mdi-close</v-icon>
          <v-icon v-else>mdi-account-circle</v-icon>
        </v-btn>
      </template>
      <v-btn
        fab
        dark
        small
        color="green"
      >
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
      <v-btn
        fab
        dark
        small
        color="indigo"
      >
        <v-icon>mdi-plus</v-icon>
      </v-btn>
      <v-btn
        fab
        dark
        small
        color="red"
      >
        <v-icon>mdi-delete</v-icon>
      </v-btn>
    </v-speed-dial> -->
		<v-btn bottom color="success" dark fab fixed large right v-show="accept" @click="addData" >
			<v-icon>check</v-icon>
		</v-btn>
	</v-main>
</template>

<script>
import SEO from './SEO'
import Doc from './Doc'
import MediaEdit from './MediaEdit'
import Location from './LocationEdit'
import SelectCard from './SelectCard'
import Transaction from './Transaction'

export default {
	components: {
		SelectCard,
		MediaEdit,
		Location,
		Doc,
		Transaction,
		SEO
	},
	data: () => ({
		direction: 'top',
      fab: false,
      fling: false,
      hover: false,
      tabs: null,
      top: false,
      right: true,
      bottom: true,
      left: false,
      transition: 'slide-y-reverse-transition',
        menu2: false,
        dataProperty:{},
		formValue:
		{
			category_id:'',
			residential_commercial:'residential',
			rent_sale:'rent',
			availability_date: new Date().toISOString().substr(0, 10),
			year:20,
			property_location:'',
			price:0,

		},
		
		select: ['Vuetify', 'Programming'],
		dataAmenities: [
		],
		dataStatus:[
			{name:'Disable', value:0},{name:'Active', value:1},{name:'Pending', value:2},
		],
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
				title:'residential',
				src: '/png/005-cottage.png',
			},
			{
				title:'commercial',
				src: '/png/006-apartments.png',
			},
			{
				title:'rent',
				 src: '/png/004-for-rent.png',
			},
			{
				title:'sale',
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
		editedIndex:null,
		tab: null,
		selected: [],
		floor_plan:[],
		files:[],
		document:[],
        amenities:[],
        dataPostPlan:[],
		video:{},
		three:{},
      
		
	}),

	computed: {
		sizeSQM()
		{
			var data=0
			if(this.formValue.size)
			data=this.formValue.size*10.7639;
			return data+' SQFT';
		},
		accept()
		{
			if(this.formValue.size && this.formValue.title && this.formValue.description
				 && this.formValue.category_id && this.formValue.price && this.formValue.property_location
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
                    
					return data.residential_commercial.toUpperCase().match(this.formValue.residential_commercial.toUpperCase()) 
					&& data.rent_sale.toUpperCase().match(this.formValue.rent_sale.toUpperCase());
                }
                );
            },
	},
	watch: {},
	created() {
		this.initialize();
	},
	methods: {
		transactionValue(item)
		{
			this.formValue.from_owner_commission=item.from_owner_commission;
			this.formValue.from_tenant_commission=item.from_tenant_commission;
			this.formValue.total_commission=item.total_commission;
		},		
		seoValue(item)
		{
			this.formValue.meta_description=item.meta_description;
			this.formValue.meta_title=item.meta_title;
			this.formValue.meta_keyword=item.meta_keyword;
		},
		docValue(item)
		{
			this.document=item;
		},
		locationValue(item)
		{
			
			this.floor_plan=item;
		},
		filesValue(item)
		{
			this.files=item;
		},
		videoValue(item)
		{
			this.video=item;
		},
		threeValue(item)
		{
			this.three=item;
		},
		async initialize() {
            this.start();
            
            try {
				let { data } = await axios({
					method: "get",
					url: "/app/property/"+this.$route.params.id
				});
				this.formValue = data;
			} catch (e) {
				this.fail();
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/category"
				});
				this.dataCategory = data;
			} catch (e) {
				this.fail();
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/amenity"
				});
				this.dataAmenities = data;
			} catch (e) {
				this.fail();
            }
            try {
				let { data } = await axios({
					method: "get",
					url: "/app/postplan"
				});
				this.dataPostPlan = data;
			} catch (e) {
				this.fail();
			}
			this.finish();
		},
		typeOne(value)
		{
			if(value==1)
			this.formValue.residential_commercial='residential';
			else
			this.formValue.residential_commercial= 'commercial';
		},
		typeTwo(value)
		{
			if(value==1)
			this.formValue.rent_sale='rent';
			else
			this.formValue.rent_sale= 'sale';

		},
		async addData()
		{
			this.start();
			      const formData = new FormData();
					this.floor_plan.forEach(file => {
						formData.append("floor_plan[]", file, file.name);
					});
					this.document.forEach(file => {
						formData.append("document[]", file, file.name);
					});
					this.files.forEach(file => {
						formData.append("media[]", file, file.name);
					});
					formData.append("three", this.three);
					formData.append("video", this.video);
					formData.append("formValue", JSON.stringify(this.formValue));
			try {
				let { data } = await axios({
					method: "post",
					url: "/app/propertyupdate",
					data: formData
				});
			this.snacks('Successfully Done','Green')

			} catch (e) {
				this.fail();
				this.snacks('Failed','red')
			}
			this.finish();
		}


	}
};
</script>