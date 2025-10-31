<title>bKash Payment Gateway</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script id="myScript" src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


<style>
    .swal-container, .swal2-container {
        z-index: 2000;
    }
    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(224,34,95,0.3) url("/images/Spinner-1s-200px.gif") center no-repeat;
    }
    body{
        text-align: center;
    }
    /* Turn off scrollbar when body element has the loading class */
    body.loading{
        overflow: hidden;   
    }
    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay{
        display: block;
    }
</style>

<div class="overlay"></div>
<div class="height d-flex justify-content-center align-items-center">
    
    <div class="card p-3">
        <center><big>পেমেন্ট ৳ {{ bangla($amount) }}</big></center>
        <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
        </div>
        
        <button class="btn btn-danger" id="bKash_button" onclick="BkashPayment()" style="background: url({{ asset('images/bkash_payment_logo.png') }}); background-size: 100%; background-size: 250px auto; background-repeat: no-repeat;">
        </button>
        <small id="changeTextonLoad">পেমেন্ট করতে উপরের বাটনে ক্লিক করুন</small>
    </div>
</div>


@include('index.payments.bkashscript')

<style type="text/css">
        body{
            background-color:#dce3f0;
        }

        .height{
            height:100vh;
        }

        .card{
            width:300px;
            height:150px;


        }

        .image{
            position:absolute;
            right:12px;
            top:10px;
        }

        .btn-danger{
            
            height:48px;
            font-size:18px;
        }
</style>



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