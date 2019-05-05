

          <!-- main  -->
          <div class="m-content">

						<!-- datalist -->
						<div class="m-portlet m-portlet--mobile">
													<div class="m-portlet__head">
														<div class="m-portlet__head-caption">
															<div class="m-portlet__head-title">
																<h3 class="m-portlet__head-text">
																	Client Notes
																</h3>
															</div>
														</div>
														<div class="m-portlet__head-tools">
															<ul class="m-portlet__nav">

															</ul>
														</div>
													</div>
													<div class="m-portlet__body">

                            <!--begin::Form-->
                  <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                    <div class="m-portlet__body">
                      <div class="form-group m-form__group row">
                        <div class="col-lg-2">
                          <label>Client Name:</label>
                          <input type="text" class="form-control m-input" placeholder="Enter " data-col-index="1">
                          <span class="m-form__help"></span>
                        </div>


                        <div class="col-lg-4">
                          <label>.</label><br>
                          <button type="button" class="btn btn-primary" id="m_search">Search</button>
                        </div>
                      </div>

                    </div>

                  </form>

                  <!--end::Form-->


														<!--begin: Datatable -->
														<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_NotesList">
															<thead>
																<tr>
																	<th>ID</th>
																	<th>Name</th>
																	<th>Company</th>
																	<th>Message</th>
																	<th>Created By</th>
																	<th>Created On</th>

																	<th>Actions</th>
																</tr>
															</thead>
															<tfoot>
																<tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Company</th>
                                  <th>Message</th>
                                  <th>Created By</th>
                                  <th>Created On</th>                                
                                  <th>Actions</th>
																</tr>
															</tfoot>
														</table>

													</div>
												</div>

						<!-- datalist -->

					</div>
          <!-- main  -->
