

          <!-- main  -->
          <div class="m-content">

						<!-- datalist -->
						<div class="m-portlet m-portlet--mobile">
													<div class="m-portlet__head">
														<div class="m-portlet__head-caption">
															<div class="m-portlet__head-title">
																<h3 class="m-portlet__head-text">
																	Edit Hotel
																</h3>
															</div>
														</div>
														<div class="m-portlet__head-tools">
															<ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                  <a href="{{route('hotel.index')}}" class="btn btn-secondary m-btn m-btn--custom m-btn--icon">
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
                          General</a>
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
                        <i class="flaticon-map-location"></i>
                      </span>
                      <h3 class="m-portlet__head-text">
                      Client Information
                      </h3>
                    </div>
                  </div>
                  <div class="m-portlet__head-tools">

                  </div>
                </div>
                <div class="m-portlet__body">
                   <!-- form  -->
                   <!--begin::Form-->
                                     <form class="m-form m-form--state m-form--fit m-form--label-align-right" id="m_form_add_client" method="post" action="{{ route('hotel.update', $data->id) }}">
                                       @csrf
                                          @method('PATCH')
                                          <div class="m-portlet__body">
                                            <div class="m-form__section m-form__section--first">
                                              <div class="form-group m-form__group row">
                                                <div class="col-lg-4 m-form__group-sub">
                                                  <label class="form-control-label">* Name:</label>
                                                    <input type="text" class="form-control m-input" value="{{$data->name}}" name="name" placeholder="Enter Company">
                                                </div>
                                                <div class="col-lg-4 m-form__group-sub">
                                                  <label class="form-control-label">Type:</label>
                                                  <select class="form-control m-input" id="exampleSelect1" name="type">
                                                   <option  value="3 STAR">3 STAR</option>
                                                   <option  value="2 STAR">2 STAR</option>
                                                 </select>
                                                </div>
                                                <div class="col-lg-4 m-form__group-sub">
                                                  <label class="form-control-label">* Category:</label>
                                                  <select class="form-control m-input" id="exampleSelect1" name="category">
                                                   <option  value="DELUXE">DELUXE</option>
                                                 </select>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- name email phone -->
                                            <div class="m-form__section m-form__section--first">
                                              <div class="form-group m-form__group row">
                                                <div class="col-lg-4 m-form__group-sub">
                                                  <label class="form-control-label">* Another Name:</label>
                                                    <input type="text" value="{{$data->alternate_name}}" class="form-control m-input" name="a_name" placeholder="Enter Other Name" >
                                                </div>
                                                <div class="col-lg-4 m-form__group-sub">
                                                  <label class="form-control-label">*Image link:</label>
                                                  <input type="text" value="{{$data->images}}" class="form-control m-input" name="img_link" placeholder="Enter link" >
                                                </div>

                                                <div class="col-lg-4 m-form__group-sub">
                                                  <label class="form-control-label">location:</label>
                                                  <select class="form-control m-input" id="exampleSelect1" name="location">
                                                    @foreach (AyraHelp::getLocation() as $source)
                                                   <option  value="{{$source->id}}">{{$source->display_name}}</option>
                                                    @endforeach


                                                </select>

                                                </div>
                                              </div>
                                            </div>
                                            <!-- name email phone -->
                                            <!-- <address location source>

                                            </address> email phone -->
                                            <div class="m-form__section m-form__section--first">
                                              <div class="form-group m-form__group row">
                                                <div class="col-lg-4 m-form__group-sub">
                                                  <label class="form-control-label"> Address:</label>
                                                    <input type="text" value="{{$data->hotel_address}}" class="form-control m-input" name="address" placeholder="Enter Address" >
                                                </div>
                                                <div class="col-lg-4 m-form__group-sub">
                                                  <label class="form-control-label">city:</label>
                                                  <input type="text"  value="{{$data->city}}" class="form-control m-input" name="city" placeholder="Enter City" >
                                                </div>

                                              </div>
                                            </div>
                                         <!-- <address location source-->
                                         <!-- website and remarks -->


                                         <!-- website and remarks -->



                                          </div>
                                       <div class="m-portlet__foot m-portlet__foot--fit">
                                         <div class="m-form__actions m-form__actions">
                                           <div class="row">
                                             <div class="col-lg-12">
                                               <button type="submit" data-wizard-action="submit" class="btn btn-warning">Save  Changes</button>
                                               <button type="reset" class="btn btn-secondary">Reset</button>
                                             </div>
                                           </div>
                                         </div>
                                       </div>
                                     </form>

                                     <!--end::Form-->

                   <!-- form  -->

                </div>
              </div>

              <!--end::Portlet-->










											             <!-- general -->

											</div>

											<div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
										              under construction
											</div>

										</div>
                    <!-- end tab -->
                  </div>
                </div>


					</div>
          <!-- main  -->
