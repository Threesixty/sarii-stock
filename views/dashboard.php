<?php
require_once('components/Widget.php');
require_once('components/Helper.php');

$histories = isset($params['histories']) ? $params['histories'] : null;

$title = 'Tableau de bord'; ?>

	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

		<?= Widget::add('subheader', $title, $user) ?>

		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
			<!--begin::Container-->
			<div class="container-fluid">
				<!--begin::Dashboard-->
				<!--begin::Row-->
				<div class="row">
					<div class="col-lg-6 col-xxl-4">
						<!--begin::Tiles Widget 7-->
						<div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="background-color: #1e1e2d">
							<!--begin::Body-->
							<div class="card-body">
								<div class="p-4">
									<h3 class="text-white font-weight-bolder mb-7">Bienvenue dans <span class="font-shadows font-size-h2 text-primary">{SARII-Stock}</span></h3>
									<p class="text-muted font-size-md mb-5">SARII-Stock est une application de gestion de stock de matériel électrique et d'automates.</p>
									<p class="text-muted font-size-md mb-5">Elle permet de saisir des produits et d'y effectuer des opérations de stockage-destockage.</p>
									<p class="text-muted font-size-md mb-5">Chaque opération est horodatée puis enregistrée afin d'obtenir un suivi efficace des mouvements. L'historique est disponible pour chaque produit directement sur la page de listing en cliquant sur l'icône 
										<span class="btn btn-sm btn-clean btn-icon">
			                                <i class="fas fa-shipping-fast"></i>
			                            </span>
			                        </p>
									<p class="text-muted font-size-md mb-2">Il existe 3 profils utilisateur :</p>
									<ul class="mb-1">
										<li class="text-primary text-uppercase">Approvisionnement</li>
										<li class="text-warning text-uppercase">Expédition</li>
										<li class="text-info text-uppercase">Admin</li>
									</ul>
									<p class="text-muted font-size-md mb-5">Chaque profil dispose de droits spécifiques.</p>
								</div>
							</div>
							<!--end::Body-->
						</div>
						<!--end::Tiles Widget 7-->
					</div>
					<div class="col-lg-6 col-xxl-4">
						<!--begin::List Widget 9-->
						<div class="card card-custom card-stretch gutter-b">
							<!--begin::Header-->
							<div class="card-header align-items-center border-0 mt-6">
								<h3 class="card-title align-items-start flex-column">
									<span class="font-weight-bolder text-dark">Activité récente</span>
								</h3>
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body card-timeline pt-0">
								<!--begin::Timeline-->
								<div class="timeline timeline-6">

									<?php
									if (!empty($histories)) {
										foreach ($histories as $date => $historyHours) { ?>

											<div class="position-relative font-size-h4 text-uppercase bg-white my-2"><?= $date ?><hr class="mt-1 mb-0"></div>

											<?php
											foreach ($historyHours as $hour => $history) {
												$history = (object) $history; ?>

												<!--begin::Item-->
												<div class="timeline-item align-items-start ml-3">
													<!--begin::Label-->
													<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"><?= $hour ?></div>
													<!--end::Label-->
													<!--begin::Badge-->
													<div class="timeline-badge">
														<i class="fa fa-genderless text-<?= $history->operation == 'inc' ? 'primary' : 'warning' ?> icon-xl"></i>
													</div>
													<!--end::Badge-->
													<!--begin::Content-->
													<div class="timeline-content d-flex">
														<span class="text-dark-75 pl-3 font-size-lg"><strong><?= $history->user->username ?></strong> a <?= $history->operation == 'inc' ? 'approvisionné' : 'expédié' ?> <strong><?= $history->value ?> unité<?= $history->value > 1 ? 's' : '' ?></strong> du produit <strong><?= $history->product->name ?></strong></span>
													</div>
													<!--end::Content-->
												</div>
												<!--end::Item-->

											<?php }
										}
									} ?>

								</div>
								<!--end::Timeline-->
							</div>
							<!--end: Card Body-->
						</div>
						<!--end: List Widget 9-->
					</div>
					<div class="col-lg-12">
						<!--begin::Card-->
						<div class="card card-custom gutter-b">
							<div class="card-header">
								<div class="card-title">
									<h3 class="card-label">Aperçu des mouvements de stock</h3>
								</div>
							</div>
							<div class="card-body">
								<!--begin::Chart-->
								<div id="chart_2" data-values='<?= json_encode($params['charts']) ?>'></div>
								<!--end::Chart-->
							</div>
						</div>
						<!--end::Card-->
					</div>
				</div>
				<!--end::Row-->
				<!--end::Dashboard-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Entry-->
	</div>
	<!--end::Content-->