<x-app-layout :$title>
    <div class="containter">
        <div class="row g-3">
            <div class="col-sm-6 col-md-4 col-lg">
                <a href="{{ route('sppd.index') }}">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa-duotone fa-newspaper fa-3x text-dark"></i>
                            <div class="d-flex flex-column ms-3">
                                <h5 class="mb-0 card-title fs-6">SPPD</h5>
                                <p class="card-text fs-4 fw-semibold"></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <a href="{{ route('pegawai.index') }}">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa-duotone fa-user-tie fa-3x text-success"></i>
                            <div class="d-flex flex-column ms-3">
                                <h5 class="mb-0 card-title fs-6">Pegawai</h5>
                                <p class="card-text fs-4 fw-semibold"></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <a href="{{ route('user.index') }}">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa-duotone fa-user-circle fa-3x text-primary"></i>
                            <div class="d-flex flex-column ms-3">
                                <h5 class="mb-0 card-title fs-6">User</h5>
                                <p class="card-text fs-4 fw-semibold"></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
