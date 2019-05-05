
          <!-- main  -->
          <div class="m-content">
						<!-- datalist -->
						<div class="m-portlet m-portlet--mobile">
													<div class="m-portlet__head">
														<div class="m-portlet__head-caption">
															<div class="m-portlet__head-title">
																<h3 class="m-portlet__head-text">
															Print Preview
																</h3>
															</div>
														</div>


                            <!-- kk -->

                            <!-- kk -->
                            <div class="m-portlet__head-tools">
									<ul class="m-portlet__nav">
										<li class="m-portlet__nav-item">
											<a href="javascript::void(0)" id="btnPrintSample" class="btn btn-info  m-btn--custom m-btn--icon">
												<span>
													<i class="la la-print"></i>
													<span>PRINT</span>
												</span>
											</a>
										</li>
										<li class="m-portlet__nav-item"></li>

									</ul>
								</div>
							</div>




													<div class="m-portlet__body">


                          <div id="div_printme">
                           <?php foreach ($sample_data as $key => $value): ?>
                             <table class="table table-sm" style="font-size:14px;border:0px solid #ccc">
                            <tbody>
                              <tr>
                                <th width="100px"><strong>Sample ID:</strong></th>
                                <td width="200px">{{$value['sample_code']}}</td>
                                 <th><strong>Name:</strong></th>
                                 <td width="200px" >{{$value['client_name']}}</td>
                                 <th><strong>Company:</strong></th>
                                  <td>{{$value['client_company']}}</td>
                              </tr>
                               <tr>
                                <th><strong>Phone:</strong></th>
                                <td>{{$value['client_phone']}}</td>
                                 <th><strong>Address:</strong></th>
                                 <td colspan="3">{{$value['client_address']}}</td>
                              </tr>
                               <tr>
                                <th><strong>Details:</strong></th>

                                <td colspan="5">
                                   <!-- table -->
                                   <table class="table table-sm m-table m-table--head-bg-brand">
                            <thead class="thead-inverse">
                              <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Discriptions</th>

                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $i=0;
                              foreach ($value['sample_details'] as $key => $items) {
                                $i++;
                                  ?>
                                  <tr>
                                    <th>{{$i}}</th>
                                    <td>{{$items->txtItem}}</td>
                                    <td>{{$items->txtItem}}</td>
                                  </tr>
                                  <?php
                              }
                               ?>


                            </tbody>
                          </table>
                                   <!-- table -->

                                 </td>

                              </tr>

                            </tbody>
                          </table>
                          <hr>
                           <?php endforeach; ?>


                          </div>


					                </div>
                    </div>
                  </div>
          <!-- main  -->
