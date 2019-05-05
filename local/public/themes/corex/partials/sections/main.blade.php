	<div class="m-content">
		<!--Begin::Section-->
		<?php
		$user = auth()->user();
		$userRoles = $user->getRoleNames();
		$user_role = $userRoles[0];
		if($user_role=="Admin"){
			?>
			<div class="row">
				<div class="col-xl-12">
					<!--begin:: Widgets/Best Sellers-->
					<div class="m-portlet m-portlet--full-height ">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">
									Hotel Chart
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
								<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget5_tab1_content" role="tab">
											Last 30 Days
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab2_content" role="tab">
											last Year
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab3_content" role="tab">
											All time
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="m-portlet__body">

							<!--begin::Content-->
							<div class="tab-content">
								<?php
								// echo "<pre>";
								// $sample_30=AyraHelp::getSample30Days();
								// print_r($sample_30);
								 ?>
								<div class="tab-pane active" id="m_widget5_tab1_content" aria-expanded="true">
								<div id="perf_div"></div>
								<?= Lava::render('ColumnChart', 'Finances', 'perf_div') ?>
								</div>

							</div>

							<!--end::Content-->
						</div>
					</div>

					<!--end:: Widgets/Best Sellers-->
				</div>

			</div>
			<?php

		}
		 ?>


		<!--End::Section-->
	</div>
