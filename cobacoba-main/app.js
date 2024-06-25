import '../src/scripts/components/index.js';
import '../src/scripts/views/pages/index.js';

document.addEventListener('DOMContentLoaded', () => {
  window.addEventListener('navigateNav', (event) => {
    const { page } = event.detail;
    const content = document.getElementById('content');

    if (page === 'home') {
      content.innerHTML = '<home-page></home-page>';
    } else if (page === 'searchpage') {
      content.innerHTML = '<search-page></search-page>';
    } else if (page === 'categories') {
      content.innerHTML = '<categories-page></categories-page>';
    } else if (page === 'detail') {
      content.innerHTML = '<product-details></product-details>';
    } else if (page === 'register') {
      content.innerHTML = '<register-form></register-form>';
    } else if (page === 'signup') {
      content.innerHTML = '<signup-component></signup-component>';
    } else if (page === 'signup-success') {
      content.innerHTML = '<signup-success></signup-success>';
    } else if (page === 'dashboard') {
      content.innerHTML = '<dashboard-page></dashboard-page>';
    } else if (page === 'test') {
      content.innerHTML = '<custom-navbar></custom-navbar>';
    }
  });
});
