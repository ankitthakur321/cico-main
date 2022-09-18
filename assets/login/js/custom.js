 $(function(){
        $('#showPassCheck').click(function(){
            if(document.getElementById('password').type=="password")
		    {
		        $("#password").prop("type", "text");
		    }
		    else
		    {
		        $("#password").prop("type", "password");
		    }
        });
        
         $('#showPassCheck2').click(function(){
            if(document.getElementById('passwordNew').type=="password" && document.getElementById('passwordNew2').type=="password")
		    {
		        $("#passwordNew").prop("type", "text");
		        $("#passwordNew2").prop("type", "text");
		    }
		    else
		    {
		        $("#passwordNew").prop("type", "password");
		        $("#passwordNew2").prop("type", "password");
		    }
        });
let otpResendTimer;
         $('#passLogin').click(function(){
            if(document.getElementById('passDiv').style.display=="none")
		    {
		        $("#passDiv").prop("style", "display:block");
		        $("#forgetPass").prop("style", "display:block");
		        $('#passLogin').html('Mobile');
		        $("#loginBtn").prop("disabled", false);
		        $("#loginBtn").val("Login");
		        $('#password').prop("required", true);
		        $('#mobileNo').prop("required", true);
		        $("#otpDiv").prop("style", "display:none");
		        $("#successText").prop("style", "display:none");
                $("#alertText").prop("style", "display:none");
                $("#otp").val('');
                if(otpResendTimer!==null){
                    clearInterval(otpResendTimer);
                }
		    }
		    else
		    {
		        $("#passDiv").prop("style", "display:none");
		        $("#forgetPass").prop("style", "display:none");
		        $('#passLogin').html('Password');
		        $("#loginBtn").prop("disabled", true);
		        $("#loginBtn").prop("type", "button");
		        $("#loginBtn").val("Login");
		        $('#password').prop("required", false);
		        $('#mobileNo').prop("required", false);
		        $("#otpDiv").prop("style", "display:none");
		        $("#successText").prop("style", "display:none");
                $("#alertText").prop("style", "display:none");
                if(otpResendTimer!==null){
                    clearInterval(otpResendTimer);
                }   
                $("#otp").val('');
		    }
        });
        
        if(document.getElementById('passDiv')!==null){
                $('#mobileNo').on('keyup',function(){
                        if( $('#mobileNo').val().length==10){
                            let firstLetter = $('#mobileNo').val().charAt(0);
                            if(firstLetter<=5){
                                $("#alertText").prop("style", "display:block");
                                $("#alertText").html("Invalid Mobile Number");
                                $("#loginBtn").prop("disabled", true);
                                $("#loginBtn").val("Login");
                            }
                            else{
            
                                $("#alertText").prop("style", "display:none");
                                if(document.getElementById('passDiv').style.display==="none")
                                {
                                    $("#loginBtn").prop("disabled", false);
                                    $("#loginBtn").val("Send OTP");
                                }
                                else{
                                    var phone = $('#mobileNo').val();
                                    $.ajax({
                                    type: "POST",
                                    url: "login/accountStatus",
                                    dataType: 'json',
                                    data: {phone: phone},
                                    success: function(res) {
                                        if(res.accountStatus=="User Found")
                                        {
                                            $("#loginBtn").prop("disabled", false);
                                            $("#loginBtn").val("Login");
                                        }
                                        else
                                        {
                                            $("#alertText").prop("style", "display:block");
                                            $("#loginBtn").prop("disabled", true);
                                            $("#loginBtn").val("Login");
                                            $("#alertText").html(res.accountStatus + "<br>Please Login with Mobile to create an account");
                                        }
                                    }
                                   });
                                    
                                }
                            }
                            
                        }
                        else{
                            $("#loginBtn").prop("disabled", true);
                            $("#otpDiv").prop("style", "display:none");
                        }
                });
            
            
                $("#loginBtn").click(function(){
                    if(document.getElementById('passDiv').style.display==="none")
                    {
                        $("#otpDiv").prop("style", "display:block");
                        var phone = $('#mobileNo').val();
                        $.ajax({
                            type: "POST",
                            url: "login/sendOTP",
                            dataType: 'json',
                            data: {phone: phone},
                            success: function(res) {
                                if(res.sentStatus=="Sent")
                                {
                                    $("#loginBtn").prop("disabled", true);
                                    var otp = res.otp;
                                    $("#successText").prop("style", "display:block");
                                    $("#successText").html('OTP Sent Successfully');
                                    
                                    var timeleft = 60;
                                    otpResendTimer = setInterval(function(){
                                      if(timeleft <= 0){
                                        clearInterval(otpResendTimer);
                                        $("#loginBtn").prop("disabled", false);
                                        $("#loginBtn").val("Resend OTP");
                                        $("#alertText").prop("style", "display:none");
                                        $("#successText").prop("style", "display:none");
                                      }
                                      $("#timer").html(timeleft+" seconds");
                                      timeleft -= 1;
                                    }, 1000);
                                    
                                    $("#otp").on('keyup',function(){
                                        if($('#otp').val().length==6){
                                            var cnfOTP = $('#otp').val();
                                            if(otp ==cnfOTP)
                                            {
                                                clearInterval(otpResendTimer);
                                                $("#successText").prop("style", "display:block");
                                                $("#successText").html('Login Successfully');
                                                $("#alertText").prop("style", "display:none");
                                                $("#loginForm").submit();
                                            }
                                            else{
                                                $("#alertText").prop("style", "display:block");
                                                $("#alertText").html('OTP did not matched');
                                                $("#successText").prop("style", "display:none");
                                                $("#loginBtn").prop("disabled", false);
                                            }
                                        }
                                    });
                                }
                                else
                                {
                                    $("#alertText").prop("style", "display:block");
                                    $("#alertText").html('OTP not sent.');
                                    $("#loginBtn").prop("disabled", false);
                                }
                            }
                        });
                    }
                    else
                    {
                        $("#loginForm").submit();
                    }
                });
            
        }
        
         $('#cnfMobileNo').on('keyup',function(){
                if( $('#cnfMobileNo').val().length==10)
                {
                    
                    let firstLetter = $('#cnfMobileNo').val().charAt(0);
                    if(firstLetter<=5){
                        $("#alertText").prop("style", "display:block");
                        $("#alertText").html("Invalid Mobile Number");
                        $("#changePassBtn").prop("style", "display:none");
                    }
                    else{
                        sendOTPStatus=true;
                        var phone = $('#cnfMobileNo').val();
                        $.ajax({
                        type: "POST",
                        url: "accountStatus",
                        dataType: 'json',
                        data: {phone: phone},
                        success: function(res) {
                            if(res.accountStatus=="User Found")
                            {
                                $("#alertText").prop("style", "display:none");
                                $("#changePassBtn").prop("style", "display:block");
                                $("#changePassBtn").val("Send OTP");
                            }
                            else
                            {
                                $("#alertText").prop("style", "display:block");
                                $("#changePassBtn").prop("style", "display:none");
                                $("#changePassBtn").val("Send OTP");
                                $("#alertText").html(res.accountStatus);
                                $("#otpDiv").prop("style", "display:none");
                            }
                        }
                       });
                    } 
                }
                else{
                    $("#changePassBtn").prop("style", "display:none");
                    $("#otpDiv").prop("style", "display:none");
                }
        });
        
        if(document.getElementById('passDiv1')!==null){
            
                $("#changePassBtn").click(function(){
                    if(document.getElementById('passDiv1').style.display=="none")
                    {
                        $("#otpDiv").prop("style", "display:block");
                        var phone = $('#cnfMobileNo').val();
                        $.ajax({
                            type: "POST",
                            url: "sendOTP",
                            dataType: 'json',
                            data: {phone: phone},
                            success: function(res) {
                                if(res.sentStatus=="Sent")
                                {
                                    $("#changePassBtn").prop("style", "display:none");
                                    $("#successText").prop("style", "display:block");
                                    $("#successText").html('OTP Sent Successfully');
                                    var otp1 = res.otp;
                                    var timeleft1 = 60;
                                    var otpResendTimer1 = setInterval(function(){
                                      if(timeleft1 <= 0){
                                        clearInterval(otpResendTimer1);
                                        $("#changePassBtn").prop("style", "display:block");
                                        $("#changePassBtn").val("Resend OTP");
                                        $("#alertText").prop("style", "display:none");
                                        $("#successText").prop("style", "display:none");
                                      }
                                      $("#timer").html(timeleft1 +" seconds");
                                      timeleft1 -= 1;
                                    }, 1000);
                                    
                                    $("#otp2").on('keyup',function(){
                                        if($('#otp2').val().length==6){
                                            var cnfOTP = $('#otp2').val();
                                            if(otp1 ==cnfOTP)
                                            {
                                                clearInterval(otpResendTimer1);
                                                $("#successText").prop("style", "display:block");
                                                $("#successText").html('OTP Verified');
                                                $("#alertText").prop("style", "display:none");
                                                $("#otpDiv").prop("style", "display:none");
                                                $("#passDiv1").prop("style", "display:block");
                                            }
                                            else{
                                                $("#alertText").prop("style", "display:block");
                                                $("#alertText").html('OTP did not matched');
                                                $("#otpDiv").prop("style", "display:block");
                                                $("#passDiv1").prop("style", "display:none");
                                            }
                                        }
                                    });
                                }
                                else
                                {
                                    $("#alertText").prop("style", "display:block");
                                    $("#alertText").html('OTP not sent.');
                                    $("#changePassBtn").prop("style", "display:block");
                                    $("#changePassBtn").val("Resend OTP");
                                }
                            }
                        });
                    }
                    else {
                        $("#forgotPassForm").submit();
                    }
                });
        }
        
        let pass1='A';
        let pass2='B';
        $("#passwordNew2").on('keyup', function(){
            pass1 = $("#passwordNew").val();
            pass2 = $("#passwordNew2").val();
            if(pass2 === pass1)
            {
                $("#changePassBtn").prop("style", "display:block");
                $("#changePassBtn").val("Change Password");
            }
            else{
                $("#changePassBtn").prop("style", "display:none");
            }
            
        });
        
});