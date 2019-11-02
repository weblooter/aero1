document.addEventListener('DOMContentLoaded', function () {
    if( document.querySelectorAll('#services-form-review').length > 0 )
    {
        document.querySelector('#services-form-review').addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(document.forms['services-form-review']);

            LocalCore.Client.Axios.instance.post('/ajax/services/form-review/', formData)
                .then(function (response) {
                    if( response.data.status === 'success' )
                    {
                        LocalCore.Client.Swal.instance.fire({
                            title: 'Спасибо за отзыв!',
                            text: '',
                            type: 'success',
                            showCancelButton: false,
                            showConfirmButton: false
                        });

                        e.target.querySelector('[data-ajax-result]').innerHTML = '<p>Спасибо за отзыв!</p>';

                        try {
                            for(var q of formData.keys())
                            {
                                document.querySelector('#services-form-review [name="'+q+'"]').value = '';
                            }
                        }
                        catch (e) {

                        }
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