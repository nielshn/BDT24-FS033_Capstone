@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener for search form
            document.getElementById('search-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const searchQuery = e.target.search.value;

                fetch(`{{ route('admin.allproducts.index') }}?search=${searchQuery}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('products-table').innerHTML = data.html;
                        attachViewDetailEvents();
                    });
            });

            // Function to attach click event listeners to view detail buttons
            function attachViewDetailEvents() {
                document.querySelectorAll('.view-product-detail').forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.getAttribute('data-id');
                        fetch(`{{ route('admin.allproducts.show', '') }}/${productId}`, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                showProductDetailModal(data);
                            });
                    });
                });
            }

            // Initial attachment of view detail events
            attachViewDetailEvents();
        });
    </script>
@endpush
