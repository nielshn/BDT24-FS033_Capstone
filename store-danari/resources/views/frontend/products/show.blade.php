@extends('dashboard')

@section('title', 'Product Details')

@section('content')
    <!-- Section Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Shirup Marzan</h2>
                <p class="dashboard-subtitle">
                    Create your own product
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <form action="">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="product-name">Product
                                                    Name</label>
                                                <input type="text" class="form-control" id="product-name"
                                                    aria-describedby="product-name" placeholder="Product Name"
                                                    value="Papel La Casa" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" class="form-control" id="price" value="200" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select name="category" id="category" class="form-select">
                                                    <option value="" disabled selected>
                                                        Select
                                                        Category
                                                    </option>
                                                    <option value="category1">
                                                        Category
                                                        1
                                                    </option>
                                                    <option value="category2">
                                                        Category
                                                        2
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="editor">Description</label>
                                                <textarea name="editor" id="editor" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5 btn-block">
                                                Save Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img src="/images/product-card-1.png" alt="product-card-1" class="w-100" />
                                        <a href="#" class="delete-gallery"><img src="/images/icon-delete.svg"
                                                alt="icon-delete" /></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img src="/images/product-card-2.png" alt="product-card-2" class="w-100" />
                                        <a href="#" class="delete-gallery"><img src="/images/icon-delete.svg"
                                                alt="icon-delete" /></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img src="/images/product-card-3.png" alt="product-card-3" class="w-100" />
                                        <a href="#" class="delete-gallery"><img src="/images/icon-delete.svg"
                                                alt="icon-delete" /></a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="file" name="file" id="file" style="display: none" multiple />
                                    <button class="btn btn-secondary btn-block mt-3" onclick="thisFileUpload()">
                                        Add Photo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('addon-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        function thisFileUpload() {
            document.getElementById("file").click();
        }
    </script>
    <script>
        ClassicEditor.create(document.querySelector("#editor"))
            .then((editor) => {
                console.log(editor);
            })
            .catch((error) => {
                console.error(error);
            });
    </script>
@endpush
