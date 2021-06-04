 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user'); ?>">
         <div class="sidebar-brand-icon rotate-n-0">
             <img src="<?= base_url('assets/img/hd2.png'); ?>" width="160" height="70">
         </div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Divider -->
     <hr class="sidebar-divider">
     <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu = "select b.module_id, b.module_nama, b.module_path, b.module_parent_id, b.module_icons from master_akses a
                    JOIN master_modules b ON a.module_id = b.module_id
                    where a.akses_user='" . $role_id . "'
                    and b.module_level=1
                    and b.show_item=1
                    order by b.module_id";
        $menu = $this->db->query($queryMenu)->result_array();


        foreach ($menu as $m) :
            $querySubMenu = "select b.module_id, b.module_nama, b.module_path, b.module_icons from master_akses a
                    JOIN master_modules b ON a.module_id = b.module_id
                    where a.akses_user='" . $role_id . "'
                    and b.module_level=2
                    and b.module_parent_id='" . $m['module_id'] . "'
                    and b.show_item=1
                    order by b.module_id";
            $SubMenu = $this->db->query($querySubMenu)->result_array();

            if (count($SubMenu) > 0) : ?>

             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                 <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo<?= $m['module_id']; ?>" aria-expanded="true" aria-controls="collapseTwo">
                     <i class="<?= $m['module_icons']; ?>"></i>
                     <span><?= $m['module_nama']; ?></span>
                 </a>

                 <div id="collapseTwo<?= $m['module_id']; ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                         <?php foreach ($SubMenu as $sm) : ?>
                             <a class="collapse-item" href="<?= $sm['module_path']; ?>"><?= $sm['module_nama']; ?></a>
                         <?php endforeach; ?>
                     </div>
                 </div>
             </li>
         <?php else : ?>
             <li class="nav-item">
                 <a class="nav-link" href="<?= $m['module_path']; ?>"><?= $m['module_nama']; ?></a>
             </li>
     <?php endif;
        endforeach;
        ?>
     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
             <i class="fas fa-fw fa-sign-out-alt"></i>
             <span>Logout</span></a>
     </li>

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>


 </ul>
 <!-- End of Sidebar -->