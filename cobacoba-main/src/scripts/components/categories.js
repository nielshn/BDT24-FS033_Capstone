/* eslint-disable no-console */
/* eslint-disable class-methods-use-this */
/* eslint-disable no-underscore-dangle */
class CategoriesSection extends HTMLElement {
  constructor() {
    super();
    this._shadowRoot = this.attachShadow({
      mode: 'open',
    });
  }

  _loadStyle() {
    const link = document.createElement('link');
    link.setAttribute('rel', 'stylesheet');
    link.setAttribute('href', '../src/style/css/components/main.css');
    this._shadowRoot.appendChild(link);
  }

  connectedCallback() {
    this.render();
    this._initializeAOS();
  }

  render() {
    this._loadStyle();

    this._shadowRoot.innerHTML += `
        <section class="store-trend-categories">
          <div class="container">
            <div class="row">
              <div style="margin-top: 20px;margin-bottom: 20px;margin-left:14px;color: grey" data-aos="fade-up">
                <h3>Categories</h3>
              </div>
            </div>
            <div class="row">
              <div
                class="col-6 col-md-3 col-lg-2"
                data-aos="fade-up"
                data-aos-delay="100"
              >
                <a href="#" class="component-categories d-block" data-page="gadgets">
                  <div class="categories-image">
                    <img
                      src="../src/public/images/categorie1.jpg"
                      alt="categories-gadgets"
                      class="w-100"
                    />
                  </div>
                  <p class="categories-text">Gadgets</p>
                </a>
              </div>
              <div
                class="col-6 col-md-3 col-lg-2"
                data-aos="fade-up"
                data-aos-delay="200"
              >
                <a href="#" class="component-categories d-block" data-page="furniture">
                  <div class="categories-image">
                    <img
                      src="../src/public/images/categorie2.jpg"
                      alt="categories-furniture"
                      class="w-100"
                    />
                  </div>
                  <p class="categories-text">Furniture</p>
                </a>
              </div>
              <div
                class="col-6 col-md-3 col-lg-2"
                data-aos="fade-up"
                data-aos-delay="300"
              >
                <a href="#" class="component-categories d-block" data-page="makeup">
                  <div class="categories-image">
                    <img
                      src="../src/public/images/categorie3.jpg"
                      alt="categories-makeup"
                      class="w-100"
                    />
                  </div>
                  <p class="categories-text">Make Up</p>
                </a>
              </div>
              <div
                class="col-6 col-md-3 col-lg-2"
                data-aos="fade-up"
                data-aos-delay="400"
              >
                <a href="#" class="component-categories d-block" data-page="sneakers">
                  <div class="categories-image">
                    <img
                      src="../src/public/images/categorie4.jpg"
                      alt="categories-sneaker"
                      class="w-100"
                    />
                  </div>
                  <p class="categories-text">Sneaker</p>
                </a>
              </div>
              <div
                class="col-6 col-md-3 col-lg-2"
                data-aos="fade-up"
                data-aos-delay="500"
              >
                <a href="#" class="component-categories d-block" data-page="tools">
                  <div class="categories-image">
                    <img
                      src="../src/public/images/categorie5.jpg"
                      alt="categories-tools"
                      class="w-100"
                    />
                  </div>
                  <p class="categories-text">Tools</p>
                </a>
              </div>
              <div
                class="col-6 col-md-3 col-lg-2"
                data-aos="fade-up"
                data-aos-delay="600"
              >
                <a href="#" class="component-categories d-block" data-page="baby">
                  <div class="categories-image">
                    <img
                      src="../src/public/images/categorie6.jpg"
                      alt="categories-baby"
                      class="w-100"
                    />
                  </div>
                  <p class="categories-text">Baby</p>
                </a>
              </div>
            </div>
          </div>
        </section>
      `;
    this._shadowRoot.querySelectorAll('.component-categories').forEach((link) => {
      link.addEventListener('click', this._navigateCategories.bind(this));
    });
  }

  _initializeAOS() {
    if (window.Aos) {
      window.Aos.refresh();
    } else {
      console.error('AOS library is not loaded.');
    }
  }

  _navigateCategories(event) {
    event.preventDefault();
    const page = event.currentTarget.getAttribute('data-page');
    window.dispatchEvent(new CustomEvent('navigateCategories', { detail: { page } }));
  }
}

customElements.define('categories-section', CategoriesSection);
