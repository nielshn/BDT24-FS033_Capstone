/* eslint-disable linebreak-style */
/* eslint-disable class-methods-use-this */
/* eslint-disable no-undef */
/* eslint-disable quotes */
/* eslint-disable no-new */
/* eslint-disable linebreak-style */
/* eslint-disable no-underscore-dangle */
class SignUp extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });

    this.shadowRoot.innerHTML = `
      <link rel="stylesheet" href="../src/style/css/components/main.css" />

      <nav-bar></nav-bar>
      <div class="page-content page-auth" id="register">
        <div class="section-store-auth" data-aos="fade-up">
          <div class="container">
            <div class="row align-items-center justify-content-center row-login">
              <div class="col-lg-4">
                <h2>
                  Memulai untuk jual beli <br />
                  dengan cara terbaru
                </h2>
                <form action="#" class="mt-3">
                  <div class="form-group">
                    <label for="name">Full Name</label>
                    <input
                      type="text"
                      name="name"
                      id="name"
                      class="form-control is-valid"
                      v-model="name"
                      autofocus
                    />
                  </div>
                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input
                      type="email"
                      name="email"
                      id="email"
                      class="form-control is-invalid"
                      v-model="email"
                    />
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input
                      type="password"
                      name="password"
                      id="password"
                      class="form-control"
                      v-model="password"
                    />
                  </div>
                  <div class="form-group">
                    <label for="store">Store</label>
                    <p class="text-muted">Apakah anda ingin membuka toko?</p>
                    <div
                      class="custom-control custom-radio custom-control-inline"
                    >
                      <input
                        type="radio"
                        class="custom-control-input"
                        name="is_store_open"
                        id="openStoreTrue"
                        v-model="is_store_open"
                        :value="true"
                      />
                      <label for="openStoreTrue" class="custom-control-label"
                        >Iya, boleh</label
                      >
                    </div>
                    <div
                      class="custom-control custom-radio custom-control-inline"
                    >
                      <input
                        type="radio"
                        class="custom-control-input"
                        name="is_store_open"
                        id="openStoreFalse"
                        v-model="is_store_open"
                        :value="false"
                      />
                      <label for="openStoreFalse" class="custom-control-label"
                        >Enggak, makasih</label
                      >
                    </div>
                  </div>
                  <div class="form-group" v-if="is_store_open">
                    <label for="tokoName">Nama Toko</label>
                    <input
                      type="text"
                      name="tokoName"
                      id="tokoName"
                      class="form-control"
                      v-model="store_name"
                      autofocus
                    />
                  </div>
                  <div class="form-group" v-if="is_store_open">
                    <label for="category">Kategori</label>
                    <select name="category" class="form-control" id="category">
                      <option value="" disabled>Select Category</option>
                    </select>
                  </div>

                  <a href="#" data-page="signup-success" class="btn btn-success btn-block mt-4 link-page"
                    >Sign Up Now</a
                  >
                  <a href="#" data-page="register" class="btn btn-signup btn-block mt-2 link-page"
                    >Back to Sign In</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;

    this.shadowRoot.addEventListener('click', this._handleClick.bind(this));

    const scriptAOS = document.createElement('script');
    scriptAOS.src = 'https://unpkg.com/aos@2.3.1/dist/aos.js';
    scriptAOS.onload = () => AOS.init();
    this.shadowRoot.appendChild(scriptAOS);

    const scriptVue = document.createElement('script');
    scriptVue.src = '../vendor/vue/vue.js';
    scriptVue.onload = () => {
      const scriptToasted = document.createElement('script');
      scriptToasted.src = 'https://unpkg.com/vue-toasted';
      scriptToasted.onload = () => {
        Vue.use(Toasted);
        new Vue({
          el: this.shadowRoot.querySelector('#register'),
          mounted() {
            AOS.init();
            this.$toasted.error(
              "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
              {
                position: "top-center",
                className: "rounded",
                duration: 5000,
                icon: "error",
              }
            );
          },
          data: {
            name: "Angga Hazza Sett",
            email: "danari@gmail.id",
            password: "",
            is_store_open: true,
            store_name: "",
          },
        });
      };
      this.shadowRoot.appendChild(scriptToasted);
    };
    this.shadowRoot.appendChild(scriptVue);
  }

  _handleClick(event) {
    const target = event.target.closest('.link-page');
    if (target) {
      event.preventDefault();
      const page = target.getAttribute('data-page');
      if (page) {
        window.dispatchEvent(new CustomEvent('navigateNav', {
          detail: {
            page,
          },
        }));
      }
    }
  }
}

customElements.define('signup-component', SignUp);
