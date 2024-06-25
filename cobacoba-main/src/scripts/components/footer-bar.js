/* eslint-disable linebreak-style */
class FooterBar extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
  }

  connectedCallback() {
    this.render();
  }

  render() {
    this.shadowRoot.innerHTML = `
      <style>
        .footer {
          width: 100%;
          background-color: #263238;
          min-height: 250px;
          padding: 10px 0px 25px 0px;
          color: #ccc;
        }

        .container {
          width: 80%;
          margin: 0 auto;
        }

        .row {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
        }

        .col {
          flex: 1;
          margin-bottom: 20px;
        }

        .headin5_amrc {
          font-size: 24px;
          color: #fff;
          margin-bottom: 15px;
        }

        .footer ul {
          list-style-type: none;
          padding: 0;
        }

        .footer ul li {
          padding-bottom: 5px;
        }

        .footer ul li a {
          color: #ccc;
          text-decoration: none;
        }

        .footer ul li a:hover {
          color: #fff;
        }

        .social_footer_ul {
          list-style-type: none;
          padding: 0;
          display: flex;
          justify-content: center;
          margin-top: 15px;
        }

        .social_footer_ul li {
          padding: 0 10px;
        }

        .social_footer_ul li a {
          color: #ccc;
          border: 1px solid #ccc;
          padding: 8px;
          border-radius: 50%;
          text-decoration: none;
        }

        .social_footer_ul li a:hover {
          color: #fff;
          border-color: #fff;
        }
      </style>

      <footer class="footer">
        <div class="container">
          <div class="row">
            <div class="col">
              <h5 class="headin5_amrc">Find us</h5>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              <p><i class="fa fa-location-arrow"></i> 9878/25 sec 9 rohini 35</p>
              <p><i class="fa fa-phone"></i> +91-9999878398</p>
              <p><i class="fa fa-envelope"></i> info@example.com</p>
            </div>

            <div class="col">
              <h5 class="headin5_amrc">Quick links</h5>
              <ul>
                <li><a href="http://webenlance.com">Home</a></li>
                <li><a href="http://webenlance.com">About</a></li>
                <li><a href="http://webenlance.com">Services</a></li>
                <li><a href="http://webenlance.com">Pricing</a></li>
                <li><a href="http://webenlance.com">Blog</a></li>
                <li><a href="http://webenlance.com">Contact</a></li>
              </ul>
            </div>

            <div class="col">
              <h5 class="headin5_amrc">Follow us</h5>
              <ul class="social_footer_ul">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
              </ul>
            </div>
          </div>
          <p style="text-align:center">Copyright @2017 | Designed With by <a href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=BDT24-FS033@dicoding.org">BDT24-FS033@dicoding.org</a></p>
        </div>
      </footer>
    `;
  }
}

customElements.define('footer-bar', FooterBar);
