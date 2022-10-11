<template>
    <v-row justify="center">
        <v-col sm="12" md="12" lg="12">
            <v-card  class="mt-5 pt-5">
                <v-card-text>
                    <v-row>
                        <v-col lg="6">
                            <v-text-field
                                v-model="dataList.video"
                                color="blue accent-4"
                                placeholder="Youtube Url Optional"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col lg="6">
                            <v-text-field
                                v-model="dataList.three_sixty"
                                color="blue accent-4"
                                placeholder="Youtube 360 Url Optional"
                            >
                            </v-text-field>
                        </v-col>
                          <v-col cols="12">
							<v-card flat>
								<v-card-title>
									<v-icon large left color="primary" >
										attach_file
									</v-icon>
									<span class="title font-weight-light" >Media</span>
								</v-card-title>
								<v-card-text>
									  <v-card-title>Gallery Image</v-card-title>
									<v-row>
									<ImageModule :toggle="isBanner" @send="receiveBanner" @cancel="cancelBanner"/>
									<v-col
										class="d-flex child-flex"
										cols="4"
										lg="2"
										>
											<v-card  >
												<v-img
												src="/images/plus.png"
												aspect-ratio="1"
												@click="isBanner=!isBanner"
												>
												</v-img>
												<v-card-subtitle align="center">
													Add image(1900 x 280)
												</v-card-subtitle>

											</v-card>
										</v-col>
										<v-col
										v-for="(image , index) in dataList.banner"
										:key="index"
										class="d-flex child-flex"
										cols="4"
										lg="2"
                                        :v-if="dataList.banner.length!=0"
										>
											<v-card flat >
												<v-img
												:src="image"
												aspect-ratio="1"
												class="grey lighten-2"
												>
												<v-btn color="error" @click="removeBanner(index)">x</v-btn>
												<template v-slot:placeholder>
													<v-row
													class="fill-height ma-0"
													align="center"
													justify="center"
													>
													<v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
													</v-row>
												</template>
												</v-img>

											</v-card>
										</v-col>
                                        
									</v-row>
								</v-card-text>
							</v-card>

						</v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-col>
  </v-row>
</template>

<script>
import ImageModule from "./../../common/ImageModule";
export default {
  components:
  {
  	ImageModule,
  },
    data: () =>({
        isBanner: false,
        totalFiles:[],
        dataList: { 
            banner :[],
            bannerId :[],
            video:null,
            three_sixty:null,
            },
    }),
    watch:
    {
        'dataList.banner'(newVal)
        {
            this.$emit('send',this.dataList);
        },
        'dataList.bannerId'(newVal)
        {
            this.$emit('send',this.dataList);
        },
        'dataList.video'(newVal)
        {
            this.$emit('send',this.dataList);
        },
        'dataList.three'(newVal)
        {
            this.$emit('send',this.dataList);
        },
    },

    methods:
    {
        cancelBanner()
		{
			this.isBanner = !this.isBanner;
		},
		 receiveBanner(item)
		{
			this.isBanner=!this.isBanner;
			this.dataList.banner.push(item.src)
			this.dataList.bannerId.push(item.id)

		},
        removeBanner(index)
		{
			this.dataList.banner.splice(index, 1);
			this.dataList.bannerId.splice(index, 1);
		},
    }

}
</script>

<style>

</style>