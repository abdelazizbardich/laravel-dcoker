<template>
  <div>
    <div class="container-fluid bg-white top-nav shadow-sm">
      <nav class="navbar navbar-expand-lg navbar-light">
        <router-link class="navbar-brand" to="/"
          ><img
            src="~@/assets/logo.png"
            width="100"
            class="img img-responsive"
            alt=""
        /></router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarText"
          aria-controls="navbarText"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <router-link class="nav-link text-dark" to="/"
                >الرئيسية</router-link
              >
            </li>
            <li class="nav-item">
              <router-link class="nav-link text-dark" to="/about"
                >عن التطبيق</router-link
              >
            </li>
            <li class="nav-item">
              <router-link class="nav-link text-dark" to="/contact"
                >تواصل معنا</router-link
              >
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link class="btn btn-danger rounded-pill" to="#"
                >تنزيل التطبيق</router-link
              >
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <main>
      <router-view></router-view>
    </main>
    <footer class="footer">
      <div class="container">
        <div class="row justify-content-center p-5">
          <div class="col-md-6 text-center">
            <img
              src="@/assets/logo.png"
              alt=""
              class="img img-responsive mx-auto w-50 d-block mb-3"
            />
            <p class="text-white text-center">
              Civic Prob Map هو مشروع أسسته جمعية Anakhil الواقعة في مراكش ، هذا
              المشروع موجه لمساعدة المرأة المغربية على تجنب أي نوع من مشاكل
              الشارع والمساعدة في حل مشاكل الشارع القائمة من خلال توجيه تقارير
              المشاكل إلى إدارتها المتخصصة.
            </p>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>
<script>
export default {};
</script>
<style>
.top-nav {
  position: relative;
  z-index: 9;
}
.btn {
  transition: 0.3s;
}
.btn:hover {
  transform: translateY(-5px);
  box-shadow: rgba(0, 0, 0, 0.267) 0px 3px 8px;
}
.btn.btn-danger,
.footer,
.bg-danger {
  border: none;
  background-image: linear-gradient(45deg, #dc3545, #a27c2c) !important;
}
.text-danger {
  background: -webkit-linear-gradient(45deg, #dc3545, #a27c2c);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
</style>
