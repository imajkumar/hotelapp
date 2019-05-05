<!-- END: Subheader -->
					<div class="m-content">
						<div class="row">
							<div class="col-lg-12">
								<!--begin::Portlet-->
								<div class="m-portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text">
												Add New Sample
												</h3>
											</div>
										</div>
									</div>





									<!--begin::Form-->
									<form class="m-form m-form--fit m-form--label-align-right m-form"   id="m_form_1">
										@csrf
										<div class="m-portlet__body">
											<div class="form-group m-form__group row">
												<div class="col-lg-4">
													<label>Sample ID:</label>
													<input type="text" id="sample_id" name="sample_id" class="form-control m-input"  style="border:1px solid #c1c1;" readonly value="{{AyraHelp::getSampleIDCode()}}">
													<span class="m-form__help"></span>
												</div>
												<?php
													$clients=AyraHelp::getClientByadded(Auth::user()->id);
												?>
												<div class="col-lg-8">
													<label>Client:</label>
													<div class="input-group m-input-group m-input-group--square">
														<div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
														<select class="form-control m-select2" id="m_select2_1" name="client_id">

													@foreach ($clients as $user)
	    											<option value="{{$user->id}}">{{$user->firstname}} | {{$user->phone}}  | {{$user->email}}</option>
													@endforeach
												</select>
													</div>
													<span class="m-form__help"></span>
												</div>
											</div>

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
          <input type="text" name="txtDiscrption" class="form-control m-input" placeholder="Description">
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
<div class="form-group m-form__group row">
												<div class="col-lg-4">
													<div class="form-group m-form__group row">
														<label>Address *</label>
															<input type="text" class="form-control m-input" name="client_address" placeholder="Enter Address">
															<span class="m-form__help"></span>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group m-form__group row">
														<label>City *</label>
															<input type="text" class="form-control m-input" name="client_city" placeholder="Enter city">
															<span class="m-form__help"></span>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group m-form__group row">
														<label>Country *</label>
															<input type="text" class="form-control m-input" name="phone" placeholder="Enter country">
															<span class="m-form__help"></span>
													</div>
												</div>
											</div>
											<div class="form-group m-form__group">
												<label for="exampleTextarea">Remarks</label>
												<textarea class="form-control m-input" id="exampleTextarea" name="remarks" rows="3"></textarea>
											</div>

	</div>
	<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
		<div class="m-form__actions m-form__actions--solid">
			<div class="row">
				<div class="col-lg-4"></div>
				<div class="col-lg-8">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-secondary">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</form>

									<!--end::Form-->
								</div>

								<!--end::Portlet-->


							</div>
						</div>
					</div>
