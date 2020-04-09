<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <li class=active><a class="nav-link" href="blank.html"><i class="fa fa-fire"></i> <span> Dashboard</span></a></li>
      <ul class="sidebar-menu">
        <li class="menu-header">Starter</li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-dashboard"></i><span>Master Data</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('post.index')}}"><span class="fas fa-book"> List Post</span></a></li>
            <li><a class="nav-link" href="{{ route('post.tampil_hapus')}}"><span class="fas fa-book"> List Post Dihapus</span></a></li>
            <li><a class="nav-link" href="{{ route('category.index')}}"><span class="far fa-clipboard"> List Category </span></a></li>
            <li><a class="nav-link" href="{{ route('tag.index')}}"><span class="far fa-bookmark"> List Tag </span></a></li>
          </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-dashboard"></i><span>User</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('user.index')}}"><span class="fas fa-book"> User</span></a></li>
            </ul>
          </li>

    </aside>
  </div>
