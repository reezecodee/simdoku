<nav class="navbar navbar-expand-lg main-navbar">
  <a href="{{ route('dashboard') }}" wire:navigate.hover class="navbar-brand sidebar-gone-hide">SIMDOKU</a>
  <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
  <div class="nav-collapse">
    <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
      <i class="fas fa-ellipsis-v"></i>
    </a>
    <ul class="navbar-nav">
      <li class="nav-item {{ Request::is('arsip*') ? 'active' : '' }}"><a href="{{ route('archive.index') }}"
          class="nav-link" wire:navigate.hover>Arsip</a></li>
      <li class="nav-item {{ Request::is('tanda-tangan*') ? 'active' : '' }}"><a href="{{ route('signature.index') }}"
          class="nav-link" wire:navigate.hover>Upload Tanda Tangan</a></li>
    </ul>
  </div>
  <div class="form-inline ml-auto">
    <ul class="navbar-nav">
      <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
      </li>
    </ul>
    <div class="search-element" style="max-width: 600px">
      <livewire:components.search-document />
    </div>
  </div>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="{{ asset('images/profile/profile.jpg') }}" class="rounded-circle mr-1">
        <div class="d-sm-none d-lg-inline-block">{{ $user->nama }}</div>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="{{ route('profile.index') }}" wire:navigate.hover class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>

<nav class="navbar navbar-secondary navbar-expand-lg">
  <div class="container">
    <ul class="navbar-nav">
      <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" wire:navigate.hover class="nav-link"><i
            class="fas fa-chart-pie"></i><span>Dashboard</span></a>
      </li>
      <li class="nav-item {{ Request::is('beasiswa*') ? 'active' : '' }}">
        <a href="{{ route('scholarship.index') }}" wire:navigate.hover class="nav-link"><i
            class="fas fa-graduation-cap"></i><span>Beasiswa</span></a>
      </li>
      <li class="nav-item {{ Request::is('surat/tugas*') ? 'active' : '' }}">
        <a href="{{ route('letter.index') }}" wire:navigate.hover class="nav-link"><i
            class="fas fa-mail-bulk"></i><span>Buat
            Surat</span></a>
      </li>
      <li class="nav-item {{ Request::is('proposal*') || Request::is('laporan*') ? 'active' : '' }} dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-book"></i><span>Proposal &
            laporan</span></a>
        <ul class="dropdown-menu">
          <li class="nav-item {{ Request::is('proposal*') ? 'active' : '' }}"><a href="{{ route('proposal.index') }}"
              wire:navigate.hover class="nav-link">Proposal</a></li>
          <li class="nav-item {{ Request::is('laporan*') ? 'active' : '' }}"><a href="{{ route('report.index') }}"
              wire:navigate.hover class="nav-link">Laporan</a></li>
        </ul>
      </li>
      <li class="nav-item {{ Request::is('formulir*') ? 'active' : '' }}">
        <a href="{{ route('form.index') }}" wire:navigate.hover class="nav-link"><i
            class="fas fa-table"></i><span>Formulir Pengajuan Dana</span></a>
      </li>
    </ul>
  </div>
</nav>