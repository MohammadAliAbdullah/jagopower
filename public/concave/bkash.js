

    var accessToken = '';
    jQuery(document).ready(function () {
        jQuery.ajaxSetup({ 
            headers: { 'X-CSRF-TOKEN': csrf }
        });
        jQuery.ajax({
            url: base_url+"/token",
            type: 'POST',
            contentType: 'application/json',
            success: function (data) {
                accessToken = JSON.stringify(data);
            },
            error: function () {
                console.log('error');
            }
        });
        var paymentConfig = {
            createCheckoutURL: base_url+"/createpayment", 
            executeCheckoutURL:  base_url+"/executepayment",
        };
        var paymentRequest;
        paymentRequest = {
            amount: jQuery('#bKash_button').attr('data-payment-amount'), 
            intent:  jQuery('#bKash_button').attr('data-payment-intent'),
            invoice: jQuery('#bKash_button').attr('data-invoice-number'),
        };
       
        bKash.init({
            paymentMode: 'checkout',
            paymentRequest: paymentRequest,
            createRequest: function (request) {
                jQuery.ajax({
                    url: paymentConfig.createCheckoutURL + "?amount=" + paymentRequest.amount + "&invoice=" + paymentRequest.invoice+ "&intent=" + paymentRequest.intent,
                    type: 'GET',
                    contentType: 'application/json',
                    success: function (data) {
                        console.log(JSON.stringify(data));
                        var obj = JSON.parse(data);
                        if (data && obj.paymentID != null) {
                            paymentID = obj.paymentID;
                            bKash.create().onSuccess(obj);
                        }
                        else {
                            console.log('error');
                            bKash.create().onError();
                        }
                    },
                    error: function () {
                        console.log('error');
                        bKash.create().onError();
                    }
                });
            },
            executeRequestOnAuthorization: function () {
                jQuery.ajax({
                    url: paymentConfig.executeCheckoutURL + "?paymentID=" + paymentID,
                    type: 'GET',
                    contentType: 'application/json',
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data && data.paymentID != null) {
                            alert('Transaction is ' + data.transactionStatus);
                            location.reload();
                            //window.location.href = "/success";
                        }
                        else {
                            bKash.execute().onError();
                        }
                    },
                    error: function () {
                        bKash.execute().onError();
                    }
                });
            }
        });
    });