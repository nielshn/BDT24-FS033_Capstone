<script>
    function showProductDetailModal(data) {
        document.getElementById('productDetailName').textContent = data.name;
        document.getElementById('productDetailDescription').textContent = data.description;
        document.getElementById('productDetailPrice').textContent = data.price;
        document.getElementById('productDetailStock').textContent = data.stock;
        document.getElementById('productDetailCategory').textContent = 'Category: ' + data.category;

        const photoContainer = document.getElementById('productDetailPhotos');
        photoContainer.innerHTML = '';
        data.photos.forEach(photo => {
            const img = document.createElement('img');
            img.src = photo;
            img.classList.add('img-fluid', 'thumbnail');
            photoContainer.appendChild(img);
        });

        $('#productDetailModal').modal('show');
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.view-product-details').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-id');

                fetch(`/admin/products/${productId}`, {
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
                });
        });

        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this product!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
