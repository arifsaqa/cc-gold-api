<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">CCGOLD</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
            <li><a href="/home" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
          </li>
          <li class="menu-header">Master</li>
            <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Harga</span></a>
                <ul class="dropdown-menu">
                    <li><a href="/buy/price" class="nav-link"></i><span>Harga Beli</span></a></li>
                    <li><a href="/sell/price" class="nav-link"></i><span>Harga Jual</span></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Promo</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/promo" class="nav-link"></i><span>Promo</span></a></li>
                    </ul>
                </li>
            </li>
          <li class="menu-header">Transaksi</li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Transaksi</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="/transaction/pending">Menunggu Persetujuan</a></li>
                <li><a class="nav-link" href="/transaction/completed">Selesai</a></li>
              </ul>
            </li>
            <li class="menu-header">Pengaturan</li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Pengaturan</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('users') }}">User</a></li>
                <li><a class="nav-link" href="{{ route('paymentMethod') }}">Payment Method</a></li>
              </ul>
            </li>
      </ul>
    </aside>
  </div>
