<template>
<div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-auto mb-3">
        <a v-b-modal.modal-1 class="btn btn-dark w-100">أضف مركز</a>
        <hr>
      </div>
      <div class="col-md">
      </div>
      <div class="col-md-auto mb-3">
        <router-link to="/admin/categories" class="btn btn-light w-100">تعديل الفئات</router-link>
        <hr>
      </div>
    </div>
    <div class="row">
      <div v-for="(center,i) in centers" :key="i" class="col-md-3 mb-3">
        <div class="bg-white rounded shadow p-3 text-center">
          <div class="logo text-center bg-light rounded mb-3 border">
            <img :src="center.logo" width="70" height="70" class="img" />
          </div>
          <div class="name text-center">{{ center.name }}</div>
          <div class="category text-center">{{ center.category.name }}</div>
          <div class="reprts text-center">{{ /*center.repport.length*/ }}(0) إبلاغ تم التكفل به</div>
          <div class="controls row mx-0 my-3">
            <div class="col-md-6 mb-2">
              <a @click="remove.key = i;remove.id= center.id; remove.name = center.name" v-b-modal.modal-3 class="btn btn-block btn-danger mx-1">حذف</a>
            </div>
            <div class="col-md-6 mb-2">
              <a @click="update.key = i;update.id= center.id; update.name = center.name;fillUpdateData(i)" v-b-modal.modal-2 class="btn btn-block btn-primary mx-1">تعديل</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modals -->
  <!-- add -->
    <b-modal id="modal-1" title="مركز جديد" @ok="addData" :ok-title="'حفظ'" :cancel-title="'إلغاء'">
      <form ref="form" @submit.stop.prevent="addData">
        <div class="form-group">
          <label for="add_name">الإسم:</label>
          <input type="text" id="add_name" class="form-control" v-model="add.name" required>
        </div>
        <div class="form-group">
          <label for="add_email">البريد الإلكتروني:</label>
          <input type="email" id="add_email" class="form-control" v-model="add.email" required>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label for="add_pphone1">رقم الهاتف:</label>
            <input type="tel" id="add_pphone1" class="form-control" v-model="add.phones[0]" required>
          </div>
          <div class="form-group col-md-4">
            <label for="add_phone2">رقم الهاتف:</label>
            <input type="tel" id="add_phone2" class="form-control" v-model="add.phones[1]" required>
          </div>
          <div class="form-group col-md-4">
            <label for="add_phone3">رقم الهاتف:</label>
            <input type="tel" id="add_phone3" class="form-control" v-model="add.phones[2]" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="add_lat">إحداثيات الموقع (أفقي):</label>
            <input type="number" id="add_lat" class="form-control" v-model="add.lat" required>
          </div>
          <div class="form-group col-md-6">
            <label for="add_long">إحداثيات الموقع (عموي):</label>
            <input type="number" id="add_long" class="form-control" v-model="add.long" required>
          </div>
        </div>
        <div class="form-group">
          <label for="add_logo">الشعار:</label>
          <input type="url" id="add_logo" class="form-control" v-model="add.logo" required>
        </div>
        <div class="form-group">
          <label for="add_password">كلمة المرور:</label>
          <input type="password" id="add_password" minlength="8" class="form-control" v-model="add.password" required>
        </div>
        <div class="form-group">
          <label for="add_category">الفئة:</label>
          <select id="add_category" class="form-control" v-model="add.category" required>
            <option value="" selected>اختر فئة...</option>
            <option v-for="(category,index) in categories" :value="category.id" :key=index>{{ category.name }}</option>
          </select>
        </div>
      </form>
    </b-modal>
    <!-- Modals -->
  <!-- update -->
    <b-modal id="modal-2" title="تعديل مركز" @ok="updateData" :ok-title="'حفظ'" :cancel-title="'إلغاء'">
      <form ref="form" @submit.stop.prevent="updateData">
        <div class="form-group">
          <label for="update_name">الإسم:</label>
          <input type="text" id="update_name" class="form-control" v-model="update.name" required>
        </div>
        <div class="form-group">
          <label for="update_email">البريد الإلكتروني:</label>
          <input type="email" id="update_email" class="form-control" v-model="update.email" required>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label for="update_pphone1">رقم الهاتف:</label>
            <input type="tel" id="update_pphone1" class="form-control" v-model="update.phones[0]" required>
          </div>
          <div class="form-group col-md-4">
            <label for="update_phone2">رقم الهاتف:</label>
            <input type="tel" id="update_phone2" class="form-control" v-model="update.phones[1]" required>
          </div>
          <div class="form-group col-md-4">
            <label for="update_phone3">رقم الهاتف:</label>
            <input type="tel" id="update_phone3" class="form-control" v-model="update.phones[2]" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="update_lat">إحداثيات الموقع (أفقي):</label>
            <input type="number" id="update_lat" class="form-control" v-model="update.lat" required>
          </div>
          <div class="form-group col-md-6">
            <label for="update_long">إحداثيات الموقع (عموي):</label>
            <input type="number" id="update_long" class="form-control" v-model="update.long" required>
          </div>
        </div>
        <div class="form-group">
          <label for="update_logo">الشعار:</label>
          <input type="url" id="update_logo" class="form-control" v-model="update.logo" required>
        </div>
        <div class="form-group">
          <label for="update_password">كلمة المرور:</label>
          <input type="password" id="update_password" minlength="8" class="form-control" v-model="update.password" required>
        </div>
        <div class="form-group">
          <label for="update_category">الفئة:</label>
          <select id="update_category" class="form-control" v-model="update.category" required>
            <option value="" selected>اختر فئة...</option>
            <option v-for="(category,index) in categories" :value="category.id" :key=index>{{ category.name }}</option>
          </select>
        </div>
      </form>
    </b-modal>
  <!-- delete -->
    <b-modal id="modal-3" title="حدف مركز" @ok="deleteData" :ok-title="'حدف'" :cancel-title="'إلغاء'">
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
      centers:null,
      categories:null,
      add:{
        name:null,
        email:null,
        phones:[null,null,null],
        lat:null,
        long:null,
        logo:null,
        password:null,
        category:""
      },
      update:{
        id:null,
        name:null,
        email:null,
        phones:[null,null,null],
        lat:null,
        long:null,
        logo:null,
        password:null,
        category:""
      },
      remove:{
        id:null,
        name:null
      }
    }
  },
  created(){
    this.getData();
    this.getCategories();
  },
  methods:{
    getData(){
      axios.get("/admin/deppartments").then(response=>{
        if(response.status == 200){
          this.centers = response.data.deppartments
        }
      })
    },
    getCategories(){
      axios.get("/admin/categories").then(response=>{
        if(response.status == 200){
          this.categories = response.data.categoiries
        }
      })
    },
    addData(){
      axios.post("/admin/deppartments/add",{
        "name": this.add.name,
        "email": this.add.email,
        "phones": this.add.phones,
        "lat": this.add.lat,
        "long": this.add.long,
        "logo": this.add.logo,
        "password": this.add.password,
        "category": this.add.category,
      }).then(response=>{
        if(response.status == 200){
          this.centers.push(response.data)
        }
      })
    },
    updateData(){
      axios.post("/admin/deppartments/update/"+this.update.id,{
          "name": this.update.name,
          "email": this.update.email,
          "phones": this.update.phones,
          "lat": this.update.lat,
          "long": this.update.long,
          "logo": this.update.logo,
          "password": this.update.password,
          "category": this.update.category
      }).then(response=>{
        if(response.status == 200){
          this.centers[this.update.key].id = response.data.id;
          this.centers[this.update.key].name = response.data.name;
          this.centers[this.update.key].email = response.data.email;
          this.centers[this.update.key].phones = response.data.phones;
          this.centers[this.update.key].lat = response.data.lat;
          this.centers[this.update.key].long = response.data.long;
          this.centers[this.update.key].logo = response.data.logo;
          this.centers[this.update.key].categories_id = response.data.categories_id;
        }
      }).catch(error=>{console.warn(error);})
    },
    deleteData(){
      axios.post("/admin/deppartments/delete/"+this.remove.id).then(response=>{
        if(response.status == 200){
          this.centers.splice(this.remove.key,1);
        }
      })
    },
    fillUpdateData(key){
      this.update.id = this.centers[key].id;
      this.update.name = this.centers[key].name;
      this.update.email = this.centers[key].email;
      this.update.phones[0] = JSON.parse(this.centers[key].phones)[0];
      this.update.phones[1] = JSON.parse(this.centers[key].phones)[1];
      this.update.phones[2] = JSON.parse(this.centers[key].phones)[2];
      this.update.lat = this.centers[key].lat;
      this.update.long = this.centers[key].long;
      this.update.logo = this.centers[key].logo;
      this.update.category = this.centers[key].categories_id;
    }
  }
};
</script>
