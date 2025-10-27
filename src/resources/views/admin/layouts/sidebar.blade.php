<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown">
      <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
        <div class="d-sm-none d-lg-inline-block">Hi, Daniel Queiroz</div>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title">Logged in 5 min ago</div>
        <a href="{{route('profile.edit')}}" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profile
        </a>
        <a href="{{ route('admin.settings.index') }}" class="dropdown-item has-icon">
          <i class="fas fa-cog"></i> Settings
        </a>
        <div class="dropdown-divider"></div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item has-icon text-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </form>
      </div>
    </li>
  </ul>
</nav>

<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="/">Portfolio</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">PF</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="nav-item {{ setSidebarActive(['dashboard']) }}">
        <a href="{{route('dashboard')}}" class="nav-link"><i class="fas fa-chart-area"></i></i><span>Dashboard</span></a>
      </li>

      <li class="menu-header">Sections</li>

      <li class="nav-item dropdown {{ setSidebarActive(['admin.typer-title.*', 'admin.hero.*']) }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Hero</span></a>
        <ul class="dropdown-menu">
          <li class="{{ setSidebarActive(['admin.typer-title.*']) }}"><a class="nav-link" href="{{route('admin.typer-title.index')}}">Typer Title</a></li>
          <li class="{{ setSidebarActive(['admin.hero.*']) }}"><a class="nav-link" href="{{route('admin.hero.index')}}">Hero Section</a></li>
        </ul>
      </li>

      <li class="{{ setSidebarActive(['admin.service.*']) }}"><a class="nav-link" href="{{route('admin.service.index')}}"><i class="fab fa-servicestack"></i></i><span>Services</span></a></li>
      <li class="{{ setSidebarActive(['admin.about.*']) }}"><a class="nav-link" href="{{route('admin.about.index')}}"><i class="fas fa-address-card"></i></i><span>About</span></a></li>

      <li class="nav-item dropdown {{ setSidebarActive(['admin.category.*', 'admin.portfolio-item.*', 'admin.portfolio-section-setting.*']) }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file"></i> <span>Portfolio</span></a>
        <ul class="dropdown-menu">
          <li class="{{ setSidebarActive(['admin.category.*']) }}"><a class="nav-link" href="{{route('admin.category.index')}}">Category</a></li>
          <li class="{{ setSidebarActive(['admin.portfolio-item.*']) }}"><a class="nav-link" href="{{route('admin.portfolio-item.index')}}">Portfolio Item</a></li>
          <li class="{{ setSidebarActive(['admin.portfolio-section-setting.*']) }}"><a class="nav-link" href="{{route('admin.portfolio-section-setting.index')}}">Section Setting</a></li>
        </ul>
      </li>

      <li class="nav-item dropdown {{ setSidebarActive(['admin.skill-item.*', 'admin.skill-section-setting.*']) }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-thumbs-up"></i></i></i> <span>Skill</span></a>
        <ul class="dropdown-menu">
          <li class="{{ setSidebarActive(['admin.skill-item.*']) }}"><a class="nav-link" href="{{route('admin.skill-item.index')}}">Skill Items</a></li>
          <li class="{{ setSidebarActive(['admin.skill-section-setting.*']) }}"><a class="nav-link" href="{{route('admin.skill-section-setting.index')}}">Section Setting</a></li>
        </ul>
      </li>

      <li class="{{ setSidebarActive(['admin.experience.*']) }}"><a class="nav-link" href="{{route('admin.experience.index')}}"><i class="fas fa-flask"></i></i><span>Experience</span></a></li>

      <li class="nav-item dropdown {{ setSidebarActive(['admin.feedback.*', 'admin.feedback-section-setting.*']) }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-star"></i> <span>Feedback</span></a>
        <ul class="dropdown-menu">
          <li class="{{ setSidebarActive(['admin.feedback.*']) }}"><a class="nav-link" href="{{route('admin.feedback.index')}}">Feedbacks</a></li>
          <li class="{{ setSidebarActive(['admin.feedback-section-setting.*']) }}"><a class="nav-link" href="{{route('admin.feedback-section-setting.index')}}">Section Setting</a></li>
        </ul>
      </li>

      <li class="nav-item dropdown {{ setSidebarActive(['admin.blog-category.*', 'admin.blog.*', 'admin.blog-section-setting.*']) }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-blog"></i></i> <span>Blog</span></a>
        <ul class="dropdown-menu">
          <li class="{{ setSidebarActive(['admin.blog-category.*']) }}"><a class="nav-link" href="{{route('admin.blog-category.index')}}">Category</a></li>
          <li class="{{ setSidebarActive(['admin.blog.*']) }}"><a class="nav-link" href="{{route('admin.blog.index')}}">Blog List</a></li>
          <li class="{{ setSidebarActive(['admin.blog-section-setting.*']) }}"><a class="nav-link" href="{{route('admin.blog-section-setting.index')}}">Section Setting</a></li>
        </ul>
      </li>

      <li class="nav-item dropdown {{ setSidebarActive(['admin.contact-section-setting.*']) }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-phone"></i><span>Contact</span></a>
        <ul class="dropdown-menu">
          <li class="{{ setSidebarActive(['admin.contact-section-setting.*']) }}"><a class="nav-link" href="{{route('admin.contact-section-setting.index')}}">Section Setting</a></li>
        </ul>
      </li>
      <li class="{{ setSidebarActive(['admin.privacy-policy.*']) }}"><a class="nav-link" href="{{route('admin.privacy-policy.index')}}"><i class="fas fa-file-contract"></i></i></i><span>Privacy Policy</span></a></li>

      <li class="nav-item dropdown {{ setSidebarActive([
        'admin.footer-social.*', 
        'admin.footer-info.*',
        'admin.footer-contact-info.*',
        'admin.footer-useful-links.*',
        'admin.footer-help-links.*',
      ]) }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-shoe-prints"></i><span>Footer</span></a>
        <ul class="dropdown-menu">
          <li class="{{ setSidebarActive(['admin.footer-social.*']) }}"><a class="nav-link" href="{{route('admin.footer-social.index')}}">Social Links</a></li>
          <li class="{{ setSidebarActive(['admin.footer-info.*']) }}"><a class="nav-link" href="{{route('admin.footer-info.index')}}">Footer Information</a></li>
          <li class="{{ setSidebarActive(['admin.footer-contact-info.*']) }}"><a class="nav-link" href="{{route('admin.footer-contact-info.index')}}">Footer Contact Info</a></li>
          <li class="{{ setSidebarActive(['admin.footer-useful-links.*']) }}"><a class="nav-link" href="{{route('admin.footer-useful-links.index')}}">Footer Useful Links</a></li>
          <li class="{{ setSidebarActive(['admin.footer-help-links.*']) }}"><a class="nav-link" href="{{route('admin.footer-help-links.index')}}">Footer Help Links</a></li>
        </ul>
      </li>

      <li class="menu-header">Settings</li>
      <li class="{{ setSidebarActive(['admin.settings.*']) }}"><a class="nav-link" href="{{route('admin.settings.index')}}"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
    </ul>
  </aside>
</div>
