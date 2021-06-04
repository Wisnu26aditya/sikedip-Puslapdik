<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-award"></i>
        </div>
        <div class="sidebar-brand-text mx-auto">Master-Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Query Menu -->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT a.id, a.menu
                    FROM user_menu a
                    JOIN user_access_menu b 
                    ON a.id = b.menu_id
                    WHERE b.role_id = $role_id 
                    ORDER BY b.menu_id ASC";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>
    <!-- Looping Menu -->
    <?php
    foreach ($menu as $m) : ?>  
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>

        <!-- Siapkan SubMenu Sesuai Menu -->
        <?php
        $menuid = $m['id'];
        $querySubMenu = "SELECT * 
                            FROM user_sub_menu
                            JOIN user_menu ON user_sub_menu.menu_id = user_menu.id 
                            WHERE user_sub_menu.menu_id = $menuid
                            AND user_sub_menu.is_active = 1          
                            ";
        $SubMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <?php foreach ($SubMenu as $sm) : ?>
            <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>
            <?php endforeach; ?>
            <hr class="sidebar-divider mt-3">
        <?php endforeach; ?>
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