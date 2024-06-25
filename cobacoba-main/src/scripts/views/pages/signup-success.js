/* eslint-disable no-trailing-spaces */
/* eslint-disable indent */
/* eslint-disable linebreak-style */
/* eslint-disable class-methods-use-this */
/* eslint-disable no-undef */
/* eslint-disable quotes */
/* eslint-disable no-new */
/* eslint-disable linebreak-style */
/* eslint-disable no-underscore-dangle */
class SignUpSuccess extends HTMLElement {
    constructor() {
      super();
      this.attachShadow({ mode: 'open' });
  
      this.shadowRoot.innerHTML = `
        <link rel="stylesheet" href="../src/style/css/components/main.css" />
  
        <nav-bar></nav-bar>
        <div class="page-content page-success">
            <div class="section-success" data-aos="zoom-in">
                <div class="container">
                <div class="row align-items-center row-login justify-content-center">
                    <div class="col-lg-6 text-center">
                    <img src="../src/public/images/bag.png" alt="success" class="mb-4" />
                    <h2>Welcome to Store</h2>
                    <p>
                        Kamu sudah berhasil terdaftar <br />
                        bersama kami. Let’s grow up now.
                    </p>
                    <div>
                        <a href="/dashboard.html" data-page="home" class="btn btn-success w-50 mt-4 link-page"
                        >My Dashboard</a
                        >
                        <a href="/index.html" data-page="home" class="btn btn-signup w-50 mt-2 link-page"
                        >Go To Shopping</a
                        >
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
      `;
  
      this.shadowRoot.addEventListener('click', this._handleClick.bind(this));
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
  
  customElements.define('signup-success', SignUpSuccess);
