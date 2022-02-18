<!--
# @Author: Codeals
# @Date:   20-06-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 07-12-2019
# @Copyright: Codeals
-->

@extends('layouts.app')

@section('content')

<!-- begin:: Subheader -->


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

              <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                  <div class="kt-container ">
                      <div class="kt-subheader__main">
												<h3 class="kt-subheader__title">
													Editar Producto </h3>
												<span class="kt-subheader__separator kt-hidden"></span>
												<div class="kt-subheader__breadcrumbs">
													<span class="kt-subheader__breadcrumbs-separator"></span>
													<a href="{{ route('admin.products.index') }}" class="kt-subheader__breadcrumbs-link">
														Listar Productos </a>
													<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
												</div>
											</div>

                  </div>
              </div>
              <div class="kt-container  kt-grid__item kt-grid__item--fluid">
                  <div class="alert alert-light alert-elevate" role="alert">
                      <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                      <div class="alert-text">
                          El producto que se edita en esta vista es un producto de tipo Admin con todos los accesos y permisos. <a class="kt-link kt-font-bold" href="https://codeals.es/" target="_blank">here</a>.
                      </div>
                  </div>
                  <div class="kt-portlet kt-portlet--mobile">
                      <div class="kt-portlet__head kt-portlet__head--lg">
                          <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                  <i class="kt-font-brand flaticon2-bell"></i>
                              </span>
                              <h3 class="kt-portlet__head-title">
                                  Modificar Producto
                              </h3>
                          </div>

                      </div>
                      <div class="kt-portlet__body">

							<!--begin::Portlet-->
							<div class="row">

								<div class="col-lg-12">


									<div class="kt-portlet">
										<div class="row">

										</div>

										<div class="row">

											<div class="col-lg-3">

											</div>

											<div class="col-lg-6">

												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">
															Editar Producto
														</h3>
													</div>
												</div>
												<!--begin::Form-->
												<form class="kt-form kt-form--label-right"  action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="_method" value="PUT">
                			@csrf

                			<input type="hidden" name="id" value="{{$product->id}}">

											<div class="kt-portlet__body">
												<div class="form-group form-group-last">
												</div>
												<div class="form-group row">
													<label for="example-text-input" class="col-2 col-form-label">Nombre Producto</label>
													<div class="col-10">
														<input class="form-control" name="product" type="text" value="{{ $product->product }}" id="example-text-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-datetime-local-input" class="col-2 col-form-label">Categoria</label>
													<div class="col-10">
														{!! Form::select('category_id', $category, null, ['class' => 'form-control']) !!}
													</div>
												</div>
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-2">
														</div>
														<div class="col-10">
															<button type="submit" class="btn btn-success">Editar</button>
															<!-- <button type="reset" class="btn btn-secondary">Cancel</button> -->
														</div>
													</div>
												</div>
											</div>
										</form>
											</div>
											<div class="col-lg-3">

											</div>
										</div>


									</div>
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
		<script src="{{ asset('assets/js/demo2/pages/crud/forms/validation/form-controls.js') }}" type="text/javascript"></script>

		<!--end::Page Scripts -->

@endsection
