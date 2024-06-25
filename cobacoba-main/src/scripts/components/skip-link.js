class SkipLink extends HTMLElement {
    _shadowRoot = null;

    constructor() {
        super();
        this._shadowRoot = this.attachShadow({ mode: 'open' });
    }

    _loadStyle() {
        const link = document.createElement('link');
        link.setAttribute('rel', 'stylesheet');
        link.setAttribute('href', '../src/style/css/components/skip-link.css');
        this._shadowRoot.appendChild(link);
    }

    _emptyContent() {
        this._shadowRoot.innerHTML = '';
    }

    connectedCallback() {
        this.render();
    }

    render() {
        this._emptyContent();
        this._loadStyle();

        const container = document.createElement('div');
        const anchor = document.createElement('a');
        anchor.href = "#content";
        anchor.className = "skip-link";
        anchor.textContent = "Menuju ke konten";

        container.appendChild(anchor);
        this._shadowRoot.appendChild(container);
    }
}

customElements.define('skip-link', SkipLink);
