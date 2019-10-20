document.addEventListener('DOMContentLoaded', function () {
    if( document.querySelectorAll('#form-send-ask').length > 0 )
    {
        document.querySelector('#form-send-ask').addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(document.forms['form-send-ask']);

            LocalCore.Client.Axios.instance.post('/ajax/consult/form-send-ask/', formData)
                .then(function (response) {
                    if( response.data.status === 'success' )
                    {
                        LocalCore.Client.Swal.instance.fire({
                            title: 'Ваш вопрос успешно отправлен!',
                            text: 'Мы свяжемся с Вами в ближайшее время.',
                            type: 'success',
                            showCancelButton: false,
                            showConfirmButton: false
                        });

                        e.target.querySelector('[data-ajax-result]').innerHTML = '<p>Спасибо за обращение! Ваш вопрос отправлен!<br />Как только хирург ответить на ваш вопрос, мы отправим уведомление на указанный вами электронный адрес.<br />На все вопросы отвечает хирург Ведров Олег Вячеславович.</p>';

                        try {
                            for(var q of formData.keys())
                            {
                                document.querySelector('#form-send-ask [name="'+q+'"]').value = '';
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