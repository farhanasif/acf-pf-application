  <aside class="main-sidebar sidebar-white-primary elevation-4">
    <!-- Brand Logo -->
  <a href="{{url('/admin-home')}}" class="brand-link">
      <img src="{{ asset('images/logo/acf-pf.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ Auth::user()->role }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('theme/dist/img/user1-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0)" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item {{ request()->is('admin-home') ? 'active' :''}}">
          {{-- <a href="{{url('/admin-home')}}" class="nav-link"> --}}
            <a href="{{ url('/admin-home') }}" class="nav-link {{ request()->is('admin-home') ? 'active' :''}}">
              <i class="nav-icon fas fa-tachometer-alt text-blue"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
              <a href="{{ route('all-employee') }}" class="nav-link {{ request()->is('all-employee') ? 'active' :''}}">
              <i class="nav-icon fas fa-users text-green"></i>
              <p>
                All Employees
              </p>
            </a>

          </li>

          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fa fa-book text-blue"></i>
              <p>
                Provident Fund
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item {{ request()->is('provident-fund/*') ? ' menu-open' :''}}">
                <a href="{{route('all-provident-fund')}}" class="nav-link {{ request()->is('provident-fund/*') ? 'active' :''}}">
                  <i class="far fa-circle nav-icon text-blue"></i>
                  <p>PF Deposit</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('all-pf-interest')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-blue"></i>
                  <p>PF Interest</p>
                </a>
            </li>
          @if(Auth::user()->role=='stakeholder')
              <li class="nav-item">
                <a href="{{url('all/approved/pf-deposite')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-blue"></i>
                  <p>All Deposit Data</p>
                </a>
              </li>
            @endif
            </ul>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class=" nav-icon fas fa-chart-bar text-yellow"></i>
              <p>
               Chart Of Accounts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('all-account-head')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-yellow"></i>
                  <p>Account Head</p>
                </a>
              </li>

            </ul>
          </li>

        <li class="nav-item has-treeview ">
             <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-briefcase text-teal"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item ">
                  <a href="{{route('all-category')}}" class="nav-link">
                    <i class="far fa-circle nav-icon text-teal"></i>
                    <p>Category</p>
                  </a>
              </li>

              <li class="nav-item">
                <a href="{{route('all-user-role')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-teal"></i>
                  <p>User Role</p>
                </a>
               </li>

              <li class="nav-item">
                <a href="{{route('all-employee-status')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-teal"></i>
                  <p>Employee Status</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('all-interest-source')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-teal"></i>
                  <p>Interest Source</p>
                </a>
              </li>

              <li class="nav-item ">
                  <a href="{{route('all-level')}}" class="nav-link">
                    <i class="far fa-circle nav-icon text-teal"></i>
                    <p>Level</p>
                  </a>
              </li>

              <li class="nav-item ">
                  <a href="{{route('all-sub-location')}}" class="nav-link">
                    <i class="far fa-circle nav-icon text-teal"></i>
                    <p>Sub Location</p>
                  </a>
              </li>

              <li class="nav-item ">
                <a href="{{route('all-work-place')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-teal"></i>
                  <p>Work Place</p>
                </a>
              </li>

              <li class="nav-item {{ request()->is('/all-office') ? 'active menu-open' :''}}">
                <a href="{{route('all-office')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-teal"></i>
                  <p>Offices</p>
                </a>
              </li>

              <li class="nav-item">
              <a href="{{route('all-department')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-teal"></i>
                  <p>Department</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('all-position')}}" class="nav-link">
                    <i class="far fa-circle nav-icon text-teal"></i>
                    <p>Position</p>
                  </a>
              </li>

              <li class="nav-item">
                <a href="{{route('all-base')}}" class="nav-link">
                    <i class="far fa-circle nav-icon text-teal"></i>
                    <p>Base</p>
                  </a>
              </li>

              <li class="nav-item">
              <a href="{{route('all-pf-calculation')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-teal"></i>
                  <p>PF Calculations</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{route('all-time-schedule')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-teal"></i>
                  <p>Time Schedule</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{route('all-duration')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-teal"></i>
                  <p>Duration</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{route('all-alert')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-teal"></i>
                  <p>Alerts</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-table text-danger"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{url('ledger')}}" class="nav-link">
                    <i class="far fa-circle nav-icon text-danger"></i>
                    <p>Ledger Report</p>
                  </a>
                </li>

              {{-- <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Contribution Report</p>
                </a>
              </li> --}}

              <li class="nav-item">
                <a href="{{ url('generate-pf-balance-sheet') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>PF Balance Sharing</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('/generate-staff-settlement') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Staff Settlement</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/generate-employee-history') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Employee History</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/income-expenditure-report') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Income & Expenditure</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/receipts-payment-statement') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Receipts & Payments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/financial-statement') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Financial Statement</p>
                </a>
              </li>

             <li class="nav-item">
                <a href="{{ url('/loan-installment-report') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Loan Settlement Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="fas fa-hand-holding-usd nav-icon text-primary"></i>
              <p>
                Loan Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/all-loans')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>All Loans</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/create-loan')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>Create Loan</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>Adust Loan</p>
                </a>
              </li> --}}
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-coins text-success"></i>
              <p>
                Bank Transaction
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('all-pf-withdraw')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>PF Withdraw</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{url('/reconciliation')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Bank Reconciliation</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- <li class="nav-item ">
              <a href="{{ route('all-user') }}" class="nav-link {{ request()->is('all-user') ? 'active' :''}}">
                <i class="nav-icon fas fa-users text-warning"></i>
                <p>
                  System Accounts
                </p>
              </a>
            </li>

            <li class="nav-item ">
                <a href="{{ route('user-management') }}" class="nav-link {{ request()->is('user-management') ? 'active' :''}}">
                    <i class="nav-icon fas fa-users text-warning"></i>
                    <p>
                      User Management
                    </p>
                </a>
            </li> --}}

            @if(Auth::user()->role=='stakeholder')
            <li class="nav-item has-treeview">
              <a href="javascript:void(0)" class="nav-link">
                <i class="nav-icon fa fa-book text-blue"></i>
                <p>
                  System User
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('new/system/user')}}" class="nav-link">
                    <i class="far fa-circle nav-icon text-blue"></i>
                    <p>New User</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{url('system/user/list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon text-blue"></i>
                    <p>User List</p>
                  </a>
                </li>

              </ul>
            </li>
            @endif

          @if(Auth::user()->role=='stakeholder')
                    <li class="nav-item ">
                <a href="{{url('assign/permission')}}" class="nav-link">
                    <i class="nav-icon fas fa-users text-warning"></i>
                    <p>
                        Assign Permission
                    </p>
                </a>
            </li>
          @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
