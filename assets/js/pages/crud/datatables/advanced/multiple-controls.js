"use strict";
var KTDatatablesAdvancedMultipleControls = function() {

	var init = function() {

        var language = {
                "sProcessing":     "Traitement en cours...",
                "sSearch":         "<i class='flaticon2-search' style='vertical-align: sub'></i>",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo":           "&nbsp; <span class='mdi mdi-long-arrow-right'></span> Page _PAGE_ / _PAGES_",
                "sInfoEmpty":      " ",
                "sInfoFiltered":   "",
                "sInfoPostFix":    "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst":      "Premier",
                    "sPrevious":   "Pr&eacute;c&eacute;dent",
                    "sNext":       "Suivant",
                    "sLast":       "Dernier"
                },
                "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                },
                "select": {
                        "rows": {
                            _: "%d lignes séléctionnées",
                            0: "Aucune ligne séléctionnée",
                            1: "1 ligne séléctionnée"
                        } 
                }
            };

		$('#kt_datatable_product').DataTable({
			// DOM Layout settings
			dom:
				"<'row py-3'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
				"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>" +
				"<'row py-3'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // read more: https://datatables.net/examples/basic_init/dom.html

			columnDefs: [
                { "orderable": false, "targets": [8] },
                { "searchable": false, "targets": [8] }
			],
            order: [[ 0, "desc" ]],
            pageLength: 25,
            language: language
		});

		$('#kt_datatable_user').DataTable({
			// DOM Layout settings
			dom:
				"<'row py-3'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
				"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>" +
				"<'row py-3'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // read more: https://datatables.net/examples/basic_init/dom.html

			columnDefs: [
                { "orderable": false, "targets": [8] },
                { "searchable": false, "targets": [8] }
			],
            order: [[ 1, "asc" ]],
            pageLength: 25,
            language: language
		});

		$('#kt_datatable_category').DataTable({
			// DOM Layout settings
			dom:
				"<'row py-3'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
				"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>" +
				"<'row py-3'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // read more: https://datatables.net/examples/basic_init/dom.html

			columnDefs: [
                { "orderable": false, "targets": [3] },
                { "searchable": false, "targets": [3] }
			],
            order: [[ 0, "desc" ]],
            pageLength: 25,
            language: language
		});
	};

	return {
		//main function to initiate the module
		init: function() {
			init();
		}
	};

}();

jQuery(document).ready(function() {
	KTDatatablesAdvancedMultipleControls.init();
});
