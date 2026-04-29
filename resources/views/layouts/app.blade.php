<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">

    <style>
        :root {
            --ui-bg: #f7faf7;
            --ui-surface: #ffffff;
            --ui-border: #e3e8df;
            --ui-text: #0f172a;
            --ui-muted: #64748b;
            --ui-primary: #2f8f46;
            --ui-primary-strong: #1f7a36;
            --ui-accent: #f59e0b;
            --ui-accent-soft: rgba(47, 143, 70, 0.12);
            --ui-success: #0f766e;
            --ui-danger: #b42318;
            --ui-shadow-soft: 0 8px 20px rgba(20, 31, 20, 0.05);
            --ui-shadow-hover: 0 14px 30px rgba(20, 31, 20, 0.08);
            --ui-radius-lg: 18px;
            --ui-radius-md: 14px;
            --ui-radius-sm: 12px;
        }

        body {
            background: var(--ui-bg);
            color: var(--ui-text);
            font-family: "Plus Jakarta Sans", "Segoe UI", Tahoma, sans-serif;
            font-size: 0.92rem;
            line-height: 1.5;
        }

        html {
            scroll-behavior: smooth;
        }

        .page-wrapper {
            background: var(--ui-bg);
            box-shadow: none !important;
            border-top-left-radius: 0 !important;
            border-top-right-radius: 0 !important;
        }

        .page-wrapper > .container-fluid {
            padding-top: 26px;
            padding-bottom: 18px;
        }

        .card {
            border: 1px solid var(--ui-border) !important;
            border-radius: var(--ui-radius-lg) !important;
            box-shadow: var(--ui-shadow-soft);
            overflow: hidden;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
            background: var(--ui-surface);
        }

        .card:hover {
            box-shadow: var(--ui-shadow-hover);
            transform: none;
        }

        .card .card-header,
        .card .card-footer {
            background: #f7faf5;
            border-color: var(--ui-border);
        }

        .btn {
            border-radius: 12px !important;
            font-weight: 600;
            font-size: 0.92rem;
            letter-spacing: 0;
            transition: background-color 0.18s ease, border-color 0.18s ease, box-shadow 0.18s ease, color 0.18s ease, transform 0.18s ease;
            padding: 0.48rem 0.88rem;
        }

        .btn-sm {
            border-radius: 10px !important;
            font-size: 0.82rem;
            padding: 0.3rem 0.62rem;
        }

        /* Keep adjacent action buttons visually separated in rows */
        .btn + .btn,
        .btn + a.btn,
        a.btn + .btn,
        a.btn + a.btn {
            margin-left: 0.5rem;
        }

        .action-buttons {
            display: inline-flex;
            align-items: center;
            flex-wrap: nowrap;
            gap: 0.38rem;
            white-space: nowrap;
        }

        .action-buttons .btn,
        .action-buttons a.btn {
            margin-left: 0 !important;
        }

        .action-buttons form {
            margin: 0;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 18px rgba(15, 23, 42, 0.1);
        }

        .btn:focus {
            box-shadow: 0 0 0 0.2rem rgba(47, 143, 70, 0.16) !important;
        }

        .btn-primary {
            background: var(--ui-primary);
            border-color: var(--ui-primary);
            color: #ffffff;
        }

        .btn-primary:hover {
            background: #25783a;
            border-color: #25783a;
            color: #ffffff;
        }

        .btn-outline-primary {
            border-color: rgba(47, 143, 70, 0.2);
            color: var(--ui-primary-strong);
            background: rgba(47, 143, 70, 0.08);
        }

        .btn-outline-primary:hover {
            background: rgba(47, 143, 70, 0.14);
            border-color: rgba(47, 143, 70, 0.28);
            color: #1f7a36;
        }

        .btn-outline-success {
            border-color: rgba(47, 143, 70, 0.3);
            color: #1f7a36;
            background: rgba(47, 143, 70, 0.1);
        }

        .btn-outline-success:hover {
            background: #2f8f46;
            border-color: #2f8f46;
            color: #ffffff;
        }

        .btn-outline-danger {
            border-color: rgba(220, 38, 38, 0.35);
            color: #b42318;
            background: rgba(220, 38, 38, 0.08);
        }

        .btn-outline-danger:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: #ffffff;
        }

        .btn-outline-warning {
            border-color: rgba(245, 158, 11, 0.35);
            color: #b45309;
            background: rgba(245, 158, 11, 0.1);
        }

        .btn-outline-warning:hover {
            background: #f59e0b;
            border-color: #f59e0b;
            color: #ffffff;
        }

        .btn-outline-info {
            border-color: rgba(14, 165, 233, 0.35);
            color: #0369a1;
            background: rgba(14, 165, 233, 0.1);
        }

        .btn-outline-info:hover {
            background: #0ea5e9;
            border-color: #0ea5e9;
            color: #ffffff;
        }

        .btn-outline-secondary,
        .btn-light {
            border-color: var(--ui-border);
            background: #fff;
            color: #334155;
        }

        .btn-outline-secondary:hover,
        .btn-light:hover {
            background: #f6f8f5;
            border-color: #d8dfd3;
        }

        /* Functional aliases to keep button colors consistent with action intent */
        .btn-action-upload,
        .btn-action-save,
        .btn-action-submit {
            background: #2f8f46;
            border-color: #2f8f46;
            color: #ffffff;
        }

        .btn-action-upload:hover,
        .btn-action-save:hover,
        .btn-action-submit:hover {
            background: #25783a;
            border-color: #25783a;
            color: #ffffff;
        }

        .btn-action-edit {
            background: #f59e0b;
            border-color: #f59e0b;
            color: #ffffff;
        }

        .btn-action-edit:hover {
            background: #d97706;
            border-color: #d97706;
            color: #ffffff;
        }

        .btn-action-view,
        .btn-action-detail {
            background: #0ea5e9;
            border-color: #0ea5e9;
            color: #ffffff;
        }

        .btn-action-view:hover,
        .btn-action-detail:hover {
            background: #0284c7;
            border-color: #0284c7;
            color: #ffffff;
        }

        .btn-action-delete {
            background: #dc2626;
            border-color: #dc2626;
            color: #ffffff;
        }

        .btn-action-delete:hover {
            background: #b91c1c;
            border-color: #b91c1c;
            color: #ffffff;
        }

        .btn-success,
        .btn-info,
        .btn-warning,
        .btn-danger,
        .btn-secondary {
            border-color: transparent;
        }

        .btn-success {
            background: #2f8f46;
            border-color: #2f8f46;
            color: #ffffff;
        }

        .btn-success:hover {
            background: #25783a;
            border-color: #25783a;
            color: #ffffff;
        }

        .btn-info {
            background: #0ea5e9;
            border-color: #0ea5e9;
            color: #ffffff;
        }

        .btn-info:hover {
            background: #0284c7;
            border-color: #0284c7;
            color: #ffffff;
        }

        .btn-warning {
            background: #f59e0b;
            border-color: #f59e0b;
            color: #1f2937;
        }

        .btn-warning:hover {
            background: #d97706;
            border-color: #d97706;
            color: #ffffff;
        }

        .btn-danger {
            background: #dc2626;
            border-color: #dc2626;
            color: #ffffff;
        }

        .btn-danger:hover {
            background: #b91c1c;
            border-color: #b91c1c;
            color: #ffffff;
        }

        .btn-secondary {
            background: #64748b;
            border-color: #64748b;
            color: #ffffff;
        }

        .btn-secondary:hover {
            background: #475569;
            border-color: #475569;
            color: #ffffff;
        }

        .form-control,
        .custom-select,
        .custom-select.form-control {
            border-radius: var(--ui-radius-sm) !important;
            border: 1px solid #d7e2d3;
            min-height: 42px;
            background-color: #fff;
            transition: border-color 0.18s ease, box-shadow 0.18s ease;
        }

        .form-control:focus,
        .custom-select:focus {
            border-color: rgba(47, 143, 70, 0.35);
            box-shadow: 0 0 0 0.22rem rgba(47, 143, 70, 0.12);
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        /* Make .table-responsive allow horizontal scrolling when needed */
        .table-responsive {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
        }

        .table-responsive table {
            min-width: max-content;
        }

        .table thead th {
            border-top: 0;
            border-bottom: 1px solid #e0e7dd;
            color: #334155;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.35px;
            text-transform: uppercase;
            background: #f7faf5;
            text-align: center;
        }

        .table tbody td {
            border-color: #e7ece5;
            vertical-align: middle;
            text-align: center;
        }

        .table-hover tbody tr:hover {
            background: #f7fbf5;
        }

        .badge {
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.28rem 0.62rem;
            font-size: 0.76rem;
            line-height: 1;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .badge-primary,
        .badge-info {
            background: #2f8f46;
            color: #ffffff;
        }

        .badge-success {
            background: #22c55e;
            color: #ffffff;
        }

        .badge-warning {
            background: #f5b63d;
            color: #1f2937;
        }

        .badge-danger {
            background: #dc2626;
            color: #ffffff;
        }

        .badge-secondary,
        .badge-light {
            background: #e9efe6;
            color: #4b5563;
        }

        .alert {
            border-radius: 14px;
            border-width: 1px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.07);
        }

        .dropdown-menu {
            border-radius: var(--ui-radius-md);
            border-color: var(--ui-border);
            box-shadow: var(--ui-shadow-soft);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #0f172a;
            letter-spacing: -0.015em;
        }

        h1 {
            font-size: 1.55rem;
            font-weight: 700;
        }

        h2 {
            font-size: 1.25rem;
            font-weight: 700;
        }

        h5 {
            font-size: 1rem;
            font-weight: 700;
        }

        .text-muted {
            color: var(--ui-muted) !important;
        }

        .modern-topbar.topbar {
            top: 12px;
            left: 312px;
            right: 16px;
            width: auto !important;
            border-radius: 24px;
            border: 1px solid rgba(15, 23, 42, 0.025);
            box-shadow: none;
            overflow: visible;
            background: rgba(252, 254, 251, 0.96);
            z-index: 1040;
        }

        @media (min-width: 992px) {
            .page-wrapper {
                margin-left: 312px !important;
            }

            .page-wrapper > .container-fluid {
                padding-left: 16px;
                padding-right: 16px;
            }
        }

        .modern-topbar .top-navbar {
            border-radius: 24px;
            min-height: 78px;
        }

        .modern-topbar .top-navbar .navbar-header {
            border-radius: 24px 0 0 24px;
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
        }

        .modern-topbar .navbar-brand .brand-text {
            color: #0f172a;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        .modern-topbar .navbar-collapse {
            border-bottom: 0;
        }

        .modern-topbar .navbar-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            gap: 16px;
            padding: 0 26px;
        }

        .modern-topbar .navbar-title {
            display: flex;
            align-items: center;
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #2f8f46;
            line-height: 1;
            white-space: nowrap;
        }

        .modern-topbar .navbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
        }

        .modern-topbar .admin-dropdown .nav-link {
            border: 1px solid #d7e0eb;
            border-radius: 999px;
            padding: 7px 12px;
            color: #334155;
            font-weight: 600;
            background: #ffffff;
            transition: all 0.2s ease;
            min-height: 40px;
        }

        .modern-topbar .admin-dropdown .nav-link:hover,
        .modern-topbar .admin-dropdown.show .nav-link {
            background: rgba(47, 143, 70, 0.08);
            border-color: rgba(47, 143, 70, 0.22);
            color: #1f7a36;
        }

        .modern-topbar .admin-avatar {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(47, 143, 70, 0.12);
            color: #1f7a36;
            font-weight: 700;
            font-size: 0.72rem;
        }

        .modern-topbar .admin-logo {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            border: 1px solid rgba(47, 143, 70, 0.16);
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex: 0 0 auto;
        }

        .modern-topbar .admin-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modern-topbar .admin-name {
            font-size: 1rem;
            font-weight: 600;
            color: #334155;
            white-space: nowrap;
        }

        .modern-topbar .admin-menu {
            min-width: 180px;
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

        .modern-sidebar.left-sidebar {
            border-color: transparent;
            border-right: 0 !important;
            box-shadow: none !important;
            z-index: 1030;
        }

        .modern-sidebar .sidebar-link {
            color: #5b6474;
            font-weight: 600;
            transition: background-color 0.18s ease, transform 0.18s ease, box-shadow 0.18s ease, color 0.18s ease;
        }

        .modern-sidebar .sidebar-link i {
            color: #70806a;
        }

        .modern-sidebar .sidebar-link:hover,
        .modern-sidebar .sidebar-item.selected > .sidebar-link,
        .modern-sidebar .sidebar-link.active {
            background: rgba(47, 143, 70, 0.12);
            color: #1f7a36;
            transform: translateX(0);
            box-shadow: inset 0 0 0 1px rgba(47, 143, 70, 0.08);
        }

        .modern-sidebar .sidebar-link:hover i,
        .modern-sidebar .sidebar-item.selected > .sidebar-link i,
        .modern-sidebar .sidebar-link.active i {
            color: #1f7a36 !important;
        }

        .modern-sidebar .sidebar-item.selected > .sidebar-link {
            background: #2f8f46;
            color: #ffffff;
            box-shadow: 0 10px 18px rgba(47, 143, 70, 0.22);
        }

        .modern-sidebar .sidebar-item.selected > .sidebar-link i {
            color: #ffffff !important;
        }

        .modern-sidebar .brand-mark {
            background: var(--ui-accent-soft) !important;
            color: var(--ui-primary-strong) !important;
        }

        .modern-sidebar .sidebar-brand {
            border-bottom-color: #e6ece3;
        }

        .modern-sidebar .nav-small-cap {
            color: #6b7280;
        }

        @media (max-width: 991.98px) {
            .page-wrapper {
                margin-left: 0 !important;
            }

            .page-wrapper > .container-fluid {
                padding-top: 18px;
                padding-bottom: 18px;
            }

            .card {
                border-radius: var(--ui-radius-md) !important;
            }

            .btn {
                padding: 0.62rem 1rem;
            }

            h1 {
                font-size: 1.6rem;
            }

            h2 {
                font-size: 1.35rem;
            }
        }
    </style>
</head>

<body>

<div id="main-wrapper"
     data-layout="vertical"
     data-navbarbg="skin6"
     data-sidebartype="full"
     data-sidebar-position="fixed"
     data-header-position="fixed"
     data-boxed-layout="full">

    <!-- SIDEBAR -->
    @include('layouts.sidebar')

    <!-- NAVBAR -->
    @include('layouts.navbar')

    <!-- CONTENT -->
    <div class="page-wrapper d-flex flex-column min-vh-100">
        <div class="container-fluid flex-grow-1">
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>

</div>

<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="deleteConfirmModalMessage">
                Data yang dipilih akan dihapus secara permanen. Lanjutkan?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="deleteConfirmSubmit">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>

<script>
    feather.replace();

    (function () {
        var pendingDeleteForm = null;

        $(document).on('submit', 'form.js-delete-confirm', function (event) {
            event.preventDefault();

            pendingDeleteForm = this;

            var customMessage = this.getAttribute('data-confirm-message');
            var message = customMessage || 'Data yang dipilih akan dihapus secara permanen. Lanjutkan?';

            $('#deleteConfirmModalMessage').text(message);
            $('#deleteConfirmModal').modal('show');
        });

        $('#deleteConfirmSubmit').on('click', function () {
            if (!pendingDeleteForm) {
                return;
            }

            var formToSubmit = pendingDeleteForm;
            pendingDeleteForm = null;
            $('#deleteConfirmModal').modal('hide');
            formToSubmit.submit();
        });

        $('#deleteConfirmModal').on('hidden.bs.modal', function () {
            pendingDeleteForm = null;
        });
    })();
</script>

</body>
</html>