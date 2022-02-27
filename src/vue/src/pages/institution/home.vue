<template>
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-md-6 mb-3">
        <div class="bg-white rounded shadow p-3 text-center">
          <span class="h2 text-center d-block">الإبلاغات</span>
          <span class="text-primary display-1 text-center d-block">{{ data.reports }}</span>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="bg-white rounded shadow p-3 text-center">
          <span class="h2 text-center d-block">إبلاغات تم التكفل بها</span>
          <span class="text-primary display-1 text-center d-block">{{ data.solved }}</span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mb-3">
        <span class="h1">إحصائيات:</span>
      </div>
      <div class="col-12 mb-3">
        <div class="bg-white rounded shadow p-1 text-center">
            <zingchart :data="data.statisticsData" :series="data.statisticsSeries" :key="data.key"></zingchart>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import 'zingchart/es6';
import zingchartVue from 'zingchart-vue';
import axios from "../../axios";
export default {
  components: {
    zingchart: zingchartVue,
  },
  data() {
    return {
        data:{
          key:0,
          reports: 0,
          solved: 0,
          statisticsData: {
            type: 'bar',
            plotarea: {
              'adjust-layout': true /* For automatic margin adjustment. */
            },
            'scale-x':{
              labels: ['يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'],
              item: {
                'font-size':15,
                'font-family': "inherit",
                'font-color': "black",
                'text-align':"center"
              }
            }
          },
          statisticsSeries: [
              { 
                values: [0,0,0,0,0,0,0,0,0,0,0,0],
                'background-color': "#f44336"
              },
          ],
        }
    }
  },
  created() {
    this.getData()
  },
  methods: {
    getData(){
      axios.get('/deppartment/home').then(response=>{
        this.data.center = response.data.center;
        this.data.reports = response.data.reports;
        this.data.solved = response.data.solved;
        this.data.statisticsSeries[0].values = response.data.statistics;
        this.data.key++;
      }).catch(error=>{
        console.error(error.response);
      })
    }
  }
}
</script>
