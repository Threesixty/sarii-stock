<?php
require_once('components/Widget.php');
require_once('components/Helper.php');

$currentUser = isset($params['currentUser']) ? $params['currentUser'] : null;
$title = null !== $currentUser ? $currentUser['firstname'].' '.$currentUser['lastname'] : 'Ajouter un utilisateur';

#Helper::pp($currentUser) ?>

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

						<form class="form" method="post">

							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Identifiant</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" placeholder="Identifiant" value="<?= isset($currentUser['username']) ? $currentUser['username'] : '' ?>" required <?= null !== $currentUser ? 'data-toggle="tooltip" data-placement="left" data-theme="dark" title="L‘identifiant ne peut être modifié" disabled' : '' ?>>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Mot de passe</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" placeholder="Mot de passe" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Prénom</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" placeholder="Prénom" value="<?= isset($currentUser['firstname']) ? $currentUser['firstname'] : '' ?>" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Nom</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" placeholder="Nom" value="<?= isset($currentUser['lastname']) ? $currentUser['lastname'] : '' ?>" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Email</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" placeholder="Email" value="<?= isset($currentUser['email']) ? $currentUser['email'] : '' ?>" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Rôle</label>
								<div class="col-sm-10">
									<select class="form-control" id="kt_select2_1" name="param" required="">
										<option></option>
										<?php
										$roles = Helper::getRoleNames();
										foreach ($roles as $key => $role) { ?>
											<option value="<?= $key ?>" <?= isset($currentUser['role']) && $currentUser['role'] == $key ? 'selected' : '' ?>><?= $role['name'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Statut</label>
								<div class="col-sm-10">
									<span class="switch">
										<label>
											<input type="checkbox" <?= isset($currentUser['status']) && $currentUser['status'] == 1 ? 'checked="checked"' : '' ?> name="status">
											<span></span>
										</label>
									</span>
								</div>
							</div>
							<div class="card-footer">
								<div class="row">
									<div class="col-sm-2 col-form-label"></div>
									<div class="col-sm-10">
										<button type="reset" class="btn btn-secondary">Annuler</button>
										<button type="submit" class="btn btn-success mr-2">Valider</button>
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
				