<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {

        var toastEl = document.querySelector('.toast');
        const toast = new bootstrap.Toast(toastEl, {
            animation: true,
            autohide: true,
            delay: 5000
        });

        $('input[name="paymentChecked"]').on('click', function() {
            let paymentType = $('input[name="paymentChecked"]:checked').val()
            if (paymentType == 'boleto') {
                $('#formBoleto').css('display', 'block')
                $('#formPix').css('display', 'none')
                $('#formCard').css('display', 'none')
            } else if (paymentType == 'pix') {
                $('#formPix').css('display', 'block')
                $('#formBoleto').css('display', 'none')
                $('#formCard').css('display', 'none')
                getQRCode()
            } else {
                $('#formCard').css('display', 'block')
                $('#formPix').css('display', 'none')
                $('#formBoleto').css('display', 'none')
            }
        })

        // $('#simulate').on('click', function() {
        //     let identificationField = $('#bar_code').val()
        //     axios.post('/api/payment/simulate', {
        //             'identificationField': identificationField
        //         }, {
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'Accept': 'application/json',
        //             }
        //         })
        //         .then(function(resp) {
        //             $('#dueDate').val(resp.data.bankSlipInfo.dueDate)
        //             $('#value').val(resp.data.bankSlipInfo.value)
        //         })
        //         .catch(function(error) {
        //             $('.toast-body').text(error.response.data.errors[0].description)
        //             toast.show();
        //         });
        // })

        $('#create').on('click', function() {

            let identificationField = $('#bar_code').val()
            let scheduleDate = $('#scheduleDate').val()
            let description = $('#description').val()
            let dueDate = $('#dueDate').val()
            let discount = $('#discount').val()
            let value = $('#value').val()

            axios.post('/api/payment/create', {
                    'identificationField': identificationField,
                    'scheduleDate': scheduleDate,
                    'description': description,
                    'discount': discount,
                    'dueDate': dueDate,
                    'value': value
                }, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                })
                .then(function(resp) {
                    window.location.href = `/payment/agradecimento?linkTransaction=${resp.data.data.transactionReceiptUrl}`
                })
                .catch(function(error) {
                    $('.toast-body').text(error.response.data.errors[0].description)
                    toast.show();
                });
        })

        //billings
        $('#createBilling').on('click', function() {

            let description = $('#description').val()
            let dueDate = $('#dueDate').val()
            let value = $('#value').val()

            axios.post('/api/billing', {
                    'value': value,
                    'dueDate': dueDate,
                    'description': description,
                    '': payId
                }, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                })
                .then(function(resp) {
                    $('#pay').attr('disabled', false)
                    $('#createBilling').attr('disabled', true)
                    $('#identificationField').val(resp.data.data.identificationField)
                    $('#payId').val(resp.data.data.id)
                })
                .catch(function(error) {
                    $('.toast-body').text(error.response.data.errors[0].description)
                    toast.show();
                });
        })

        function parseQueryString(queryString) {
            var params = {};
            var pairs = queryString.split('&');

            for (var i = 0; i < pairs.length; i++) {
                var pair = pairs[i].split('=');
                var name = decodeURIComponent(pair[0]);
                var value = decodeURIComponent(pair[1] || '');

                if (name.length) {
                    if (!params[name]) {
                        params[name] = value;
                    } else if (Array.isArray(params[name])) {
                        params[name].push(value);
                    } else {
                        params[name] = [params[name], value];
                    }
                }
            }

            return params;
        }

        //obter QRCode
        function getQRCode() {
            axios.get('/api/payment/pix?payId=' + $('#payId').val(), {}, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                })
                .then(function(resp) {
                    $('#qrCode').val(resp.data.data.payload)
                    $('#encodedImage').val(resp.data.data.encodedImage)
                    $('#payPix').attr('disabled', false)
                })
                .catch(function(error) {
                    $('.toast-body').text(error.response.data.errors[0].description)
                    toast.show();
                });
        }

        // pagar no pix
        $('#formPix').submit(function(event) {
            event.preventDefault();
            let formData = parseQueryString($('#formPix').serialize());

            axios.post('/api/payment/pix', {
                    'qrCode': {
                        'payload': formData.qrCode
                    },
                    'value': formData.value,
                    'description': formData.description,
                    'scheduleDate': formData.scheduleDate,
                }, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                })
                .then(function(resp) {
                    $('#qrCode').val(resp.data.data.payload)
                    $('#encodedImage').val(resp.data.data.encodedImage)
                    $('#pay').attr('disabled', false)
                })
                .catch(function(error) {
                    $('.toast-body').text(error.response.data.errors[0].description)
                    toast.show();
                });
        })

        // credit card
        $('#formCard').submit(function(event) {
            event.preventDefault();
            var formData = parseQueryString($('#formCard').serialize());

            axios.post('/api/payment/credit/card', {
                    'billingType': 'CREDIT_CARD',
                    'creditCard': {
                        'holderName': formData.holderName,
                        'number': formData.number,
                        'expiryMonth': formData.expiryMonth,
                        'expiryYear': formData.expiryYear,
                        'ccv': formData.ccv,
                    },
                    'creditCardHolderInfo': {
                        'name': formData.name,
                        'email': formData.email,
                        'cpfCnpj': formData.cpfCnpj,
                        'postalCode': formData.postalCode,
                        'addressNumber': formData.addressNumber,
                        'addressComplement': formData.addressComplement,
                        'mobilePhone': formData.mobilePhone,
                    },
                    'dueDate': formData.dueDate,
                    'value': formData.value,
                }, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                })
                .then(function(resp) {
                    window.location.href = `/payment/agradecimento?linkTransaction=${resp.data.data.transactionReceiptUrl}`
                })
                .catch(function(error) {
                    $('.toast-body').text(error.response.data.errors[0].description)
                    toast.show();
                });
        })

    });
</script>
</body>

</html>
