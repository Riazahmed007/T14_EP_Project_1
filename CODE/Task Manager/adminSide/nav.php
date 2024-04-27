<?php
class NavigationMenu {
    private $adminLogin;
    private $menuItems;

    public function __construct($adminLogin) {
        $this->adminLogin = $adminLogin;
        $this->menuItems = [
            1 => [
                ['link' => 'dashboard.php', 'icon' => 'bi-house', 'text' => 'Dashboard'],
                ['link' => 'projects.php', 'icon' => 'bi-table', 'text' => 'Projects'],
                ['link' => 'employees1.php', 'icon' => 'bi-people', 'text' => 'Employees'],
                ['link' => 'tasks.php', 'icon' => 'bi-table', 'text' => 'Tasks']
            ],
            0 => [
                ['link' => 'tasks.php', 'icon' => 'bi-table', 'text' => 'Tasks'],
                ['link' => 'employees.php', 'icon' => 'bi-people', 'text' => 'Employees']
            ]
        ];
    }

    public function displayMenu() {
        $items = $this->menuItems[$this->adminLogin];
        foreach ($items as $item) {
            echo '<li class="mb-3">';
            echo '<a href="' . $item['link'] . '" class="nav-link px-0 align-middle">';
            echo '<i class="fs-4 ' . $item['icon'] . '"></i> <span class="ms-1 d-none d-sm-inline nav-link-text s">' . $item['text'] . '</span>';
            echo '</a>';
            echo '</li>';
        }
    }

    public function displayWelcomeMessage() {
        if ($this->adminLogin == 0) {
            echo 'Welcome! Admin';
        } else {
            echo 'Welcome! Supervisor';
        }
    }
}

// Usage
$menu = new NavigationMenu($_COOKIE['adminLogin']);
?>

<!-- Sidebar -->
<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidebar">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100 sidenavv">
        <a href="dashboard.php" class="bg-whited-flex align-items-center pb-3 mb-md-0 me-md-auto text-decoration-none"></a>
        <!-- Navigation Menu -->
        <ul style="background: #fff; padding: 10px 80px 10px 30px; border-radius: 19px;" class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start menu" id="menu">
            <?php $menu->displayMenu(); ?>
        </ul>
        <hr>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../assets/imgs/team4.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                <span class="d-none d-sm-inline mx-1 s">
                    <?php $menu->displayWelcomeMessage(); ?>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="adminLogout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>