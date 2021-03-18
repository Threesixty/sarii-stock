
		<!--begin::Subheader-->
		<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
			<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
				<!--begin::Info-->
				<div class="d-flex align-items-center flex-wrap mr-2">
					<!--begin::Page Title-->
					<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?= $title ?></h5>
					<!--end::Page Title-->
				</div>
				<!--end::Info-->
				<!--begin::Toolbar-->
				<div class="d-flex align-items-center">
					<!--begin::Topbar-->
					<div class="topbar">
						<!--begin::User-->
						<div class="topbar-item">
							<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
								<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1"><?= Helper::bonjour() ?></span>
								<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?= $user['firstname'] ?></span>
								<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
									<span class="symbol-label font-size-h5 font-weight-bold"><?= substr(ucwords($user['firstname']), 0, 2) ?><?= substr(ucwords($user['lastname']), 0, 1) ?></span>
								</span>
							</div>
						</div>
						<!--end::User-->
					</div>
					<!--end::Topbar-->
				</div>
				<!--end::Toolbar-->
			</div>
		</div>
		<!--end::Subheader-->