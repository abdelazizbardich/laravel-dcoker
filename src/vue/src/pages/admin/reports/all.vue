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
            <td>{{ report.id }}</td>
            <td>lat:{{ report.lat }} / long:{{ report.long }}</td>
            <td>
              <span class="badge border border-success text-success" v-if="report.solved">Soved</span>
              <span class="badge border border-danger text-danger"  v-else>Pending</span>
            </td>
            <td>
              <button @click="remove.id = report.id; remove.name = report.problem.name" v-b-modal.modal-1 class="btn btn-danger btn-sm">
                حذف
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Modals -->
      <!-- delete -->
        <b-modal id="modal-1" title="حدف الإبلاغ" @ok="deleteReport" :ok-title="'حدف'" :cancel-title="'إلغاء'">
          <span>سيتم حدف هذا الإبلاغ: {{ remove.name }}</span>
        </b-modal>
    <!-- Modals -->
  </div>
</template>
<script>
import { Loader } from "@googlemaps/js-api-loader";
import axios from "../../../axios";
export default {
  data: () => {
    return {
      table: false,
      mapControls: {
        zoom: 12,
      },
      map: {},
      remove:{
        id:null,
        name:null
      },
      reports:[]
    };
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
        zoom: 12,
        disableDefaultUI: true,
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
            color: "#000000",
            fontWeight: "bold",
          },
        });
      });
    },
    async getData(){
      await axios.get("/admin/repports").then(response=>{
         this.reports = response.data.repports
      }).catch(error => {
        console.error(error.response.data);
      })
    },
    deleteReport(){
      axios.get("/admin/repports/delete/"+this.remove.id).then(response=>{
        if(response.status == 200){
          this.$router.go()
        }
      }).catch(error => {
        console.error(error.response.data);
      })
    }
  },
};
</script>
