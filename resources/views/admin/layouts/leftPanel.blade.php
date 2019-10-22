<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">THANH ĐIỀU KHIỂN</li>
            <li><a href="{{route('dashboard-v1')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="{{isset($type_menu) && $type_menu == 'product' ? 'active' : ''}} treeview">
                <a href="#">
                    <i class="fa fa-product-hunt text-primary"></i> <span>Quản lý sản phẩm</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin_list_category')}}"><i class="fa fa-circle-o"></i><span>Danh mục sản phẩm</span></a></li>
                    <li><a href="{{route('admin_list_product')}}"><i class="fa fa-circle-o"></i><span>Danh sách sản phẩm</span></a></li>
                </ul>
            </li>
            <li {{isset($type_menu) && $type_menu == 'service' ? 'active' : ''}}><a href="{{route('admin_list_service')}}"><i class="fa fa-book"></i> <span>Danh sách dịch vụ</span></a></li>
            <li {{isset($type_menu) && $type_menu == 'contact' ? 'active' : ''}}><a href="{{route('admin_list_contact')}}"><i class="fa fa-id-card"></i> <span>Danh sách liên hệ</span></a></li>
            <li {{isset($type_menu) && $type_menu == 'config' ? 'active' : ''}}><a href="{{route('admin_update_config_view')}}"><i class="fa fa-cogs"></i> <span>Cấu hình website</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
