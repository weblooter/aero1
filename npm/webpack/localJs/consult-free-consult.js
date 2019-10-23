document.addEventListener('DOMContentLoaded', function () {
    if( document.querySelectorAll('#consult-free-consult').length > 0 )
    {
        document.querySelector('#consult-free-consult').addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(document.forms['consult-free-consult']);

            LocalCore.Client.Axios.instance.post('/ajax/consult/free-consult/', formData)
                .then(function (response) {
                    if( response.data.status === 'success' )
                    {
                        LocalCore.Client.Swal.instance.fire({
                            title: 'Спасибо за обращение!',
                            text: 'Мы скоро свяжемся с вами.',
                            type: 'success',
                            showCancelButton: false,
                            showConfirmButton: false
                        });

                        if( document.querySelectorAll('[data-consult-free-consult-result]').length > 0 )
                        {
                            document.querySelector('[data-consult-free-consult-result]').innerHTML = 'Спасибо за обращение!<br/>Мы скоро свяжемся с вами.';
                        }

                        try {
                            for(var q of formData.keys())
                            {
                                document.querySelector('#consult-free-consult [name="'+q+'"]').value = '';
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