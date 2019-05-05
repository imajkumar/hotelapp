

          <!-- main  -->
          <div class="m-content">

						<!-- datalist -->
						<div class="m-portlet m-portlet--mobile">
													<div class="m-portlet__head">
														<div class="m-portlet__head-caption">
															<div class="m-portlet__head-title">
																<h3 class="m-portlet__head-text">
																	Add New Sample
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
                          <i class="flaticon-users-1"></i>
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
                        <i class="flaticon-map-location"></i>
                      </span>
                      <h3 class="m-portlet__head-text">
                      Sample  Information
                      </h3>
                    </div>
                  </div>
                  <div class="m-portlet__head-tools">

                  </div>
                </div>
                <div class="m-portlet__body">
                   <!-- form  -->
                   <!--begin::Form-->
                                     <form class="m-form m-form--state m-form--fit m-form--label-align-right"   id="m_form_add_sample" method="post" action="{{ route('sample.store')}}">
                                       @csrf
                                       <div class="m-portlet__body">
                                         <div class="m-form__section m-form__section--first">
                                           <div class="form-group m-form__group row">
                                             <div class="col-lg-4 m-form__group-sub">
                                            <label class="form-control-label">* Sample ID:</label>
                                                 <input type="text" class="form-control m-input" value="{{AyraHelp::getSampleIDCode()}}" name="sample_id" placeholder="Enter Company">
                                             </div>
                                             <div class="col-lg-8 m-form__group-sub">
                                               <label class="form-control-label">Select Client:</label>
																							 <select class="form-control m-select2 client_name" id="m_select2_1" name="client_id">

 																						@foreach (AyraHelp::getClientByadded(Auth::user()->id) as $user)
 										    											<option value="{{$user->id}}">{{$user->firstname}} | {{$user->phone}}  | {{$user->email}}</option>


 																						@endforeach

 																					</select>
                                             </div>

                                           </div>
                                         </div>
                                         <!-- name email phone -->
                                         <div class="m-form__section m-form__section--first">

																					 											<!-- repeater -->

																					 <div id="m_repeater_1">
																					 <div class="form-group  m-form__group row" id="m_repeater_1">
																					 <label  class="col-lg-2 col-form-label">
																					   Sample Details:
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

																					   			<input type="text" name="txtItem" class="form-control m-input" placeholder="Item Name">
																					         </div>

																					       </div>
																					       <div class="d-md-none m--margin-bottom-1"></div>
																					     </div>
																					     <div class="col-md-6">
																					       <div class="m-form__group m-form__group--inline">
																					         <div class="m-form__label">
																					           <label class="m-label m-label--single">
																					             Description:
																					           </label>
																					         </div>
																					         <div class="m-form__control">
																					           <input type="text" name="txtDiscrption" class="form-control m-input" placeholder="Description">
																					         </div>
																					       </div>
																					       <div class="d-md-none m--margin-bottom-2"></div>
																					     </div>

																					     <div class="col-md-1">
																					       <div data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill">
																					         <span>
																					           <i class="la la-trash-o"></i>
																					           <span>
																					             Remove
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
                                                 <input type="text" class="form-control m-input" id="client_address" name="client_address" placeholder="Enter Address" >
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">Location:</label>
                                               <input type="text" class="form-control m-input" name="location" placeholder="Enter Location" >
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">Remarks:</label>
																							   <input type="text" class="form-control m-input" name="remarks" placeholder="Enter Remraks" >

                                             </div>
                                           </div>
                                         </div>
                                      <!-- <address location source-->


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
