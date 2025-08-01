<!DOCTYPE html>

<html lang="en">

<head>
	{{--
	<base href="" /> --}}
	<title>Bappeda - Sumatera Barat</title>
	<meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="{{asset('assets_global/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
		type="text/css" />
	<link href="{{asset('assets_global/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets_global/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

	<link rel="icon" type="image/png" href="{{ asset('logo/B BAPPEDA.png') }}" sizes="32x32">
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
		rel="stylesheet">
	<link
		href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
		rel="stylesheet">
	{{--
	<link
		href="https://fonts.googleapis.com/css2?family=Geologica:wght@400;500;600;700;800;900&family=Poppins:wght@400;500&display=swap"
		rel="stylesheet" /> --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
	{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
	<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
	<link href="{{asset('assets_global/custom/custom.css')}}" rel="stylesheet" type="text/css" />
	@yield('css')
	<style>
		body.access-high-contrast {
			filter: contrast(200%);
		}

		body.access-dark-mode {
			background-color: #000;
			color: #fff;
		}

		body.access-light-mode {
			background-color: #fff;
			color: #000;
		}

		body.access-readable-font {
			font-family: Arial, sans-serif;
			font-size: 1.1em;
		}

		body.access-grey-scale {
			filter: grayscale(100%);
		}

		body.access-underline-links a {
			text-decoration: underline;
		}

		body.access-text-left {
			text-align: left;
		}

		.access-btn {
			position: fixed;
			top: 20%;
			left: 0;
			background: #003399;
			color: white;
			padding: 15px;
			border-radius: 0 7px 7px 0;
			cursor: pointer;
			z-index: 9999;
		}

		.access-panel {
			position: fixed;
			top: 100px;
			left: 60px;
			background: #fff;
			border: 1px solid #ccc;
			width: 250px;
			display: none;
			z-index: 9998;
			padding: 10px;
		}

		.access-panel button {
			display: block;
			width: 100%;
			margin: 5px 0;
		}
	</style>

</head>

<body id="kt_app_body" data-kt-app-layout="light-header" data-kt-app-header-fixed="true"
	data-kt-app-toolbar-enabled="true" data-kt-app-header-fixed-mobile="true" class="app-default">
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			@if ($errors->any())
				@foreach ($errors->all() as $error)
					toastr.error('{{ $error }}');
				@endforeach
			@endif


			@if (session('success'))
				toastr.success('{{ session('success') }}');
			@endif

			@if (session('error'))
				toastr.error('{{ session('error') }}');
			@endif
		});
	</script>
	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
			<div id="kt_app_header" class="app-header bg-backdrop">

				@include('partials.guest.nav')
			</div>
			<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
				<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
					<div class="d-flex flex-column flex-column-fluid">
						<div id="kt_app_content" class="app-content flex-column-fluid bg-white pb-0">
							@yield('content')
						</div>
					</div>
					<div id="kt_app_footer" class="footer justify-content-center bg-custom-orange">
						@include('partials.guest.footer')
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<span class="svg-icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
					fill="currentColor" />
				<path
					d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
					fill="currentColor" />
			</svg>
		</span>
	</div>

	<button id="kt_drawer_example_dismiss_button"
		class="btn btn-primary tombol_contact_us rounded-pill hover-elevate-down btn-icon">
		<i class="fa-solid fa-circle-user fs-2hx"></i>
	</button>

	<div id="kt_drawer_example_dismiss" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
		data-kt-drawer-toggle="#kt_drawer_example_dismiss_button"
		data-kt-drawer-close="#kt_drawer_example_dismiss_close" data-kt-drawer-overlay="true"
		data-kt-drawer-width="{default:'250px', 'md': '500px'}">
		<div class="card rounded-0 w-100">
			<div class="card-header pe-5">
				<div class="card-title">
					<div class="d-flex justify-content-center flex-column me-3">
						<a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 lh-1">Pegawai Terbaik</a>
					</div>
				</div>
				<div class="card-toolbar">
					<div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_example_dismiss_close">
						<i class="fa-solid fa-square-xmark fs-3"></i>
					</div>
				</div>
			</div>
			<div class="card-body hover-scroll-overlay-y">
				@php
					$data = \App\Models\PegawaiTerbaik::orderBy('tahun')->orderBy('bulan')->get()->groupBy('tahun');
				@endphp

				<ul class="nav nav-tabs" id="tahunTabs" role="tablist">
					@foreach ($data as $tahun => $bulans)
						<li class="nav-item" role="presentation">
							<button class="nav-link @if ($loop->first) active @endif" data-bs-toggle="tab" data-bs-target="#tahun-{{ $tahun }}" type="button" role="tab">
								{{ $tahun }}
							</button>
						</li>
					@endforeach
				</ul>

				<div class="tab-content mt-4" id="tahunTabsContent">
					@foreach ($data as $tahun => $bulans)
						<div class="tab-pane fade @if ($loop->first) show active @endif" id="tahun-{{ $tahun }}" role="tabpanel">
							{{-- Tab Bulanan --}}
							<ul class="nav nav-pills mb-3" id="bulanTabs-{{ $tahun }}" role="tablist">
								@foreach ($bulans->groupBy('bulan') as $bulan => $items)
									<li class="nav-item" role="presentation">
										<button class="nav-link @if ($loop->first) active @endif" data-bs-toggle="pill" data-bs-target="#bulan-{{ $tahun }}-{{ $bulan }}" type="button" role="tab">
											{{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
										</button>
									</li>
								@endforeach
							</ul>

							<div class="tab-content" id="bulanTabsContent-{{ $tahun }}">
								@foreach ($bulans->groupBy('bulan') as $bulan => $items)
									<div class="tab-pane fade @if ($loop->first) show active @endif" id="bulan-{{ $tahun }}-{{ $bulan }}" role="tabpanel">
										@foreach ($items as $item)
											<div class="card mb-3">
												<div class="card-body">
													<table class="table table-borderless text-start mb-2">
														<tbody>
															<tr>
																<th class="fw-bold text-gray-800">
																	<span>Nama</span>
																</th>
																<td class="text-uppercase"><span>{{ $item->_pegawai->nama_pns ?? '' }}</span> </td>
															</tr>
															<tr>
																<th class="fw-bold text-gray-800"><span>NIP</span></th>
																<td>
																	<span>
																		{{ $item->_pegawai->nip ?? '' }}
																	</span>
																</td>
															</tr>
															<tr>
																<th class="fw-bold text-gray-800">
																	<span>
																		Jabatan
																	</span>
																</th>
																<td><span>{{ $item->_pegawai->jabatan_nm ?? '' }}</span> </td>
															</tr>
														</tbody>
													</table>
													@if($item->path)
														<img src="{{ asset('uploads/pegawai_terbaik/' . $item->path) }}" width="250" />
													@endif
												</div>
											</div>
										@endforeach
									</div>
								@endforeach
							</div>
						</div>
					@endforeach
				</div>

			</div>

			<div class="card-footer">
				<button class="btn btn-light-danger" data-kt-drawer-dismiss="true">Tutup</button>
			</div>
		</div>
	</div>
	<div class="access-btn" onclick="togglePanel()">
		<i class="fa fa-wheelchair text-white"></i> Akses
	</div>

	<!-- Panel Aksesibilitas -->
	<div class="access-panel" id="accessPanel">
		<button onclick="resizeText(1.1)">Perbesar Teks</button>
		<button onclick="resizeText(0.9)">Perkecil Teks</button>
		<button onclick="toggleClass('access-grey-scale')">Skala Abu - Abu</button>
		<button onclick="toggleClass('access-high-contrast')">Kontras Tinggi</button>
		<button onclick="toggleClass('access-dark-mode')">Latar Gelap</button>
		<button onclick="toggleClass('access-light-mode')">Latar Terang</button>
		<button onclick="toggleClass('access-readable-font')">Tulisan Dapat Dibaca</button>
		<button onclick="toggleClass('access-underline-links')">Garis Bawah Tautan</button>
		<button onclick="toggleClass('access-text-left')">Rata Tulisan</button>
		<button onclick="resetAccessibility()">Atur Ulang</button>
	</div>


	<script src="{{asset('assets_global/plugins/global/plugins.bundle.js')}}"></script>
	<script src="{{asset('assets_global/js/scripts.bundle.js')}}"></script>
	<script src="{{asset('assets_global/plugins/custom/datatables/datatables.bundle.js')}}"></script>
	@yield('script')

	<script>
		let currentUtterance = null;

		function speakText(text) {
			if (!text.trim()) return;
			window.speechSynthesis.cancel(); // Hentikan suara sebelumnya

			const msg = new SpeechSynthesisUtterance(text.trim());
			msg.lang = 'id-ID'; // Bahasa Indonesia
			msg.rate = 1;
			window.speechSynthesis.speak(msg);
			currentUtterance = msg;
		}

		function togglePanel() {
			const panel = document.getElementById('accessPanel');
			panel.style.display = (panel.style.display === 'block') ? 'none' : 'block';
		}

		function toggleClass(className) {
			document.body.classList.toggle(className);
		}

		function resizeText(factor) {
			const body = document.body;
			const currentSize = parseFloat(getComputedStyle(body).fontSize);
			body.style.fontSize = (currentSize * factor) + 'px';
		}

		function resetAccessibility() {
			document.body.className = '';
			document.body.style.fontSize = '';
			window.speechSynthesis.cancel();
		}

		function isSpeakableTag(tag) {
			return ['p', 'a', 'span', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'].includes(tag);
		}

		document.body.addEventListener('mouseover', function (e) {
			const tag = e.target.tagName.toLowerCase();
			if (isSpeakableTag(tag)) {
				const text = e.target.innerText || e.target.textContent || '';
				speakText(text);
			}
		});

		document.body.addEventListener('mouseout', function (e) {
			const tag = e.target.tagName.toLowerCase();
			if (isSpeakableTag(tag)) {
				window.speechSynthesis.cancel();
			}
		});
	</script>
</body>




</html>