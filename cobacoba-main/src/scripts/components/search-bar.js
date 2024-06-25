class SearchBar extends HTMLElement {
  _shadowRoot = null;
  _style = null;

  _submitEvent = "submit";
  _searchEvent = "search";

  constructor() {
    super();

    this._shadowRoot = this.attachShadow({ mode: "open" });
    this._style = document.createElement("style");

    this.render();
  }

  _emptyContent() {
    this._shadowRoot.innerHTML = "";
  }

  connectedCallback() {
    this._shadowRoot.querySelector("form").addEventListener("submit", (event) => this._onFormSubmit(event, this));
    this.addEventListener(this._submitEvent, this._onSearchBarSubmit);
  }

  disconnectedCallback() {
    this._shadowRoot.querySelector("form").removeEventListener("submit", (event) => this._onFormSubmit(event, this));
    this.removeEventListener(this._submitEvent, this._onSearchBarSubmit);
  }

  _onFormSubmit(event, searchBarInstance) {
    searchBarInstance.dispatchEvent(new CustomEvent("submit"));

    event.preventDefault();
  }

  _onSearchBarSubmit() {
    const query = this._shadowRoot.querySelector("input#name").value;

    if (!query) return;

    this.dispatchEvent(
      new CustomEvent(this._searchEvent, {
        detail: { query },
        bubbles: true,
      })
    );
  }

  _updateStyle() {
    this._style.textContent = `
        :host {
          display: inline;
        }
      
        .floating-form {
          background-color: transparent;
          padding: 0;
          border-radius: 5px;
    
          position: sticky;
          top: 10px;
        }
    
        .search-form {
          display: flex;
          gap: 8px;
          align-items: center;
        }
    
        .search-form .form-group {
          flex-grow: 1;
          position: relative;
        }
    
        .search-form .form-group input {
          display: block;
          width: 100%;
          height: 30px;
          padding: 0 20px;
          border: 2px solid #40e0d0; /* turquoise border color */
          border-radius: 20px; /* rounded corners */
          font-size: 1rem;
        }
    
        .search-form .form-group input:focus-visible {
          outline: 0;
          border-color: #40e0d0;
        }
    
        .search-form .form-group input::placeholder {
          color: #ccc; /* placeholder color */
        }
    
        .search-form .form-group label {
          display: none; /* hide label */
        }
    
        .search-form button {
          border: none;
          background: transparent;
          cursor: pointer;
        }
    
        .search-form button svg {
          fill: #ccc; /* icon color */
          width: 24px;
          height: 24px;
        }
    
        .search-form button:hover svg {
          fill: #40e0d0; /* icon hover color */
        }
      `;
  }

  render() {
    this._emptyContent();
    this._updateStyle();

    this._shadowRoot.appendChild(this._style);
    this._shadowRoot.innerHTML += `
        <div class="floating-form">
          <form id="searchForm" class="search-form">
            <div class="form-group">
              <input id="name" name="name" type="search" required placeholder="Search..." />
            </div>
            <button type="submit">
              <svg viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27a6.471 6.471 0 001.48-5.34C15.17 5.64 12.52 3 9.25 3S3.33 5.64 3.04 8.93a6.471 6.471 0 005.34 7.48c1.61.28 3.16-.1 4.37-1.04l.27.28v.79l4.99 4.99a1 1 0 001.41 0l.99-.99a1 1 0 000-1.41L15.5 14zM9.25 14c-2.62 0-4.75-2.13-4.75-4.75S6.63 4.5 9.25 4.5 14 6.63 14 9.25 11.87 14 9.25 14z"/>
              </svg>
            </button>
          </form>
        </div>
      `;
  }
}

customElements.define("search-bar", SearchBar);
