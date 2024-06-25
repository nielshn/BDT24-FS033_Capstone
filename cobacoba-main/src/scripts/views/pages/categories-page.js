/* eslint-disable linebreak-style */
class CategoriesPage extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
  }

  connectedCallback() {
    this.shadowRoot.innerHTML = `
            <style>
              .breadcrumb {
                  background-color: #eceff1;
                  padding: 15px;
                  border-radius: 5px;
                  display: flex;
                  align-items: center;
                  gap: 5px;
                  margin-right: 12%;
                  margin-left: 12%;
              }
  
              .breadcrumb-link {
                  color: #007bff;
                  text-decoration: none;
              }
  
              .breadcrumb-link:hover {
                  text-decoration: underline;
              }
  
              .breadcrumb-current {
                  color: #6c757d;
              }
              
              .header-text {
                color: #29A867;
              }
  
              .content {
                max-width: 75%;
                margin: 0 auto;
                padding: 20px;
              }
  
              .content__heading {
                font-size: 24px;
                margin-bottom: 20px;
              }
              
              #query {
                width: 100%;
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 15px;
                
                background-color: #D9D9D9;
              }
  
              .content__search{
                max-width: 75%;
                margin: 0 auto;
                padding: 20px;
                text-align: center;
              }
  
              ul {
                list-style-type: none; /* Remove bullets */
                padding: 0; /* Remove default padding */
                margin-top: 20px;
              }
  
              li {
                margin-top: 40px;
              }
            </style>
            
            <header>
              <nav-bar></nav-bar>
            </header>

            <categories-section></categories-section>
            <store-all-products></store-all-products>
            
          `;
  }
}

customElements.define('categories-page', CategoriesPage);
