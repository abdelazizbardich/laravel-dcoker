<template>
  <div class="">
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-md-12">
        <button class="btn btn-light" v-b-modal.modal-1>فئة جديدة</button>
      </div>
    </div>
    <div class="row">
      <div v-for="(category,i) in categories" :key="i" class="col-md-3 mb-3">
        <div class="bg-dark rounded shadow p-3 text-center">
          <div class="logo text-center bg-white rounded mb-3 border">
            <img height="70" width="70" class="img" :src="category.icon" >
          </div>
          <div class="name text-center text-white" contenteditable="true">{{ category.name }}</div>
          <div class="controls row mx-0 mt-3">
            <div class="col-md-6 mb-2">
              <a @click="remove.id = category.id;remove.key = i; remove.name = category.name" v-b-modal.modal-3 class="btn btn-sm btn-block btn-danger mx-1">حذف</a>
            </div>
            <div class="col-md-6 mb-2">
              <a @click="update.id = category.id;update.key = i; update.name = category.name, update.icon = category.icon" v-b-modal.modal-2 class="btn btn-sm btn-block btn-primary mx-1">تعديل</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Modals -->
  <!-- add -->
    <b-modal id="modal-1" title="فئة جديدة" @ok="addData" :ok-title="'حفظ'" :cancel-title="'إلغاء'">
      <form ref="form" @submit.stop.prevent="addData">
        <div class="form-group">
          <label for="name_add">الإسم:</label>
          <input type="text" id="name_add" class="form-control" v-model="add.name" required>
        </div>
        <div class="form-group">
          <label for="add_logo">الشعار:</label>
          <input type="text" id="add_logo" class="form-control" v-model="add.icon" required>
        </div>
      </form>
    </b-modal>
  <!-- update -->
    <b-modal id="modal-2" title="تعديل فئة" @ok="updateData" :ok-title="'حفظ'" :cancel-title="'إلغاء'">
      <form ref="form" @submit.stop.prevent="updateData">
        <div class="form-group">
          <label for="name_add">الإسم:</label>
          <input type="text" id="name_add" class="form-control" v-model="update.name" required>
        </div>
        <div class="form-group">
          <label for="update_logo">الشعار:</label>
          <input type="text" id="update_logo" class="form-control" v-model="update.icon" required>
        </div>
      </form>
    </b-modal>
  <!-- delete -->
    <b-modal id="modal-3" title="حدف فئة" @ok="deleteData" :ok-title="'حدف'" :cancel-title="'إلغاء'">
      <span>سيتم حدف هذه الفئة: {{ remove.name }}</span>
    </b-modal>
<!-- Modals -->
</div>
</template>
<script>
import axios from "@/axios.js";
export default {
  data:()=>{
    return {
      categories:null,
      add:{
        name:null,
        icon:null
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
  created(){
    this.getData()
  },
  methods:{
    getData(){
      axios.get("/admin/categories").then(response=>{
        if(response.status == 200){
          this.categories = response.data.categoiries
        }
      })
    },
    addData(){
      axios.post("/admin/categories/add",{
        "name":this.add.name,
        "icon":this.add.icon
      }).then(response=>{
        if(response.status == 200){
            this.categories.push(response.data)
            this.add.name = null;
            this.add.icon = null;
        }
      })
    },
    updateData(){
      axios.post("/admin/categories/update/"+this.update.id,{
        "name":this.update.name,
        "icon":this.update.icon
      }).then(response=>{
        if(response.status == 200){
            this.categories[this.update.key].name = response.data.name
            this.categories[this.update.key].icon = response.data.icon 
            this.update.name = null;
            this.update.icon = null;
            this.update.key = null;
            this.update.id = null;
        }
      })
    },
    deleteData(){
      axios.post("/admin/categories/delete/"+this.remove.id).then(response=>{
        if(response.status == 200){
          this.categories.splice(this.remove.key,1);
        }
      })
    }
  }
};
</script>
<style>
.modal-header .close {
    margin-left: unset !important;
}
</style>