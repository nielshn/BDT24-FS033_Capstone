@section('title', 'Dashboard Store')
<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <x-slot name="header">
                <div class="items-center bg-indigo-100 px-6 py-4 rounded-md shadow-md">
                    <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">Account Settings</h2>
                    <p class="text-0xl">Update your current profile</p>
                </div>
            </x-slot>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <form action="">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country">Your Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="Papel La Casa" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country">Your Email</label>
                                                <input type="text" class="form-control" id="email" name="email"
                                                    value="email@example.com" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country">Address 1</label>
                                                <input type="text" class="form-control" id="addressOne"
                                                    name="addressOne" value="Setra Duta Cemara" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="adressTwo">Address 2</label>
                                                <input type="text" class="form-control" id="adressTwo"
                                                    name="adressTwo" value="Blok B2 No. 34" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="province">Province</label>
                                                <select name="province" id="province" class="form-control">
                                                    <option value="West Java">West Java</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select name="city" id="city" class="form-control">
                                                    <option value="Bandung">Bandung</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="postalCode">Postal Code</label>
                                                <input type="text" class="form-control" id="postalCode"
                                                    name="postalCode" value="Setra Duta Cemara" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <input type="text" class="form-control" id="country" name="country"
                                                    value="Indonesia" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile"
                                                    value="+ 628 2020 111111" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">
                                                Save Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
