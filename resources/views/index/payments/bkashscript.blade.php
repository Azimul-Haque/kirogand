<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    // $("#bKash_button").trigger("click");
    function BkashPayment() {
        showLoading();
        // get token
        $.ajax({
            url: "{{ route('bkash-get-token') }}",
            type: 'POST',
            contentType: 'application/json',
            success: function (data) {
                $('pay-with-bkash-button').trigger('click');
                if (data.hasOwnProperty('msg')) {
                    showErrorMessage(data) // unknown error
                }
            },
            error: function (err) {
                hideLoading();
                showErrorMessage(err);
            }
        });
    }
    let paymentID = '';
    bKash.init({
            paymentMode: 'checkout',
            paymentRequest: {},
            createRequest: function (request) {
                setTimeout(function () {
                    createPayment(request);
                }, 2000)
            },
            executeRequestOnAuthorization: function (request) {
                $.ajax({
                    url: '{{ route('bkash-execute-payment') }}',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "paymentID": paymentID
                    }),
                    success: function (data) {
                        if (data) {
                            if (data.paymentID != null) {
                                BkashSuccess(data);
                            } else {
                                showErrorMessage(data);
                                bKash.execute().onError();
                            }
                        } else {
                            $.get('{{ route('bkash-query-payment') }}', {
                                payment_info: {
                                    payment_id: paymentID
                                }
                            }, function (data) {
                                if (data.transactionStatus === 'Completed') {
                                    BkashSuccess(data);
                                } else {
                                    createPayment(request);
                                }
                            });
                        }
                    },
                    error: function (err) {
                        bKash.execute().onError();
                    }
                });
            },
            onClose: function () {
                window.location.replace('{{ route('bkash-cancel-page-web') }}');
                // for error handle after close bKash Popup
            }
        });
        function createPayment(request) {
            // Amount already checked and verified by the controller
            // because of createRequest function finds amount from this request
            {{--request['amount'] = "{{ Session::get('bkash')['invoice_amount'] }}";--}} 

            request['amount'] = {{ $amount ? $amount : 0 }}; // max two decimal points allowed
            $.ajax({
                url: '{{ route('bkash-create-payment') }}',
                data: JSON.stringify(request),
                type: 'POST',
                contentType: 'application/json',
                success: function (data) {
                    hideLoading();
                    if (data && data.paymentID != null) {
                        paymentID = data.paymentID;
                        bKash.create().onSuccess(data);
                    } else {
                        bKash.create().onError();
                    }
                },
                error: function (err) {
                    hideLoading();
                    showErrorMessage(err.responseJSON);
                    bKash.create().onError();
                }
            });
        }
        function BkashSuccess(data) {
            // console.log('পেমেন্ট সাকসেসফুল!');
            console.log(data);
            // Swal.fire("Successful", 'পেমেন্ট সাকসেসফুল!', "success");
            $.post('{{ route('bkash-success') }}', {
                payment_info: data,
                mobile: '{{ $user->mobile }}',
                package_id: '{{ $packageid }}'
            }, function (res) {
                // console.log(res.status);
                // console.log(JSON.parse(res));
                // alert('Payment is successful');
                // location.reload();
                if(res.status == true) {
                    window.location.replace('{{ route('bkash-success-page-web') }}');
                } else {
                    window.location.replace('{{ route('bkash-failed-page-web') }}');
                }
                
            });
        }
        function showErrorMessage(response) {
            let message = 'Unknown Error';
            if (response.hasOwnProperty('errorMessage')) {
                let errorCode = parseInt(response.errorCode);
                let bkashErrorCode = [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014,
                    2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030,
                    2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046,
                    2047, 2048, 2049, 2050, 2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060, 2061, 2062,
                    2063, 2064, 2065, 2066, 2067, 2068, 2069, 503,
                ];
                if (bkashErrorCode.includes(errorCode)) {
                    message = response.errorMessage
                }
            }
            Swal.fire("Payment Failed!", message, "error");
        }
        function showLoading() {
            $("body").addClass("loading");
        }
        function hideLoading() {
            $("body").removeClass("loading"); 
        }
</script>


<script>
        


        document.addEventListener('DOMContentLoaded', () => {
            // 1. SELECT THE IFRAME using the name attribute
            const iframe = document.querySelector('iframe[name="bKash_checkout_app"]');
            const status = document.getElementById('statusMessage');

            if (!iframe) {
                 status.innerHTML = '<span class="text-red-600">Error: Iframe not found.</span>';
                 return;
            }

            // 2. WAIT FOR THE IFRAME TO LOAD
            iframe.onload = function() {
                try {
                    // 3. GET THE IFRAME'S CONTENT DOCUMENT
                    // This only works if it's Same-Origin
                    const iframeDocument = iframe.contentDocument || iframe.contentWindow.document;

                    if (!iframeDocument) {
                        status.innerHTML = '<span class="text-red-600">Error: Could not access iframe document. (Is it cross-origin?)</span>';
                        return;
                    }

                    // 4. QUERY FOR THE TARGET ELEMENT *INSIDE* THE IFRAME'S DOCUMENT
                    const targetElement = iframeDocument.querySelector('.merchant__details__name');
                    
                    if (targetElement) {
                        // 5. CHANGE THE VALUE/TEXT
                        targetElement.textContent = 'D-Nagorik Payment Services';
                        targetElement.style.color = '#10b981'; // Success Green
                        status.innerHTML = '<span class="text-green-600">Status: Success! Element inside iframe was updated.</span>';
                        console.log('Iframe content successfully updated.');
                    } else {
                        status.innerHTML = '<span class="text-red-600">Error: Target element (.merchant__details__name) not found inside iframe.</span>';
                        console.error('Target element not found inside iframe.');
                    }

                } catch (error) {
                    // This catches the Same-Origin Policy security error
                    status.innerHTML = `<span class="text-red-600">SECURITY BLOCKED: Cannot access content. Iframe is likely cross-origin: ${error.message}</span>`;
                    console.error('Security Error (Same-Origin Policy violation):', error);
                }
            };
        });
    </script>