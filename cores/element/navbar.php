<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo"></div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item">
                    <a href="<?php echo $sys_link;?>/" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo $sys_link;?>/modules/task_assign/" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Text-Speech</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo $sys_link;?>/modules/hire/" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Speech-Text</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo $sys_link;?>/modules/work_update/" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Apna Kaam Kar</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>