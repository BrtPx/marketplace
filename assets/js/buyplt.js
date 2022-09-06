


// ====== VALIDATE NEW  lipalater CUSTOMER DETAILS ========
$(document).ready(function(){
    $('.newCustomerVerificationOTP').on('submit',  function(e) {
        e.preventDefault()
        const url = $(this).attr('action')
        const data = new FormData(this)

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            beforeSend: function() {
                $('#newCustomerVerifyButton').text('Connecting please wait...')
            },
            success: function(data) {
                if (data.response === 'success') {
                    $('#newCustomerVerifyButton').text('Successfully Sent!').css({'background' : '#00A86B'})
                    $('.newCustomerVerificationOTP')[0].reset()
                    $('.newCustomerLipalater_error').html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${ data.message }
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `)
                    console.log(data.details)
                    $('#staticBackdropLipaLaterOTPVerification').modal('show')
                    // setTimeout(() => {
                    //     window.location.href = '<?= base_url('registration-details') ?>'
                    // }, 3000)
                }else{
                        $('#newCustomerVerifyButton').html('Continue <i class="fas fa-arrow-right">')
                        errorMessage(data.message, '#confPassword', '#submitFinalLipalaterData', '#ll_confPasswordError')
                    

                    setTimeout(() => {
                        
                        removeErrorMessage('Continue <i class="fas fa-arrow-right">', '#confPassword', 'll_confPasswordError', '#submitFinalLipalaterData')
                    }, 5000)
                }
                if(data.phohone_error || data.nationalId_error || data.firstName_error || data.lastName_error || data.countryCode_error || data.dob_error){
                    alert("please fill all the required fields")
                }

                if (data.phone_error) {
                    $('#phoneError_msg').html(data.phone_error)
                    $('#lipalaterCustomerPhone').css({'border' : '1px solid red'})
                }

                if (data.nationalId_error) {
                    $('#idNumberError_msg').html(data.nationalId_error)
                    $('#lipalaterNationalId').css({'border' : '1px solid red'})
                }

                if (data.firstName_error) {
                    $('#firstNameError_msg').html(data.firstName_error)
                    $('#lipalate_firstName').css({'border' : '1px solid red'})
                }

                if (data.lastName_error) {
                    $('#lastNameError_msg').html(data.lastName_error)
                    $('#lipalater_lastName').css({'border' : '1px solid red'})
                }

                if (data.countryCode_error) {
                    $('#countryCode_error').html(data.countryCode_error)
                    $('#country_code').css({'border' : '1px solid red'})
                } 

                if (data.dob_error) {
                    $('#dobError_msg').html(data.dob_error)
                    $('#lipalater_dob').css({'border' : '1px solid red'})
                }
            }
        })
    })
})

    // ======= CONFIRM OTP CODE ========
$(document).on('submit', '#verify_otp_message', function(e) {
        e.preventDefault()
        const url = $(this).attr('action')
        const formData = new FormData(this)

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            beforeSend: function(){
                $('#otpSubmitButton').text('Connecting please wait...')
            },
            success: function(data) {
                if (data.response === 'success') { // Parse message for successfully verified customers.
                    $('#otpmessage_error').html(``)
                    $('#staticBackdropLipaLaterOTPVerification').modal('hide')
                    $('#customerLimitDetails').modal('show') 
                    $('.success-image').removeClass('d-none')
                    $('.warning-image').addClass('d-none')
                    $('.warning-message').addClass('d-none')
                    $('.success-btn').removeClass('d-none')
                    $('.close-btn').removeClass('d-none')
                    $('.warning-btn').addClass('d-none')
                    $('.credit_limit').text(data.creditLimit)
                    $('.credit_available').text(data.availableLimit)
                    $('.lipalaterPlaceOrder').attr('disabled', false)
                    $('.ll-customername').text('Dear customer')

                    console.log(data.customer_data)
                } else if (data.response === 'zero_limit'){ // Parse message for zero limit customers
                    setTimeout(()=>{
                        $("#loadpaymentinfo").modal("hide")
                        $('.finish').show()
                        $('.lipalaterlogin').hide()
                        $('#status').text('Failed')
                        // $('#icons').html(`<img src="${url + 'assets/img/images/download.png'}" class="fit-image">`)
                        $('.lipatext').html('Dear customer ' + data.message)
                        $('#lipaOrder').hide()
                    },2000)
                } else if (data.response === 'rejected') { // Parse message for rejected customers.
                    $('#otpmessage_error').html(``)
                    $('#staticBackdropLipaLaterOTPVerification').modal('hide')
                    $('#customerLimitDetails').modal('show') 
                    $('.success-warning-message').addClass('d-none')
                    $('.success-image').addClass('d-none')
                    $('.paymentMode').addClass('d-none')
                    $('.multiplyImg').addClass('d-none')
                    $('.rejectedCustomer').removeClass('d-none')
                    $('.ll-rejectCustomer').html(data.message)
                    $('.goToregistrationButton').html(`
                        <div class="col-md-12 col-12 warning-btn">
                            <a href="${data.url}" class="btn btn-success btn-sm btn-block">Sign Up</a>
                        </div>
                    `)
                } else if (data.response === 'low_limit'){ //Parse message for low limit customers
                    $('#otpmessage_error').html(``)
                    $('#staticBackdropLipaLaterOTPVerification').modal('hide')
                    $('#customerLimitDetails').modal('show') 
                    $('.success-image').addClass('d-none')
                    $('.warning-image').removeClass('d-none')
                    $('.warning-message').removeClass('d-none')
                    $('.success-btn').addClass('d-none')
                    $('.close-btn').addClass('d-none')
                    $('.warning-btn').removeClass('d-none')
                    $('.credit_limit').text(data.creditLimit)
                    $('.credit_available').text(data.availableLimit)
                    $('.warning-message').html(data.message)
                    $('.ll-customername').text('Dear customer')
                    
                }else if(data.response === 'newUser'){
                    $('#otpmessage_error').html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${data.message}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `)
                    if(data.url){
                            setTimeout(() => {
                            $('#staticBackdropLipaLaterOTPVerification').modal('hide')
                            window.location.href = data.url
                        }, 3000)
                    }else{
                            setTimeout(() => {
                            $('#staticBackdropLipaLaterOTPVerification').modal('hide')
                        }, 3000)
                    }
                }else{
                    $('#otpmessage_error').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${data.message}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `)
                    setTimeout(() => {
                        $('#otpSubmitButton').text('Submit')
                    }, 3000)
                }

                if (data.otp_errorMessage) {
                    $('#otpmessage_error').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${data.otp_errorMessage}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `)
                    setTimeout(() => {
                        $('#otpSubmitButton').text('Submit')
                    }, 3000)
                }
            }
        })
})

 // ======= LIPALATER VALIDATE EXISTING CUSTOMER ========
$(document).on('submit', '.validateLipalaterCustomer', function(e) {
    e.preventDefault()
    const url = $(this).attr('action')
    const data = new FormData(this)

    $.ajax({
        url: url,
        method: 'POST',
        dataType: 'JSON',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#existingCustomerButton').text('Connecting please wait...')
        },
        success: function(data) {
            if (data.response === 'success') {
                
                $('.validateLipalaterCustomer')[0].reset()
                $('#existingCustomerButton').text('Successfully Done!').css({'background' : '#00A86B'})
                $('.validateCustomer_error').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${data.message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `)
                setTimeout(() => {
                    $('#staticBackdropLipaLaterExistingCustomer').modal('hide')
                    $('#staticBackdropLipaLaterOTPVerification').modal('show')
                    $('.validateCustomer_error').hide()
                }, 3000)
            }else{
                $('.validateCustomer_error').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${data.message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `)
                setTimeout(() => {
                    
                    $('.validateCustomer_error').hide()
                }, 3000)
            }

            if (data.nationalId_error) {
                $('.validateCustomer_error').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${data.nationalId_error}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `)
            }

            if (data.phone_error) {
                $('.validateCustomer_error').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${data.phone_error}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `)
            }
        },
        error: function(error){
            console.log()
        }
    })
})
//  lipa later login and first time user script
$(document).ready(function () {
        $(".lipalaterregister").hide()
        $('#heading').text('Welcome back to Lipalater')
        $("#lll").click(function(){           
            $(".lipalaterlogin").show();
            $(".lipalaterregister").hide();

            $('#heading').text('Welcome back to Lipalater')
        });
        $("#llr").click(function(){           
            $(".lipalaterregister").show();
            $(".lipalaterlogin").hide();

            $('#heading').text('Lipalater Registration')
        });
    
})



// lipalater progress step by step form script
$(document).ready(function(){
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;
    var inputs = userInputs()

    console.log(inputs);
    
    setProgressBar(current);
    
    
    $(".next").click(function(){
    
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        
        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active2");
        
        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;
            
            current_fs.css({
            'display': 'none',
            'position': 'relative'
            });
            next_fs.css({'opacity': opacity});
        },
        duration: 500
        });
        setProgressBar(++current);
    });
    
    $(".previous").click(function(){
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active2");
    
    //show the previous fieldset
    previous_fs.show();
    
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    previous_fs.css({'opacity': opacity});
    },
    duration: 500
    });
    setProgressBar(--current);
    });
    
    function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
    .css("width",percent+"%")
    }
    
    $(".submit").click(function(){
    return false;
    })
    
    });

     // ========= SWITCH BETWEEN OCCUPATIONAL INPUTS =========
    function employmentType(value) {
        if (value === 'Self-Employed') {
            $('.sector').addClass('d-none')
            $('.self_employed').removeClass('d-none')
        } else if (value === '' || value === 'Employed') {
            $('.sector').removeClass('d-none')
            $('.self_employed').addClass('d-none')
        }
    }

    // ========= LIPALATER FUNCTIONS ==========
    function changeOccupation(value){
        if (value === 'Private-Sector') {
            $(".government_sector").addClass('d-none')
            $(".private_sector").removeClass('d-none')
        } else if (value === 'Government-Sector') {
            $(".private_sector").addClass('d-none')
            $(".government_sector").removeClass('d-none')
        } else if (value === '') {
            $(".private_sector").addClass('d-none')
            $(".government_sector").addClass('d-none')
        }
    }
 // end of step by step script


// lipalater submit all data for a new user in ajax
$(document).ready(function(){
	$('#llcancel').on('click',(()=>{
        window.location.href = url
    }))
    $('.submitLipalaterdata').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:url,
            dataType: 'json',
            type: 'post',
            data: data,
            beforeSend: (()=>{

            }),
            sucess: (()=>{
                if (data.response === 'success') {
                }else if(data.response === 'zero_limit'){
                }else if(data.response === 'low_limit'){ 
                    
                }else{}

                if (data.emailError_msg) {}

                if (data.passwordError_msg) {}

                if (data.confPasswordError_msg) {}
            }),
            error: ((error)=>{
                console.log(error);
            })
        })
        
    })
})

$(document).ready(function(){

    
    $('#existingCustomerButton').on('click', ((e)=>{
        e.preventDefault()
        var nationalId = $('#ll_id').val()
        var phone = $('#ll_phoneLabel').val()

        var data = {
            'll_id' : nationalId,
            'll_Phone_number':phone
        }

        $.ajax({
            url: url + 'lipalater/validateExistingCustomer',
            method: 'post',
            dataType: 'json',
            data: data,
            beforeSend: (()=>{
                $("#loadpaymentinfo").modal("show")
            }),
            success: ((data)=>{
                if(data.response === 'success'){
                    $('#msform')[0].reset()
                    setTimeout(()=>{
                        $("#loadpaymentinfo").modal("hide")
                        $('#llOtpmodal').modal('show')
                    },1000)
                }else{
                    setTimeout(()=>{
                        $("#loadpaymentinfo").modal("hide")
                        Command:toastr['error'](data.details)
                    },1000)
                }

                if (data.nationalId_error) {
                    setTimeout(()=>{
                        Command:toastr['error'](data.nationalId_error)
                        $("#loadpaymentinfo").modal("hide")
                        $('#ll_id').css('border','1px solid red').focus()
                    },3000)
                }

                if (data.phone_error) {
                    setTimeout(()=>{
                        Command:toastr['error'](data.phone_error)
                        $("#loadpaymentinfo").modal("hide")
                        $('#ll_id').css('border','1px solid red').focus()
                    },3000)
                }
            }),
            error: ((err)=>{
                console.log(err);
            })
        })
    }))

    $('.finish').hide()

    $('#otpSubmitButton').on('click', ((e)=>{
        e.preventDefault()
        // const urls = $(this).attr('action')
        var otp =$('#otpSMS').val()
        var data = {
            'otpSMS': otp
        }

        $.ajax({
            url: url + 'lipalater/verifyOTPMessage',
            method: 'post',
            dataType: 'json',
            data: data,
            beforeSend: function(){
                $('#llOtpmodal').modal('hide')
                $("#loadpaymentinfo").modal("show")
            },
            success: function(data) {
                if (data.response === 'success') { // Parse message for successfully verified customers.
                    setTimeout(()=>{
                        $("#loadpaymentinfo").modal("hide")
                        $('.lipalaterlogin').hide()
                        $('.finish').show()
                        $('#icons').html(`<img src="https://i.imgur.com/GwStPmg.png" class="fit-image">`)
                        $('.credit_limit').text(data.creditLimit)
                        $('.credit_available').text(data.availableLimit)
                        $('#loanamount').text(data.loanamount)
                        $('#upfrontpay').text(data.upfront_fee)
                        $('#firstpay').text(data.first_installment)
                        $('#montlhlypay').text(data.minimum_payment)
                    },2000)

                    
                } else if (data.response === 'zero_limit'){ // Parse message for zero limit customers
                    setTimeout(()=>{
                        $("#loadpaymentinfo").modal("hide")
                        $('.finish').show()
                        $('.lipalaterlogin').hide()
                        $('#loandetail').hide()
                        $('#status').text('Failed')
                        $('#limitstatus').text('Zero Limit')
                        // $('#icons').html(`<img src="${url + 'assets/img/images/download.png'}" class="fit-image">`)
                        $('.lipatext').html('Dear customer ' + data.message)
                        $('#lipaOrder').hide()
                        $('.credit_limit').text('0.00')
                        $('.credit_available').text('0.00')
                    },2000)
                   
                } else if (data.response === 'rejected') { // Parse message for rejected customers.
                    setTimeout(()=>{
                        $("#loadpaymentinfo").modal("hide")
                        $('.lipalaterlogin').hide()
                        $('.finish').show()
                        $('#limitstatus').text('Rejected')
                        $('#status').text('Failed')
                        $('#status').text(data.response).css('color', 'red')
                        // $('#icons').html(`<img src="${url + 'assets/img/images/download.png'}" class="fit-image">`)
                        $('#loandetails').hide()
                        $('.lipatext').html(data.message)
                        $('#lipaOrder').hide()
                    },2000)
                    
                } else if (data.response === 'low_limit'){ //Parse message for low limit customers
                    setTimeout(()=>{
                        $("#loadpaymentinfo").modal("hide")
                        $('.lipalaterlogin').hide()
                        $('.finish').show()
                        $('#status').text('Failed')
                        $('#limitstatus').text('Low Limit')
                        // $('#icons').html(`<img src="https://i.imgur.com/GwStPmg.png" width="20" class="fit-image">`)
                        $('.credit_limit').text(data.creditLimit)
                        $('.credit_available').text(data.availableLimit)
                        $('.lipatext').html(data.message)
                        $('#loandetail').hide()
                        $('#lipaOrder').hide()
                    },2000)
                   
                    
                }else if(data.response === 'newUser'){
                    $('#otpmessage_error').html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${data.message}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `)
                    if(data.url){
                            setTimeout(() => {
                            $('#staticBackdropLipaLaterOTPVerification').modal('hide')
                            window.location.href = data.url
                        }, 3000)
                    }else{
                            setTimeout(() => {
                            $('#staticBackdropLipaLaterOTPVerification').modal('hide')
                        }, 3000)
                    }
                }else{
                    setTimeout(()=>{
                        $("#loadpaymentinfo").modal("hide")
                        Command:toastr['error'](data.message)
                    },100)
                }

                if (data.otp_errorMessage) {
                    setTimeout(()=>{
                        $("#loadpaymentinfo").modal("hide")
                        Command:toastr['error'](data.otp_errorMessage)
                    },100)
                    // setTimeout(() => {
                    //     $('#otpSubmitButton').text('Submit')
                    // }, 3000)
                }
            }
        })
    }))
	
	$('#lipaOrder').on('click', ((e)=>{
        e.preventDefault()
        url = url + 'lipalater/createPurches'
        $.ajax({
            url: url,
            method: 'post',
            dataType: 'json',
            beforeSend: function(){
                
                $("#loadpaymentinfo").modal("show")
            },
            success: function(response){
                if(response.response === "success"){
                    $("#loadpaymentinfo").modal("hide")
                    let timerInterval
                    new swal({
                        title: "Order successfully placed!",
                        text: response.message,
                        html: 'Redirecting in <b></b> milliseconds.',
                        icon: "success",
                        allowOutsideClick: false,
                        timer: 5000,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = (Swal.getTimerLeft() / 1000).toFixed(0)
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.href = url + 'checkout/successOrder'
                        }
                    });
                }else{
                    $('#loadpaymentinfo').modal('hide')
                    if(response.title === 'Customer Not Found'){
                        var customer = 'No customer with id  found, Please register to continue with the purches'
                        Command:toastr['error'](customer)
                    }else{
                        
                    }
                }
            }
        })
    }))
})

function userInputs(){
    const url=$(this).attr('action');
    const firstName = $("#firstName").val();
    const lastName = $("#lastName").val();
    const phoneNumber = $("#customerPhoneNumber").val();
    const nationalId = $("#nationalIdNumber").val();
    const dateOfBirth = $("#dateOfBirth").val();
    const maritalStatus = $("#customerMarital").val();
    const customerGender = $("#customerGender").val();
    const employmentStatus = $('#employmentStatus').val();
    const employmentSector = $('#employmentSector').val();
    const employerName = $("#employerName").val();
    const jobFunction = $("#jobFunction").val();
    const jobLevel = $("#jobLevel").val();
    const paymentMode1 = $("#modeOfPayment1").val();
    const netIncome1 = $("#netMonthlyIncome1").val();
    const monthlyExpenses1 = $("#monthlyExpenses1").val();
    const companyName = $('#companyName').val();
    const jobGroup = $('#customerjobGroup').val();
    const paymentMode = $('#paymentMode').val();
    const netIncome = $('#netMonthlyIncome').val();
    const monthlyExpenses = $('#monthlyExpenses').val();
    const jobgroups = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T'];
    const businessType = $('#businessType').val();
    const paymentMethod = $('#getPaymentMode').val();
    const businessIndustry = $('#businessIndustry').val();
    const averageMonthlyPersonalExpenses = $('#personalExpense').val();
    const grossMonthlyRevenue = $('#monthlyBusinessRevenue').val();
    const averageMonthlyBussinessExpenses = $('#monthlyBusinessExpenses').val();
    const businessName = $('#business_name').val();
    const businessLocation = $('#business_location').val();
    const businessRegistration = $('#business_registered').val()
    const email = $('#ll_email').val()
    const password = $('#ll_password').val()
    const confirmPassword = $('#confPassword').val()

    // var year = dateOfBirth.substring(0,4)
    // var month = dateOfBirth.substring(5,7)
    // var day = dateOfBirth.substring(8,10)
    // var dob = { year:year, month: month, day: day }
    // const userDOB = dob.month +'/' + dob.day  + '/' +dob.year
    const data ={
        first_name: firstName,
        last_name: lastName,
        phone: phoneNumber,
        id: nationalId,
        dob: dateOfBirth,
        user_dob: dateOfBirth,
        marital_status: maritalStatus,
        gender: customerGender,
        
        employer: employerName,
        job_function: jobFunction,
        job_level: jobLevel,
        payment_mode: paymentMode1,
        net_income: netIncome1,
        monthly_expenses: monthlyExpenses1,
        
        employer: companyName,
        job_group: jobGroup,
        payment_mode: paymentMode,
        net_income: netIncome,
        monthly_expense: monthlyExpenses,
        
        business_type: businessType,
        payment_mode: paymentMethod,
        business_industry: businessIndustry,
        monthly_personal_expenses: averageMonthlyPersonalExpenses,
        gross_monthly_revenue: grossMonthlyRevenue,
        average_business_expenses: averageMonthlyBussinessExpenses,
        business_name: businessName,
        bussiness_location: businessLocation,
        business_registration: businessRegistration,

        employmentStatus: employmentStatus,
        
        email: email,
        password: password,
        conf_password: confirmPassword
    }

    return data
} 
