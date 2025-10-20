<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>@yield('title', 'Dashboard')</title>

	<!-- Meta -->
	<meta name="description"
		content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals." />
	<meta name="keywords"
		content="metronic, bootstrap, bootstrap 5, admin themes, web design, web development, free templates" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template" />
	<meta property="og:url" content="https://keenthemes.com/metronic" />
	<meta property="og:site_name" content="Metronic by Keenthemes" />
	<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
	<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

	<!-- Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

	<!-- Vendor Stylesheets (para páginas específicas, opcional) -->
	<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
		type="text/css" />
	<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
		type="text/css" />

	<!-- Global Stylesheets Bundle (obligatorios) -->
	<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <x-link></x-link>
	<script>
		// Prevención de clickjacking
		if (window.top != window.self) {
			window.top.location.replace(window.self.location.href);
		}
	</script>

	<style>
		:root {
			--bs-primary: #396DFA;
			--bs-primary-active: #2f5cd9;
			/* un tono más oscuro para el estado activo */
			--bs-primary-light: #809cff;
			/* un tono más claro para hover o light variants */
		}

		/* ===== Sidebar Fix Metronic ===== */
		.app-sidebar .menu-link {
			display: flex;
			align-items: center;
			padding: 0.65rem 1rem;
			border-radius: 0.475rem;
			color: var(--bs-gray-700);
			text-decoration: none !important;
			/* ❌ quita el subrayado */
			transition: all 0.2s ease;
		}

		.app-sidebar .menu-link:hover {
			background-color: var(--bs-gray-100);
			color: var(--bs-primary);
		}

		.app-sidebar .menu-link.active {
			background-color: var(--bs-light-primary);
			color: var(--bs-primary);
			font-weight: 600;
		}

		.app-sidebar .menu-icon {
			margin-right: 0.75rem;
			display: flex;
			align-items: center;
		}

		.app-sidebar .menu-title {
			font-size: 0.95rem;
			text-transform: none;
		}

		/* Submenús */
		.app-sidebar .menu-sub .menu-link {
			padding-left: 2.5rem;
			font-size: 0.9rem;
			color: var(--bs-gray-600);
		}

		.app-sidebar .menu-sub .menu-link.active {
			color: var(--bs-primary);
			background-color: transparent;
		}
	</style>
</head>

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true"
	data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
	data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-aside-enabled="false"
	data-kt-app-aside-fixed="false" data-kt-app-aside-push-toolbar="false" data-kt-app-aside-push-footer="false"
	class="app-default">


	<!--begin::Theme mode setup on page load-->
	<script>
		var defaultThemeMode = "light";
		var themeMode;
		if (document.documentElement) {
			if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
				themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
			} else {
				if (localStorage.getItem("data-bs-theme") !== null) {
					themeMode = localStorage.getItem("data-bs-theme");
				} else {
					themeMode = defaultThemeMode;
				}
			}
			if (themeMode === "system") {
				themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
			}
			document.documentElement.setAttribute("data-bs-theme", themeMode);
		}
	</script>
	<!--end::Theme mode setup on page load-->
	<!--begin::App-->

	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		<!--begin::Page-->
		<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
			<!-- Header -->
			@include('partials.header')


			<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
				<!--begin::Sidebar-->
				@include('partials.sidebar')
				<!--end::Sidebar-->
				<!--begin::Main-->
				<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
					<!--begin::Content wrapper-->
					<div class="d-flex flex-column flex-column-fluid">
						<!--begin::Content-->
						<div id="kt_app_content" class="app-content flex-column-fluid">
							<!--begin::Content container-->
							<div id="kt_app_content_container" class="app-container container-fluid">

								@yield('content')

								<!--end::Row-->
							</div>
							<!--end::Content container-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Content wrapper-->
					<!--begin::Footer-->
					@include('partials.footer')
					<!--end::Footer-->
				</div>
			</div>
		</div>
		<!--end::Wrapper-->
	</div>
	<!--begin::Javascript-->
	<script>
		var hostUrl = "{{ asset('assets') }}/";
	</script>

	<!--begin::Global Javascript Bundle (obligatorio para todas las páginas)-->
	<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
	<!--end::Global Javascript Bundle-->

	<!--begin::Vendors Javascript (usados solo en algunas páginas)-->
	<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
	<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
	<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
	<!--end::Vendors Javascript-->

	<!--begin::Custom Javascript (usados solo en algunas páginas)-->
	<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
	<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
	<script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
	<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
	<!--end::Custom Javascript-->

	<!-- Para cargar scripts adicionales desde otras vistas -->
	@stack('scripts')
	<!--end::Javascript-->
</body>

</html>