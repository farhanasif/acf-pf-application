<?php

    $role = Auth::user()->role;
    $manage_route = DB::select("select * from manage_route where role = $role ");
    $menu_id = $manage_route[0]->menu_id;
    $sub_menu_id = $manage_route[0]->sub_menu_id;

    $menu = DB::select("SELECT * FROM menu WHERE id  IN($menu_id)");

    // dd($menu);

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  <a href="{{url('/admin-home')}}" class="brand-link">
      <img src="{{ asset('images/logo/acf.png')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">PF APP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('theme/dist/img/user1-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0)" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        @foreach ($menu as $item)
            @if($item->route == 'NA')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class=" nav-icon {{ $item->icon }}"></i>
                        <p>
                            {{ $item->name }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <?php $sub_menu = DB::select("SELECT * FROM sub_menu WHERE id  IN ($sub_menu_id) AND menu_id = $item->id ");?>

                        @foreach ($sub_menu as $item2)
                            <li class="nav-item">
                                <a href="{{$item2->route}}" class="nav-link">
                                    <i class="far fa-circle nav-icon text-yellow"></i>
                                    <p>
                                        {{ $item2->sub_menu_name }}

                                    </p>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </li>

            @else
                <li class="nav-item">
                    <a href=" {{ $item->route }} " class="nav-link">
                        <i class=" nav-icon {{ $item->icon }}"></i>
                        <p>
                            {{ $item->name }}

                        </p>
                    </a>
                </li>
            @endif

        @endforeach
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
