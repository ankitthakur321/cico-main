<html>
<body>
    <button id="rzp-button1" style="display:none;">Pay</button>
    <form method="POST" action="<?=base_url('payment/paymentSuccessInfo')?>" id="paymentSuccessForm" style="display:none;">
        <input type="text" id="paymentId" name="paymentId" /><br>
        <input type="text" id="orderId" name="orderId" /><br>
        <input type="text" id="checksum" name="checksum" /><br>
        <input type="text" id="hotelId" name="hotelId" value="<?=$this->session->userdata('hotelId')?>" /><br>
        <input type="text" id="uId" name="uId" value="<?=$this->session->userdata('userid')?>" /><br>
        <input type="date" id="paymentDate" name="paymentDate" /><br>
        <input type="text" id="amount" name="amount" value="<?=$amount ?>" /><br>
    </form>
    
    <form method="POST" action="<?=base_url('payment/paymentFailureInfo')?>"  id="paymentFailureForm" style="display:none;">
        <input type="text" id="paymentfailureId" name="paymentfailureId" /><br>
        <input type="text" id="orderfailureId" name="orderfailureId" /><br>
        <input type="text" id="failurehotelId" name="failurehotelId" value="<?=$this->session->userdata('hotelId')?>" /><br>
        <input type="text" id="failureuId" name="failureuId" value="<?=$this->session->userdata('userid')?>" /><br>
        <input type="date" id="failurepaymentDate" name="failurepaymentDate" /><br>
        <input type="date" id="errorcode" name="errorcode" /><br>
        <input type="date" id="errorDescription" name="errorDescription" /><br>
        <input type="date" id="errorSource" name="errorSource" /><br>
        <input type="text" id="failureAmount" name="failureAmount" value="<?=$amount ?>" /><br>
        <input type="text" id="failureReason" name="failureReason" /><br>
    </form>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- latest jquery-->
    <script src="<?=base_url('assets/js/jquery-3.5.1.min.js')?>"></script>
    <script>
    var options = {
        "key": "rzp_live_SAWpMSiyITpZDy", // Enter the Key ID generated from the Dashboard
        "amount": "<?=$amount*100 ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "Checkin Checkout",
        "description": "Hotel information",
        "image": "https://checkinandcheckout.com/assets/images/icon/logo.png",
        "order_id": "<?=$orderId?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "handler": function (response){
            $('#paymentId').val(response.razorpay_payment_id);
            $('#orderId').val(response.razorpay_order_id);
            $('#checksum').val(response.razorpay_signature);
            $('#paymentSuccessForm').submit();
            
        },
        "prefill": {
            "name": "<?=$this->input->post('userName')?>",
            "email": "<?=$this->input->post('userEmail')?>",
            "contact": "<?=$this->input->post('userPhone')?>"
        },
        "theme": {
            "color": "#e51e25"
        },
        "modal": {
                "ondismiss": function(){
                    document.location.replace(document.referrer);
                 }
            }
        };
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){
            $('#paymentfailureId').val(response.error.metadata.payment_id);
            $('#orderfailureId').val(response.error.metadata.order_id);
            $('#errorcode').val(response.error.code);
            $('#errorDescription').val(response.error.description);
            $('#errorSource').val(response.error.source);
            $('#failureReason').val(response.error.reason);
            $('#paymentFailureForm').submit();
    });
    document.getElementById('rzp-button1').onclick = function(e){
        var date = new Date();
        var currentDate = date.toISOString().slice(0,10);
        $('#paymentDate').val(currentDate);
        $('#failurepaymentDate').val(currentDate);
        
        rzp1.open();
        e.preventDefault();
        
    }
    $('#rzp-button1').click();
    
    
    </script>
</html>