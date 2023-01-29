<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="/images/logo-1.png" width="30" height="30">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Asuransi') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-building"></i>
            <span>Data Bangunan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu data bangunan</h6>
                <a class="collapse-item" href="{{ route('building-object.index') }}">Objek Bangunan</a>
                <a class="collapse-item" href="{{ route('building-type.index') }}">Tipe Bangunan</a>
                <a class="collapse-item" href="{{ route('building-flood-area.index') }}">Area Banjir</a>
                <a class="collapse-item" href="{{ route('building.index') }}">Bangunan</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Page Menu -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('customer.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Data Pelanggan</span></a>
    </li>

</ul>
