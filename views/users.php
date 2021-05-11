<?php
require_once('components/Widget.php');
require_once('components/Helper.php');

$users = isset($params['users']) ? $params['users'] : null;

$title = 'Liste des utilisateurs'; ?>

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
							<a href="<?= Helper::getUrl('utilisateur') ?>" class="btn btn-primary font-weight-bolder">
								<i class="la la-plus"></i> Nouvel utilisateur
							</a>
							<!--end::Button-->
						</div>
					</div>
					<div class="card-body">

						<span id="kt_quick_panel_toggle" class="d-none"></span>
						<!--begin: Datatable-->
						<table class="table table-separate table-head-custom table-checkable table-responsive" id="kt_datatable_product">
							<thead>
								<tr>
									<th>ID</th>
									<th>Identifiant</th>
									<th>Email</th>
									<th>Nom</th>
									<th>Prénom</th>
									<th>Rôle</th>
									<th>Statut</th>
									<th>Date de création</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if (null !== $users) {
									foreach ($users as $key => $currentUser) {
										$currentUser = (object) $currentUser; ?>

										<tr class="<?= $currentUser->status == 0 ? 'bg-dark-o-20' : '' ?>">
											<td class="m-3 border-left-3 border-left-<?= Helper::getRoleName($currentUser->role, true) ?>">#<?= $currentUser->id ?></td>
											<td><a href="<?= Helper::getUrl('utilisateur', ['id' => $currentUser->id]) ?>" class="font-weight-bolder"><?= $currentUser-> username ?></a></td>
											<td><?= $currentUser->email ?></td>
											<td><?= strtoupper($currentUser->lastname) ?></td>
											<td><?= ucwords($currentUser->firstname) ?></td>
											<td><span class="text-uppercase text-<?= Helper::getRoleName($currentUser->role, true) ?>"><?= Helper::getRoleName($currentUser->role) ?></span></td>
											<td><span class="label label-lg font-weight-bold label-light-<?= $currentUser->status == 1 ? 'success' : 'danger' ?> label-inline"><?= $currentUser->status == 1 ? 'Actif' : 'Désactivé' ?></span></td>
											<td data-order="<?= $currentUser->created_at ?>"><?= strftime('%e %B %Y', $currentUser->created_at) ?></td>
											<td nowrap="nowrap" class="history-parent" data-id="<?= $currentUser->id ?>" data-url="<?= Helper::getUrl('historiqueUtilisateur') ?>">
												<a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon kt_quick_panel_toggle" data-toggle="tooltip" data-theme="dark" title="Historique">
													<i class="fas fa-user-clock"></i>
												</a>
												<a href="<?= Helper::getUrl('utilisateur', ['id' => $currentUser->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-theme="dark" title="Éditer">
													<i class="icon-xl la la-edit"></i>
												</a>
												<a href="<?= Helper::getUrl('utilisateurs', ['del' => $currentUser->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-theme="dark" data-placement="right" title="Supprimer">
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