
<style>
    /* Local style for a softer, modern sidebar card look. */
    .modern-sidebar.left-sidebar {
        padding-top: 0;
        border-radius: 18px;
        border: 1px solid rgba(15, 23, 42, 0.08);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        overflow: hidden;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    @media (min-width: 992px) {
        .modern-sidebar.left-sidebar {
            top: 12px;
            left: 12px;
            width: 236px;
            height: calc(100% - 24px);
            margin: 0;
        }

        .modern-sidebar .scroll-sidebar {
            height: 100%;
        }
    }

    .modern-sidebar .sidebar-brand {
        height: 82px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 20px;
        border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    .modern-sidebar .sidebar-brand img {
        max-height: 34px;
        width: auto;
    }

    .modern-sidebar .scroll-sidebar {
        border-radius: 18px;
    }

    .modern-sidebar .sidebar-nav {
        padding-top: 0;
    }

    .modern-sidebar .sidebar-link {
        margin: 4px 10px;
        border-radius: 12px;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .modern-sidebar .sidebar-link:hover,
    .modern-sidebar .sidebar-item.selected > .sidebar-link,
    .modern-sidebar .sidebar-link.active {
        background-color: #e8f0fe;
        transform: translateX(2px);
    }

    .modern-sidebar .nav-small-cap {
        margin-top: 8px;
        padding-left: 16px;
        color: #64748b;
        letter-spacing: 0.4px;
        font-weight: 600;
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
    }
</style>

<aside class="left-sidebar modern-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <div class="sidebar-brand">
                    <a href="index.html">
                        <img src="https://placehold.co/220x60/EAF2FF/1D4ED8?text=%E2%88%91+Pangkat" alt="SiPerPangkat" class="img-fluid">
                    </a>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="index.html"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Applications</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link" href="ticket-list.html"
                                aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                    class="hide-menu">Ticket List
                                </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-chat.html"
                                aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                                    class="hide-menu">Chat</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-calendar.html"
                                aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                                    class="hide-menu">Calendar</span></a></li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Components</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">Forms </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="form-inputs.html" class="sidebar-link"><span
                                            class="hide-menu"> Form Inputs
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link"><span
                                            class="hide-menu"> Form Grids
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="form-checkbox-radio.html" class="sidebar-link"><span
                                            class="hide-menu"> Checkboxes &
                                            Radios
                                        </span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                    class="hide-menu">Tables </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="table-basic.html" class="sidebar-link"><span
                                            class="hide-menu"> Basic Table
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="table-dark-basic.html" class="sidebar-link"><span
                                            class="hide-menu"> Dark Basic Table
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="table-sizing.html" class="sidebar-link"><span
                                            class="hide-menu">
                                            Sizing Table
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="table-layout-coloured.html" class="sidebar-link"><span
                                            class="hide-menu">
                                            Coloured
                                            Table Layout
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="table-datatable-basic.html" class="sidebar-link"><span
                                            class="hide-menu">
                                            Basic
                                            Datatables
                                            Layout
                                        </span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="bar-chart" class="feather-icon"></i><span
                                    class="hide-menu">Charts </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="chart-morris.html" class="sidebar-link"><span
                                            class="hide-menu"> Morris Chart
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="chart-chart-js.html" class="sidebar-link"><span
                                            class="hide-menu"> ChartJs
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="chart-knob.html" class="sidebar-link"><span
                                            class="hide-menu">
                                            Knob Chart
                                        </span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="box" class="feather-icon"></i><span
                                    class="hide-menu">UI Elements </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="ui-buttons.html" class="sidebar-link"><span
                                            class="hide-menu"> Buttons
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="ui-modals.html" class="sidebar-link"><span
                                            class="hide-menu"> Modals </span></a>
                                </li>
                                <li class="sidebar-item"><a href="ui-tab.html" class="sidebar-link"><span
                                            class="hide-menu"> Tabs </span></a></li>
                                <li class="sidebar-item"><a href="ui-tooltip-popover.html" class="sidebar-link"><span
                                            class="hide-menu"> Tooltip &
                                            Popover</span></a></li>
                                <li class="sidebar-item"><a href="ui-notification.html" class="sidebar-link"><span
                                            class="hide-menu">Notification</span></a></li>
                                <li class="sidebar-item"><a href="ui-progressbar.html" class="sidebar-link"><span
                                            class="hide-menu">Progressbar</span></a></li>
                                <li class="sidebar-item"><a href="ui-typography.html" class="sidebar-link"><span
                                            class="hide-menu">Typography</span></a></li>
                                <li class="sidebar-item"><a href="ui-bootstrap.html" class="sidebar-link"><span
                                            class="hide-menu">Bootstrap
                                            UI</span></a></li>
                                <li class="sidebar-item"><a href="ui-breadcrumb.html" class="sidebar-link"><span
                                            class="hide-menu">Breadcrumb</span></a></li>
                                <li class="sidebar-item"><a href="ui-list-media.html" class="sidebar-link"><span
                                            class="hide-menu">List
                                            Media</span></a></li>
                                <li class="sidebar-item"><a href="ui-grid.html" class="sidebar-link"><span
                                            class="hide-menu"> Grid </span></a></li>
                                <li class="sidebar-item"><a href="ui-carousel.html" class="sidebar-link"><span
                                            class="hide-menu">
                                            Carousel</span></a></li>
                                <li class="sidebar-item"><a href="ui-scrollspy.html" class="sidebar-link"><span
                                            class="hide-menu">
                                            Scrollspy</span></a></li>
                                <li class="sidebar-item"><a href="ui-toasts.html" class="sidebar-link"><span
                                            class="hide-menu"> Toasts</span></a>
                                </li>
                                <li class="sidebar-item"><a href="ui-spinner.html" class="sidebar-link"><span
                                            class="hide-menu"> Spinner </span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ui-cards.html"
                                aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span
                                    class="hide-menu">Cards
                                </span></a>
                        </li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Authentication</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="authentication-login1.html"
                                aria-expanded="false"><i data-feather="lock" class="feather-icon"></i><span
                                    class="hide-menu">Login
                                </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                href="authentication-register1.html" aria-expanded="false"><i data-feather="lock"
                                    class="feather-icon"></i><span class="hide-menu">Register
                                </span></a>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="feather" class="feather-icon"></i><span
                                    class="hide-menu">Icons
                                </span></a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><span
                                            class="hide-menu"> Fontawesome Icons </span></a></li>

                                <li class="sidebar-item"><a href="icon-simple-lineicon.html" class="sidebar-link"><span
                                            class="hide-menu"> Simple Line Icons </span></a></li>
                            </ul>
                        </li>

                        
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="authentication-login1.html"
                                aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                    class="hide-menu">Logout</span></a></li>
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                        aria-expanded="false"><i data-feather="crosshair" class="feather-icon"></i><span
                                            class="hide-menu">Multi
                                            level
                                            dd</span></a>
                                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                                        <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                    class="hide-menu"> item 1.1</span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                    class="hide-menu"> item 1.2</span></a>
                                        </li>
                                        <li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)"
                                                aria-expanded="false"><span class="hide-menu">Menu 1.3</span></a>
                                            <ul aria-expanded="false" class="collapse second-level base-level-line">
                                                <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                            class="hide-menu"> item
                                                            1.3.1</span></a></li>
                                                <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                            class="hide-menu"> item
                                                            1.3.2</span></a></li>
                                                <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                            class="hide-menu"> item
                                                            1.3.3</span></a></li>
                                                <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                            class="hide-menu"> item
                                                            1.3.4</span></a></li>
                                            </ul>
                                        </li>
                                        <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                    class="hide-menu"> item
                                                    1.4</span></a></li>
                                    </ul>
                                </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
