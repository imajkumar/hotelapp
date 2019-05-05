

          <!-- main  -->
          <div class="m-content">

						<!-- datalist -->
						<div class="m-portlet m-portlet--mobile">
													<div class="m-portlet__head">
														<div class="m-portlet__head-caption">
															<div class="m-portlet__head-title">
																<h3 class="m-portlet__head-text">
																	Add New Client
																</h3>
															</div>
														</div>
														<div class="m-portlet__head-tools">
															<ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                  <a href="{{route('client.index')}}" class="btn btn-secondary m-btn m-btn--custom m-btn--icon">
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
                                     <form class="m-form m-form--state m-form--fit m-form--label-align-right" id="m_form_add_client" method="post" action="{{ route('client.store')}}">
                                       @csrf
                                       <div class="m-portlet__body">
                                         <div class="m-form__section m-form__section--first">
                                           <div class="form-group m-form__group row">
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">* Name:</label>
                                                 <input type="text" class="form-control m-input" name="name" placeholder="Enter Name">
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">Phone:</label>
                                               <input type="text" class="form-control m-input" name="phone" placeholder="Enter phone">
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">*Email:</label>
                                               <input type="email" class="form-control m-input" name="email" placeholder="Enter Email" >
                                             </div>

                                           </div>
                                         </div>
                                         <!-- name email phone -->
                                         <div class="m-form__section m-form__section--first">
                                           <div class="form-group m-form__group row">
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label"> Password:</label>
                                               <input type="password" class="form-control m-input" name="password" placeholder="Enter Password">
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">* Property Type:</label>
                                                 <input type="text" class="form-control m-input" name="property_type" placeholder="Enter Property Type" >
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">* City:</label>
                                               <input type="text" class="form-control m-input" name="city" placeholder="Enter City" >
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
                                                 <input type="text" class="form-control m-input" name="address" placeholder="Enter Address" >
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">Location:</label>
                                               <input type="text" class="form-control m-input" name="location" placeholder="Enter Location" >
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">


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
                                               <button type="submit" data-wizard-action="submit" class="btn btn-primary">Save</button>
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



										</div>
                    <!-- end tab -->
                  </div>
                </div>


					</div>
          <!-- main  -->
