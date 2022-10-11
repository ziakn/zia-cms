<template>
    <v-row justify="center">
        <v-col sm="12" md="12" lg="10">
            <v-card  class="mt-5 pt-5">
                <v-card-title> 
                    <span class="title font-weight-light">Price</span>
                </v-card-title>
                <v-card-text>
                    <v-row>
                        <v-col sm="12" md="12" lg="6" >
							<v-text-field
							 v-model="price"
							 label="Price"
							 required
							 filled
                             disabled
							></v-text-field>
						</v-col>
                        <v-col sm="12" md="12" lg="6" >
							<v-text-field
							 v-model="formValue.remaining_price"
							 label="Remaining Price"
							 required
							 filled
							></v-text-field>
						</v-col>
                    </v-row>
                    <v-divider></v-divider>
                    <span class="title font-weight-light">Service Charges</span>
                    <v-row>
                     <v-col sm="12" md="12" lg="6" >
							<v-select
							v-model="formValue.dataOwner"
                            @change="ownerComissionSet"
							:items="dataOwner"
							item-value="value"
							item-text="name"												
							label="Owner commision by days"
                            
							required
							filled
							></v-select>
						</v-col>
                        <v-col sm="12" md="12" lg="6" >
							<v-text-field
							 v-model="formValue.from_owner_commission"
							 label="Total Price"
							 required
							 filled
							></v-text-field>
						</v-col>	
                    </v-row>
                    <v-row>
                        <v-col sm="12" md="12" lg="6" >
							<v-select
							v-model="formValue.dataTenant"
                            @change="tenantComissionSet"
							:items="dataTenant"
							item-value="value"
							item-text="name"												
							label="Tenents commision by days"
							required
							filled
							></v-select>
						</v-col>	
                        <v-col sm="12" md="12" lg="6" >
							<v-text-field
							 v-model="formValue.from_tenant_commission"
							 label="Total Price"
							 required
							 filled
							></v-text-field>
						</v-col>	
                    </v-row>
                    <v-row>
                        <v-col sm="12" md="12" lg="12" >
							<v-text-field
							 v-model="formValue.total_commission"
							 label="Total Price"
							 required
							 filled
							></v-text-field>
						</v-col>	
                    </v-row>
                      <v-divider></v-divider>
                    <span class="title font-weight-light">Agent</span>
                    <v-row>
                        <v-col sm="12" md="12" lg="6" >
							<v-select
							v-model="formValue.dataAgent"
							:items="dataAgent"
							item-value="value"
							item-text="name"												
							label="Agents"
							required
							filled
							></v-select>
						</v-col>	
                        <v-col sm="12" md="12" lg="6" >
							<v-text-field
							 v-model="formValue.agent_price"
							 label="Total Price"
							 required
							 filled
							></v-text-field>
						</v-col>	
                    </v-row>
                </v-card-text>

            </v-card>
        </v-col>
    </v-row>
</template>
<script>
export default {
    
    props:{
        price: null,
    },
	data: () => ({
        formValue:{
            price:'',
            remaining_price:'',
            total_commission:'',
            from_owner_commission:'',
            from_tenant_commission:'',
            dataAgent:'',
            dataOwner:'',
            dataTenant:'',
             },
            select: ['Vuetify', 'Programming'],
        dataAgent:[
			{name:'0', value:'0'},{name:'1', value:'1'},{name:'2', value:'2'},{name:'3', value:'3'},{name:'4', value:'4'},{name:'5', value:'5'},
			{name:'6', value:'6'},{name:'7', value:'7'},{name:'8', value:'8'},{name:'9', value:'9'},{name:'10', value:'10'},
            {name:'11', value:'11'},{name:'12', value:'12'},{name:'13', value:'13'},{name:'14', value:'14'},{name:'15', value:'15'},
            {name:'16', value:'16'},{name:'17', value:'17'},{name:'18', value:'18'},{name:'19', value:'19'},{name:'20', value:'20'},
            {name:'21', value:'21'},{name:'22', value:'22'},{name:'23', value:'23'},{name:'24', value:'24'},{name:'25', value:'25'},
            {name:'26', value:'26'},{name:'27', value:'27'},{name:'28', value:'28'},{name:'29', value:'29'},{name:'30', value:'30'},
        ],
        dataOwner:[
			{name:'0', value:'0'},{name:'1', value:'1'},{name:'2', value:'2'},{name:'3', value:'3'},{name:'4', value:'4'},{name:'5', value:'5'},
			{name:'6', value:'6'},{name:'7', value:'7'},{name:'8', value:'8'},{name:'9', value:'9'},{name:'10', value:'10'},
            {name:'11', value:'11'},{name:'12', value:'12'},{name:'13', value:'13'},{name:'14', value:'14'},{name:'15', value:'15'},
            {name:'16', value:'16'},{name:'17', value:'17'},{name:'18', value:'18'},{name:'19', value:'19'},{name:'20', value:'20'},
            {name:'21', value:'21'},{name:'22', value:'22'},{name:'23', value:'23'},{name:'24', value:'24'},{name:'25', value:'25'},
            {name:'26', value:'26'},{name:'27', value:'27'},{name:'28', value:'28'},{name:'29', value:'29'},{name:'30', value:'30'},
        ],
        dataTenant:[
            {name:'0', value:'0'},{name:'1', value:'1'},{name:'2', value:'2'},{name:'3', value:'3'},{name:'4', value:'4'},{name:'5', value:'5'},
			{name:'6', value:'6'},{name:'7', value:'7'},{name:'8', value:'8'},{name:'9', value:'9'},{name:'10', value:'10'},
            {name:'11', value:'11'},{name:'12', value:'12'},{name:'13', value:'13'},{name:'14', value:'14'},{name:'15', value:'15'},
            {name:'16', value:'16'},{name:'17', value:'17'},{name:'18', value:'18'},{name:'19', value:'19'},{name:'20', value:'20'},
            {name:'21', value:'21'},{name:'22', value:'22'},{name:'23', value:'23'},{name:'24', value:'24'},{name:'25', value:'25'},
            {name:'26', value:'26'},{name:'27', value:'27'},{name:'28', value:'28'},{name:'29', value:'29'},{name:'30', value:'30'},
        ],  
    }),
    created(){
        
    },
    methods:{
        ownerComissionSet()
        {
            this.formValue.from_owner_commission=Number(((this.price/30)*this.formValue.dataOwner).toFixed(1)) 
            this.formValue.total_commission = Number((this.formValue.from_owner_commission+this.formValue.from_tenant_commission).toFixed(1))
            this.sendValue()
          
        },
        tenantComissionSet()
        {
             this.formValue.from_tenant_commission=Number(((this.price/30)*this.formValue.dataTenant).toFixed(1)) 
             this.formValue.total_commission= Number((this.formValue.from_owner_commission+ this.formValue.from_tenant_commission).toFixed(1)) 
             this.sendValue()
        },
        sendValue()
        {
            this.$emit('send',this.formValue)
        }

        
    },
}
</script>

<style>

</style>