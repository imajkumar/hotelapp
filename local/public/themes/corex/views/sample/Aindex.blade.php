
<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">Samples Data</h3>
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="/" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">sample</span>
										</a>
									</li>

									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
											<span class="m-nav__link-text">Sample list</span>
									</li>
								</ul>
							</div>
						</div>
					</div>

          <!-- main  -->
          <div class="m-content">
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Samples<small>Get the information of sample</small>
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<!--begin: Search Form -->
								<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
									<div class="row align-items-center">
										<div class="col-xl-8 order-2 order-xl-1">
											<div class="form-group m-form__group row align-items-center">
												<div class="col-md-4">
													<div class="m-form__group m-form__group--inline">
														<div class="m-form__label">
															<label>Status:</label>
														</div>
														<div class="m-form__control">
															<select class="form-control" id="m_form_status_sample">
																<option value="">All</option>
																<option value="1">NEW</option>
																<option value="2">SENT</option>
																<option value="3">RECEIVED</option>
																<option value="4">FEEDBACK</option>
															</select>
														</div>

													</div>
													<div class="d-md-none m--margin-bottom-10"></div>
												</div>
												<div class="col-md-4">
													<div class="m-form__group m-form__group--inline">
														<div class="m-form__label">
															<label>Sales</label>
															<?php
															$sales=AyraHelp::getSalesAgent();
															?>
														</div>
														<div class="m-form__control">
															<select class="form-control" id="m_form_sales">
																<option value="">All</option>
																@foreach ($sales as $user)
																	<option value="{{$user->id}}">{{strtoupper($user->name)}}</option>
																@endforeach
															</select>
														</div>
													</div>
													<div class="d-md-none m--margin-bottom-10"></div>
												</div>
												<div class="col-md-4">
													<div class="m-input-icon m-input-icon--left">
														<input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
														<span class="m-input-icon__icon m-input-icon__icon--left">
															<span><i class="la la-search"></i></span>
														</span>
													</div>
												</div>
											</div>
										</div>
											@if (Auth()->user()->hasAnyPermission(['Create Sample']))
										<div class="col-xl-2 order-1 order-xl-2 m--align-right">
											<a href="{{route('sample.create')}}" id="btnAddClient_withModal#"  class="btn btn-primary m-btn m-btn--custom m-btn--icon  ">
												<span>
													<i class="la la-cart-plus"></i>
													<span>New Sample</span>
												</span>
											</a>
											<div class="m-separator m-separator--dashed d-xl-none"></div>
										</div>
										@endif


										<div class="col-xl-2 order-1 order-xl-2 m--align-right" style="display:none">
											<a href="javascript:void(0)" class="btn btn-primary m-btn m-btn--custom m-btn--icon  ">
												<span>
													<i class="la la-cart-plus"></i>
													<span>New Client</span>
												</span>
											</a>
											<div class="m-separator m-separator--dashed d-xl-none"></div>
										</div>

									</div>
								</div>

								<!--end: Search Form -->

								<!--begin: Datatable -->
								<div class="ajax_data_samples" id="ajax_data"></div>

								<!--end: Datatable -->
							</div>
						</div>
					</div>
          <!-- main  -->

<!-- All modal -->
<!--begin::Modal::Add Client-->
<!--begin::Modal-->
						<div class="modal fade" id="m_select2_modal" role="dialog" aria-labelledby="" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="">Add Client</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true" class="la la-remove"></span>
										</button>
									</div>
									<form class="m-form m-form--fit m-form--label-align-right" id="m_form_2">
											@csrf
										<div class="modal-body">
											<div class="form-group m-form__group row">
												<div class="col-lg-4 col-md-9 col-sm-12">
													<div class="form-group m-form__group row">
														<label>Company </label>
															<input type="text" class="form-control m-input" name="company" placeholder="Enter company">
															<span class="m-form__help"></span>
													</div>
												</div>

												<div class="col-lg-4 col-md-9 col-sm-12">
													<div class="form-group m-form__group row">
														<label>Brand</label>
															<input type="text" class="form-control m-input" name="brand" placeholder="Enter brand name">
															<span class="m-form__help"></span>
													</div>
												</div>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<div class="form-group m-form__group row">
														<label>City</label>
														<select class="form-control m-select2 client_city" id="m_select2_1_modal" name="city">
															<option value="Search City">-SELECT-</option>
														</select>
															<span class="m-form__help"></span>
													</div>
												</div>
											</div>

											<div class="form-group m-form__group row">
												<div class="col-lg-4">
													<div class="form-group m-form__group row">
														<label>Country </label>
														<select class="form-control m-input" name="country" id="namecountry">

														</select>
														<span class="m-form__help"></span>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group m-form__group row">
														<label>Address</label>
															<input type="text" class="form-control m-input" name="address" placeholder="Enter Address">
															<span class="m-form__help"></span>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group m-form__group row">
														<label>GSTTIN</label>
															<input type="text" class="form-control m-input" name="gst" placeholder="Enter GSTTIN">
															<span class="m-form__help"></span>
													</div>
												</div>
											</div>
											<div class="m-divider">
												<span></span>
												<span>Primary Contact</span>
												<span></span>
											</div>

											<div class="form-group m-form__group row">
												<div class="col-lg-4">
													<div class="form-group m-form__group row">
														<label>Name *</label>
															<input type="text" class="form-control m-input" name="name" placeholder="Enter name">
															<span class="m-form__help"></span>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group m-form__group row">
														<label>Email</label>
															<input type="text" class="form-control m-input" name="email" placeholder="Enter your email">
															<span class="m-form__help"></span>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group m-form__group row">
														<label>Phone *</label>
															<input type="text" class="form-control m-input" name="phone" placeholder="Enter your phone">
															<span class="m-form__help"></span>
													</div>
												</div>
											</div>






										</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions m-form__actions">
												<div class="row">
													<div class="col-lg-9 ml-lg-auto">
														<button type="submit" class="btn btn-primary">Submit</button>
														<button type="reset" class="btn btn-secondary">Reset</button>
														</div>
												</div>
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-brand m-btn" data-dismiss="modal">Close</button>

										</div>
									</form>
								</div>
							</div>
						</div>

						<!--end::Modal-->


						<!--start::Modal::Edit Client-->
						<!--begin::Modal-->
												<div class="modal fade" id="m_modal_edit_client" role="dialog" aria-labelledby="" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="">Add Client</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true" class="la la-remove"></span>
																</button>
															</div>
															<form class="m-form m-form--fit m-form--label-align-right" id="m_form_222">
																	@csrf
																	<input type="hidden" name="rowid" id="edit_rowid">
																<div class="modal-body">
																	<div class="form-group m-form__group row">
																		<div class="col-lg-4 col-md-9 col-sm-12">
																			<div class="form-group m-form__group row">
																				<label>Company </label>
																					<input type="text" class="form-control m-input" name="company" id="company" placeholder="Enter company">
																					<span class="m-form__help"></span>
																			</div>
																		</div>

																		<div class="col-lg-4 col-md-9 col-sm-12">
																			<div class="form-group m-form__group row">
																				<label>Brand</label>
																					<input type="text" class="form-control m-input" name="brand" id="brand" placeholder="Enter brand name">
																					<span class="m-form__help"></span>
																			</div>
																		</div>
																		<div class="col-lg-4 col-md-9 col-sm-12">
																			<div class="form-group m-form__group row">
																				<label>City</label>
																				<select class="form-control m-select2 client_city" id="m_select2_1_modal_edit" name="city">
																					<option value="Search City">-SELECT-</option>
																				</select>
																					<span class="m-form__help"></span>
																			</div>
																		</div>
																	</div>

																	<div class="form-group m-form__group row">
																		<div class="col-lg-4">
																			<div class="form-group m-form__group row">
																				<label>Country </label>
																				<select class="form-control m-input" name="country" id="namecountry">

																				</select>
																				<span class="m-form__help"></span>
																			</div>
																		</div>
																		<div class="col-lg-4">
																			<div class="form-group m-form__group row">
																				<label>Address</label>
																					<input type="text" class="form-control m-input" name="address" id="address" placeholder="Enter Address">
																					<span class="m-form__help"></span>
																			</div>
																		</div>
																		<div class="col-lg-4">
																			<div class="form-group m-form__group row">
																				<label>GSTTIN</label>
																					<input type="text" class="form-control m-input" name="gst" id="gst" placeholder="Enter GSTTIN">
																					<span class="m-form__help"></span>
																			</div>
																		</div>
																	</div>
																	<div class="m-divider">
																		<span></span>
																		<span>Primary Contact</span>
																		<span></span>
																	</div>

																	<div class="form-group m-form__group row">
																		<div class="col-lg-4">
																			<div class="form-group m-form__group row">
																				<label>Name *</label>
																					<input type="text" class="form-control m-input" name="name" id="name" placeholder="Enter name">
																					<span class="m-form__help"></span>
																			</div>
																		</div>
																		<div class="col-lg-4">
																			<div class="form-group m-form__group row">
																				<label>Email</label>
																					<input type="text" class="form-control m-input" name="email" id="email" placeholder="Enter your email">
																					<span class="m-form__help"></span>
																			</div>
																		</div>
																		<div class="col-lg-4">
																			<div class="form-group m-form__group row">
																				<label>Phone *</label>
																					<input type="text" class="form-control m-input" name="phone" id="phone" placeholder="Enter your phone">
																					<span class="m-form__help"></span>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="m-portlet__foot m-portlet__foot--fit">
																	<div class="m-form__actions m-form__actions">
																		<div class="row">
																			<div class="col-lg-9 ml-lg-auto">
																				<button type="submit" class="btn btn-primary">Submit</button>
																				<button type="reset" class="btn btn-secondary">Reset</button>
																				</div>
																		</div>
																	</div>
																</div>

																<div class="modal-footer">
																	<button type="button" class="btn btn-brand m-btn" data-dismiss="modal">Close</button>

																</div>
															</form>
														</div>
													</div>
												</div>

												<!--end::Modal-->
						<!--end::Modal::Edit Client-->

						<!--start::Modal::VIEW Client-->
						<!--begin::Modal-->
									<div class="modal fade" id="m_modal_views_client" tabindex="-1" role="dialog" aria-labelledby="m_modal_views_client" aria-hidden="true" method="post" action="#">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">View Client's Details</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<!--begin::Portlet-->


													<!--begin::Form-->
											<div class="form-group m-form__group row">
												<div class="col-lg-6">
													<label class="mytextaj"><strong>Client ID:</strong></label>
											   	<span class="m-form__control-static" id="vm_userid"></span>
												</div>
												<div class="col-lg-6">
													<label class="mytextaj"><strong>Name:</strong></label>
											   	<span class="m-form__control-static" id="vm_name"></span>
												</div>

											</div>

											<div class="form-group m-form__group row">
												<div class="col-lg-6">
													<label class="mytextaj"><strong>Phone:</strong></label>
											   	<span class="m-form__control-static" id="vm_phone"></span>
												</div>
												<div class="col-lg-6">
													<label class="mytextaj"><strong>Email:</strong></label>
											   	<span class="m-form__control-static" id="vm_email"></span>
												</div>

											</div>
											<div class="form-group m-form__group row">
											<div class="col-lg-6">
												<label class="mytextaj"><strong>company:</strong></label>
												<span class="m-form__control-static" id="vm_company"></span>
											</div>
											<div class="col-lg-6">
												<label class="mytextaj"><strong>Brand Name:</strong></label>
												<span class="m-form__control-static" id="vm_brand"></span>
											</div>
										</div>
											<div class="form-group m-form__group row">
												<div class="col-lg-6">
													<label class="mytextaj"><strong>Address:</strong></label>
											   	<span class="m-form__control-static" id="vm_address"></span>
												</div>
												<div class="col-lg-6">
													<label class="mytextaj"><strong>GSTTIN:</strong></label>
											   	<span class="m-form__control-static" id="vm_gst"></span>
												</div>
											</div>
											<div class="form-group m-form__group row">
											<div class="col-lg-12">
												<label class="mytextaj">Remarks:</label>
												<span class="m-form__control-static" id="vm_remarks"></span>
											</div>
										</div>
													<!--end::Portlet-->
												</div>
											</div>
										</div>
									</div>
									<!--end::Modal-->

						<!--end::Modal::view Client-->



						{{-- m_view_sample_details model --}}
						<!--begin::Modal-->
						<div class="modal fade" id="m_view_sample_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Sample Information</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<table class="table">
													<tbody>
														<tr>
															<th>Created On:</th>
															<td id="v_created_on"></td>
															<td>Client ID:</td>
															<td id="user_id"></td>
														</tr>
														<tr>
															<th>Company:</th>
															<td id="v_companay"></td>
															<td>Contact Person:</td>
															<td id="v_name"></td>
														</tr>
														<tr>
															<th>Address:</th>
															<td id="v_address"></td>
															<td>Phone:</td>
															<td id="v_phone"></td>
														</tr>
														<tr>
															<th>Sample ID:</th>
															<td id="sid_code"></td>
															<td>Sales Agent:</td>
															<td id="s_name"></td>
														</tr>
														<tr>
															<th>Sample Status:</th>
															<td id="v_status"></td>
															<td>Sent Date:</td>
															<td id="sent_on"></td>
														</tr>
														<tr>
															<th>Sample Details:</th>
															<td id="sample_details" colspan="3"></td>

														</tr>
														<tr>
															<th>Remarks:</th>
															<td id="remarks" colspan="2"></td>
														</tr>

													</tbody>
												</table>

												<div class="courier_info_view ">
													<table class="table">
																<tbody>
																	<tr>
																		<th>Courier:</th>
																		<td id="courier_details"></td>
																		<td>Tracking ID:</td>
																		<td id="v_track_id"></td>
																	</tr>

																	<tr>
																		<td>Courier Remarks:</td>
																		<td id="v_remarks" colspan="3"></td>
																	</tr>

																</tbody>
															</table>

												</div>
												<div class="courier_info_entry" style="display:none" >
													<!--begin::Form-->
													<form class="m-form m-form--fit ">

												<div class="form-group m-form__group row">
													<label class="col-lg-2 col-form-label">Courier:</label>
													<div class="col-lg-4">
														<select class="form-control m-input m-input--square courier_details" id="courier_id" name="courier_details">
															<option value="" >-Select Courier-</option>
																	<?php
																		$cour_ar=AyraHelp::getCourier();
																	 foreach ($cour_ar as $key => $value) {

																			?>
																			<option  value="<?php echo $value->id?>"><?php echo $value->courier_name?> ( <?php echo $value->courier_address?> )</option>

																			<?php

																	}
																	?>
														</select>

													</div>
													<label class="col-lg-2 col-form-label">Tracking ID:</label>
													<div class="col-lg-4">
															<input class="form-control m-input" name="track_id" id="track_id" type="text" placeholder="Enter Tracking id">

													</div>
												</div>
												<div class="form-group m-form__group row">
													<label class="col-lg-2 col-form-label">Date:</label>
													<div class="col-lg-4 col-md-9 col-sm-12">
											<div class="input-group date">
												<input type="text" class="form-control m-input" readonly  id="m_datepicker_3" />
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
											<span class="m-form__help"></span>
										</div>

													<label class="col-lg-2 col-form-label">Courier Remarks:</label>
													<div class="col-lg-4">
														<textarea class="form-control m-input m-input--air" id="c_remarks" name="remarks" rows="2"></textarea>

													</div>
												</div>
												<input type="hidden" name="v_s_id" id="v_s_id">


											<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
												<div class="m-form__actions m-form__actions--solid">
													<div class="row">
														<div class="col-lg-5"></div>
														<div class="col-lg-7">
															<a href="javascript:void(0)" id="btnSaveSentInfomration" class="btn btn-accent m-btn m-btn--custom m-btn--icon" data-wizard-action="next">
															<span>
															<span>Submit Now</span>&nbsp;&nbsp;
															<i class="la la-arrow-right"></i>
															</span>
															</a>
														</div>
													</div>
												</div>
											</div>
										</form>

										<!--end::Form-->



												</div>






									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

									</div>
								</div>
							</div>
						</div>

						<!--end::Modal-->


						{{-- m_view_sample_details modal --}}

						m_modal_edit_samples


<!-- All modal -->
