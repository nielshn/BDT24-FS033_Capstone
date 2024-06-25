/* eslint-disable linebreak-style */
/* eslint-disable class-methods-use-this */
/* eslint-disable linebreak-style */
/* eslint-disable no-underscore-dangle */
/* eslint-disable linebreak-style */
class StoreNewProducts extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });

    // Add the Bootstrap CSS link dynamically
    const bootstrapLink = document.createElement('link');
    bootstrapLink.rel = 'stylesheet';
    bootstrapLink.href = 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css';

    // Add custom CSS link dynamically if needed
    const customStylesLink = document.createElement('link');
    customStylesLink.rel = 'stylesheet';
    customStylesLink.href = '../src/style/css/components/main.css';

    const styles = document.createElement('style');
    styles.textContent = `
          `;

    const container = document.createElement('div');
    container.innerHTML = `
            <section class="store-new-products">
                <div class="container">
                    <div class="row">
                        <div class="col-12" data-aos="fade-up" style="margin-top: 20px;margin-bottom: 20px;color: grey">
                            <h4>All Products</h4>
                        </div>
                    </div>
                    <div class="row">
                        ${this.createProduct('Apple Watch 4', '../src/public/images/pic.jpg', '$890', 100)}
                        ${this.createProduct('Orange Bogotta', './images/products-orange-bogotta.jpg', '$94,509', 200)}
                        ${this.createProduct('Sofa Ternyaman', './images/products-sofa-ternyaman.jpg', '$1,409', 300)}
                        ${this.createProduct('Bubuk Maketti', './images/products-bubuk-maketti.jpg', '$225', 400)}
                        ${this.createProduct('Tatakan Gelas', './images/products-tatakan-gelas.jpg', '$45,184', 500)}
                        ${this.createProduct('Mavic Kawe', './images/products-mavic-kawe.jpg', '$503', 600)}
                        ${this.createProduct('Black Edition Nike', './images/products-black-edition-nike.jpg', '$70,482', 700)}
                        ${this.createProduct('Monkey Toys', './images/products-monkey-toys.jpg', '$783', 800)}
                    </div>
                </div>
            </section>
          `;
    this.shadowRoot.append(bootstrapLink, customStylesLink, styles, container);

    this.shadowRoot.querySelector('.container').addEventListener('click', this._navigateNav.bind(this));
  }

  createProduct(name, imageUrl, price, delay) {
    return `
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="${delay}">
                <a href="#" class="component-products d-block" data-page="detail" >
                    <div class="products-thumbnail">
                        <div class="products-image" style="background-image: url('${imageUrl}');"></div>
                    </div>
                    <div class="products-text">${name}</div>
                    <div class="products-price">${price}</div>
                </a>
            </div>
          `;
  }

  _navigateNav(event) {
    event.preventDefault();
    const target = event.target.closest('.component-products');
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

customElements.define('store-new-products', StoreNewProducts);
