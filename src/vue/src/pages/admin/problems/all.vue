<template>
<div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md">
      </div>
      <div class="col-md-auto mb-3">
        <a @click="add.name = null" v-b-modal.modal-1 class="btn btn-light w-100">أضف مشكل</a>
        <hr>
      </div>
    </div>
    <div class="row" :key=key>
      <div v-for="(probleme,i) in problemes" :key="i" class="col-md-3 mb-3">
        <div class="bg-white rounded shadow p-3 text-center">
          <div class="logo text-center mb-2">
            <img :src="probleme.icon" :alt="probleme.name" width="100" height="100" class="img img-responsive img-thumbnail bg-light p-2">
          </div>
          <div class="name text-center mb-2">{{ probleme.name }}</div>
          <div class="stats">
            <div class="small">الإبلاغات:</div>
            <div class="progress" style="height: 10px">
              <div class="progress-bar bg-danger small" :style="'height: 10px; width: '+(((probleme.repport.filter(report=>report.solved == 1).length/probleme.repport.length)*100)||0)+'%'">تم التكفل ب({{ probleme.repport.filter(report=>report.solved == 1).length }})
              </div>
            </div>
            <div class="d-flex justify-content-between">
              <span class="small">0</span>
              <span class="small">{{ probleme.repport.length }}</span>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-6">
              <a @click="update.id = probleme.id; update.name = probleme.name, update.key = i,update.icon = probleme.icon" v-b-modal.modal-2 class="btn btn-primary w-100 btn-sm mb-1">تعديل</a>
            </div>
            <div class="col-md-6 text-left">
              <a @click="remove.id = probleme.id; remove.name = null, remove.key = i" v-b-modal.modal-3 class="btn btn-danger w-100 btn-sm mb-1">حذف</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   <!-- Modals -->
  <!-- add -->
    <b-modal id="modal-1" title="مشكل جديد" @ok="addData" :ok-title="'حفظ'" :cancel-title="'إلغاء'">
      <form ref="form" @submit.stop.prevent="addData">
        <div class="form-group">
          <label for="name_add">الإسم:</label>
          <input type="text" id="name_add" class="form-control" v-model="add.name" required>
        </div>
        <div class="form-group">
          <label for="logo_add">الشعار:</label>
          <input type="text" id="logo_add" class="form-control" v-model="add.icon" required>
        </div>
      </form>
    </b-modal>
    <!-- Modals -->
  <!-- update -->
    <b-modal id="modal-2" title="تعديل مشكل" @ok="updateData" :ok-title="'حفظ'" :cancel-title="'إلغاء'">
      <form ref="form" @submit.stop.prevent="updateData">
        <div class="form-group">
          <label for="name_add">الإسم:</label>
          <input type="text" id="name_add" class="form-control" v-model="update.name" required>
        </div>
        <div class="form-group">
          <label for="logo_add">الشعار:</label>
          <input type="text" id="logo_add" class="form-control" v-model="update.icon" required>
        </div>
      </form>
    </b-modal>
  <!-- delete -->
    <b-modal id="modal-3" title="حدف مشكل" @ok="deleteData" :ok-title="'حدف'" :cancel-title="'إلغاء'">
      <span>سيتم حدف مشكل: {{ remove.name }}</span>
    </b-modal>
<!-- Modals -->
</div>
</template>
<script>
import axios from "@/axios.js";
export default {
  data:()=>{
    return {
      key:0,
      problemes:[],
      add:{
        key:null,
        name:null,
        logo:null
      },
      update:{
        key:null,
        id:null,
        name:null,
        icon:null
      },
      remove:{
        key:null,
        id:null,
        name:null
      }
    }
  },
  created() {
    this.getData()
  },
  methods:{
    getData(){
      axios.get("/admin/problemes").then(response=>{
        if(response.status == 200){
          this.problemes = response.data.problemes
        }
      })
    },
    addData(){
      axios.post("/admin/problemes/add",
        {
            "name":this.add.name,
            "icon":this.add.icon
        }
      ).then(response=>{
        if(response.status == 200){
          this.problemes.push(response.data)
          this.add.name = null;
          this.add.icon = null;
        }
      })
    },
    updateData(){

      axios.post("/admin/problemes/update/"+this.update.id,{
            "name":this.update.name,
            "icon":this.update.icon
        }
        ).then(response=>{
        if(response.status == 200){
          this.problemes[this.update.key].name = response.data.name;
          this.problemes[this.update.key].icon = response.data.icon;
        }
      })
    },
    deleteData(){
      axios.post("/admin/problemes/delete/"+this.remove.id).then(response=>{
        if(response.status == 200){
          this.problemes.splice(this.remove.key,1)
        }
      })
    }
  }
};
</script>
