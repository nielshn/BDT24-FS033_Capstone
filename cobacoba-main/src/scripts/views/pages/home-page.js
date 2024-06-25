class HomePage extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
  }

  connectedCallback() {
    this.shadowRoot.innerHTML = `
          <header>
            <nav-bar></nav-bar>
          </header>
          <carousel-section></carousel-section>
          <categories-section></categories-section>
          <store-new-products></store-new-products>
      `;
  }
}

customElements.define('home-page', HomePage);
