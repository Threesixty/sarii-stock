<?php
require_once('components/Widget.php');
require_once('components/Helper.php');

$title = 'Liste des produits'; ?>

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
							<h3 class="card-label">Multiple Controls
							<span class="text-muted pt-2 font-size-sm d-block">multiple controls examples</span></h3>
						</div>
						<div class="card-toolbar">
							<!--begin::Button-->
							<a href="<?= Helper::getUrl('produit') ?>" class="btn btn-primary font-weight-bolder">
								<i class="la la-plus"></i> Nouveau produit
							</a>
							<!--end::Button-->
						</div>
					</div>
					<div class="card-body">
						<!--begin: Datatable-->
						<table class="table table-separate table-head-custom table-checkable table-responsive" id="kt_datatable_product">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nom du produit</th>
									<th>Référence</th>
									<th>Catégorie</th>
									<th>Stock</th>
									<th>Stock mini</th>
									<th>Statut</th>
									<th>Date de création</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td><a href="<?= Helper::getUrl('produit', ['id' => 1]) ?>">plop</a></td>
									<td>3068320080000</td>
									<td>Actionneurs</td>
									<td><span class="label label-xl font-weight-boldest label-light-danger label-inline h4">20</span></td>
									<td>10</td>
									<td><span class="label label-lg font-weight-bold label-light-success label-inline">Actif</span></td>
									<td data-order="123456789">16 février 2021</td>
									<td nowrap="nowrap">
										<div class="dropdown dropdown-inline" data-toggle="tooltip" data-theme="dark" data-placement="left" title="Actions sur le stock">
											<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
				                                <i class="fas fa-shipping-fast"></i>
				                            </a>
										  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
												<ul class="nav nav-hoverable flex-column">
										    		<li class="nav-item">
										    			<a class="nav-link" href="#">
										    				<i class="nav-icon fas fa-plus"></i>
										    				<span class="nav-text">Réapprovisionner</span>
										    			</a>
										    		</li>
										    		<li class="nav-item">
										    			<a class="nav-link" href="#">
										    				<i class="nav-icon fas fa-share"></i>
										    				<span class="nav-text">Expédier</span>
										    			</a>
										    		</li>
										    		<li>
										    			<hr style="margin: 0; border-color: #eee;">
										    		</li>
										    		<li class="nav-item">
										    			<a class="nav-link" href="#">
										    				<i class="nav-icon fas la-list"></i>
										    				<span class="nav-text">Historique</span>
										    			</a>
										    		</li>
												</ul>
										  	</div>
										</div>
										<a href="<?= Helper::getUrl('produit', ['id' => 1]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-theme="dark" title="Éditer">
											<i class="icon-xl la la-edit"></i>
										</a>
										<a href="<?= Helper::getUrl('produits', ['del' => 1]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-theme="dark" data-placement="right" title="Supprimer">
											<i class="icon-xl la la-trash"></i>
										</a>
									</td>
								</tr>
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