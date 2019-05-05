

          <!-- main  -->
          <div class="m-content">

						<!-- datalist -->
						<div class="m-portlet m-portlet--mobile">
													<div class="m-portlet__head">
														<div class="m-portlet__head-caption">
															<div class="m-portlet__head-title">
																<h3 class="m-portlet__head-text">
																	Client List
																</h3>
															</div>
														</div>
														<div class="m-portlet__head-tools">
															<ul class="m-portlet__nav">
																<li class="m-portlet__nav-item">
																	<a href="{{route('client.create')}}" class="btn btn-primary m-btn m-btn--custom m-btn--icon">
																		<span>
																			<i class="la la-plus"></i>
																			<span>Add New </span>
																		</span>
																	</a>
																</li>
															</ul>
														</div>
													</div>
													<div class="m-portlet__body">

																<!--begin::Form-->
									<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
										<div class="m-portlet__body">
											<div class="form-group m-form__group row">
												<label class="col-lg-1 col-form-label">RecordID:</label>
												<div class="col-lg-3">
													<input type="text" class="form-control m-input" placeholder="" data-col-index="0">

												</div>
												<label class="col-lg-1 col-form-label">Contact:</label>
												<div class="col-lg-3">
													<input type="text" class="form-control m-input" placeholder="" data-col-index="4">

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
														<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_clientsList">
															<thead>
																<tr>
																	<th>ID</th>
																	<th>Name</th>
																	<th>Email</th>
																	<th>Phone</th>
																	<th>Created on</th>
																	<th>Created by</th>
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
