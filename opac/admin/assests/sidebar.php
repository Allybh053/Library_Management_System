    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="<?= $admin_url ?>">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#Category-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-apps-fill"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="Category-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= $admin_url ?>category/new">
                            <i class="bi bi-circle"></i><span>New Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>category/list">
                            <i class="bi bi-circle"></i><span>List Category</span>
                        </a>
                    </li>
                </ul>
            </li> -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-book-fill"></i><span>Books</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= $admin_url ?>books/new">
                            <i class="bi bi-circle"></i><span>New Book</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>books/list">
                            <i class="bi bi-circle"></i><span>List Books</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End Components Nav -->

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-book-3-fill"></i><span>Publishers</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= $admin_url ?>publishers/new">
                            <i class="bi bi-circle"></i><span>New Publisher</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>publishers/list">
                            <i class="bi bi-circle"></i><span>Publisher List</span>
                        </a>
                    </li>
                </ul>
            </li> -->
            <!-- End Forms Nav -->

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-pencil-fill"></i><span>Authors</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= $admin_url ?>authors/new">
                            <i class="bi bi-circle"></i><span>New Authors</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>authors/list">
                            <i class="bi bi-circle"></i><span>Author List</span>
                        </a>
                    </li>
                </ul>
            </li> -->
            <!-- End Tables Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= $admin_url ?>users/new">
                            <i class="bi bi-circle"></i><span>New User</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>users/list">
                            <i class="bi bi-circle"></i><span>Users List</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End Charts Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#Settings-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-folder-settings-fill"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="Settings-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= $admin_url ?>settings/about">
                            <i class="bi bi-circle"></i><span>About</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>settings/sliderlist">
                            <i class="bi bi-circle"></i><span>Slider List</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>settings/slidernew">
                            <i class="bi bi-circle"></i><span>Slider Upload</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>settings/languagelist">
                            <i class="bi bi-circle"></i><span>Language List</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>settings/languagenew">
                            <i class="bi bi-circle"></i><span>Language New</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>libraryActivity/list">
                            <i class="bi bi-circle"></i><span>Library Activity List</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>libraryActivity/new">
                            <i class="bi bi-circle"></i><span>Library Activity New</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>settings/downloadActivityList">
                            <i class="bi bi-circle"></i><span>Download List</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>settings/downloadActivity">
                            <i class="bi bi-circle"></i><span>Download New</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>settings/Brochurelibrary">
                            <i class="bi bi-circle"></i><span>Brochure Library</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>weblink/list">
                            <i class="bi bi-circle"></i><span>Web Link List</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $admin_url ?>weblink/new">
                            <i class="bi bi-circle"></i><span>Web Link New</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="<?= $admin_url ?>settings/languagenew">
                            <i class="bi bi-circle"></i><span>Info Library</span>
                        </a>
                    </li> -->
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= $admin_url ?>settings/password">
                    <i class="ri-door-lock-box-fill"></i>
                    <span>Change Password</span>
                </a>
            </li>
            <!-- End Settings Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= $admin_url ?>logout">
                    <i class="ri-logout-circle-line"></i>
                    <span>Logout</span>
                </a>
            </li>


            <!-- End Logout -->

        </ul>

    </aside>
    <!-- End Sidebar-->