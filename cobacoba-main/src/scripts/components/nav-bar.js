/* eslint-disable no-dupe-class-members */
/* eslint-disable class-methods-use-this */
/* eslint-disable no-underscore-dangle */
class NavBar extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
  }

  connectedCallback() {
    this.render();
    this._setupEventListeners();
  }

  _clearContent() {
    this.shadowRoot.innerHTML = '';
  }

  _loadStyle() {
    const link = document.createElement('link');
    link.setAttribute('rel', 'stylesheet');
    link.setAttribute('href', '../src/style/css/components/main.css');
    this.shadowRoot.appendChild(link);
  }

  render() {
    this._clearContent();
    this._loadStyle();

    this.shadowRoot.innerHTML += `
      <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
        <div class="container">
          <a href="#" data-page="home" class="nav-link" id="navbar-brand">
            <img src="../src/public/images/logo.png" alt="Logo">
          </a>
          <button class="navbar-toggler" type="button" id="navbar-toggler">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a href="#" data-page="searchpage" class="nav-link"><search-bar></search-bar></a>
              </li>
              <li class="nav-item active">
                <a href="#" data-page="home" class="nav-link">Home</a>
              </li>
              <li class="nav-item">
                <a href="#" data-page="categories" class="nav-link">Categories</a>
              </li>
              <li class="nav-item">
                <a href="#" data-page="detail" class="nav-link">Rewards</a>
              </li>
              <li class="nav-item">
                <a href="#" data-page="signup" class="nav-link">Sign Up</a>
              </li>
              <li class="nav-item">
                <a href="#" data-page="register" class="btn btn-success nav-link">Sign In</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    `;
  }

  _setupEventListeners() {
    const navbarToggler = this.shadowRoot.getElementById('navbar-toggler');
    const navbarResponsive = this.shadowRoot.getElementById('navbarResponsive');

    navbarToggler.addEventListener('click', () => {
      navbarResponsive.classList.toggle('show');
    });

    this.shadowRoot.querySelectorAll('.nav-link').forEach((link) => {
      link.addEventListener('click', this._navigateNav.bind(this));
    });
  }

  _navigateNav(event) {
    event.preventDefault();
    const page = event.currentTarget.getAttribute('data-page');
    if (page) {
      window.dispatchEvent(new CustomEvent('navigateNav', {
        detail: {
          page,
        },
      }));
    }
  }
}

customElements.define('nav-bar', NavBar);
