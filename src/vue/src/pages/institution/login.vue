<template>
  <div class="row bg-danger vh-100 m-0 d-flex align-items-center justify-content-center">
    <div class="col-md-5 ">
        <h1 class="h1 m-0 text-center text-light">تسجيل الدخول كمركز</h1>
        <form class="bg-white rounded border p-5 m-3 shadow" @submit.prevent="login">
            <div class="form-group">
                <label for="email" class="form-label">بريد الالكتروني:</label>
                <input type="email" v-model="data.email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">كلمة المرور:</label>
                <input type="password" v-model="data.password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-danger w-100">تسجيل الدخول</button>
            </div>
        </form>
    </div>
  </div>
</template>
<script>
import axios from "../../axios";
export default {
    data:()=>{
        return {
            data:{
                role:"admin",
                email:"appinstitution@email.com",
                password:"pass1234"
            }
        }
    },
    methods:{
        login(){
            axios.post("/deppartment/login",{
                email:this.data.email,
                password:this.data.password
            }).then(response=>{
                if(response.status == 200){
                    this.$store.dispatch('setUserData',response.data);
                    this.$router.push("/institution")
                }else{
                    this.$store.dispatch("notifier",{msg:response.data});
                }
            }).catch(e=>{
                this.$store.dispatch("notifier",{msg:e.response.data});
            })
        }
    }
}
</script>
<style scoped>
</style>
