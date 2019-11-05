@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>User management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>Roles</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            
            <li>
                <a href="{{ route('admin.salary_groups.index') }}">
                    <i class="fa fa-group"></i>
                    <span>Salary Groups</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.employees.index') }}">
                    <i class="fa fa-user"></i>
                    <span>Employees</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.import_attendances.index') }}">
                    <i class="fa fa-calendar"></i>
                    <span>Generate Salary</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.employee_funds.index') }}">
                    <i class="fa fa-money"></i>
                    <span>Employee-funds</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.salaries.index') }}">
                    <i class="fa fa-money"></i>
                    <span>Salaries</span>
                </a>
            </li>
            

                <li class="{{ request()->is('admin/allowances') || request()->is('admin/allowances/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.allowances.index") }}">
                        <i class="fa fas fa-cogs">

                        </i>
                        <span>Allowances</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/deductions') || request()->is('admin/deductions/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.deductions.index") }}">
                        <i class="fa fa-cogs">

                        </i>
                        <span>Deductions</span>
                    </a>
                </li>

                <li class="{{ request()->is('admin/advances') || request()->is('admin/advances/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.advances.index") }}">
                        <i class="fa fa-cogs">

                        </i>
                        <span>Advances</span>
                    </a>
                </li>



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change Password</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

