class DatatableController {
    datatableAjaxUrl = null;
    configs = {};
    datatable = null;

    constructor(datatableAjaxUrl, configs) {
        this.datatableAjaxUrl = datatableAjaxUrl;
        this.configs = configs;
        window.datatableController = this;
    }

    initDatatable() {
        this.datatable = $('table#datatable').DataTable({
            ajax: {
                url: this.datatableAjaxUrl,
                data: function (object, settings) { // send each column's `visible` property in the ajax body
                    object.filters = {};
                    $('.datatable-filter').each(function (index, filter) {
                        if (filter.value !== undefined && filter.value !== '') {
                            object.filters[filter.dataset.name] = filter.value;
                        }
                    });

                    for (const i in object.columns) {
                        object.columns[i].visible = settings.aoColumns[i].visible;
                    }
                }
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ...this.configs,
        });

        window.datatable = this.datatable;

        this.initSelect2();
        this.initOnDrawEvents();
        this.initDatatableFilters();
    }

    reloadDatatable() {
        datatable.ajax.reload();
    }

    initSelect2() {
        this.datatable.on('draw', () => {
            const selectable = $('.selectable');
            selectable.select2();
        });
    }

    initDatatableFilters() {
        const klass = this;

        $('.datatable-filter').on('change', function () {
            klass.reloadDatatable();
        });
    }

    initOnDrawEvents() {}
}

window.DatatableController = DatatableController;
