<?php
require_once('components/Widget.php');
require_once('components/Helper.php');

$categories = isset($params['categories']) ? $params['categories'] : null;

$title = 'Liste des familles de produit'; ?>

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
						<div class="card-toolbar">
							<!--begin::Button-->
							<a href="<?= Helper::getUrl('categorie') ?>" class="btn btn-primary font-weight-bolder">
								<i class="la la-plus"></i> Nouvelle famille
							</a>
							<!--end::Button-->
						</div>
					</div>
					<div class="card-body">

						<span id="kt_quick_panel_toggle" class="d-none"></span>
						<!--begin: Datatable-->
						<table class="table table-separate table-head-custom table-checkable table-responsive" id="kt_datatable_category">
							<thead>
								<tr>
									<th style="width: 5%">ID</th>
									<th style="width: 65%">Nom</th>
									<th style="width: 20%">Date de création</th>
									<th style="width: 10%">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if (null !== $categories) {
									foreach ($categories as $key => $currentCategory) {
										$currentCategory = (object) $currentCategory; ?>

										<tr>
											<td class="m-3 border-left-3 border-left-<?= Helper::getRoleName($currentCategory->role, true) ?>">#<?= $currentCategory->id ?></td>
											<td><a href="<?= Helper::getUrl('categorie', ['id' => $currentCategory->id]) ?>" class="font-weight-bolder"><?= $currentCategory->name ?></a></td>
											<td data-order="<?= $currentCategory->created_at ?>"><?= strftime('%e %B %Y', $currentCategory->created_at) ?></td>
											<td nowrap="nowrap" class="history-parent" data-id="<?= $currentCategory->id ?>" data-url="<?= Helper::getUrl('historiquecategorie') ?>">
												<a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon kt_quick_panel_toggle" data-toggle="tooltip" data-theme="dark" title="Historique">
													<i class="fas fa-user-clock"></i>
												</a>
												<a href="<?= Helper::getUrl('categorie', ['id' => $currentCategory->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-theme="dark" title="Éditer">
													<i class="icon-xl la la-edit"></i>
												</a>
												<a href="<?= Helper::getUrl('categories', ['del' => $currentCategory->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-theme="dark" data-placement="right" title="Supprimer">
													<i class="icon-xl la la-trash"></i>
												</a>
											</td>
										</tr>

									<?php }
								} ?>
							</tbody>
						</table>
						<!--end: Datatable-->
					</div>
				</div>
				<!--end::Card-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Entry-->
	</div>
	<!--end::Content-->