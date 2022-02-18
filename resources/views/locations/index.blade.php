@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/leaflet.css') }}" />
@endsection

@section('content')

<!-- begin:: Content Head -->

						<!-- end:: Content Head -->

						<!-- begin:: Content -->
						<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<!-- NOTIFICACION -->
							@if(Session::has('msg'))
									<div class="alert alert-success fade show" role="alert">
										<div class="alert-icon"><i class="flaticon-user-ok"></i></div>
										<div class="alert-text">{{ Session::get('msg') }}</div>
										<div class="alert-close">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true"><i class="la la-close"></i></span>
											</button>
										</div>
									</div>
							@endif

							@if(Session::has('err'))
									<div class="alert alert-danger fade show" role="alert">
										<div class="alert-icon"><i class="flaticon2-cross"></i></div>
										<div class="alert-text">{{ Session::get('err') }}</div>
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
													Lista de Ubicaciones </h3>
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
                          Lista de las ubicaciones. <a class="kt-link kt-font-bold" href="https://codeals.es/" target="_blank">here</a>.
                      </div>
                  </div>
                  <div class="kt-portlet kt-portlet--mobile">
										<div class="kt-portlet__head kt-portlet__head--lg">
												<div class="kt-portlet__head-label">
														<span class="kt-portlet__head-icon">
																<i class="kt-font-brand flaticon2-bell"></i>
														</span>
														<h3 class="kt-portlet__head-title">
															Ubicaciones
														</h3>
												</div>

										</div>
								<div class="kt-portlet__body">

							<!--Begin::Section-->
							<div class="row">

                @foreach($locations as $location)

						        <div class="col-xl-4">

									<!--Begin::Portlet-->
									<div class="kt-portlet kt-portlet--height-fluid">
										<div class="kt-portlet__head kt-portlet__head--noborder">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
												</h3>
											</div>
											<div class="kt-portlet__head-toolbar">
												<a href="#" class="btn btn-icon" data-toggle="dropdown">
													<i class="flaticon-more-1 kt-font-brand"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right">
													<ul class="kt-nav">

                            <li class="kt-nav__item">
															<a href="{{ route('admin.locations.edit', $location->id) }}" class="kt-nav__link">
																<i class="kt-nav__link-icon la la-edit"></i>
																<span class="kt-nav__link-text">Editar</span>
															</a>
														</li>

                            {!! Form::open(['route' => ['admin.locations.destroy', $location->id], 'id' => 'form_location_'.$location->id]) !!}
                                <li class="kt-nav__item">
                                    <input type="hidden" name="_method" value="DELETE">
  																<a type="submit" form-id="form_location_{{$location->id}}" data-dialog="delete_dialog" class="kt-nav__link" style="-webkit-appearance: none !important;"  title="{!! trans('user.views.delete') !!}">
                                    <i class="kt-nav__link-icon flaticon-cancel "></i>
                                    <span class="kt-nav__link-text">Eliminar</span>
  																</a>
														    </li>
                            {!! Form::close() !!}

													</ul>
												</div>
											</div>
										</div>
										<div class="kt-portlet__body">

											<!--begin::Widget -->
											<div class="kt-widget kt-widget--user-profile-2">
												<div class="kt-widget__head">
													<div class="kt-widget__media">
														<img class="kt-widget__img kt-hidden-" src="{{ asset('uploads/locations/'.$location->logo) }}" alt="image">
														<div class="kt-widget__pic kt-widget__pic--success kt-font-success kt-font-boldest kt-hidden">
															ChS
														</div>
													</div>
													<div class="kt-widget__info">
														<a href="#" class="kt-widget__username">
															{{$location->location}}
														</a>
														<span class="kt-widget__desc">
															{{$location->start_time}} - {{$location->end_time}} Horario
														</span>
													</div>
												</div>
                        <br/>

												<div class="kt-widget__body">
                          <div class="kt-widget15">
                            <div class="kt-widget15__map">
                              <div id="map{{$location->id}}" class="map" location="{{$location->id}}" lat="{{$location->latitude}}" lng="{{$location->longitude}}" style="height: 320px; border: 1px solid #AAA;"></div>
                            </div>
  													<div class="kt-widget__section">
  														{{$location->zip}}, {{$location->address}}, {{$location->city}}, {{$location->neighborhood}}, {{$location->municipality}}, {{$location->contry}}
  													</div>
  													<div class="kt-widget__item">
  														<div class="kt-widget__contact">
  															<span class="kt-widget__label">Correo</span>
  															<a href="#" class="kt-widget__data">{{$location->email}}</a>
  														</div>
  														<div class="kt-widget__contact">
  															<span class="kt-widget__label">Teléfono</span>
  															<a href="#" class="kt-widget__data">{{$location->phone}}</a>
  														</div>
															<div class="kt-widget__contact">
  															<span class="kt-widget__label">Sitio Web</span>
  															<a href="#" class="kt-widget__data">{{$location->web}}</a>
  														</div>

  													</div>
                          </div>
												</div>
												<!-- <div class="kt-widget__footer">
													<button type="button" class="btn btn-label-warning btn-lg btn-upper">write message</button>
												</div> -->
											</div>

											<!--end::Widget -->
										</div>
									</div>

									<!--End::Portlet-->
								</div>
                @endforeach
							</div>

							<!--End::Section-->

							<!--Begin::Section-->
							<div class="row">
								<div class="col-xl-12">

									<!--begin:: Components/Pagination/Default-->
									<div class="kt-portlet">
										<div class="kt-portlet__body">

											<!--begin: Pagination-->
											<div class="kt-pagination kt-pagination--brand">

                        <ul class="kt-pagination__links">
                        	{{ $locations->links() }}
                        </ul>

											</div>

											<!--end: Pagination-->
										</div>
									</div>

									<!--end:: Components/Pagination/Default-->
								</div>
							</div>

							<!--End::Section-->
						</div>
						</div>
						</div>

						<!-- end:: Content -->

              <div class="modal modal-stick-to-bottom fade" id="delete_dialog" role="dialog" data-backdrop="false" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Atención</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Desea eliminar ubicaciones</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger delete">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>

@endsection

@section('js')
		<script src="{{ asset('assets/js/demo4/pages/dashboard.js') }}" type="text/javascript"></script>
        <script type='text/javascript' src="{{ asset('js/leaflet.js') }}"></script>
        <script type="text/javascript">

            var form_to_submit = '';

            $(document).ready(function(){

                $('[data-dialog]').click(function (e) {
                    e.preventDefault();
                    form_to_submit = $(this).attr('form-id');
                    $('#delete_dialog').modal('show');
                });

                $('.delete').click(function () {
                    if(form_to_submit != '') {
                        // alert('Eliminar '+form_to_submit);
                        $("#"+form_to_submit).submit();
                    }
                });

                $('.map').each(function(){

                    var map = L.map( 'map'+$(this).attr('location'), {
                      center: [$(this).attr('lat'), $(this).attr('lng')],
                      minZoom: 2,
                      zoom: 14
                    });

                    var myIcon = L.icon({
                      iconUrl: "{{ asset('assets/media/maps/pin24.png') }}",
                      iconRetinaUrl: "{{ asset('assets/media/maps/pin48.png') }}",
                      iconSize: [35, 30],
                      iconAnchor: [9, 21],
                      popupAnchor: [0, -14]
                    })

                    L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                      subdomains: ['a', 'b', 'c']
                    }).addTo( map );

                    marker = new L.Marker([$(this).attr('lat'), $(this).attr('lng')], {icon: myIcon}).addTo(map);
                });
            });

        </script>


@endsection
