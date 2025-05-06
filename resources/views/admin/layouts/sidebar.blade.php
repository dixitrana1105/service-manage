<aside id="customSidebar" class="main-sidebar sidebar-dark-primary elevation-3">
    <!-- Brand Section -->
    <div class="brand-link d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.dashboard') }}" id="toggleSidebarBtn" class="text-white" title="Toggle Sidebar">
            <div class="brand-link text-center">
                <img src="{{ asset('./assets/admin-assets/img/Admin-Panel logo.jpg') }}" alt="Service Management Logo"
                    class="brand-image elevation-3 mb-1"
                    style="opacity: .8; width: 45px; height: 45px; border-radius: 50%;">
                <div style="font-family: Georgia, 'Times New Roman', Times, serif;" class="text-white">
                    Admin-Panel
                </div>
            </div>
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Navigation -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Create Company Menu -->
                @php
                    $createCompanyOpen = request()->is('admin/why*') || request()->is('admin/team*') || request()->is('admin/services*') ||
                        request()->is('admin/clients*') || request()->is('admin/users*') || request()->is('admin/appointments*') ||
                        request()->is('admin/whatsapp*') || request()->is('admin/about*') || request()->is('admin/business-automation*') ||
                        request()->is('admin/pages*') || request()->is('admin/theme*') || request()->is('admin/ticket*') || request()->is('admin/subscribers*') ||
                        request()->is('admin/admin/admin-whatsapp-preview*') || request()->is('admin/admin/whatsapp-flow*');
                @endphp

                <li class="nav-item has-treeview {{ $createCompanyOpen ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $createCompanyOpen ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Create Company
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.why.index') }}"
                                class="nav-link {{ request()->is('admin/why*') ? 'active' : '' }}">
                                <i class="fas fa-question-circle nav-icon"></i>
                                <p>Manage Why</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.team.index') }}"
                                class="nav-link {{ request()->is('admin/team*') ? 'active' : '' }}">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Manage Team</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.services.index') }}"
                                class="nav-link {{ request()->is('admin/services*') ? 'active' : '' }}">
                                <i class="fas fa-concierge-bell nav-icon"></i>
                                <p>Manage Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.clients.index') }}"
                                class="nav-link {{ request()->is('admin/clients*') ? 'active' : '' }}">
                                <i class="fas fa-handshake nav-icon"></i>
                                <p>Manage Clients</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Manage Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.appointments.index') }}"
                                class="nav-link {{ request()->is('admin/appointments*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-check nav-icon"></i>
                                <p>Booking Appointments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.whatsapp.index') }}"
                                class="nav-link {{ request()->is('admin/whatsapp*') ? 'active' : '' }}">
                                <i class="fab fa-whatsapp nav-icon"></i>
                                <p>Manage WhatsApp Chatbot</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('whatsapp-Main-preview') }}"
                                class="nav-link {{ request()->is('admin/admin/admin-whatsapp-preview*') ? 'active' : '' }}">
                                <i class="fab fa-whatsapp nav-icon"></i>
                                <p>Manage Whatsapp-Preview</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.whatsapp-flow.edit') }}"
                                class="nav-link {{ request()->is('admin/admin/whatsapp-flow*') ? 'active' : '' }}">
                                <i class="fab fa-whatsapp nav-icon"></i>
                                <p>Manage Whatsapp-Flow</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.about.index') }}"
                                class="nav-link {{ request()->is('admin/about*') ? 'active' : '' }}">
                                <i class="fas fa-info-circle nav-icon"></i>
                                <p>Create About</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.business-automation.index') }}"
                                class="nav-link {{ request()->is('admin/business-automation*') ? 'active' : '' }}">
                                <i class="fas fa-robot nav-icon"></i>
                                <p>Manage Business Automation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pages.index') }}"
                                class="nav-link {{ request()->is('admin/pages*') ? 'active' : '' }}">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>Manage Pages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.theme.index') }}"
                                class="nav-link {{ request()->is('admin/theme*') ? 'active' : '' }}">
                                <i class="fas fa-paint-roller nav-icon"></i>
                                <p>Manage Layouts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ticket.index') }}"
                                class="nav-link {{ request()->is('admin/ticket*') ? 'active' : '' }}">
                                <i class="fas fa-ticket-alt nav-icon"></i>
                                <p>Manage Ticket System</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.subscribers') }}"
                                class="nav-link {{ request()->is('admin/subscribers*') ? 'active' : '' }}">
                                <i class="fa-solid fa-bell nav-icon"></i>
                                <p>Manage Subscriber</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Other Menus -->
                <li class="nav-item">
                    <a href="{{ route('admin.company-profile.index') }}"
                        class="nav-link {{ request()->is('admin/company-profile*') ? 'active' : '' }}">
                        <i class="fas fa-building nav-icon"></i>
                        <p>Company Profile</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.service-detail-sections.index') }}"
                        class="nav-link {{ request()->is('admin/service-detail-sections*') ? 'active' : '' }}">
                        <i class="fas fa-info bg-white text-dark rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px;"></i>&nbsp;
                        <p>Manage Service Detail Section</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.company_growth.index') }}"
                        class="nav-link {{ request()->is('admin/company-Groth*') ? 'active' : '' }}">
                        <i class="fas fa-chart-line bg-white text-dark rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px; font-size: 16px;"></i>&nbsp;
                        <p>Manage Company Growth</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.clearCache') }}"
                        class="nav-link {{ request()->is('admin/clearCache') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-trash-alt"></i>
                        <p>Cache Clear</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>


<!-- Custom Styles -->
<!-- <style>
    .sidebar-collapsed {
        width: 60px !important;
        transition: width 0.3s ease;
        overflow-x: hidden;
    }

    .sidebar-collapsed .nav-link p,
    .sidebar-collapsed .brand-text,
    .sidebar-collapsed .nav-treeview {
        display: none !important;
    }

    .sidebar-collapsed .brand-image {
        margin-left: 5px;
    }
</style> -->

<!-- Sidebar Toggle Script -->
<!-- <script>
    document.getElementById('toggleSidebarBtn').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('customSidebar').classList.toggle('sidebar-collapsed');
    });
</script> -->