<li class="active treeview menu-open">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Menu</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
      </span>
  </a>
    <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-circle-o"></i>Dashboard</a></li>
        <li><a href="{{route('admin.kelolauser')}}"><i class="fa fa-circle-o"></i>Kelola User</a></li>
        <li><a href="{{route('admin.kelolajenis')}}"><i class="fa fa-circle-o"></i>Kelola Jenis</a></li>
        <li><a href="#"><i class="fa fa-circle-o"></i>List Keluhan</a></li>
        <li class="header">User Menu</li>
        <li><a href="#"><i class="fa fa-circle-o"></i>To Do List</a></li>
        <li><a href="{{route('user.myTicket')}}"><i class="fa fa-circle-o"></i>My Tickets</a></li>
        <li><a href="{{route('user.createTicket')}}"><i class="fa fa-circle-o"></i>Create Ticket</a></li>
    </ul>
</li>