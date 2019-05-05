

          <!-- main  -->
          <div class="m-content">

						<!-- datalist -->
						<div class="m-portlet m-portlet--mobile">
													<div class="m-portlet__head">
														<div class="m-portlet__head-caption">
															<div class="m-portlet__head-title">
																<h3 class="m-portlet__head-text">
																	Edit Order
																</h3>
															</div>
														</div>
														<div class="m-portlet__head-tools">
															<ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                  <a href="{{route('orders.index')}}" class="btn btn-secondary m-btn m-btn--custom m-btn--icon">
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

											<li class="nav-item">
												<a class="nav-link " data-toggle="tab" href="#m_tabs_3_3">
                          <i class="flaticon-users-1"></i>
                          Material Planning
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
                        <i class="flaticon-map-location"></i>
                      </span>
                      <h3 class="m-portlet__head-text">
                      Order  Information
                      </h3>
                    </div>
                  </div>
                  <div class="m-portlet__head-tools">

                  </div>
                </div>
                <div class="m-portlet__body">
                   <!-- form  -->
                   <!--begin::Form-->
                                     <form class="m-form m-form--state m-form--fit m-form--label-align-right"   id="m_form_add_sample" method="post" action="{{ route('sample.update', $samples->id) }}">
                                       @csrf
																			 @method('PATCH')
                                       <div class="m-portlet__body">
                                         <div class="m-form__section m-form__section--first">
                                           <div class="form-group m-form__group row">
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">* Order ID:</label>
                                            <input type="text" class="form-control m-input" value=""  name="sample_id" placeholder="">
                                             </div>
                                             <div class="col-lg-8 m-form__group-sub">
                                               <label class="form-control-label">Select Client:</label>
																							 <select class="form-control m-select2 client_name" id="m_select2_1" name="client_id">
																								 <?php

	 																							foreach (AyraHelp::getClientByadded(Auth::user()->id) as $key => $value) {

	 																								 if($samples->client_id==$value->id){
	 																								 ?>
	 																									 <option  value="{{$value->id}}" selected>{{$value->firstname}} | {{$value->phone}}  | {{$value->email}}</option>

	 																								 <?php
	 																								 }else{
	 																									 ?>
	 																										 <option  value="{{$value->id}}" >{{$value->firstname}} | {{$value->phone}}  | {{$value->email}}</option>

	 																									 <?php

	 																								 }
	 																							}
	 																							 ?>

		 																					</select>
                                             </div>

                                           </div>
                                         </div>
                                         <div class="m-form__section m-form__section--first">
                                           <div class="form-group m-form__group row">
                                             
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">* Sample ID:</label>
                                                 <input type="text" class="form-control m-input" value=""  name="sample_id" placeholder="Enter Company">
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">Due Date:</label>
                                               <div class="input-group date">
                                                 <input type="text" class="form-control m-input" readonly  name="order_due_date" id="m_datepicker_3" />
                                                 <div class="input-group-append">
                                                   <span class="input-group-text">
                                                     <i class="la la-calendar"></i>
                                                   </span>
                                                 </div>
                                               </div>
                                             </div>


                                           </div>
                                         </div>
                                         <!-- name email phone -->
                                         <div class="m-form__section m-form__section--first">

																					 <!-- repeater -->

										 <div id="m_repeater_1">
										 <div class="form-group  m-form__group row" id="m_repeater_1">
										 <label  class="col-lg-2 col-form-label">
											 Items Details:
										 </label>
										 <div data-repeater-list="aj" class="col-lg-12">


												 <div data-repeater-item class="form-group m-form__group row align-items-center">
													 <div class="col-md-4">
														 <div class="m-form__group m-form__group--inline">
															 <div class="m-form__label">
																 <label>
																	 Item
																 </label>

															 </div>

															 <div class="m-form__control">

															 <input type="text" name="txtItem" value="" class="form-control m-input" placeholder="Item Name">
															 </div>

														 </div>
														 <div class="d-md-none m--margin-bottom-2"></div>
													 </div>
													 <div class="col-md-6">
														 <div class="m-form__group m-form__group--inline">
															 <div class="m-form__label">
																 <label class="m-label m-label--single">
																	 Description:
																 </label>
															 </div>
															 <div class="m-form__control">
																 <input type="text" name="txtDiscrption" value="" class="form-control m-input" placeholder="Description">
															 </div>
														 </div>
														 <div class="d-md-none m--margin-bottom-10"></div>
													 </div>

													 <div class="col-md-1">
														 <div data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill">
															 <span>
																 <i class="la la-trash-o"></i>
																 <span>
																	 Delete
																 </span>
															 </span>
														 </div>
													 </div>
												 </div>








										 </div>
										 </div>
										 <div class="m-form__group form-group row">
										 <label class="col-lg-2 col-form-label"></label>
										 <div class="col-lg-4">
											 <div data-repeater-create="" class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide">
												 <span>
													 <i class="la la-plus"></i>
													 <span>
														 Add
													 </span>
												 </span>
											 </div>
										 </div>
										 </div>
										 </div>
										 <!-- repeater -->
                                         </div>
                                         <!-- name email phone -->
                                         <!-- <address location source>

                                         </address> email phone -->
                                         <div class="m-form__section m-form__section--first">
                                           <div class="form-group m-form__group row">
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label"> Address:</label>
                                                 <input type="text" class="form-control m-input" id="client_address" value="" name="client_address" placeholder="Enter Address" >
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">Location:</label>
                                               <input type="text" class="form-control m-input" value=""  name="location" placeholder="Enter Location" >
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">Remarks:</label>
																							   <input type="text" class="form-control m-input" value=""  name="remarks" placeholder="Enter Remraks" >
                                             </div>
                                           </div>
                                         </div>
                                         <?php
                                         $user = auth()->user();
                                         $userRoles = $user->getRoleNames();
                                         $user_role = $userRoles[0];
                                         if($user_role=='Admin'|| $user_role=='Staff'){

                                          ?>

                                          <!-- <address location source-->
                                          <div class="m-form__section m-form__section--first">
                                            <div class="form-group m-form__group row">
                                              <div class="col-lg-4 m-form__group-sub">
                                                <label class="form-control-label"> Courier:</label>


                                                <select class="form-control m-input m-input--air" id="3" name="courier_id">
                                                  <?php
                                                  foreach (AyraHelp::getCourier() as $key => $cour) {
                                                    if( $samples->courier_id==$cour->id){
                                                      ?>

                                                      <option selected value="{{$cour->id}}">{{$cour->courier_name}}</option>
                                                      <?php
                                                    }else{
                                                      ?>

                                                      <option  value="{{$cour->id}}">{{$cour->courier_name}}</option>
                                                      <?php
                                                    }


                                                  }
                                                   ?>
                                                </select>
                                              </div>
                                              <div class="col-lg-4 m-form__group-sub">
                                                <label class="form-control-label">Sent Date:</label>
                                                <div class="input-group date">
                                                  <input type="text" class="form-control m-input" readonly value="{{date("d-M-Y", strtotime($samples->sent_on))}}"  name="sent_on" id="m_datepicker_3" />
                                                  <div class="input-group-append">
                                                    <span class="input-group-text">
                                                      <i class="la la-calendar"></i>
                                                    </span>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-lg-4 m-form__group-sub">
                                                <label class="form-control-label">Status:</label>
                                                <?php

                                                 ?>
                                                <select class="form-control m-input m-input--air" id="status_sample" name="sample_status">
                                                  <option {{$samples->status==1 ?'selected':"" }} value="1">NEW</option>
                                                  <option {{$samples->status==2 ?'selected':"" }} value="2">SENT</option>
                                                  <option {{$samples->status==3 ?'selected':"" }} value="3">RECEIVED</option>
                                                  <option {{$samples->status==4 ?'selected':"" }} value="4">FEEDBACK</option>

                                                </select>

                                              </div>
                                            </div>
                                          </div>
                                          <div class="m-form__section m-form__section--first">
                                            <div class="form-group m-form__group row">
                                              <div class="col-lg-4 m-form__group-sub">
                                                <label class="form-control-label"> Track ID:</label>
                                                  <input type="text" class="form-control m-input" id="trackiii" value="{{$samples->track_id}}" name="track_id" placeholder="Enter TracK Id" >
                                              </div>
                                              <div class="col-lg-8 m-form__group-sub">
                                                <label class="form-control-label">Courier Remarks:</label>
                                                <input type="text" class="form-control m-input" value="{{$samples->courier_remarks}}"  name="courier_remarks" placeholder="Enter Courier Remarks" >
                                              </div>

                                            </div>
                                          </div>
                                          <?php
                                         }

                                         ?>


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

											<div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
										              under construction
											</div>

										</div>
                    <!-- end tab -->
                  </div>
                </div>


					</div>
          <!-- main  -->
