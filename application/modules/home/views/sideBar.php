<!-- Page Sidebar Start-->
  <div class="sidebar-wrapper">
    <div>
      <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="<?=IMG?>logo/logo.png"
            alt=""></a>
        <div class="back-btn"><i data-feather="grid"></i></div>
        <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid">
          </i></div>
      </div>
      <div class="logo-icon-wrapper"><a href="index.html">
          <div class="icon-box-sidebar"><i data-feather="grid"></i></div>
        </a></div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn">
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                  aria-hidden="true"></i></div>
            </li>
            <li class="pin-title sidebar-list">
              <h6>Pinned</h6>
            </li>
            <hr>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                href="javascript:void(0)"><i data-feather="home"></i><span class="lan-3">Dashboard</span></a>
              <ul class="sidebar-submenu">
                <li><a class="lan-4" href="javascript://">Default</a></li>
                <li><a class="lan-5" href="javascript://">Ecommerce</a></li>
              </ul>
            </li>
            <?php if ($permissions == 'all' || in_array('role', $permissions)): ?>
              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                  href="javascript:void(0)"><i data-feather="airplay"></i><span class="lan-16">Roles</span></a>
                <ul class="sidebar-submenu">
                  <?php if ($permissions == 'all' || in_array('role_view', $permissions)): ?>
                    <li><a href="<?=BASEURL.'role'?>">All Roles</a></li>
                  <?php endif ?>
                  <?php if ($permissions == 'all' || in_array('role_add', $permissions)): ?>
                    <li><a href="<?=BASEURL.'role/create'?>">Create</a></li>
                  <?php endif ?>
                </ul>
              </li>
            <?php endif ?>
            <?php if ($permissions == 'all' || in_array('user', $permissions)): ?>
              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                  href="javascript:void(0)"><i data-feather="airplay"></i><span class="lan-16">Users</span></a>
                <ul class="sidebar-submenu">
                  <?php if ($permissions == 'all' || in_array('user_view', $permissions)): ?>
                    <li><a href="<?=BASEURL.'user'?>">All Users</a></li>
                  <?php endif ?>
                  <?php if ($permissions == 'all' || in_array('user_add', $permissions)): ?>
                    <li><a href="<?=BASEURL.'user/create'?>">Create</a></li>
                  <?php endif ?>
                </ul>
              </li>
            <?php endif ?>
            <?php if ($permissions == 'all' || in_array('building', $permissions)): ?>
              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                  href="javascript:void(0)"><i data-feather="airplay"></i><span class="lan-16">Building</span></a>
                <ul class="sidebar-submenu">
                  <?php if ($permissions == 'all' || in_array('building_floor_view', $permissions)): ?>
                    <li><a href="<?=BASEURL.'building'?>">Floors</a></li>
                  <?php endif ?>
                  <?php if ($permissions == 'all' || in_array('building_floor_add', $permissions)): ?>
                    <li><a href="<?=BASEURL.'building/add-floor'?>">Add Floor</a></li>
                  <?php endif ?>
                  <?php if ($permissions == 'all' || in_array('building_room_view', $permissions)): ?>
                    <li><a href="<?=BASEURL.'building/rooms'?>">Rooms</a></li>
                  <?php endif ?>
                  <?php if ($permissions == 'all' || in_array('building_room_add', $permissions)): ?>
                    <li><a href="<?=BASEURL.'building/add-room'?>">Add Room</a></li>
                  <?php endif ?>
                </ul>
              </li>
            <?php endif ?>
          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>