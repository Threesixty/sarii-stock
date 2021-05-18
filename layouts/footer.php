
					<!--begin::Footer-->
					<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted font-weight-bold mr-2"><?= date('Y') ?>©</span>
								<a href="mailto:michael.convergence@gmail.com" target="_blank" class="text-dark-75 text-hover-primary">Michael THOMAS</a>
							</div>
							<!--end::Copyright-->
							<!--begin::Nav-->
							<div class="nav nav-dark"></div>
							<!--end::Nav-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->

		<!-- begin::User Panel-->
		<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
			<!--begin::Header-->
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-1">
				<h3 class="d-block font-weight-bold m-0"><?= $user['firstname'] ?> <?= $user['lastname'] ?></h3>
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<p class="d-block text-uppercase pb-2 text-<?= Helper::getRoleName($user['role'], true) ?>"><?= Helper::getRoleName($user['role']) ?></p>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content pr-5 mr-n5">
				<!--begin::Header-->
				<div class="d-flex align-items-center">
					<div class="d-flex flex-column">
						<div class="navi">
							<form class="form" method="post">
								<input type="hidden" name="logout" value="1">
								<button type="submit" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Déconnexion</button>
							</form>
						</div>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Separator-->
				<div class="separator separator-dashed my-7"></div>
				<!--end::Separator-->

				<div class="navi navi-icon-circle navi-spacer-x-0">
					<h4 class="font-weight-bold my-2">Historique des mouvements</h4>
					<?php
					if (!empty($currentUserHistories)) {
						foreach ($currentUserHistories as $userHistory) {
							$color = $userHistory['operation'] == 'inc' ? 'primary' : 'warning'; ?>

							<!--begin::Item-->
							<a href="<?= Helper::getUrl('produit', ['id' => $userHistory['product']['id']]) ?>" class="navi-item">
								<div class="navi-link rounded">
									<div class="symbol symbol-60 mr-4">
										<div class="symbol-label">
											<span class="text-center font-weight-bolder font-size-h1 text-<?= $color ?>"><?= $userHistory['operation'] == 'inc' ? '+' : '-' ?><?= $userHistory['value'] ?></span>
										</div>
									</div>
									<div class="navi-text">
										<div class="font-weight-bold font-size-sm title">
											<span class="text-<?= $color ?> text-uppercase"><?= $userHistory['operation'] == 'inc' ? 'Approvisionnement' : 'Expédition' ?></span>
											<hr class="my-1">
										</div>
										<div class="font-weight-bold font-size-lg count">Le <?= date('d/m/Y à H:i', $userHistory['created_at']) ?></div>
										<div class="text-muted subtitle">
											<small class="d-block">Produit <strong><?= $userHistory['product']['name'] ?></strong></small>
										</div>
									</div>
								</div>
							</a>
							<!--end::Item-->

						<?php }
					} ?>
				</div>

			</div>
			<!--end::Content-->
		</div>
		<!-- end::User Panel-->

		<!-- Show barcode -->
		<div class="modal fade show" id="modalBarcode" tabindex="-1" aria-labelledby="modalBarcodeLabel" aria-modal="true" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title text-uppercase" id="exampleModalLabel"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i aria-hidden="true" class="ki ki-close"></i>
						</button>
					</div>
					<div class="modal-body text-center">
						<img class="barcode-img" src="" style="max-width: 100%">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-success font-weight-bold print-barcode">Imprimer</button>
						<button type="button" class="btn btn-sm btn-primary font-weight-bold" data-dismiss="modal">Fermer</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Add stock -->
		<div class="modal fade show" id="modalIncStock" tabindex="-1" aria-labelledby="modalIncStockLabel" aria-modal="true" role="dialog" data-backdrop="static">
			<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
				<form class="form" method="post">
					<input type="hidden" name="product_id">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title text-uppercase text-primary" id="exampleModalLabel">Approvisionner</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<i aria-hidden="true" class="ki ki-close"></i>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Quantité :</label>
								<input type="number" class="form-control" name="inc_stock" placeholder="10">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-light-primary font-weight-bold" data-dismiss="modal">Annuler</button>
							<button type="submit" class="btn btn-sm btn-primary font-weight-bold">Valider</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- Remove stock -->
		<div class="modal fade show" id="modalDecStock" tabindex="-1" aria-labelledby="modalDecStockLabel" aria-modal="true" role="dialog" data-backdrop="static">
			<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
				<form class="form" method="post">
					<input type="hidden" name="product_id">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title text-uppercase text-warning" id="exampleModalLabel">Expédier</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<i aria-hidden="true" class="ki ki-close"></i>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Quantité :</label>
								<input type="number" class="form-control" name="dec_stock" placeholder="10">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-light-warning font-weight-bold" data-dismiss="modal">Annuler</button>
							<button type="submit" class="btn btn-sm btn-warning font-weight-bold">Valider</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- begin::User Panel-->
		<div id="kt_quick_panel" class="kt_quick_panel offcanvas offcanvas-right p-10">

			<!--begin::Header-->
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
				<h3 class="font-weight-bold m-0">Historique des mouvements</h3>
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content pr-5 mr-n5">
				
				<div class="navi navi-icon-circle navi-spacer-x-0">
					<!--begin::Item-->
					<a href="#" class="navi-item d-none">
						<div class="navi-link rounded">
							<div class="symbol symbol-60 mr-4">
								<div class="symbol-label">
									<span class="text-center font-weight-bolder font-size-h1"></span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold font-size-sm title"></div>
								<div class="font-weight-bold font-size-lg count"></div>
								<div class="text-muted subtitle"></div>
							</div>
						</div>
					</a>
					<!--end::Item-->
				</div>

			</div>

		</div>
		</div>
		<!-- end::User Panel-->



		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</div>
		<!--end::Scrolltop-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<script src="assets/js/pages/crud/datatables/advanced/multiple-controls.js"></script>
		<script src="assets/js/pages/custom/projects/add-project.js"></script>
		<script src="assets/js/pages/crud/forms/widgets/select2.js"></script>
		<script src="assets/js/pages/features/charts/apexcharts.js"></script>
		<script src="assets/js/pages/crud/file-upload/image-input.js"></script>
	</body>
	<!--end::Body-->
</html>