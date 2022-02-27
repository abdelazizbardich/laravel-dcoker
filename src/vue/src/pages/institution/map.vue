<template>
  <div>
    <div class="row m-0">
      <div class="col-md-auto mb-3 text-center">
        <h1 class="text-white text-center">المشاكل المبلغ عنها</h1>
      </div>
      <div class="col"></div>
      <div class="col-md-auto mb-3 p-0 text-center">
        <button
          :class="!table ? 'btn-dark' : 'btn-light'"
          class="btn mx-2 d-inline-block"
          @click="table = false"
        >
          الخريطة
        </button>
        <button
          :class="table ? 'btn-dark' : 'btn-light'"
          class="btn d-inline-block"
          @click="table = true"
        >
          جدول البيانات
        </button>
      </div>
    </div>
    <div
      class="rounded shadow p-5 bg-white vh-100 mb-5"
      v-show="!table"
      ref="map"
    ></div>
    <div class="rounded shadow p-5 bg-white mb-5 ddd" v-show="table">
      <table class="table">
        <thead>
          <th>نوع الإبلاغ</th>
          <th>الاحداثيات</th>
          <th>الوضعية</th>
          <th></th>
        </thead>
        <tbody>
          <tr v-for="(report,i) in reports" :key="i">
            <td><img :src="report.problem.icon" alt="report.problem.name" width="20" class="img p-1 ml-3"> {{ report.problem.name }}</td>
            <td>lat:{{ report.lat }} / long:{{ report.long }}</td>
            <td>
              <span class="badge border border-success text-success" v-if="report.solved">Soved</span>
              <span class="badge border border-danger text-danger"  v-else>Pending</span>
            </td>
            <td>
              <button @click="resolved.id = report.id; resolved.name = report.name;resolved.key = i" v-b-modal.modal-1 class="btn btn-success btn-sm">تم الحل</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Modals -->
      <!-- resolved -->
        <b-modal id="modal-1" title="تعيين مشكل تم حلها" @ok="setSolved" :ok-title="'تعيين'" :cancel-title="'إلغاء'">
          <span>تعيين {{ resolved.name }} مشكل تم حلها</span>
        </b-modal>
    <!-- Modals --> 
  </div>
</template>
<script>
import { Loader } from "@googlemaps/js-api-loader";
import axios from "../../axios";
export default {
  data: () => {
    return {
      reports:[],
      table: false,
      mapControls: {
        zoom: 12,
      },
      map: {},
      resolved:{
        key:null,
        id:null,
        name:null
      }
    };
  },
  watch: {
    zoom() {},
  },
  async created() {
    this.getData();
    const loader = new Loader({
      apiKey: "AIzaSyAedlnIywFnLCza1_QRGQG65QYGZ6yD8UE",
      version: "weekly",
      libraries: ["places"],
    });
    loader.load().then(() => {
      this.map = new window.google.maps.Map(this.$refs["map"], {
        center: {
          lat: 31.6346023,
          lng: -8.0778935,
        },
        zoom: 8,
        disableDefaultUI: false,
        mapTypeId: "roadmap",
      });
      this.initMap();
    });
  },
  methods: {
    initMap() {
      this.reports.forEach((report) => {
        new window.google.maps.Marker({
          map: this.map,
          position: {
            lat: +report.lat,
            lng: +report.long,
          },
          icon: {
            url: report.problem.icon,
            labelOrigin: new window.google.maps.Point(75, 45),
            size: new window.google.maps.Size(32, 52),
          },
          label: {
            text: report.problem.name,
            color: "#ff3838",
            fontWeight: "bold",
          },
        });
      });
    },
    async getData(){
      await axios.get("/deppartment/repports").then(response=>{
         this.reports = response.data.repports
      }).catch(error => {
        console.error(error.response.data);
      })
    },
    setSolved(){
      axios.get("/deppartment/repports/solved/"+this.resolved.id).then(response=>{
        if(response.status == 200){
          this.reports[this.resolved.key].solved = true
        }
      }).catch(error => {
        console.error(error);
      })
    }
  },
};
</script>
