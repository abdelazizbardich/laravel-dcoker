<template>
  <div>
    <div class="container-fluid">
      <div class="row">
        <div
          :class="sideBar ? 'show' : ''"
          class="col-md-auto p-0 p-relative z-1 vh-100 bg-white shadow"
          id="sideBar"
        >
          <div
            class="d-flex flex-column p-3 h-100"
            :style="sideBar ? 'width: 250px' : ''"
          >
            <router-link to="/admin/home"
              ><img
                v-if="sideBar"
                class="w-75 d-block mx-auto"
                src="@/assets/logo.png"
                alt="logo"
              />
              <img
                v-else
                width="20"
                class="d-block mx-auto mb-5"
                src="@/assets/icon.png"
                alt="icon"
              />
            </router-link>
            <ul
              class="nav nav-pills flex-column mb-auto"
              :class="sideBar ? '' : 'p-0'"
            >
              <li class="d-flex align-items-center">
                <router-link to="/admin" class="nav-link d-flex w-100" >
                <b-icon icon="tv" class="text-primary mx-2"></b-icon>
                <span v-if="sideBar">الصفحة الرئيسية</span> </router-link>
              </li>
              <li class="d-flex align-items-center">
                <router-link to="/admin/reports" class="nav-link d-flex w-100">
                  <b-icon icon="bullseye" class="text-primary mx-2"></b-icon>
                  <span v-if="sideBar">الإبلاغات</span></router-link>
              </li>
              <li class="d-flex align-items-center">
                <router-link to="/admin/problemes" class="nav-link d-flex w-100">
                  <b-icon icon="card-checklist" class="text-primary mx-2"></b-icon>
                  <span v-if="sideBar">المشاكل</span></router-link>
              </li>
              <li class="d-flex align-items-center">
                <router-link to="/admin/centers" class="nav-link d-flex w-100">
                  <b-icon icon="building" class="text-primary mx-2"></b-icon>
                  <span v-if="sideBar">المراكز</span></router-link>
              </li>
              <li class="btn d-flex align-items-center border bg-danger shadow-sm rounded" :class="(sideBar)?'mt-5':''">
                <span class="nav-link  d-block" to="#" @click="logout()">
                  <b-icon icon="door-open" class="text-light mx-2" style="color:white !important;"></b-icon>
                  <span v-if="sideBar" class="text-white">تسجيل الخروج </span></span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col p-relative">
          <header class="w-100 py-3">
            <div class="container-fluid">
              <div class="row">
                <div class="col d-none d-md-block">
                  <button
                    @click="toggleSidebar"
                    class="btn btn-light bg-transparent border-0 text-white"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-list"
                      viewBox="0 0 16 16"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
                      />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </header>
          <hr class="m-0 mb-3" />
          <main>
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <router-view></router-view>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: () => {
    return {
      sideBar: true,
    };
  },
  methods: {
    toggleSidebar() {
      this.sideBar ? (this.sideBar = false) : (this.sideBar = true);
    },
    logout(){
      this.$store.dispatch("clearUserData");
      this.$router.push("/admin/login");
    }
  },
};
</script>
<style scoped>
main:before {
  content: "";
  z-index: -1;
  width: 100%;
  height: 250px;
  background: linear-gradient(45deg, #f44336 0, #f44336 100%) !important;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
}
#sideBar {
  position: sticky;
  top: 0;
  bottom: 0;
  height: 100vh;
}
li svg {
  color: #f44336 !important;
}
@media screen and (max-width: 700px) {
  #sideBar {
    position: initial;
    height: fit-content !important;
  }
  #sideBar > div {
    width: 100% !important;
  }
  #sideBar > div a img {
    max-width: 30%;
  }
  #sideBar ul {
    width: 100%;
    flex-direction: row !important;
  }
  #sideBar ul li {
    display: inline-block;
  }
}
</style>
