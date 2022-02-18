<!--
# @Author: Codeals
# @Date:   20-06-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 23-08-2019
# @Copyright: Codeals
-->

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
@endsection

@section('content')

	<!-- begin:: Content -->
		<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

		@if ($errors->any())
				<div class="alert alert-danger fade show" role="alert">
					<div class="alert-icon"><i class="flaticon2-cross"></i></div>
					<div class="alert-text">
						@foreach ($errors->all() as $err)
							{{ $err }} </br>
						@endforeach
					</div>
					<div class="alert-close">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true"><i class="la la-close"></i></span>
						</button>
					</div>
				</div>
		@endif

		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
				<div class="kt-container ">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title">
								Editar Ubicación </h3>
							<span class="kt-subheader__separator kt-hidden"></span>
							<div class="kt-subheader__breadcrumbs">
								<span class="kt-subheader__breadcrumbs-separator"></span>
								<a href="{{ route('admin.locations.index') }}" class="kt-subheader__breadcrumbs-link">
									Listar Ubicacións </a>
								<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
							</div>
						</div>

				</div>
		</div>

		<div class="kt-container  kt-grid__item kt-grid__item--fluid">
				<div class="alert alert-light alert-elevate" role="alert">
						<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
						<div class="alert-text">
								Editar ubicaciones, con vistas a proximas actualizaciones de las Apps. <a class="kt-link kt-font-bold" href="https://codeals.es/" target="_blank">here</a>.
						</div>
				</div>
				<div class="kt-portlet kt-portlet--mobile">
					<div class="kt-portlet__head kt-portlet__head--lg">
							<div class="kt-portlet__head-label">
									<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-bell"></i>
									</span>
									<h3 class="kt-portlet__head-title">
											Editar Ubicación
									</h3>
							</div>

					</div>
			<div class="kt-portlet__body">

							<!--begin::Portlet-->
							<div class="row">

								<div class="col-lg-12">

										<!--begin::Form-->
										<form class="kt-form kt-form--label-right"  action="{{route('admin.locations.update', $location->id)}}" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="_method" value="PUT">
                			@csrf

                			<input type="hidden" name="id" value="{{$location->id}}">

                      <input type="hidden" id="latitude" name="latitude" value="">
                      <input type="hidden" id="longitude" name="longitude" value="">
											<div class="kt-portlet__body">
												<div class="kt-section">
													<h3 class="kt-section__title">
														Ubicación
													</h3>
													<div class="kt-section__content">
														<div class="form-group form-group-last row">
															<div class="col-lg-3">
															<label class="form-control-label">* Nombre de la Ubicación</label>
																<input type="text" name="location" class="form-control" placeholder="" value="{{ $location->location }}">
															</div>

                              <div class="col-lg-3">
															<label class="form-control-label">Email</label>
																<input type="text" name="email" class="form-control" placeholder="" value="{{ $location->email }}">
															</div>

															<div class="col-lg-3">
															<label class="form-control-label"> Telefono</label>
																<input type="text" name="phone" class="form-control" placeholder="" value="{{ $location->phone }}">
															</div>

															<div class="col-lg-3">
																<label class="form-control-label"> Sitio Web</label>
																<input type="text" name="web" class="form-control" placeholder="" value="{{ $location->phone }}">
															</div>

                              <div class="custom-file col-lg-3">
																<label class="form-control-label">Logo </label>
																<input type="file" class="form-control" name="logo" placeholder="" value="{{ $location->logo }}">
															</div>

														</div>

													</div>
												</div>
												<div class="kt-separator kt-separator--border-dashed kt-separator--space-xl"></div>

												<div class="kt-section">
													<h3 class="kt-section__title">
														Dirección
													</h3>
													<div class="kt-section__content">
														<div class="form-group form-group-last row">
															<div class="col-lg-3">
															<label class="form-control-label"> Codigo Postal</label>
																<input type="text" name="zip" class="form-control" placeholder="" value="{{ $location->zip }}">
															</div>

                              <div class="col-lg-3">
																<label class="form-control-label">Dirección</label>
																<input type="text" name="address" class="form-control" placeholder="" value="{{ $location->address }}">
															</div>

                              <div class="col-lg-3">
																<label class="form-control-label">Ciudad</label>
																<input type="text" class="form-control" name="city" placeholder="" value="{{ $location->city }}">
															</div>

															<div class="col-lg-3">
																<label class="form-control-label">Pais</label>
																<input type="text" class="form-control" name="country" placeholder="" value="{{ $location->country }}">
															</div>

														</div>

														<div class="form-group form-group-last row">
															<div class="col-lg-3">
															<label class="form-control-label"> Barrio</label>
																<input type="text" name="neighborhood" class="form-control" placeholder="" value="{{ $location->neighborhood }}">
															</div>

                              <div class="col-lg-3">
																<label class="form-control-label">Municipio</label>
																<input type="text" name="municipality" class="form-control" placeholder="" value="{{ $location->municipality }}">
															</div>

                              <div class="col-lg-3">
																<label class="form-control-label">Horario de apertura</label>
																<input type="time" class="form-control" name="start_time" placeholder="" value="{{ $location->start_time }}">
															</div>

															<div class="col-lg-3">
																<label class="form-control-label">Horario de cierre</label>
																<input type="time" class="form-control" name="end_time" placeholder="" value="{{ $location->end_time }}">
															</div>

														</div>
                            <br>
                            <div id="map" style="height: 440px; border: 1px solid #AAA;"></div>

													</div>
												</div>

											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-12">
															<button type="submit" class="btn btn-success">Editar</button>
															<button type="reset" class="btn btn-secondary">Cancelar</button>
														</div>
													</div>
												</div>
											</div>
										</form>

										<!--end::Form-->

									<!--end::Portlet-->
								</div>
							</div>
							</div>
							</div>
						</div>

						<!-- end:: Content -->

@endsection

@section('js')

    <!--begin::Page Scripts(used by this page) -->
		<script src="{{ asset('assets/js/demo4/pages/crud/forms/validation/form-controls.js') }}" type="text/javascript"></script>
        <script type='text/javascript' src='https://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js'></script>
        <script type="text/javascript">

            $(document).ready(function(){
                navigator.geolocation.getCurrentPosition(success, error, options);
            });

            var options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };

            var map;

            var marker;

            function success(pos) {
                var crd = pos.coords;

                console.log('Your current position is:');
                console.log('Latitude : ' + crd.latitude);
                console.log('Longitude: ' + crd.longitude);
                console.log('More or less ' + crd.accuracy + ' meters.');

                map = L.map( 'map', {
                  center: [crd.latitude, crd.longitude],
                  minZoom: 2,
                  zoom: 12
                });

                map.on('click', function (e) {
                  if (marker) {
                    map.removeLayer(marker);
                  }
                  marker = new L.Marker(e.latlng).addTo(map);
                  $('#latitude').val(e.latlng.lat);
                  $('#longitude').val(e.latlng.lng);
                });

                L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                  subdomains: ['a', 'b', 'c']
                }).addTo( map );
            };

            function error(err) {
                map = L.map( 'map', {
                  center: [20.0, 5.0],
                  minZoom: 2,
                  zoom: 2
                });

                L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                  subdomains: ['a', 'b', 'c']
                }).addTo( map )

                var myIcon = L.icon({
                  iconUrl: "{{ asset('assets/media/maps/pin24.png') }}",
                  iconRetinaUrl: "{{ asset('assets/media/maps/pin48.png') }}",
                  iconSize: [29, 24],
                  iconAnchor: [9, 21],
                  popupAnchor: [0, -14]
                })

                for ( var i=0; i < markers.length; ++i )
                {
                 L.marker( [markers[i].lat, markers[i].lng], {icon: myIcon} )
                  .bindPopup( '<a href="' + markers[i].url + '" target="_blank">' + markers[i].name + '</a>' )
                  .addTo( map );
                }
            };

        </script>
		<!--end::Page Scripts -->

@endsection
