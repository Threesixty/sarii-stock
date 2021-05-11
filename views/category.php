<?php
require_once('components/Widget.php');
require_once('components/Helper.php');

$currentCategory = isset($params['currentCategory']) ? $params['currentCategory'] : null;
$title = null !== $currentCategory ? $currentCategory['name'] : 'Ajouter une famille de produit';

#Helper::pp($currentCategory) ?>

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

						<form id="kt_category_form" class="form" method="post">
							<?php
							if (null !== $currentCategory) { ?>
								<input type="hidden" name="id" value="<?= $currentCategory['id'] ?>">
							<?php } ?>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label text-right">Nom de la famille <sup class="text-danger">*</sup></label>
								<div class="col-sm-10">
									<input type="text" name="name" class="form-control" placeholder="Nom de la famille" value="<?= isset($currentCategory['name']) ? $currentCategory['name'] : '' ?>" required>
								</div>
							</div>
							<div class="card-footer">
								<div class="row">
									<div class="col-sm-2 col-form-label"><sup class="text-danger">*</sup> <small>Champs requis</small></div>
									<div class="col-sm-10">
										<button type="reset" class="btn btn-secondary">Annuler</button>
										<button id="kt_category_submit" type="submit" class="btn btn-success mr-2">Valider</button>
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
				