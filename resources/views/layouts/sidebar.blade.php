
<style>
    /* Clean sidebar style inspired by modern admin panels. */
    .modern-sidebar.left-sidebar {
        padding-top: 0;
        border-radius: 28px;
        border: 0;
        border-right: 0 !important;
        box-shadow: none !important;
        overflow: hidden;
        background: #ffffff;
    }

    @media (min-width: 992px) {
        .modern-sidebar.left-sidebar {
            top: 12px;
            left: 12px;
            width: 272px;
            height: calc(100% - 24px);
            margin: 0;
        }

        .modern-sidebar .scroll-sidebar {
            height: 100%;
        }
    }

    .modern-sidebar .sidebar-brand {
        height: 108px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 24px;
        border-bottom: 1px solid rgba(15, 23, 42, 0.05);
        background: #ffffff;
    }

    .modern-sidebar .brand-mark {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: rgba(47, 143, 70, 0.12);
        color: #2f8f46;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.95rem;
        margin-right: 12px;
        flex: 0 0 auto;
    }

    .modern-sidebar .brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.05;
        align-items: center;
    }

    .modern-sidebar .brand-text strong {
        font-size: 1.05rem;
        color: #2f8f46;
        font-weight: 800;
        letter-spacing: -0.02em;
    }

    .modern-sidebar .brand-text span {
        font-size: 0.78rem;
        color: #6b7280;
        font-weight: 600;
        margin-top: 2px;
    }

    .modern-sidebar .scroll-sidebar {
        border-radius: 28px;
    }

    .modern-sidebar .sidebar-nav {
        padding-top: 10px;
    }

    .modern-sidebar .sidebar-link {
        margin: 6px 14px;
        border-radius: 16px;
        padding: 11px 16px !important;
        transition: background-color 0.18s ease, transform 0.18s ease, box-shadow 0.18s ease, color 0.18s ease;
        font-size: 0.92rem;
        font-weight: 600;
        color: #5b6474;
        overflow: hidden;
    }

    .modern-sidebar .sidebar-link::before,
    .modern-sidebar .sidebar-link::after {
        display: none !important;
        content: none !important;
    }

    .modern-sidebar .sidebar-item .first-level .sidebar-link {
        margin-left: 16px;
        padding-left: 20px !important;
        font-size: 0.92rem;
    }

    .modern-sidebar .sidebar-item .first-level .sidebar-item {
        margin: 2px 0;
    }

    .modern-sidebar .sidebar-item .sidebar-link.has-arrow {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 12px;
        padding-right: 34px !important;
    }

    .modern-sidebar .sidebar-link.has-arrow::after {
        display: none !important;
    }

    .modern-sidebar .dropdown-indicator {
        margin-left: auto;
        width: 16px;
        height: 16px;
        opacity: 0.7;
        transition: transform 0.2s ease, opacity 0.2s ease;
    }

    .modern-sidebar .sidebar-link.has-arrow[aria-expanded="true"] .dropdown-indicator {
        transform: rotate(180deg);
        opacity: 1;
    }

    .modern-sidebar .sidebar-link:hover {
        background: rgba(47, 143, 70, 0.12);
        color: #1f7a36;
        transform: translateX(0);
        box-shadow: inset 0 0 0 1px rgba(47, 143, 70, 0.08);
    }

    .modern-sidebar .sidebar-link:hover i {
        color: #1f7a36 !important;
    }

    .modern-sidebar .sidebar-item.selected > .sidebar-link,
    .modern-sidebar .sidebar-link.active {
        border-radius: 999px !important;
        background: #2f8f46 !important;
        color: #ffffff !important;
        box-shadow: 0 10px 18px rgba(47, 143, 70, 0.22) !important;
    }

    .modern-sidebar .sidebar-item.selected > .sidebar-link i,
    .modern-sidebar .sidebar-link.active i {
        color: #ffffff !important;
    }

    .modern-sidebar .nav-small-cap {
        margin-top: 12px;
        padding-left: 20px;
        color: #6b7280;
        letter-spacing: 0.35px;
        font-weight: 700;
        font-size: 0.72rem;
        text-transform: uppercase;
    }

    .modern-sidebar .list-divider {
        margin: 12px 18px;
        border-color: #edf2f0;
    }

    @media (max-width: 991.98px) {
        .modern-sidebar.left-sidebar {
            margin: 0;
            top: 0;
            left: 0;
            width: 260px;
            height: 100%;
            border-radius: 0;
            border: 0;
            box-shadow: none;
        }

        .modern-sidebar .scroll-sidebar {
            border-radius: 0;
        }

        .modern-sidebar .sidebar-brand {
            height: 96px;
        }

        .modern-sidebar .brand-text strong {
            font-size: 1rem;
        }

        .modern-sidebar .sidebar-link {
            margin: 6px 12px;
            padding: 11px 14px !important;
        }
    }
</style>

<aside class="left-sidebar modern-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <div class="sidebar-brand">
                    <a href="{{ route('dashboard') }}">
                        <div class="d-flex align-items-center">
                            <span class="brand-mark">SP</span>
                            <span class="brand-text">
                                <strong>SiPerPangkat</strong>
                                <span>PAK System</span>
                            </span>
                        </div>
                    </a>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Menu Aplikasi</span></li>

                        <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'selected' : '' }}">
                            <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                                <i data-feather="grid" class="feather-icon"></i><span class="hide-menu">Dashboard PAK</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('pegawai.index') ? 'selected' : '' }}">
                            <a class="sidebar-link" href="{{ route('pegawai.index') }}" aria-expanded="false">
                                <i data-feather="users" class="feather-icon"></i><span class="hide-menu">Daftar Pegawai</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('pak-histories.create') ? 'selected' : '' }}">
                            <a class="sidebar-link" href="{{ route('pak-histories.create') }}" aria-expanded="false">
                                <i data-feather="edit-3" class="feather-icon"></i><span class="hide-menu">Input PAK Baru</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('pegawai.create') || request()->routeIs('master-data.*') ? 'selected' : '' }}">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="{{ request()->routeIs('pegawai.create') || request()->routeIs('master-data.*') ? 'true' : 'false' }}">
                                <i data-feather="database" class="feather-icon"></i>
                                <span class="hide-menu">Master Data</span>
                                <i data-feather="chevron-down" class="feather-icon dropdown-indicator"></i>
                            </a>
                            <ul aria-expanded="{{ request()->routeIs('pegawai.create') || request()->routeIs('master-data.*') ? 'true' : 'false' }}" class="collapse first-level base-level-line {{ request()->routeIs('pegawai.create') || request()->routeIs('master-data.*') ? 'show' : '' }}">
                                <li class="sidebar-item {{ request()->routeIs('pegawai.create') ? 'selected' : '' }}">
                                    <a href="{{ route('pegawai.create') }}" class="sidebar-link">
                                        <span class="hide-menu">Pegawai Baru</span>
                                    </a>
                                </li>
                                <li class="sidebar-item {{ request()->routeIs('master-data.golongan.*') ? 'selected' : '' }}">
                                    <a href="{{ route('master-data.golongan.index') }}" class="sidebar-link">
                                        <span class="hide-menu">Golongan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item {{ request()->routeIs('master-data.jf.*') ? 'selected' : '' }}">
                                    <a href="{{ route('master-data.jf.index') }}" class="sidebar-link">
                                        <span class="hide-menu">Jabatan Fungsional</span>
                                    </a>
                                </li>
                                <li class="sidebar-item {{ request()->routeIs('master-data.unit-kerja.*') ? 'selected' : '' }}">
                                    <a href="{{ route('master-data.unit-kerja.index') }}" class="sidebar-link">
                                        <span class="hide-menu">Unit Kerja</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="list-divider"></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
