

          <!-- main  -->
          <div class="m-content">

						<!-- datalist -->
						<div class="m-portlet m-portlet--mobile">
													<div class="m-portlet__head">
														<div class="m-portlet__head-caption">
															<div class="m-portlet__head-title">
																<h3 class="m-portlet__head-text">
															Profile
																</h3>
															</div>
														</div>
														<div class="m-portlet__head-tools">
															<ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                  <a href="/" class="btn btn-secondary m-btn m-btn--custom m-btn--icon">
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
                          My profile</a>
											</li>

											<li class="nav-item">
												<a class="nav-link " data-toggle="tab" href="#m_tabs_3_3">
                          <i class="flaticon-users-1"></i>
                          Settings
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
                                                 <input type="text" class="form-control m-input" value ="{{Auth::user()->name}}" name="name" placeholder="Enter Name">
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">Email:</label>
                                                 <input type="text" class="form-control m-input" value="{{Auth::user()->email}}" name="email" placeholder="Enter Email">
                                             </div>
                                             <div class="col-lg-4 m-form__group-sub">
                                               <label class="form-control-label">Phone</label>
                                                <input type="phone" class="form-control m-input" value="{{Auth::user()->phone}}" name="phone" placeholder="Enter Phone" >
                                             </div>
                                           </div>
                                         </div>

                                       </div>
                                       <div class="m-portlet__foot m-portlet__foot--fit">
                                         <div class="m-form__actions m-form__actions">
                                           <div class="row">
                                             <div class="col-lg-12">
                                               <button type="submit" data-wizard-action="submit" class="btn btn-primary">Save Changes</button>
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
										              <!-- Settings -->
                                  <!--begin::Portlet-->
						<div class="m-portlet m-portlet--space">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
										My Settings
										</h3>
									</div>
								</div>

							</div>
							<div class="m-portlet__body">
								<div class="row">
									<div class="col-xl-4">
										<div class="m-tabs" data-tabs="true" data-tabs-contents="#m_sections">
											<ul class="m-nav m-nav--active-bg m-nav--active-bg-padding-lg m-nav--font-lg m-nav--font-bold m--margin-bottom-20 m--margin-top-10 m--margin-right-40" id="m_nav" role="tablist">
												<li class="m-nav__item">
													<a class="m-nav__link m-tabs__item m-tabs__item--active" data-tab-target="#m_section_1" href="#">
														<span class="m-nav__link-text">Password </span>
													</a>
												</li>
												<li class="m-nav__item">
													<a class="m-nav__link m-tabs__item" data-tab-target="#m_section_2" href="#">
														<span class="m-nav__link-text">Manage Clients</span>
													</a>
												</li>

											</ul>
										</div>
									</div>
									<div class="col-xl-8">
										<div class="m-tabs-content" id="m_sections">

											<!--begin::Section 1-->
											<div class="m-tabs-content__item m-tabs-content__item--active" id="m_section_1">
												<h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">Password Reset</h4>
												<div class="m-accordion m-accordion--section m-accordion--padding-lg" id="m_section_1_content">

													<!--begin::Item-->
													<div class="m-accordion__item">

														<div class="m-accordion__item-body collapse show" id="m_section_1_content_1_body" role="tabpanel" aria-labelledby="m_section_1_content_1_head" data-parent="#m_section_1_content">
															<div class="m-accordion__item-content">
															   <!-- password reset -->
                                 <!--begin::Portlet-->



 									<!--begin::Form-->
 									<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="m_form_2_reset">
 										<div class="m-portlet__body">
 											<div class="m-form__content">
 												<div class="m-alert m-alert--icon alert alert-warning m--hide" role="alert" id="m_form_2_msg">
 													<div class="m-alert__icon">
 														<i class="la la-warning"></i>
 													</div>


 												</div>
 											</div>
 											<div class="form-group m-form__group row">
 												<label class="col-form-label col-lg-3 col-sm-12">Email *</label>
 												<div class="col-lg-9 col-md-9 col-sm-12">
 													<input type="text" class="form-control m-input" name="email" placeholder="Enter your email">
 													<span class="m-form__help">We'll never share your email with anyone else.</span>
 												</div>
 											</div>
 											<div class="form-group m-form__group row">
 												<label class="col-form-label col-lg-3 col-sm-12">URL *</label>
 												<div class="col-lg-9 col-md-9 col-sm-12">
 													<div class="input-group">
 														<input type="text" class="form-control m-input" name="url" placeholder="Enter your url">
 														<div class="input-group-append"><span class="input-group-text">.via.com</span></div>
 													</div>
 													<span class="m-form__help">Please enter your website URL.</span>
 												</div>
 											</div>
 											<div class="form-group m-form__group row">
 												<label class="col-form-label col-lg-3 col-sm-12">Digits</label>
 												<div class="col-lg-9 col-md-9 col-sm-12">
 													<div class="m-input-icon m-input-icon--left">
 														<input type="text" class="form-control m-input" name="digits" placeholder="Enter digits">
 														<span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-calculator"></i></span></span>
 													</div>
 													<span class="m-form__help">Please enter only digits</span>
 												</div>
 											</div>
 											<div class="form-group m-form__group row">
 												<label class="col-form-label col-lg-3 col-sm-12">Credit Card</label>
 												<div class="col-lg-9 col-md-9 col-sm-12">
 													<div class="input-group">
 														<input type="text" class="form-control m-input" name="creditcard" placeholder="Enter card number">
 														<div class="input-group-append"><span class="input-group-text"><i class="la la-credit-card"></i></span></div>
 													</div>
 													<span class="m-form__help">Please enter your credit card number</span>
 												</div>
 											</div>
 											<div class="form-group m-form__group row">
 												<label class="col-form-label col-lg-3 col-sm-12">US Phone</label>
 												<div class="col-lg-9 col-md-9 col-sm-12">
 													<div class="input-group">
 														<input type="text" class="form-control m-input" name="phone" placeholder="Enter phone">
 														<div class="input-group-append"><a href="#" class="btn btn-brand"><i class="la la-phone"></i></a></div>
 													</div>
 													<span class="m-form__help">Please enter your US phone number</span>
 												</div>
 											</div>
 											<div class="form-group m-form__group row">
 												<label class="col-form-label col-lg-3 col-sm-12">Option *</label>
 												<div class="col-lg-9 col-md-9 col-sm-12">
 													<select class="form-control m-input" name="option">
 														<option value="">Select</option>
 														<option>1</option>
 														<option>2</option>
 														<option>3</option>
 														<option>4</option>
 														<option>5</option>
 													</select>
 													<span class="m-form__help">Please select an option.</span>
 												</div>
 											</div>
 											<div class="form-group m-form__group row">
 												<label class="col-form-label col-lg-3 col-sm-12">Options *</label>
 												<div class="col-lg-9 col-md-9 col-sm-12">
 													<select class="form-control m-input" name="options" multiple size="5">
 														<option>1</option>
 														<option>2</option>
 														<option>3</option>
 														<option>4</option>
 														<option>5</option>
 													</select>
 													<span class="m-form__help">Please select at least one or maximum 4 options</span>
 												</div>
 											</div>
 											<div class="form-group m-form__group row">
 												<label class="col-form-label col-lg-3 col-sm-12">Memo *</label>
 												<div class="col-lg-9 col-md-9 col-sm-12">
 													<textarea class="form-control m-input" name="memo" placeholder="Enter a menu"></textarea>
 													<span class="m-form__help">Please enter a menu within text length range 10 and 100.</span>
 												</div>
 											</div>
 											<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>
 											<div class="form-group m-form__group row">
 												<label class="col-form-label col-lg-3 col-sm-12">Checkbox *</label>
 												<div class="col-lg-9 col-md-9 col-sm-12">
 													<div class="m-checkbox-inline">
 														<label class="m-checkbox">
 															<input type="checkbox" name="checkbox"> Tick me
 															<span></span>
 														</label>
 													</div>
 													<span class="m-form__help">Please tick the checkbox</span>
 												</div>
 											</div>
 											<div class="form-group m-form__group row">
 												<label class="col-form-label col-lg-3 col-sm-12">Checkboxes *</label>
 												<div class="col-lg-9 col-md-9 col-sm-12">
 													<div class="m-checkbox-list">
 														<label class="m-checkbox">
 															<input type="checkbox" name="checkboxes"> Option 1
 															<span></span>
 														</label>
 														<label class="m-checkbox">
 															<input type="checkbox" name="checkboxes"> Option 2
 															<span></span>
 														</label>
 														<label class="m-checkbox">
 															<input type="checkbox" name="checkboxes"> Option 3
 															<span></span>
 														</label>
 													</div>
 													<span class="m-form__help">Please select at lease 1 and maximum 2 options</span>
 												</div>
 											</div>
 											<div class="form-group m-form__group row">
 												<label class="col-form-label col-lg-3 col-sm-12">Radios *</label>
 												<div class="col-lg-9 col-md-9 col-sm-12">
 													<div class="m-radio-inline">
 														<label class="m-radio">
 															<input type="checkbox" name="radio"> Option 1
 															<span></span>
 														</label>
 														<label class="m-radio">
 															<input type="checkbox" name="radio"> Option 2
 															<span></span>
 														</label>
 														<label class="m-radio">
 															<input type="radio" name="radio"> Option 3
 															<span></span>
 														</label>
 													</div>
 													<span class="m-form__help">Please select an option</span>
 												</div>
 											</div>
 										</div>
 										<div class="m-portlet__foot m-portlet__foot--fit">
 											<div class="m-form__actions m-form__actions">
 												<div class="row">
 													<div class="col-lg-9 ml-lg-auto">
 														<button type="submit" class="btn btn-accent">Validate</button>
 														<button type="reset" class="btn btn-secondary">Cancel</button>
 													</div>
 												</div>
 											</div>
 										</div>
 									</form>

 									<!--end::Form-->
 								

 								<!--end::Portlet-->


															   <!-- password reset -->

															</div>
														</div>
													</div>

													<!--end::Item-->



												</div>
											</div>

											<!--begin::Section 1-->

											<!--begin::Section 2-->
											<div class="m-tabs-content__item" id="m_section_2">
												<h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">Terms & Conditions</h4>
												<div class="m-accordion m-accordion--section m-accordion--padding-lg" id="m_section_2_content">

													<!--begin::Item-->
													<div class="m-accordion__item">
														<div class="m-accordion__item-head collapsed-" role="tab" id="m_section_2_content_1_head" data-toggle="collapse" href="#m_section_2_content_1_body">
															<span class="m-accordion__item-icon"><i class="flaticon-gift"></i></span>
															<span class="m-accordion__item-title">Lorem Ipsum has been the industry</span>
															<span class="m-accordion__item-mode"></span>
														</div>
														<div class="m-accordion__item-body collapse show" id="m_section_2_content_1_body" role="tabpanel" aria-labelledby="m_section_2_content_1_head" data-parent="#m_section_2_content">
															<div class="m-accordion__item-content">
																<p>
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
																	into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
																</p>
																<p> Type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
																	galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
																	into
																</p>
																<p>
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
																	into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
																	leap into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
																	the leap into
																</p>
																<p>
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
																	into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
																	leap into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
																	the leap into
																</p>
																<p>
																	Lorem Ipsum has been the industry's <a href="#" class="m-link m--font-boldest">Example boldest link</a>
																</p>
															</div>
														</div>
													</div>

													<!--end::Item-->

													<!--begin::Item-->
													<div class="m-accordion__item">
														<div class="m-accordion__item-head collapsed" role="tab" id="m_section_2_content_2_head" data-toggle="collapse" href="#m_section_2_content_2_body">
															<span class="m-accordion__item-icon"><i class="flaticon-calendar-3"></i></span>
															<span class="m-accordion__item-title">It has survived not only five centuries</span>
															<span class="m-accordion__item-mode"></span>
														</div>
														<div class="m-accordion__item-body collapse" id="m_section_2_content_2_body" role="tabpanel" aria-labelledby="m_section_2_content_2_head" data-parent="#m_section_2_content">
															<div class="m-accordion__item-content">
																<p>
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
																	into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
																	leap into Lorem Ipsum has been the industry's standard dummy text ever
																</p>
																<p> Since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
																	into nto Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha.
																</p>
																<p>
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
																	into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
																	leap into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
																	the leap into
																</p>
																<p>
																	It has survived not only five centuries, but also the leap into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
																	book. It has survived not only five centuries, but also the leap into
																</p>
																<p>
																	Lorem Ipsum has been the industry's <a href="#" class="m-link m--font-boldest">Example boldest link</a>
																</p>
															</div>
														</div>
													</div>

													<!--end::Item-->

													<!--begin::Item-->
													<div class="m-accordion__item">
														<div class="m-accordion__item-head collapsed" role="tab" id="m_section_2_content_3_head" data-toggle="collapse" href="#m_section_2_content_3_body">
															<span class="m-accordion__item-icon"><i class="flaticon-security"></i></span>
															<span class="m-accordion__item-title">Type and scrambled it to make a type specimen book</span>
															<span class="m-accordion__item-mode"></span>
														</div>
														<div class="m-accordion__item-body collapse" id="m_section_2_content_3_body" role="tabpanel" aria-labelledby="m_section_2_content_3_head" data-parent="#m_section_2_content">
															<div class="m-accordion__item-content">
																<p>
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
																	into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
																	leap into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
																	the leap into
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
																	into
																</p>
																<p>
																	Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
																	into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
																	leap into Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
																	the leap into
																</p>
																<p>
																	Lorem Ipsum has been the industry's <a href="#" class="m-link m--font-boldest">Example boldest link</a>
																</p>
															</div>
														</div>
													</div>

													<!--end::Item-->
												</div>
											</div>

											<!--begin::Section 2-->


										</div>
									</div>
								</div>
							</div>
						</div>

						<!--end::Portlet-->
										              <!-- Settings -->

											</div>

										</div>
                    <!-- end tab -->
                  </div>
                </div>


					</div>
          <!-- main  -->
