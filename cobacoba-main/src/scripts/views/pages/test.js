class CustomNavbar extends HTMLElement {
  constructor() {
    super();

    // Buat elemen host
    const shadowRoot = this.attachShadow({ mode: 'open' });

    // Tambahkan link Bootstrap ke dalam Shadow DOM
    const bootstrapLink = document.createElement('link');
    bootstrapLink.setAttribute('rel', 'stylesheet');
    bootstrapLink.setAttribute('href', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    shadowRoot.appendChild(bootstrapLink);

    // Buat navbar di dalam Shadow DOM
    const navbar = document.createElement('nav');
    navbar.classList.add('navbar', 'navbar-expand-lg', 'navbar-light', 'bg-light');

    // Isi navbar dengan konten Bootstrap navbar
    navbar.innerHTML = `
        <style>
          .logo {
            font-size: 1.5rem;
          }
  
          .nav-links {
            list-style: none;
            display: flex;
          }
  
          .nav-links li {
            padding: 0px 15px;
          }
  
          .nav-links a {
            text-decoration: none;
            color: black; /* Ganti warna teks untuk keperluan contoh */
          }
  
          .burger {
            display: none;
            cursor: pointer;
          }
  
          .burger div {
            width: 25px;
            height: 3px;
            background-color: black; /* Ganti warna garis untuk keperluan contoh */
            margin: 5px;
          }
  
          @media screen and (max-width: 768px) {
            .nav-links {
              display: none;
              flex-direction: column;
              width: 100%;
              position: absolute;
              top: 70px;
              left: 0;
              background-color: #333;
              padding: 10px 0;
            }
  
            .nav-links.active {
              display: flex;
            }
  
            .burger {
              display: block;
            }
          }
        </style>
        <nav class="navbar">
          <h1 class="logo">Logo</h1>
          <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
          <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
          </div>
        </nav>
      `;

    // Tambahkan navbar ke dalam Shadow DOM
    shadowRoot.appendChild(navbar);
  }

  connectedCallback() {
    // Dapatkan elemen burger dan nav-links dari shadow DOM
    const burger = this.shadowRoot.querySelector('.burger');
    const navLinks = this.shadowRoot.querySelector('.nav-links');

    // Tambahkan event listener untuk burger menu
    burger.addEventListener('click', () => {
      navLinks.classList.toggle('active');
    });
  }
}

// Daftarkan custom element ke dalam DOM
customElements.define('custom-navbar', CustomNavbar);
