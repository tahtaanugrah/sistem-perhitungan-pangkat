<style>
    .modern-topbar.topbar {
        top: 12px;
        left: 312px;
        right: 16px;
        width: auto !important;
        border-radius: 26px;
        border: 1px solid rgba(15, 23, 42, 0.04);
        box-shadow: 0 14px 32px rgba(15, 23, 42, 0.05);
        overflow: visible;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        z-index: 1040;
        transition: left 0.3s ease, right 0.3s ease;
    }

    .modern-topbar .top-navbar {
        border-radius: 26px;
        min-height: 78px;
    }

    .modern-topbar .top-navbar .navbar-header {
        border-radius: 26px 0 0 26px;
        box-shadow: none;
        background: transparent !important;
        border-right: 0;
    }

    .modern-topbar .navbar-brand .brand-mark {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        background: rgba(47, 143, 70, 0.12);
        color: var(--ui-primary-strong);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.86rem;
        margin-right: 10px;
        flex: 0 0 auto;
    }

    .modern-topbar .navbar-brand .brand-text {
        color: #0f172a;
        font-weight: 700;
        letter-spacing: -0.01em;
        white-space: nowrap;
    }

    .modern-topbar .navbar-collapse {
        border-bottom: 0;
    }

    .modern-topbar .navbar-toolbar {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        width: 100%;
        gap: 14px;
        padding: 0 22px;
    }

    .modern-topbar .navbar-left-spacer {
        flex: 1 1 auto;
        min-width: 24px;
    }

    .modern-topbar .navbar-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-left: auto;
    }

    .modern-topbar .icon-circle-btn,
    .modern-topbar .admin-chip {
        border: 0;
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
    }

    .modern-topbar .icon-circle-btn {
        width: 42px;
        height: 42px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #334155;
        transition: transform 0.18s ease, box-shadow 0.18s ease, color 0.18s ease, background 0.18s ease;
    }

    .modern-topbar .icon-circle-btn:hover {
        transform: translateY(-1px);
        color: #1f7a36;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
        background: #f8faf9;
    }

    .modern-topbar .icon-circle-btn .feather-icon {
        width: 18px;
        height: 18px;
    }

    .modern-topbar .admin-chip {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        border-radius: 999px;
        padding: 8px 14px 8px 10px;
        background: #ffffff;
        color: #334155;
        min-height: 42px;
        text-decoration: none;
        transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
    }

    .modern-topbar .admin-chip:hover,
    .modern-topbar .admin-chip.show {
        transform: translateY(-1px);
        background: #f8faf9;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
    }

    .modern-topbar .admin-avatar {
        width: 32px;
        height: 32px;
        border-radius: 999px;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(47, 143, 70, 0.12);
        color: #1f7a36;
        font-weight: 700;
        font-size: 0.72rem;
        flex: 0 0 auto;
    }

    .modern-topbar .admin-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .modern-topbar .admin-text {
        display: flex;
        flex-direction: column;
        line-height: 1.1;
        text-align: left;
    }

    .modern-topbar .admin-name {
        font-size: 0.96rem;
        font-weight: 700;
        color: #0f172a;
        white-space: nowrap;
    }

    .modern-topbar .admin-role {
        font-size: 0.76rem;
        font-weight: 600;
        color: #7c8aa0;
        white-space: nowrap;
    }

    .modern-topbar .admin-menu {
        min-width: 200px;
        border-radius: 14px;
        border: 1px solid #d7e0eb;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.12);
    }

    .modern-topbar .admin-menu .dropdown-item {
        font-weight: 600;
        color: #334155;
    }

    .modern-topbar .admin-menu .dropdown-item:hover {
        background: rgba(47, 143, 70, 0.08);
        color: #1f7a36;
    }

    .modern-topbar .search-pill {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-width: 180px;
        max-width: 260px;
        padding: 10px 14px;
        border-radius: 999px;
        background: #ffffff;
        color: #7c8aa0;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
        border: 1px solid rgba(15, 23, 42, 0.04);
    }

    .modern-topbar .search-pill .feather-icon {
        width: 18px;
        height: 18px;
        flex: 0 0 auto;
    }

    .modern-topbar .search-pill span {
        font-size: 0.9rem;
        font-weight: 600;
        color: #7c8aa0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .modern-topbar .sidebar-toggle-btn {
        display: none;
        width: 42px;
        height: 42px;
        border-radius: 999px;
        border: 0;
        background: #ffffff;
        color: #334155;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
        transition: transform 0.18s ease, box-shadow 0.18s ease, color 0.18s ease;
    }

    .modern-topbar .sidebar-toggle-btn:hover {
        transform: translateY(-1px);
        color: #1f7a36;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
    }

    .modern-topbar .sidebar-toggle-btn .feather-icon {
        width: 18px;
        height: 18px;
    }

    @media (min-width: 992px) {
        .modern-topbar.topbar {
            left: 312px;
            right: 16px;
        }

        .modern-topbar .top-navbar .navbar-header {
            display: none;
        }

        .modern-topbar .top-navbar .navbar-collapse {
            margin-left: 0 !important;
        }
    }

    @media (max-width: 991.98px) {
        .modern-topbar.topbar {
            top: 0;
            left: 0;
            right: 0;
            border-radius: 0;
            border: 0;
            box-shadow: none;
        }

        .modern-topbar .top-navbar,
        .modern-topbar .navbar-header {
            border-radius: 0;
        }

        .modern-topbar .top-navbar {
            min-height: 64px;
        }

        .modern-topbar .navbar-toolbar {
            padding: 10px 14px;
            justify-content: space-between;
            gap: 8px;
        }

        .modern-topbar .navbar-left-spacer {
            display: none;
        }

        .modern-topbar .sidebar-toggle-btn {
            display: inline-flex;
            flex: 0 0 auto;
        }

        .modern-topbar .search-pill {
            min-width: 0;
            max-width: none;
            flex: 1 1 auto;
            padding: 9px 12px;
        }

        .modern-topbar .search-pill span {
            display: none;
        }

        .modern-topbar .navbar-actions {
            gap: 8px;
        }

        .modern-topbar .admin-chip {
            padding: 7px 10px;
        }

        .modern-topbar .admin-text {
            display: none;
        }

        .modern-topbar .admin-avatar {
            width: 30px;
            height: 30px;
        }

        .modern-topbar .icon-circle-btn {
            width: 38px;
            height: 38px;
        }
    }
</style>

<header class="topbar modern-topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <div class="navbar-brand">
                <a href="{{ route('dashboard') }}">
                    <span class="d-flex align-items-center">
                        <span class="brand-mark">SP</span>
                        <span class="brand-text">SiPerPangkat</span>
                    </span>
                </a>
            </div>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
               data-toggle="collapse" data-target="#navbarSupportedContent"
               aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti-more"></i>
            </a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <div class="navbar-toolbar">
                <div class="navbar-left-spacer d-none d-md-block">
                    <a href="{{ route('dashboard') }}" class="search-pill text-decoration-none" aria-label="Go to dashboard">
                        <i data-feather="search" class="feather-icon"></i>
                        <span>Cari, lihat, atau buka menu</span>
                    </a>
                </div>

                <div class="navbar-actions">
                    <button type="button" class="sidebar-toggle-btn d-md-none" id="sidebarToggleBtn" aria-label="Toggle sidebar">
                        <i data-feather="menu" class="feather-icon"></i>
                    </button>

                    <button type="button" class="icon-circle-btn d-none d-md-inline-flex" aria-label="Notifications">
                        <i data-feather="bell" class="feather-icon"></i>
                    </button>

                    <div class="dropdown">
                        <a class="admin-chip dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="admin-avatar">
                                <img src="{{ asset('assets/images/logo-icon.png') }}" alt="Admin">
                            </span>
                            <span class="admin-text d-none d-md-flex">
                                <span class="admin-name">Admin</span>
                                <span class="admin-role">Admin store</span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right admin-menu">
                            <span class="dropdown-item-text text-muted">Profile Admin</span>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i data-feather="user" class="svg-icon mr-2"></i>Profile</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i data-feather="settings" class="svg-icon mr-2"></i>Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i data-feather="log-out" class="svg-icon mr-2"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.feather) {
            feather.replace();
        }

        var toggleBtn = document.getElementById('sidebarToggleBtn');
        var sidebar = document.querySelector('.modern-sidebar.left-sidebar');
        var overlay = document.getElementById('sidebarOverlay');

        if (!toggleBtn || !sidebar) {
            return;
        }

        function closeSidebar() {
            sidebar.classList.remove('active');
            if (overlay) {
                overlay.classList.remove('active');
            }
        }

        toggleBtn.addEventListener('click', function (event) {
            event.preventDefault();
            sidebar.classList.toggle('active');
            if (overlay) {
                overlay.classList.toggle('active');
            }
        });

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        });
    });
</script>
