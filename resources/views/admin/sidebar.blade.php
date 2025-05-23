<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
    <div class="sidebar-brand-text mx-3">AgroTech</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="/dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">List Data</div>


<li class="nav-item {{ request()->is('products') ? 'active' : '' }}">
    <a class="nav-link" href="/products">
        <i class="fas fa-light fa-briefcase"></i>
        <span>Data Alat</span></a>
</li>
<!-- Nav Item - Tables -->
<li class="nav-item {{ request()->is('users') ? 'active' : '' }}">
    <a class="nav-link" href="/users">
        <i class="fas fa-user"></i>
        <span>Data Penyewa</span></a>
</li>

<li class="nav-item {{ request()->is('transaction') ? 'active' : '' }}">
    <a class="nav-link" href="/transaction">
        <i class="fas fa-clipboard-list"></i>
        <span>Transaksi</span></a>
</li>

<li class="nav-item {{ request()->is('perusahaan') ? 'active' : '' }}">
    <a class="nav-link" href="/perusahaan">
        <i class="fas fa-clipboard-list"></i>
        <span>Profil Perusahaan</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->