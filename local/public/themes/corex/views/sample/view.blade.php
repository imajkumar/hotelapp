

          <!-- main  -->
          <div class="m-content">

						<!-- datalist -->
						<div class="m-portlet m-portlet--mobile">
													<div class="m-portlet__head">
														<div class="m-portlet__head-caption">
															<div class="m-portlet__head-title">
																<h3 class="m-portlet__head-text">
																	Sample Information
																</h3>
															</div>
														</div>
														<div class="m-portlet__head-tools">
															<ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                  <a href="{{route('sample.index')}}" class="btn btn-secondary m-btn m-btn--custom m-btn--icon">
                                    <span>
                                  	<i class="la la-arrow-left"></i>
                                      <span>BACK </span>
                                    </span>
                                  </a>
                                </li>

															</ul>
														</div>
													</div>
													<div class="m-portlet__body">
                      <ul class="nav nav-pills" role="tablist">
											<li class="nav-item ">
												<a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1">
                          <i class="la la-gear"></i>
                          Sample</a>
											</li>
											<li class="nav-item">
												<a class="nav-link " data-toggle="tab" href="#m_tabs_3_3">
                          <i class="flaticon-file-2"></i>
                          Orders
                        </a>
											</li>
										</ul>

                    <div class="tab-content">
											<div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">


                        <!--begin::Portlet-->
								<div class="m-portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon">
													<i class="la la-thumb-tack m--font-primary"></i>
												</span>
												<h3 class="m-portlet__head-text m--font-primary">
													Sample Information
												</h3>
											</div>
										</div>

									</div>
									<div class="m-portlet__body">
                    <table class="table m-table">
                    <thead>

                    </thead>
                    <tbody>
                      <tr>
                        <th><strong>Sample ID</strong></th>
                        <td colspan="3">{{$sample_data->sample_code}}</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <th><strong>Company</strong></th>
                        <td colspan="3">{{$client_data->company}}</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <th><strong>Brand</strong></th>
                        <td colspan="3">{{$client_data->brand}}</td>
                        <td></td>
                        <td></td>
                      </tr>

                      <tr>
                        <th><strong>Name</strong></th>
                        <td colspan="3">{{$client_data->firstname}}</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <th><strong>Samples</strong></th>
                        <td colspan="3">
                          <table class="table table-sm m-table m-table--head-bg-metal">
                          <thead class="thead-inverse">
                            <tr>
                              <th style="color:#000" >#</th>
                              <th style="color:#000">Item</th>
                              <th style="color:#000" >Discription</th>

                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          //echo "<pre>";
                        //  print_r($sample_data);
                        //  print_r($sample_data->sample_details);
                          $sample_items=json_decode($sample_data->sample_details);

                          foreach ($sample_items as $key => $value) {
                            //print_r($value->txtItem);
                            //print_r($value->txtDiscrption);
                            ?>
                            <tr>
                              <th scope="row">1</th>
                              <td>{{$value->txtItem}}</td>
                              <td>{{$value->txtDiscrption}}</td>

                            </tr>
                            <?php
                          }


                          ?>
													</tbody>
												</table>

                        </td>
                        <td></td>
                        <td></td>
                      </tr>

                      <tr>
                        <th><strong>Shipping Address</strong></th>
                        <td colspan="3">{{$sample_data->ship_address}}</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <th><strong>Location</strong></th>
                        <td colspan="3">{{$sample_data->location}}</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <th><strong>Status</strong></th>
                        <td colspan="3">

                          @switch($sample_data->status)
                                  @case(1)
                                    <span class="m-badge m-badge--brand m-badge--wide m-badge--rounded">NEW</span>
                                  @break
                                  @case(2)
                                    <span class="m-badge m-badge--metal m-badge--wide m-badge--rounded">SENT</span>
                                      @break
                                  @case(3)
                                  <span class="m-badge m-badge--primary m-badge--wide m-badge--rounded">RECIEVED</span>
                                    @break
                                  @case(4)
                                  <span class="m-badge m-badge--success m-badge--wide m-badge--rounded">FEEDBACK</span>

                                  @break



                              @endswitch
                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <th><strong>Courier</strong></th>
                        <td colspan="3">
                          <table class="table table-sm m-table m-table--head-bg-metal">
  													<thead class="thead-inverse">
  														<tr>

  															<th  style="color:#000">Courier Name</th>
  															<th  style="color:#000">Tracking ID</th>
  															<th style="color:#000" >Sent on</th>
  														</tr>
  													</thead>
  													<tbody>
  														<tr>

  															<td>
                                  <?php
                                  if($sample_data->courier_id!=NULL ){
                                    ?>
                                    {{AyraHelp::getCouriers($sample_data->courier_id)->courier_name}}
                                    <?php
                                  }
                                   ?>


                                </td>
  														  <td>

                                  <?php
                                  if($sample_data->track_id!=NULL ){
                                    ?>
                                    {{$sample_data->track_id}}
                                    <?php
                                  }
                                   ?>
                                </td>
  														  <td>
                                  <?php
                                  if($sample_data->sent_on!=NULL ){
                                    ?>
                                    {{date('j M Y', strtotime($sample_data->sent_on))}}
                                    <?php
                                  }
                                   ?>

                                </td>
  														</tr>

  													</tbody>
  												</table>
                        </td>
                        <td></td>
                        <td></td>
                      </tr>

                    </tbody>
                  </table>





									</div>
								</div>

								<!--end::Portlet-->


											</div>

						<div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
            <!--begin::Portlet-->
              <div class="m-portlet" style="display:none">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <span class="m-portlet__head-icon">
                        <i class="la la-thumb-tack m--font-success"></i>
                      </span>
                      <h3 class="m-portlet__head-text m--font-success">
                      Notes
                      </h3>
                    </div>
                  </div>
                  <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                      <li class="m-portlet__nav-item">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#m_modal_6" class="btn btn-primary btn-sm m-btn  m-btn m-btn--icon">
															<span>
																<i class="flaticon-file-2"></i>
																<span>Add New</span>
															</span>
														</a>

                      </li>


                    </ul>
                  </div>
                </div>
                <div class="m-portlet__body">

                  <!--begin: Datatable -->

								<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_clientNotesList">
									<thead>
										<tr>
											<th>ID</th>
											<th>Message</th>
											<th>Created By</th>
											<th>Created On</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>




									</tbody>
								</table>


						<!-- END EXAMPLE TABLE PORTLET-->




                </div>
              </div>

              <!--end::Portlet-->

              <!-- m_modal_6 -->
              <!-- Modal -->
						<div class="modal fade" id="m_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Client Notes</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id" value="{{$client_data->id}}">
                    <div class="form-group">
												<label for="message-text" class="form-control-label">*Message:</label>
												<textarea class="form-control" id="txtNotes"  name="txtNotes"></textarea>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" id="btnClientNotes" class="btn btn-primary">Save</button>
									</div>
								</div>
							</div>
						</div>

              <!-- m_modal_6 -->

											</div>

										</div>
                    <!-- end tab -->
                  </div>
                </div>

					</div>
          <!-- main  -->
