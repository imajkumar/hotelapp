
<?php 
$hotels_arr=AyraHelp::getHotes();


?>
          <!-- main  -->
          <div class="m-content">
			  <!--begin: Search Form -->
			  <form class="m-form m-form--fit m--margin-bottom-20">
					<div class="row m--margin-bottom-20">
						<div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
							<label>Hotel :</label>
							<select class="form-control m-input" data-col-index="1">
									<option value="">Select</option>
									<?php 
									foreach ($hotels_arr as $key => $value) {
										
										?>
									<option value="{{$value->name}}">{{$value->name}}</option>
										<?php
									}
									?>
								</select>

						</div>
						
						
						
					</div>
					
					<div class="m-separator m-separator--md m-separator--dashed"></div>
					<div class="row">
						<div class="col-lg-12">
							<button class="btn btn-brand m-btn m-btn--icon" id="m_search">
								<span>
									<i class="la la-search"></i>
									<span>Search</span>
								</span>
							</button>
							&nbsp;&nbsp;
							<button class="btn btn-secondary m-btn m-btn--icon" id="m_reset">
								<span>
									<i class="la la-close"></i>
									<span>Reset</span>
								</span>
							</button>
						</div>
					</div>
				</form>


						<!-- datalist -->
						<div class="m-portlet m-portlet--mobile">
													<div class="m-portlet__head">
														<div class="m-portlet__head-caption">
															<div class="m-portlet__head-title">
																<h3 class="m-portlet__head-text">
																	Room List
																</h3>
															</div>
														</div>
														<div class="m-portlet__head-tools">
															<ul class="m-portlet__nav">
																<li class="m-portlet__nav-item">
																	<a href="{{route('room.create')}}" class="btn btn-primary m-btn m-btn--custom m-btn--icon">
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



														<!--begin: Datatable -->
                            <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_13">
															<thead>
																<tr>
																	<th>ID</th>
																	<th>Hotel Name</th>
																	<th>Type</th>
                                  <th>Price</th>
																	<th>Adult</th>
																	<th>Child</th>																	
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
