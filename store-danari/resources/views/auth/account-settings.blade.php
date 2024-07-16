@section('title', 'My Account Store')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="items-center bg-gradient-to-r from-indigo-200 to-purple-300 px-4 py-2 rounded-md shadow-md">
                <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">Account Settings</h2>
                <p class="text-md">Update your current profile</p>
            </div>
            <div class="dashboard-content mt-4">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('account-settings.store') }}" id="locations" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address_one">Address 1</label>
                                                <input type="text" class="form-control" id="address_one"
                                                    name="address_one"
                                                    value="{{ $user->address->address_one ?? '' }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address_two">Address 2</label>
                                                <input type="text" class="form-control" id="address_two"
                                                    name="address_two"
                                                    value="{{ $user->address->address_two ?? '' }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="provinces_id">Province</label>
                                                <select name="provinces_id" id="provinces_id" class="form-control"
                                                    v-model="provinces_id" @change="getRegenciesData" required>
                                                    <option value="" selected disabled>Select Province</option>
                                                    <option v-for="province in provinces" :value="province.id"
                                                        :selected="province.id == {{ $user->address->provinces_id ?? 'null' }}">
                                                        @{{ province.name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="regencies_id">City</label>
                                                <select name="regencies_id" id="regencies_id" class="form-control"
                                                    v-model="regencies_id" required>
                                                    <option value="" selected disabled>Select City</option>
                                                    <option v-for="regency in regencies" :value="regency.id"
                                                        :selected="regency.id == {{ $user->address->regencies_id ?? 'null' }}">
                                                        @{{ regency.name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="zip_code">Postal Code</label>
                                                <input type="text" class="form-control" id="zip_code"
                                                    name="zip_code" value="{{ $user->address->zip_code ?? '' }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <input type="text" class="form-control" id="country" name="country"
                                                    value="{{ $user->address->country ?? '' }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number">Mobile</label>
                                                <input type="number" class="form-control" id="phone_number"
                                                    name="phone_number" value="{{ $user->phone_number }}"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                                    onkeydown="return event.keyCode !== 189 && event.keyCode !== 109" />
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
    @push('addon-script')
        <script src="/vendor/vue/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
            var locations = new Vue({
                el: "#locations",
                mounted() {
                    AOS.init();
                    this.getProvincesData();
                    this.provinces_id = "{{ $user->address->provinces_id ?? '' }}";
                    this.regencies_id = "{{ $user->address->regencies_id ?? '' }}";
                },
                data: {
                    provinces: null,
                    regencies: null,
                    provinces_id: null,
                    regencies_id: null
                },
                methods: {
                    getProvincesData() {
                        var self = this;
                        axios.get('{{ route('api-provinces') }}')
                            .then(function(response) {
                                self.provinces = response.data;
                                if (self.provinces_id) {
                                    self.getRegenciesData();
                                }
                            })
                    },
                    getRegenciesData() {
                        var self = this;
                        axios.get('{{ url('regencies') }}/' + self.provinces_id)
                            .then(function(response) {
                                self.regencies = response.data;
                            })
                    },
                },
                watch: {
                    provinces_id: function(val, oldVal) {
                        this.regencies_id = null;
                        this.getRegenciesData();
                    },
                }
            });
        </script>
    @endpush
</x-app-layout>
