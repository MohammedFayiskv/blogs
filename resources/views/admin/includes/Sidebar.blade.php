<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{URL::to('index')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Masters</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a  href="{{ route('categories.index') }}">
           
              <i class="bi bi-circle"></i><span>Category</span>
            </a>
          </li>
          <li>
            <a href="{{ route('tags.index') }}">
              <i class="bi bi-circle"></i><span>Tags</span>
            </a>
          </li>
          <li>
            <a href="{{ route('blogs.index') }}">
              <i class="bi bi-circle"></i><span>Blogs</span>
            </a>
          </li>
       
        </ul>
      </li><!-- End Components Nav -->

     

    </ul>

  </aside>