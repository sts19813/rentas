<div id="kt_app_sidebar" class="app-sidebar flex-column"
    data-kt-drawer="true"
    data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true"
    data-kt-drawer-width="250px"
    data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <!--begin::Wrapper-->
    <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper">
        <div class="hover-scroll-y my-5 my-lg-2 mx-4"
            data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}"
            data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_header"
            data-kt-scroll-wrappers="#kt_app_sidebar_wrapper"
            data-kt-scroll-offset="5px">

            <!--begin::Sidebar menu-->
            <div id="kt_app_sidebar_menu"
                data-kt-menu="true"
                data-kt-menu-expand="false"
                class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-3 mb-5">

                <!-- Dashboard -->
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-element-11 fs-2"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>

                <!-- Proyectos -->
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('proyectos*') ? 'active' : '' }}" href="{{ url('/proyectos') }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-folder fs-2"></i>
                        </span>
                        <span class="menu-title">Proyectos</span>
                    </a>
                </div>

                <!-- Cotización -->
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('cotizacion*') ? 'active' : '' }}" href="{{ url('/cotizacion') }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-calculator fs-2"></i>
                        </span>
                        <span class="menu-title">Cotización</span>
                    </a>
                </div>

                <!-- Clientes -->
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('clientes*') ? 'active' : '' }}" href="{{ url('/clientes') }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-user fs-2"></i>
                        </span>
                        <span class="menu-title">Clientes</span>
                    </a>
                </div>

                <!-- Configuraciones -->
                <div class="menu-item menu-accordion {{ request()->is('amenidades*') || request()->is('servicios*') ? 'show' : '' }}"
                    data-kt-menu-trigger="click">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-setting-3 fs-2"></i>
                        </span>
                        <span class="menu-title">Configuraciones</span>
                        <span class="menu-arrow"></span>
                    </span>

                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('amenidades*') ? 'active' : '' }}" href="{{ url('/amenidades') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Amenidades</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('servicios*') ? 'active' : '' }}" href="{{ url('/servicios') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Servicios</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Perfil -->
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ url('/profile') }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-profile-circle fs-2"></i>
                        </span>
                        <span class="menu-title">Perfil</span>
                    </a>
                </div>

                <!-- Salir -->
                <div class="menu-item">
                    <a class="menu-link" href="{{ url('/logout') }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-exit-right fs-2"></i>
                        </span>
                        <span class="menu-title">Salir</span>
                    </a>
                </div>

            </div>
            <!--end::Sidebar menu-->
        </div>
    </div>
    <!--end::Wrapper-->
</div>
