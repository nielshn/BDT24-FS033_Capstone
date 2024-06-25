/* eslint-disable linebreak-style */
/* eslint-disable class-methods-use-this */
/* eslint-disable no-undef */
/* eslint-disable linebreak-style */
/* eslint-disable no-underscore-dangle */
/* eslint-disable linebreak-style */
/* eslint-disable no-new */
class RegisterForm extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });

    // Adding Bootstrap CSS link dynamically
    const bootstrapLink = document.createElement('link');
    bootstrapLink.rel = 'stylesheet';
    bootstrapLink.href = 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css';
    this.shadowRoot.appendChild(bootstrapLink);

    const stylesheetLink = document.createElement('link');
    stylesheetLink.rel = 'stylesheet';
    stylesheetLink.href = '../src/style/css/components/main.css';
    this.shadowRoot.appendChild(stylesheetLink);

    const template = document.createElement('template');
    template.innerHTML = `
            <nav-bar></nav-bar>
            <div class="page-content page-auth">
              <div class="section-store-auth" data-aos="fade-up">
                  <div class="container">
                  <div class="row align-items-center row-login">
                      <div class="col-lg-6 text-center">
                      <img
                          src="../src/public/images/signin.png"
                          alt="login placeholder"
                          class="w-50 mb-4 mb-lg-none"
                          style="border-top-right-radius: 10%;border-bottom-left-radius: 10%"
                      />
                      </div>
                      <div class="col-lg-5">
                      <h2>Belanja kebutuhan utama, menjadi lebih mudah</h2>
                      <form action="#" class="mt-3">
                          <div class="form-group">
                          <label for="email">Email Address</label>
                          <input
                              type="email"
                              name="email"
                              id="email"
                              class="form-control w-75"
                          />
                          </div>
                          <div class="form-group">
                          <label for="password">Password</label>
                          <input
                              type="password"
                              name="password"
                              id="password"
                              class="form-control w-75"
                          />
                          </div>
                          <a
                          href="/dashboard.html"
                          class="btn btn-success btn-block w-75 mt-4"
                          data-page="dashboard"
                          >Sign In to My Account</a>
                          
                          <a
                          href="#"
                          class="btn btn-signup btn-block w-75 mt-2"
                          data-page="test"
                          >Sign Up</a
                          >
                      </form>
                      </div>
                  </div>
                  </div>
              </div>
            </div>
          `;

    this.shadowRoot.appendChild(template.content.cloneNode(true));
    this.shadowRoot.querySelector('.container').addEventListener('click', this._navigateNav.bind(this));
  }

  connectedCallback() {
    Aos.init();
  }

  _navigateNav(event) {
    event.preventDefault();
    const target = event.target.closest('.btn');
    if (target) {
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

customElements.define('register-form', RegisterForm);
