<template>
  <div>
    <header
      class="d-flex justify-content-center flex-column text-center text-dark align-itmes-center"
    >
      <div class="mx-auto col-md-6 text-center">
        <span class="small">خريطة Civic Prob</span>
        <h1 class="text-center text-danger">
          أبلغ عن أي مشكلة في الشارع ، وسنحاول حلها
        </h1>
        <p class="text-center">
          هدفنا هو المساعدة في إنهاء المشاكل التي تواجهها النساء في طريقهن.
          بناءً على خريطتنا التفاعلية ، يمكنك الإبلاغ عن أي مشكلة ، وسنتأكد من
          وصولها إلى المكان الصحيح لمزيد من فرص حلها
        </p>
        <router-link to="#" class="btn btn-danger rounded-pill"
          >إكتشف أكثر</router-link
        >
      </div>
    </header>
    <section id="records" ref="counter">
      <div class="container-fluid">
        <div class="row py-5">
          <div class="col-md-3 text-center py-2">
            <span class="h1 text-white d-block text-center"
              >+{{ counter.user }}</span
            >
            <span class="counter-label d-block text-center">مستخدم</span>
          </div>
          <div class="col-md-3 text-center py-2">
            <span class="h1 text-white d-block text-center"
              >+{{ counter.administration }}</span
            >
            <span class="counter-label d-block text-center">مؤسسة مشتركة</span>
          </div>
          <div class="col-md-3 text-center py-2">
            <span class="h1 text-white d-block text-center"
              >+{{ counter.reports }}</span
            >
            <span class="counter-label d-block text-center">إبلاغ</span>
          </div>
          <div class="col-md-3 text-center py-2">
            <span class="h1 text-white d-block text-center"
              >+{{ counter.solved }}</span
            >
            <span class="counter-label d-block text-center">مشكل تم حله</span>
          </div>
        </div>
      </div>
    </section>
    <section id="about" class="bg-white">
      <div class="container">
        <div class="row py-5 align-items-center">
          <div class="col-md-6">
            <img
              src="@/assets/about.png"
              class="img img-responsive w-100"
              alt="about"
            />
          </div>
          <div class="col-md-6">
            <img
              src="@/assets/logo.png"
              alt="logo"
              width="150"
              class="img img-responsive d-block mb-3"
            />
            <h2 class="text-danger">خريطة Civic Prob</h2>
            <p>
              Civic Prob Map هو مشروع أسسته جمعية Anakhil الواقعة في مراكش ، هذا
              المشروع موجه لمساعدة المرأة المغربية على تجنب أي نوع من مشاكل
              الشارع والمساعدة في حل مشاكل الشارع القائمة من خلال توجيه تقارير
              المشاكل إلى إدارتها المتخصصة.
            </p>
            <router-link to="#" class="btn btn-danger rounded-pill"
              >إكتشف أكثر</router-link
            >
          </div>
        </div>
      </div>
    </section>
    <section id="download" class="bg-danger">
      <div class="container">
        <div class="row py-5 justify-content-center">
          <div class="col-md-6">
            <h2 class="h1 text-center text-white">
              التطبيق متاح على كل أجهزة Android و iOS
            </h2>
            <p class="text-center">
              تم تصميم هذا التطبيق ليدعم أي جهاز محمول متوفر لتسهيل استخدامه في
              أي مكان وفي كل مكان
            </p>
            <div class="d-flex justify-content-center">
              <router-link to="#" class="btn btn-light rounded-pill mx-2"
                >Android</router-link
              >
              <router-link to="#" class="btn btn-light rounded-pill mx-2"
                >IOS</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="contact" class="bg-white">
      <div class="container">
        <div class="row py-5 justify-content-center">
          <div class="col-md-6 text-center">
            <h2 class="h1 text-center d-block text-danger">اتصل بنا</h2>
            <form action="#" method="post">
              <div class="form-group">
                <label for="">الإسم:</label>
                <input type="text" class="form-control" />
              </div>
              <div class="form-group">
                <label for="">البريد الإلكتروني:</label>
                <input type="text" class="form-control" />
              </div>
              <div class="form-group">
                <label for="">الرسالة:</label>
                <textarea class="form-control"></textarea>
              </div>
              <div class="form-group">
                <button class="btn btn-danger">أرسل</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
export default {
  data: () => {
    return {
      counter: {
        user: 0,
        administration: 0,
        reports: 0,
        solved: 0,
      },
    };
  },
  mounted() {
    console.log();
    let user = 3000;
    let administration = 300;
    let reports = 150000;
    let solved = 30000;
    setInterval(() => {
      if (this.counter.user < user) {
        this.counter.user += Math.ceil(user / 500);
      }
      if (this.counter.administration < administration) {
        this.counter.administration += Math.ceil(administration / 500);
      }
      if (this.counter.reports < reports) {
        this.counter.reports += Math.ceil(reports / 500);
      }
      if (this.counter.solved < solved) {
        this.counter.solved += Math.ceil(solved / 500);
      }

      if (
        this.counter.user > user &&
        this.counter.administration > administration &&
        this.counter.reports > reports &&
        this.counter.solved > solved
      ) {
        clearInterval();
      }
    }, 0);
  },
  methods: {},
};
</script>
<style scoped>
header {
  min-height: calc(100vh - 60px);
  background-image: url("~@/assets/map.jpg");
  background-position: center center;
  background-size: cover;
  position: relative;
}
header * {
  position: relative;
  z-index: 1;
}
header::before {
  content: "";
  position: absolute;
  inset-block: 0;
  inset-inline: 0;
  background-color: #ffffffb8;
  z-index: 0;
}
#records {
  position: relative;
  margin-block: -10vh;
}
#records::before {
  background-image: linear-gradient(45deg, #dc3545, #a27c2c);
  position: absolute;
  inset-block: 0;
  inset-inline: 0;
  content: "";
  clip-path: polygon(0 0, 100% 13%, 100% 100%, 0 84%);
}
.counter-label {
  font-size: 1.3rem;
}
</style>
