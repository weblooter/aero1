document.addEventListener('DOMContentLoaded', function () {
    if( document.querySelectorAll('#consult-short-form').length > 0 )
    {
        document.querySelector('#consult-short-form').addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(document.forms['consult-short-form']);

            LocalCore.Client.Axios.instance.post('/ajax/consult/short-form/', formData)
                .then(function (response) {
                    if( response.data.status === 'success' )
                    {
                        LocalCore.Client.Swal.instance.fire({
                            title: 'Ваш вопрос успешно отправлен!',
                            text: 'Мы свяжемся с Вами в ближайшее время.',
                            type: 'success',
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                    }
                    else
                    {
                        LocalCore.Helper.showErrorAjaxModal();
                    }
                })
                .catch(function (e) {
                    LocalCore.Helper.showErrorAjaxModal();
                })
        })
    }
});