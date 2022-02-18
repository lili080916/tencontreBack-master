<!--
# @Author: Codeals
# @Date:   23-06-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 12-08-2019
# @Copyright: Codeals
-->

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/leaflet.css') }}" />
@endsection

@section('content')

<!-- begin:: Subheader -->
						<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-subheader__main">
								<h3 class="kt-subheader__title">
									{!! trans('farm.views.farm') !!} </h3>
								<span class="kt-subheader__separator kt-hidden"></span>
								<div class="kt-subheader__breadcrumbs">
									<a href="{{ route('admin') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon-home-2"></i></a>
									<span class="kt-subheader__breadcrumbs-separator"></span>
									<a href="{{ route('admin') }}" class="kt-subheader__breadcrumbs-link">
										{!! trans('share.layouts.home') !!} </a>

									<span class="kt-subheader__breadcrumbs-separator"></span>
									<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{!! trans('farm.views.farm') !!}</span>
								</div>
							</div>

						</div>

						<!-- end:: Subheader -->

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

							<!--Begin::App-->
							<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

								<!--Begin:: App Aside Mobile Toggle-->
								<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
									<i class="la la-close"></i>
								</button>

								<!--End:: App Aside Mobile Toggle-->

								<!--Begin:: App Aside-->
								<div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

									<!--begin:: Widgets/Applications/User/Profile1-->
									<div class="kt-portlet ">
										<div class="kt-portlet__head  kt-portlet__head--noborder">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
												</h3>
											</div>

										</div>
										<div class="kt-portlet__body kt-portlet__body--fit-y">

											<!--begin::Widget -->
											<div class="kt-widget kt-widget--user-profile-1">
												<div class="kt-widget__head">
													<div class="kt-widget__media">
														<img src="#" alt="image">
													</div>
													<div class="kt-widget__content">
														<div class="kt-widget__section">
															<a href="#" class="kt-widget__username">
																TEST 1
																<i class="flaticon2-correct kt-font-success"></i>
															</a>
															<span class="kt-widget__subtitle">
																TEST 2
															</span>
														</div>
														<div class="kt-widget__action">
															<a href="#" class="btn btn-info btn-sm">{!! trans('farm.views.edit') !!}</a>&nbsp;
															<a href="#" class="btn btn-success btn-sm">{!! trans('farm.views.list') !!}</a>
														</div>
													</div>
												</div>
												<div class="kt-widget__body">
													<div class="kt-widget__content">
														<div class="kt-widget__info">
															<span class="kt-widget__label">{!! trans('farm.views.email') !!}:</span>
															<a href="#" class="kt-widget__data">TEST 3</a>
														</div>
														<div class="kt-widget__info">
															<span class="kt-widget__label">{!! trans('farm.views.phone') !!}:</span>
															<a href="#" class="kt-widget__data">TEST 4</a>
														</div>
														<div class="kt-widget__info">
															<span class="kt-widget__label">{!! trans('farm.views.location') !!}:</span>
															<span class="kt-widget__data">TEST 5</span>
														</div>


															<!-- <div class="kt-widget15__map">
	                            <div id="map1" class="map" report="1" lat="23.08834535" lng="-82.49166978" style="height: 320px; border: 1px solid #AAA;"></div>
	                            </div> -->

													</div>
													<div class="kt-widget__items">
														<a href="#" class="kt-widget__item kt-widget__item--active">
															<span class="kt-widget__section">
																<span class="kt-widget__icon">
																	<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon id="Bound" points="0 0 24 0 24 24 0 24" />
																			<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" id="Shape" fill="#000000" fill-rule="nonzero" />
																			<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" id="Path" fill="#000000" opacity="0.3" />
																		</g>
																	</svg> </span>
																<span class="kt-widget__desc">
																	{!! trans('report.views.newfarm') !!}
																</span>
															</span>
															<span class="kt-badge kt-badge--unified-info kt-badge--sm kt-badge--rounded kt-badge--bolder">TEST 6</span>
														</a>
														<a href="#" class="kt-widget__item">
															<span class="kt-widget__section">
																<span class="kt-widget__icon">
																	<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon id="Shape" points="0 0 24 0 24 24 0 24" />
																			<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero" />
																		</g>
																	</svg> </span>
																<span class="kt-widget__desc">
																	{!! trans('farm.views.newwork') !!}
																</span>
															</span>
															<span class="kt-badge kt-badge--unified-info kt-badge--sm kt-badge--rounded kt-badge--bolder">TEST 7</span>
														</a>

													</div>
												</div>
											</div>

											<!--end::Widget -->
										</div>
									</div>

									<!--end:: Widgets/Applications/User/Profile1-->
								</div>

								<!--End:: App Aside-->

								<!--Begin:: App Content-->
								<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
									<div class="row">
										<div class="col-xl-12">
											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">{!! trans('farm.views.farm') !!} <small>{!! trans('share.views.insert') !!}</small></h3>
													</div>

												</div>

												<!-- MAP  -->
													<div class="kt-widget15__map">
														<div id="map1" class="map" report="1" lat="23.08834535" lng="-82.49166978" style="height: 320px; border: 1px solid #AAA;"></div>
														<!-- <div id="map2" class="map" report="2" lat="23.09722436" lng="-82.42762223" style="height: 320px; border: 1px solid #AAA;"></div> -->
														<!-- <div id="map3" class="map" report="3" lat="23.09487832" lng="-82.42525192" style="height: 320px; border: 1px solid #AAA;"></div> -->
													</div>

												<!-- MAP  -->
												

											</div>
										</div>
									</div>

									<div class="row">
											<div class="col-xl-12">

												<!--begin:: Widgets/User Progress -->
												<div class="kt-portlet kt-portlet--height-fluid">
													<div class="kt-portlet__head">
														<div class="kt-portlet__head-label">
															<h3 class="kt-portlet__head-title">
																TEST
															</h3>
														</div>

													</div>
													<div class="kt-portlet__body">
														<div class="tab-content">
															<div class="tab-pane active" id="kt_widget31_tab1_content">
																<div class="kt-widget31">

																	<div class="kt-widget31__item">
																		<div class="kt-widget31__content">
																			<div class="kt-widget31__pic">
																				<img src="#" alt="">
																			</div>
																			<div class="kt-widget31__info">
																				<a href="#" class="kt-widget31__username">
																				</a>
																				<p class="kt-widget31__text">
																					TEST 9
																				</p>
																			</div>
																		</div>
																		<div class="kt-widget31__content">
																			<div class="kt-widget31__progress">
																				<a href="#" class="kt-widget31__stats">
																				</a>

																			</div>
																	

																		</div>
																	</div>

																</div>
															</div>

														</div>
													</div>
												</div>

												<!--end:: Widgets/User Progress -->
											</div>
									</div>
								</div>

								<!--End:: App Content-->
							</div>

							<!--End::App-->
						</div>

						<!-- end:: Content -->
												<!-- modal delete -->
                        <!-- <div class="modal modal-stick-to-bottom fade" id="delete_dialog" role="dialog" data-backdrop="false" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{!! trans('share.views.carefull') !!}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{!! trans('share.views.msg_delete') !!}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! trans('share.views.candel') !!}</button>
                                        <button type="button" class="btn btn-danger delete">{!! trans('share.views.delete') !!}</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->

@endsection

@section('js')

    <!--begin::Page Scripts(used by this page) -->

    <script src="{{ asset('assets/js/demo4/pages/dashboard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/demo4/pages/custom/apps/user/profile.js') }}" type="text/javascript"></script>

		<!--end::Page Scripts -->

		<!-- Maps -->
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
                            alert('Eliminar '+form_to_submit);
                            // $("#"+form_to_submit).submit();
                        }
                    });

						$('.map').each(function(){

							// ,{'23.09722436', '-82.42762223'}

								var map = L.map( 'map'+$(this).attr('report'), {
									center: [$(this).attr('lat'), $(this).attr('lng')],
									minZoom: 2,
									zoom: 14
								},
								{
									center: [23.09722436, -82.42762223],
									minZoom: 2,
									zoom: 14
								}
								);

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
