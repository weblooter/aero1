document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelectorAll('#consult-short-form, #consult-short-form-header-menu').length > 0) {

        [].forEach.call(document.querySelectorAll('#consult-short-form, #consult-short-form-header-menu'), function ($el) {

            $el.addEventListener('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(document.forms[$el.getAttribute('id')]);

                LocalCore.Client.Axios.instance.post('/ajax/consult/short-form/', formData)
                    .then(function (response) {
                        if (response.data.status === 'success') {
                            LocalCore.Client.Swal.instance.fire({
                                title: 'Спасибо за обращение!',
                                text: 'Мы свяжемся с Вами в ближайшее время.',
                                type: 'success',
                                showCancelButton: false,
                                showConfirmButton: false
                            });

                            try {
                                for (var q of formData.keys()) {
                                    $el.querySelector('[name="' + q + '"]').value = '';
                                }
                            } catch (e) {

                            }
                        } else {
                            LocalCore.Helper.showErrorAjaxModal();
                        }
                    })
                    .catch(function (e) {
                        LocalCore.Helper.showErrorAjaxModal();
                    })
            })
        });
    }
});