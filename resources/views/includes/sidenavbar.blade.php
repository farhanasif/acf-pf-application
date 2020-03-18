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
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item {{ request()->is('admin-home') ? 'active' :''}}">
          <a href="{{url('/admin-home')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('all-employee')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Employee Setup
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Employees</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Batch Upload</p>
                </a>
              </li>
            </ul> --}}
          </li>
          <li class="nav-item ">
          <a href="{{route('all-user')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Employeer Setup
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/all-user')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/add-user')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/show-batch-upload')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Batch Upload</p>
                </a>
              </li>
            </ul> --}}
          </li>

          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p>
                Provident Fund
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('all-provident-fund')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PF Deposit</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('all-pf-interest')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PF Interest</p>
                </a>
            </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class=" nav-icon fas fa-chart-bar"></i>
              <p>
               Chart Of Accounts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('all-account-head')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Account Head</p>
                </a>
              </li>

            </ul>
          </li>

        <li class="nav-item has-treeview ">
             <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item ">
                  <a href="{{route('all-category')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Category</p>
                  </a>
              </li>

              <li class="nav-item">
                <a href="{{route('all-user-role')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Role</p>
                </a>
               </li>

              <li class="nav-item">
                <a href="{{route('all-employee-status')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Status</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('all-interest-source')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Interest Source</p>
                </a>
              </li>

              <li class="nav-item ">
                  <a href="{{route('all-level')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Level</p>
                  </a>
              </li>

              <li class="nav-item ">
                  <a href="{{route('all-sub-location')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sub Location</p>
                  </a>
              </li>

              <li class="nav-item ">
                <a href="{{route('all-work-place')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Work Place</p>
                </a>
              </li>

              <li class="nav-item {{ request()->is('/all-office') ? 'active menu-open' :''}}">
                <a href="{{route('all-office')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Offices</p>
                </a>
              </li>

              <li class="nav-item">
              <a href="{{route('all-department')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Department</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('all-position')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Position</p>
                  </a>
              </li>

              <li class="nav-item">
                <a href="{{route('all-base')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Base</p>
                  </a>
              </li>

              <li class="nav-item">
              <a href="{{route('all-pf-calculation')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PF Calculations</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{route('all-time-schedule')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Time Schedule</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{route('all-duration')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Duration</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{route('all-alert')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Alerts</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{url('ledger')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ledger Report</p>
                  </a>
                </li>

              <li class="nav-item">
              <a href="{{url('provident-fund-report')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Provident Fund</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Balance Sheet</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loan Statement</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Provident Fund</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Loan Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Loans</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Loan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adust Loan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Reconciliation
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('all-pf-withdraw')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PF Withdraw</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loan Disburse</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
