
<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">RAW Data</h3>
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="/" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">raw data</span>
										</a>
									</li>

									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
											<span class="m-nav__link-text">Raw data list</span>
									</li>
								</ul>
							</div>
						</div>
					</div>

          <!-- main  -->
          <div class="m-content">

						<!-- datalist -->
						<div class="m-portlet m-portlet--mobile">
													<div class="m-portlet__head">
														<div class="m-portlet__head-caption">
															<div class="m-portlet__head-title">
																<h3 class="m-portlet__head-text">
																	Raw Client Data
																</h3>
															</div>
														</div>
														<div class="m-portlet__head-tools">
															<ul class="m-portlet__nav">
																<!-- <li class="m-portlet__nav-item">
																	<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon">
																		<span>
																			<i class="la la-cart-plus"></i>
																			<span>Add New </span>
																		</span>
																		
																	</a>
																</li> -->
																<li class="m-portlet__nav-item">
																	<a href="javascript:void(0)" id="btnImportSample"  class="btn btn-accent m-btn m-btn--custom m-btn--icon">
																		<span>
																			<i class="la la-cart-plus"></i>
																			<span>Import Data </span>
																		</span>
																	</a>
																</li>

																<li class="m-portlet__nav-item">
																	<a href="{{route('export_sample')}}"  class="btn btn-accent m-btn m-btn--custom m-btn--icon">
																		<span>
																			<i class="la la-cart-plus"></i>
																			<span>Download Sample </span>
																		</span>
																	</a>
																</li>


															</ul>
														</div>
													</div>
													<div class="m-portlet__body">
														<!--begin::Form-->
																<form class="m-form m-form--fit m-form--label-align-right ajfileupload" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
																	<div class="m-portlet__body">
																	@csrf
																		<div class="form-group m-form__group">
																			<label for="exampleInputEmail1">File Browser</label>
																			<div></div>
																			<div class="custom-file">
																				<input type="file" name="file" class="custom-file-input" id="customFile">
																				<label class="custom-file-label" for="customFile">Choose file</label>
																			</div>
																		</div>
																	</div>
																	<div class="m-portlet__foot m-portlet__foot--fit">
																		<div class="m-form__actions">
																			<button type="submit" class="btn btn-primary">Upload Now</button>
																			<button type="button" id="btnImportCancel" class="btn btn-secondary">Cancel</button>
																		</div>
																	</div>
																</form>

																<!--end::Form-->

																<!--begin::Form-->
									<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
										<div class="m-portlet__body">
											<div class="form-group m-form__group row">
												<label class="col-lg-1 col-form-label">RecordID:</label>
												<div class="col-lg-3">
													<input type="text" class="form-control m-input" placeholder="" data-col-index="0">

												</div>
												<label class="col-lg-1 col-form-label">Product:</label>
												<div class="col-lg-3">
													<input type="text" class="form-control m-input" placeholder="" data-col-index="1">

												</div>

												<div class="col-lg-3">


														<button class="btn btn-brand m-btn m-btn--icon" id="m_search">
															<span>
																<i class="la la-search"></i>
																<span>Search</span>
															</span>
														</button>

												</div>
											</div>

										</div>

									</form>

									<!--end::Form-->




														<!--begin: Datatable -->
														<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
															<thead>
																<tr>
																	<th>#</th>
																	<th>Product</th>
																	<th>Company</th>
																	<th>Contact</th>
																	<th>Location</th>
																	<th>Application</th>
																	<th>Status</th>
																	<th>Actions</th>
																</tr>
															</thead>
															
														</table>
													</div>
												</div>

						<!-- datalist -->

					</div>
          <!-- main  -->
