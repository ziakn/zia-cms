<template>
    <div>
        <v-data-table :headers="headers" :items="dataList" :search="search" class="elevation-1" show-expand >
            
            <template v-slot:item.id="{ item }" >
                <p class="font-weight-medium mt-3"><b>{{item.id }}</b></p>
                <p class="font-weight-light">{{item.admin.name }}</p>
            </template>
            <template v-slot:item.title="{ item }">
                <p class="font-weight-medium mt-3"><b>{{item.title }}</b></p>
                <p class="font-weight-light">{{item.property_location }}</p>
            </template>
            <template v-slot:item.size="{ item }">
                <p class="font-weight-medium mt-3">
                    <b>
                        {{item.room }}<v-icon small>king_bed</v-icon>
                        {{item.bathroom }}<v-icon small>bathtub</v-icon>
                    </b>
                </p>
                <p class="font-weight-light">{{item.size }}SQM</p>
            </template>
            <template v-slot:item.price="{ item }">
                <p class="font-weight-medium mt-3">
                    <p class="font-weight-medium mt-3"><b>{{item.price }}</b></p>
                    <p class="font-weight-light">{{item.residential_commercial }}</p>
            </template>
            <template v-slot:item.category_id="{ item }">
                <p class="font-weight-medium mt-3"><b>{{item.category.name }}</b></p>
                <p class="font-weight-light">{{item.rent_sale }}</p>
            </template>
            <template v-slot:item.updated_at="{ item }">
                <p class="font-weight-medium mt-3">
                    <b>
                        {{ item.updated_at | moment("from", "now") }}
                    </b>
                </p>
                <p class="font-weight-light">
                    {{ item.created_at | moment("from", "now") }}
                </p>
            </template>
            <template v-slot:item.status="{ item }">
                <p class="font-weight-medium mt-3" v-if="item.status==1"><v-icon color="green ">done_all</v-icon></p>
                <p class="font-weight-medium mt-3" v-else-if="item.status==0"><v-icon color="primary">info</v-icon></p>
                <p class="font-weight-medium mt-3" v-else><v-icon color="red">close</v-icon></p>
            </template>
            <template v-slot:item.action="{ item }">
                <v-icon small @click="editItem(item)">edit</v-icon>
                <v-icon small @click="deleteItem(item)">delete</v-icon>
                <v-chip width=10 color="green" dark></v-chip>
            </template>
            <template v-slot:no-data>
                No Data
            </template>
            <template v-slot:expanded-item="{ headers,item }">
            <td :colspan="headers.length">
               <Detail :item='item'></Detail>
            </td>
            </template>
        </v-data-table>
        <DeleteModal :trigger="isDelete" :title="deleteTitle" :body="deleteBody" @request="remove"></DeleteModal>
    </div>
</template>

<script>
import DeleteModal from "./../../common/DeleteModal";
import Detail from "./Detail";
export default {
	components: {
        DeleteModal,
        Detail
    },
    props:
    {
        search: String,
        dataProperty: Array,
    },
	data: () => ({
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete: false,
		edit: true,
		dialog: false,
		headers: [
			{ text: "ID/User", value: "id" },
			{ text: "Title/Location", value: "title" },
			{ text: "Layout/Size", value: "size" },
			{ text: "Type/Offering", value: "category_id" },
			{ text: "Price/Category", value: "price" },
            { text: "Updated/Listed", value: "updated_at" },
            { text: "State", value: "status" },
			{ text: "Action", align: "center", value: "action", sortable: false }
		],
		editedIndex: -1,
        defaultItem: {},
        propertyDetail:[],
	}),

	computed: {
        dataList()
        {
            return this.dataProperty;
        }
	},
	watch: {},
	created() {
	},
	methods: {
        editItem(item)
        {
            this.$router.push('/dashboard/editproperty/'+item.id);

        },
		deleteItem(item) {
			this.dataIndex = this.dataProperty.indexOf(item);
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
					url: "/app/property/" + this.dataProperty[this.dataIndex].id
				});
				this.snacks('Successfully Done','Green')
				this.dataProperty.splice(this.dataIndex, 1);
				this.close();
			} catch (e) {
				this.snacks('Operation Failed','Red')

            }
            
        },
        async getDetail()
            {
                console.log("its clicked")
            }
	}
};
</script>