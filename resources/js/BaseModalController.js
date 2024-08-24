class BaseModalController {
    datatable = null;
    form = null;
    modal = null;
    response = null;

    constructor(datatable, formId, modalId, response) {
        this.modal = $(`#${modalId}`);
        this.response = response;

        this.showModal();

        this.datatable = datatable;
        this.form = $(`#${formId}`);

    }

    bindEvents() {
        this.modalHideEvent();
        this.submit();
    }

    showModal() {
        this.modal.html(this.response);
        this.modal.modal('show');
    }

    modalHideEvent() {
        this.modal.on('hidden.bs.modal', async () => {
            await this.datatable.ajax.reload();
        });
    }

    submit() {
        const klass = this;
        const form = this.form;

        if (form !== null) {
            form.on('submit', (e) => {
                e.preventDefault();

                const data = form.serializeArray();
                $.ajax({
                    url: form.prop('action'),
                    data: data,
                    type: 'POST',
                    success: async (response) => {
                        klass.modal.modal('hide');

                        showNotification(response.status, response.message);
                    },
                    error: (xhr, status, error) => {
                        if (xhr.status === 422)
                            showValidationErrors(form, xhr.responseJSON.errors)
                        console.error(xhr, status, error);
                    }
                });
            });
        }
    }
}

window.BaseModalController = BaseModalController;
