var LocalCore = {
    _reg: {
        _sessid: null,
    },

    Helper: {
        showErrorAjaxModal: function () {
            LocalCore.Client.Swal.instance.fire({
                title: 'Не удалось отправить вопрос!',
                text: 'Возникли технические сложности. Попробуйте позже. Либо свяжитесь с нами по телефону.',
                type: 'error',
                showCancelButton: false,
                showConfirmButton: false
            })
        }
    },

    Client: {
        Axios: {
            instance: null,

            /**
             * Задать аксиосу дефалтный конфиг
             * @param Axios
             */
            setDefaultConfig: function (Axios) {
                Axios.defaults.transformRequest = function (data, headers) {
                    if( data instanceof FormData)
                    {
                        data.append('sessid', LocalCore._reg._sessid);
                    }
                    else
                    {
                        if( typeof data ==  'undefined')
                        {
                            data = 'sessid='+LocalCore._reg._sessid;
                        }
                        else
                        {
                            data += '&sessid='+LocalCore._reg._sessid;
                        }
                    }
                    return data;
                };
                Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
                Axios.defaults.headers.common['Content-Type'] = 'application/json';
            }
        },
        Qs: {
            instance: null
        },
        Swal: {
            instance: null
        }
    }
};