<?php
require_once('components/Widget.php');
require_once('components/Helper.php');

$currentUser = isset($params['currentUser']) ? $params['currentUser'] : null;

$title = 'Ajouter un utilisateur'; ?>

	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

		<?= Widget::add('subheader', $title, $user) ?>

		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
			<!--begin::Container-->
			<div class="container-fluid">
				<!--begin::Card-->
				<div class="card card-custom">
					<div class="card-header flex-wrap py-5">
						<div class="card-title">
							<?= $title ?>
						</div>
					</div>
					<div class="card-body p-5">
						<?= Helper::pp($currentUser) ?>

						<form class="form" method="post">

							<div class="form-group row">
								<label class="col-2 col-form-label">Text</label>
								<div class="col-10">
									<input class="form-control" type="text" value="Artisanal kale" id="example-text-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-search-input" class="col-2 col-form-label">Search</label>
								<div class="col-10">
									<input class="form-control" type="search" value="How do I shoot web" id="example-search-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-email-input" class="col-2 col-form-label">Email</label>
								<div class="col-10">
									<input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-url-input" class="col-2 col-form-label">URL</label>
								<div class="col-10">
									<input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-tel-input" class="col-2 col-form-label">Telephone</label>
								<div class="col-10">
									<input class="form-control" type="tel" value="1-(555)-555-5555" id="example-tel-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-password-input" class="col-2 col-form-label">Password</label>
								<div class="col-10">
									<input class="form-control" type="password" value="hunter2" id="example-password-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-number-input" class="col-2 col-form-label">Number</label>
								<div class="col-10">
									<input class="form-control" type="number" value="42" id="example-number-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-datetime-local-input" class="col-2 col-form-label">Date and time</label>
								<div class="col-10">
									<input class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-date-input" class="col-2 col-form-label">Date</label>
								<div class="col-10">
									<input class="form-control" type="date" value="2011-08-19" id="example-date-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-month-input" class="col-2 col-form-label">Month</label>
								<div class="col-10">
									<input class="form-control" type="month" value="2011-08" id="example-month-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-week-input" class="col-2 col-form-label">Week</label>
								<div class="col-10">
									<input class="form-control" type="week" value="2011-W33" id="example-week-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-time-input" class="col-2 col-form-label">Time</label>
								<div class="col-10">
									<input class="form-control" type="time" value="13:45:00" id="example-time-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-color-input" class="col-2 col-form-label">Color</label>
								<div class="col-10">
									<input class="form-control" type="color" value="#563d7c" id="example-color-input" />
								</div>
							</div>
							<div class="form-group row">
								<label for="example-email-input" class="col-2 col-form-label">Range</label>
								<div class="col-10">
									<input class="form-control" type="range" />
								</div>
							</div>
							<div class="card-footer">
								<div class="row">
									<div class="col-2"></div>
									<div class="col-10">
										<button type="reset" class="btn btn-success mr-2">Submit</button>
										<button type="reset" class="btn btn-secondary">Cancel</button>
									</div>
								</div>
							</div>
							<!--end::Card-->

						</form>

					</div>
				</div>
				<!--end::Card-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Entry-->
	</div>
	<!--end::Content-->
				