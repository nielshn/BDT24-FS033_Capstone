/* eslint-disable no-use-before-define */
/* eslint-disable no-underscore-dangle */
class CarouselSection extends HTMLElement {
  constructor() {
    super();
    this._shadowRoot = this.attachShadow({
      mode: 'open',
    });
  }

  _loadStyle() {
    const linkCss = document.createElement('link');
    linkCss.setAttribute('rel', 'stylesheet');
    linkCss.setAttribute('href', '../src/style/css/components/carousel.css');
    this._shadowRoot.appendChild(linkCss);
  }

  _emptyContent() {
    this._shadowRoot.innerHTML = '';
  }

  connectedCallback() {
    this.render();
    this._initializeCarousel();
  }

  render() {
    this._emptyContent();
    this._loadStyle();

    this._shadowRoot.innerHTML += `
        <div class="slideshow-container">
          <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="../src/public/images/banner.jpg" style="width:100%">
            <div class="text">Caption Text</div>
          </div>

          <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="../src/public/images/banner.jpg" style="width:100%">
            <div class="text">Caption Two</div>
          </div>

          <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="../src/public/images/banner.jpg" style="width:100%">
            <div class="text">Caption Three</div>
          </div>

          <a class="prev">&#10094;</a>
          <a class="next">&#10095;</a>
        </div>
        <br>

        <div style="text-align:center">
          <span class="dot"></span>
          <span class="dot"></span>
          <span class="dot"></span>
        </div>
      `;
  }

  _initializeCarousel() {
    let slideIndex = 0;
    const slides = this._shadowRoot.querySelectorAll('.mySlides');
    const dots = this._shadowRoot.querySelectorAll('.dot');

    function showSlides() {
      // eslint-disable-next-line no-plusplus
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
      }
      // eslint-disable-next-line no-plusplus
      slideIndex++;
      if (slideIndex > slides.length) { slideIndex = 1; }
      // eslint-disable-next-line no-plusplus
      for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(' active', '');
      }
      slides[slideIndex - 1].style.display = 'block';
      dots[slideIndex - 1].className += ' active';
      setTimeout(showSlides, 5000);
    }
    showSlides();

    const prev = this._shadowRoot.querySelector('.prev');
    const next = this._shadowRoot.querySelector('.next');

    prev.addEventListener('click', () => plusSlides(-1));
    next.addEventListener('click', () => plusSlides(1));

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => currentSlide(index + 1));
    });
  }
}

customElements.define('carousel-section', CarouselSection);
