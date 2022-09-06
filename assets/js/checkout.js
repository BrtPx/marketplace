
// a_event 

let a_event = document.querySelectorAll(".a_event");
let a_meganav = document.querySelectorAll(".a_meganav");
let slide_toggle = document.querySelector("#toggle_slide");


for(let i = 0;i < a_event.length;i++){
    // onmouseleave
    onmouseleave(i)
    
    // onclick
    onclick(i)

    // onhover
    onhover(i)

    a_meganav[i].addEventListener("mouseenter", (e)=> {
            e.target.classList.add("slide_active_d_hover");
    })

    a_meganav[i].addEventListener("mouseleave", (e)=> {
            e.target.classList.remove("slide_active_d_hover");
    })

}

function onhover(num){
    a_event[num].onmouseenter=(e)=>{
        e.stopPropagation()
        
        if(a_event[num].classList.contains("a_event_"+num)){
            for(let i = 0;i < a_meganav.length;i++){
                if(a_meganav[i].classList.contains("a_event_child_"+num)){
                    a_meganav[i].classList.add("slide_active_d");
                }
            }
        }
    }
}

function onclick(num){
    a_event[num].onclick=(e)=>{
        e.stopPropagation()
        
        if(a_event[num].classList.contains("a_event_"+num)){
            for(let i = 0;i < a_meganav.length;i++){
                if(a_meganav[i].classList.contains("a_event_child_"+num)){
                    a_meganav[i].classList.add("slide_active_d");
                }
            }
        }
    }
}

function onmouseleave(num){
    a_event[num].addEventListener("mouseleave", ()=> {
        if(a_event[num].classList.contains("a_event_"+num)){
            for(let i = 0;i < a_meganav.length;i++){
                if(a_meganav[i].classList.contains("a_event_child_"+num)){
                    a_meganav[i].classList.remove("slide_active_d");
                }
            }
        }
    });
}

// a

let toggle_p = document.querySelector(".toggle-p");
let toggle_p2 = document.querySelector(".toggle-p2");
let slide = document.querySelector(".hero-child-1");

toggle_p.onclick=(e)=>{
    e.stopPropagation()
    slide.classList.toggle("hero-child-1_active");
}
toggle_p.onmouseenter=(e)=>{
    e.stopPropagation()
    slide.classList.add("hero-child-1_active");
}

document.querySelector("header").addEventListener("click", () => {
    slide.classList.remove("hero-child-1_active");
});

document.querySelector(".wrap-middle").addEventListener("click", () => {
    slide.classList.remove("hero-child-1_active");
});

// when you mouseenter

let toggle_slide = document.querySelector("#toggle_slide");
toggle_slide.addEventListener("mouseenter", () => {
    toggle_slide.classList.add("slide_active_d_hover")
});
toggle_slide.addEventListener("mouseleave", () => {
    toggle_slide.classList.remove("slide_active_d_hover")
});

// 


window.addEventListener("scroll", (e) => {
    // let nav_scroll = document.getElementById("nav_scroll");
    let nav_scroll = document.querySelector(".checkout-right");
    let footer_offset = document.querySelector(".footer-bottom");

    if(window.scrollY + 470 >= nav_scroll.offsetTop){
        document.querySelector(".scroll-nav-ul").classList.add("nav_fixed_middle");
        document.querySelector(".scroll-nav-ul li a").classList.add("transition-1");
        document.querySelector(".path-normal").classList.add("transition-1");
        document.querySelector(".path-normal-1").classList.add("transition-1");
    }else if(window.scrollY <= nav_scroll.offsetTop){
        document.querySelector(".scroll-nav-ul").classList.remove("nav_fixed_middle");
        document.querySelector(".scroll-nav-ul li a").classList.remove("transition-1");
        document.querySelector(".path-normal").classList.remove("transition-1");
        document.querySelector(".path-normal-1").classList.remove("transition-1");
    }
    if(window.scrollY + 550 >= footer_offset.offsetTop){
        document.querySelector(".scroll-nav-ul").classList.remove("nav_fixed_middle");
        document.querySelector(".scroll-nav-ul li a").classList.remove("transition-1");
        document.querySelector(".path-normal").classList.remove("transition-1");
        document.querySelector(".path-normal-1").classList.remove("transition-1");
    }
});


// e.target.parentElement.parentElement.nextElementSibling.style.display = "none";

let checkbox = document.querySelectorAll(".checkbox");

checkbox[0].checked = true;

if(checkbox[0].checked){
    checkbox[0].parentElement.parentElement.nextElementSibling.style.display = "block";
}else{
    checkbox[0].parentElement.parentElement.nextElementSibling.style.display = "none";
}

for(let i = 0;i < checkbox.length;i++){
    checkbox[i].addEventListener("click", (e) => {
        if(checkbox[0].checked){
            checkbox[0].parentElement.parentElement.nextElementSibling.style.display = "block";
        }else{
            checkbox[0].parentElement.parentElement.nextElementSibling.style.display = "none";
        }

        // checkbox 1

        if(checkbox[1].checked){
            checkbox[1].parentElement.parentElement.nextElementSibling.style.display = "block";
        }else{
            checkbox[1].parentElement.parentElement.nextElementSibling.style.display = "none";
        }
        
        // checkbox 2

        if(checkbox[2].checked){
            checkbox[2].parentElement.parentElement.nextElementSibling.style.display = "block";
        }else{
            checkbox[2].parentElement.parentElement.nextElementSibling.style.display = "none";
        }
        
        //checkbox 3
        if(loginStatus == 1){

            if(checkbox[3].checked){
                checkbox[3].parentElement.parentElement.nextElementSibling.style.display = "block";
            }else{
                checkbox[3].parentElement.parentElement.nextElementSibling.style.display = "none";
            }
        }
        
        // checkbox 4

    });
}


/* Editable change button */
if(title == 'Checkout Page'){
let change_phone_number = document.querySelector(".change_phone_number");
let class_number = document.querySelector(".class_number");

change_phone_number.addEventListener('click', function () {
    class_number.removeAttribute("readonly");
    class_number.focus();
});

class_number.addEventListener('blur', function () {
    class_number.setAttribute("readonly", "");
});

/* */

let change_ship_location = document.querySelector(".change_ship_location");
let class_location = document.querySelector(".class_location");

change_ship_location.addEventListener('click', function () {
    class_location.removeAttribute("readonly");
    class_location.focus();
});

class_location.addEventListener('blur', function () {
    class_location.setAttribute("readonly", "");
});

}


$(document).ready(function() {
    var owner = $('#owner');
    var cardNumber = $('#cardNumber');
    var cardNumberField = $('#card-number-field');
    var CVV = $("#cvv");
    var expiryDate = $("#exp-date");
    var mastercard = $("#mastercard");
    var confirmButton = $('#confirm-purchase');
    var visa = $("#visa");
    var amex = $("#amex");

    // Use the payform library to format and validate
    // the payment fields.
	
    cardNumber.payform('formatCardNumber');
    CVV.payform('formatCardCVC');
    expiryDate.payform('formatCardExpiry');
	
    cardNumber.keyup(function() {

            amex.removeClass('transparent');
            visa.removeClass('transparent');
            mastercard.removeClass('transparent');

            if ($.payform.validateCardNumber(cardNumber.val()) == false) {
                cardNumberField.addClass('has-error');
            } else {
                cardNumberField.removeClass('has-error');
                cardNumberField.addClass('has-success');
            }

            if ($.payform.parseCardType(cardNumber.val()) == 'visa') {
                mastercard.addClass('transparent');
                amex.addClass('transparent');
            } else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {
                mastercard.addClass('transparent');
                visa.addClass('transparent');
            } else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {
                amex.addClass('transparent');
                visa.addClass('transparent');
            }
        });

        var stripeKey = $("#stripesecrete").val();
        Stripe.setPublishableKey(stripeKey);

      $('.guestplaceOrderButton').on("click", function(e){
        e.preventDefault()

        var shippingNumber = $('#guestshippingnumber').val()
        var payment_mode = $('.payment:checked').val()
        let firstname = $('#guestfirstName').val()
        let lastName = $('#guestlastName').val()
        let county = $('#guestcounty').val()
        let checkoutRegion = $('#guestregion').val()
        let delivery_address = $('#guestdelivery_address').val()
        let emailAddress = $('#guestemail_address').val()
        let mpesaNumber = $('#phoneNumber').val()
        let pickupnotes = $('#guestpickupnotes').val()
        
        var data = {
            'shippingphoneNumber': shippingNumber,
            'payment_mode': payment_mode,
            'firstname': firstname,
            'lastName': lastName,
            'county': county,
            'checkoutRegion': checkoutRegion,
            'delivery_address': delivery_address,
            'emailAddress': emailAddress,
            'mpesaphone_number': mpesaNumber,
            'pickupnotes': pickupnotes
        }
        
        if(cartTotal > 0){
           
            if (payment_mode == 1) {
                $.ajax({
                    url: url + 'checkout/guestPayments',
                    method: 'post',
                    dataType: 'json',
                    data: data,
                    beforeSend: ()=>{
                        
                        $("#loadpaymentinfo").modal(
                            "show")
                       
                    },
                    success:function(data){
                        if(data.response == 'success'){
                            // $('#')[0].reset()
                            setTimeout(function() {
                                $("#loadpaymentinfo").modal("hide")
                                
                                $("#confirmPaymentInformation").modal(
                                    "show")
                            }, 3500)
                            completePayment()
                        }
                        if(data.response == 'warning'){
                            setTimeout(function() {
                                $("#loadpaymentinfo").modal("hide")
                                Command: toastr['warning'](data.message)
                                $("#guestemailAddress").css("border", "1px solid red").focus()
                            }, 3500)

                        }
                        if(data.firstname_error){
                            setTimeout(function() {
                                $("#loadpaymentinfo").modal("hide")
                                $("#guestcheckout_name").text(data.firstName_error)
                                $("#guestfirstName").css("border", "1px solid red").focus()
                                Command: toastr["error"](data.firstname_error)
                            }, 3500)
                        }
                        if(data.lastname_error){
                            setTimeout(function() {
                                $("#loadpaymentinfo").modal("hide")
                                $("#guestlastName").css("border", "1px solid red").focus()
                                Command: toastr["error"](data.lastname_error)

                            }, 3500)

                        }
                        if(data.email_error){
                            setTimeout(function() {
                                $("#loadpaymentinfo").modal("hide")
                                $("#guestemail_address").css("border", "1px solid red").focus()
                                Command: toastr["error"](data.email_error)
                            }, 3500)

                        }
                        if(data.phonenumber_error){
                            setTimeout(function() {
                                $("#loadpaymentinfo").modal("hide")
                                $("#guestshippingnumber").css("border", "1px solid red").focus()
                                Command: toastr["error"](data.phonenumber_error)
                            }, 3500)

                        }
                        if(data.mpesaphone_number){
                            setTimeout(function() {
                                $("#loadpaymentinfo").modal("hide")
                                Command: toastr["error"](data.mpesaphone_number)
                            }, 2000)
                            $("#validatempesa").html(
                                `
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Please enter valid mpesa number
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                `
                            )

                        }
                    },
                    error: function(error){
                        console.log(error)
                    }
                })
            }else if (payment_mode == 2) {
                        $.ajax({
                        url: url + 'checkout/guestPayments',
                        method: 'post',
                        dataType: 'json',
                        data: data,
                        beforeSend: function(){
                            $('#loadpaymentinfo').modal('show')
                        },
                        success: function(data) {
                            if(data.response == 'success'){
                                $("#loadpaymentinfo").modal("hide")
                                let timerInterval
                                new swal({
                                    title: "Order successfully placed!",
                                    text: data.message,
                                    html: 'Redirecting in <b></b> milliseconds.',
                                    icon: "success",
                                    allowOutsideClick: false,
                                    timer: 5000,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        const b = Swal.getHtmlContainer()
                                            .querySelector('b')
                                        timerInterval = setInterval(() => {
                                            b.textContent = (Swal
                                                    .getTimerLeft() / 1000)
                                                .toFixed(0)
                                        }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        window.location.href = url + 'checkout/successOrder'
                                    }
                                });
                            }
                            if(data.response == 'warning'){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    Command: toastr['warning'](data.message)
                                    $("#guestemailAddress").css("border", "1px solid red").focus()
                                }, 3500)

                            }
                            if(data.firstname_error){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    $("#guestcheckout_name").text(data.firstName_error)
                                    $("#guestfirstName").css("border", "1px solid red").focus()
                                    Command: toastr["error"](data.firstname_error)
                                }, 3500)
                            }
                            if(data.lastname_error){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    $("#guestlastName").css("border", "1px solid red").focus()
                                    Command: toastr["error"](data.lastname_error)

                                }, 3500)

                            }
                            if(data.email_error){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    $("#guestemailAddress").css("border", "1px solid red").focus()
                                    Command: toastr["error"](data.email_error)
                                }, 3500)

                            }
                            if(data.phonenumber_error){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    $("#guestphoneNumber").css("border", "1px solid red").focus()
                                    Command: toastr["error"](data.phonenumber_error)
                                }, 3500)

                            }
                            if(data.mpesaphonenumber_error){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    Command: toastr["error"](data.mpesaphonenumber_error)
                                }, 3500)

                            }
                        },
                        error: function(error) {
                            console.log()
                        }
                    })
                


            }else if(payment_mode == 3){

                var isCardValid = $.payform.validateCardNumber(cardNumber.val());
                var isCvvValid = $.payform.validateCardCVC(CVV.val());
                var isDateValid = $.payform.validateCardExpiry(expiryDate.val());
                var exp_month = String(expiryDate.val()).substr(0,3)
                var exp_year = String(expiryDate.val()).substr(4,6)

                if(owner.val().length < 5){

                    Comand:toastr['error']('Wrong Holders name')
                    owner.css('border', '1px solid red').focus()
                    cardNumber.css('border', '')
                } else if (!isCardValid) {
                    Comand:toastr['error']('Wrong card number')
                    cardNumber.css('border', '1px solid red').focus()
                    owner.css('border', '')
                } else if (!isCvvValid) {
                    Comand:toastr['error']('Wrong CVV')
                    CVV.css('border', '1px solid red').focus()
                    cardNumber.css('border', '')
                    owner.css('border', '')

                }
                else{
                        stripPyments('checkout/guestPayments');
                    }
            }else if(payment_mode == 4){                    
                $.ajax({
                    url: url + 'lipalater/loadLipa',
                    method: 'post',
                    dataType: 'json',
                    beforeSend: (()=>{
                        $("#loadpaymentinfo").modal("show")
                    }),
                    success: function(response){
                        if(response.response === 'error'){
                            setTimeout(()=>{
                                $("#loadpaymentinfo").modal("hide")
                                Command:toastr['error'](response.message)
                            },500)  
                        }else{
                            window.location.href= url + 'checkout/buynowpaylater/lipalater-checkout'
                        }

                    }
                })
            }

        }else{
            Command: toastr['error']("Your cart is empty!!")
        }
      })



    $('.placeOrderButton').on("click", function(e) {
        e.preventDefault()
        
        var shippingNumber = $('#shippingnumber').val()
        var payment_mode = $('.payment:checked').val()
        let firstname = $('#firstName').val()
        let lastName = $('#lastName').val()
        let county = $('#county').val()
        let checkoutRegion = $('#region').val()
        let delivery_address = $('#delivery_address').val()
        let emailAddress = $('#email_address').val()
        let mpesaNumber = $('#phoneNumber').val()
        let pickupnotes = $('#pickupnotes').val()
        // let terms = $('#defaultCheck10:checked').val()

        var data = {
            'shippingphoneNumber': shippingNumber,
            'payment_mode': payment_mode,
            'firstname': firstname,
            'lastName': lastName,
            'county': county,
            'checkoutRegion': checkoutRegion,
            'delivery_address': delivery_address,
            'emailAddress': emailAddress,
            'mpesaphone_number': mpesaNumber,
            'pickupnotes': pickupnotes
        }
        
        if (cartTotal > 0) {
                if (payment_mode == 1) {
                        $.ajax({
                            url: url + 'checkout/mpesaPayment',
                            method: 'post',
                            dataType: 'json',
                            data: data,
                            beforeSend: (()=>{
                                $('#loadpaymentinfo').modal('show')
                            }),
                            success: function(data) {

                                if (data.response == 'success') {
                                    // $('#')[0].reset()
                                    setTimeout(function() {
                                        $("#loadpaymentinfo").modal("hide")
                                        $("#confirmPaymentInformation").modal("show")
                                    }, 2000)
                                    completePayment()
                                }

                                if(data.firstename_error){
                                    setTimeout(function() {
                                        $("#loadpaymentinfo").modal("hide")
                                        // $("#firstName").text(data.firstName_error)
                                        $("#firstName").css("border", "1px solid red").focus()
                                        Command: toastr["error"](data.firstname_error)
                                    }, 3500)
                                }
                                if(data.lastname_error){
                                    setTimeout(function() {
                                        $("#loadpaymentinfo").modal("hide")
                                        $("#lastName").css("border", "1px solid red").focus()
                                        Command: toastr["error"](data.lastname_error)

                                    }, 3500)

                                }
                                if(data.emailAddress){
                                    setTimeout(function() {
                                        $("#loadpaymentinfo").modal("hide")
                                        $("#email_address").css("border", "1px solid red").focus()
                                        Command: toastr["error"](data.emailAddress)
                                    }, 2000)

                                }
                                if(data.shippingphoneNumber){
                                    setTimeout(function() {
                                        $("#loadpaymentinfo").modal("hide")
                                        $("#shippingnumber").css("border", "1px solid red").focus()
                                        Command: toastr["error"](data.shippingphoneNumber)
                                    }, 2000)

                                }
                                if(data.mpesaphone_number){
                                    setTimeout(function() {
                                        $("#loadpaymentinfo").modal("hide")
                                        Command: toastr["error"](data.mpesaphone_number)
                                    }, 2000)
                                    $("#validatempesa").html(
                                        `
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                Please enter valid mpesa number
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        `
                                    )
                                    // Command: toastr["error"]("Enter Valid mpesa number")

                                }

                                if(data.checkoutRegion){
                                    setTimeout(function() {
                                        $("#loadpaymentinfo").modal("hide")
                                        Command: toastr["error"](data.checkoutRegion)
                                    }, 2000)

                                }

                                if(data.county){
                                    setTimeout(function() {
                                        $("#loadpaymentinfo").modal("hide")
                                        Command: toastr["error"](data.county)
                                    }, 2000)

                                }

                            },
                            error: function(error) {
                                console.log(error)
                            }

                        });

                    
                } else if (payment_mode == 2) {
                        $.ajax({
                        url: url + 'checkout/mpesaPayment',
                        method: 'post',
                        dataType: 'json',
                        data: data,
                        beforeSend: (()=>{
                            $('#loadpaymentinfo').modal('show')
                        }),
                        success: function(data) {
                            if(data.response === 'success'){

                                $('#loadpaymentinfo').modal('hide')
                                let timerInterval
                                new swal({
                                    title: "Order successfully placed!",
                                    text: data.message,
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
                            }

                            if(data.firstename_error){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    // $("#firstName").text(data.firstName_error)
                                    $("#firstName").css("border", "1px solid red").focus()
                                    Command: toastr["error"](data.firstname_error)
                                }, 3500)
                            }
                            if(data.lastname_error){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    $("#lastName").css("border", "1px solid red").focus()
                                    Command: toastr["error"](data.lastname_error)

                                }, 3500)

                            }
                            if(data.emailAddress){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    $("#email_address").css("border", "1px solid red").focus()
                                    Command: toastr["error"](data.emailAddress)
                                }, 2000)

                            }
                            if(data.shippingphoneNumber){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    $("#shippingnumber").css("border", "1px solid red").focus()
                                    Command: toastr["error"](data.shippingphoneNumber)
                                }, 2000)

                            }
                            if(data.mpesaphone_number){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    Command: toastr["error"](data.mpesaphone_number)
                                }, 2000)
                                $("#validatempesa").html(
                                    `
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Please enter valid mpesa number
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    `
                                )
                                // Command: toastr["error"]("Enter Valid mpesa number")

                            }

                            if(data.checkoutRegion){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    Command: toastr["error"](data.checkoutRegion)
                                }, 2000)

                            }

                            if(data.county){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    Command: toastr["error"](data.county)
                                }, 2000)

                            }
                        },
                        error: function(error) {
                            console.log()
                        }
                    })

                }else if(payment_mode == 3){

                    var isCardValid = $.payform.validateCardNumber(cardNumber.val());
                    var isCvvValid = $.payform.validateCardCVC(CVV.val());
                    var isDateValid = $.payform.validateCardExpiry(expiryDate.val());
                    var exp_month = String(expiryDate.val()).substr(0,3)
                    var exp_year = String(expiryDate.val()).substr(4,6)
    
                    if(owner.val().length < 5){
    
                        Comand:toastr['error']('Wrong Holders name')
                        owner.css('border', '1px solid red').focus()
                        cardNumber.css('border', '')
                    } else if (!isCardValid) {
                        Comand:toastr['error']('Wrong card number')
                        cardNumber.css('border', '1px solid red').focus()
                        owner.css('border', '')
                    } else if (!isCvvValid) {
                        Comand:toastr['error']('Wrong CVV')
                        CVV.css('border', '1px solid red').focus()
                        cardNumber.css('border', '')
                        owner.css('border', '')
    
                    }
                    else{
                            stripPyments('checkout/mpesaPayment');
                        }
                }else if(payment_mode == 4){                    
                    $.ajax({
                        url: url + 'lipalater/loadLipa',
                        method: 'post',
                        dataType: 'json',
                        beforeSend: (()=>{
                            $("#loadpaymentinfo").modal("show")
                        }),
                        success: function(response){
                            if(response.response === 'error'){
                                setTimeout(()=>{
                                    $("#loadpaymentinfo").modal("hide")
                                    Command:toastr['error'](response.message)
                                },500)  
                            }else{
                                window.location.href= url + 'checkout/buynowpaylater/lipalater-checkout'
                            }

                        }
                    })
                }
            
        } else {
            Command: toastr['error']("Your cart is empty!!")
        }

    })

    $('select[name="shippingCounty"]').on('change', function(e) {
        e.preventDefault()
        var countyCode = $(this).val()
        var data = {
            county_code: countyCode
        }
        $.get(url + 'checkout/get_regiondata', data, function(response) {
            var data = JSON.parse(response)
            $('select[name="shippingRegion"]').html('');
            $.each(data, function(key, value) {
                $('select[name="shippingRegion"]').append(`
                    <option value="${ value.region_name }">${ value.region_name }</option>
                        `)
            })
        })
    })

    
        var countyCode = $('select[name="shippingCounty"]').val()
        var data = {
            county_code: countyCode
        }
        $.get(url + 'checkout/get_regiondata', data, function(response) {
            var data = JSON.parse(response)
            $('select[name="shippingRegion"]').html('');
            $.each(data, function(key, value) {
                $('select[name="shippingRegion"]').append(`
                    <option value="${ value.region_name }"
                    ${(value.region_name == region) ? 'selected' : ''}
                    >${ value.region_name }</option>
                        `)
            })
        })

})


function completePayment(){
    $("#paymentConfirmation").on("click", function(e) {

    var data = {
        phonenumber: phoneNumber
    }
    $.ajax({
        url: url + 'checkout/getPayment',
        method: 'post',
        dataType: 'json',
        data: data,
        success: function(data) {

            if (data.response ==
                'success') {
                setTimeout(() => {
                    $("#confirmPaymentInformation").modal("hide")
                    let timerInterval
                    new swal
                        ({
                            title: "Payment received!",
                            text: data.message,
                            html: 'Redirecting in <b></b> milliseconds.',
                            icon: "success",
                            allowOutsideClick: false,
                            timer: 5000,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval=setInterval(() => {
                                            b.textContent =(Swal.getTimerLeft() / 1000).toFixed(0)
                                        },100
                                    )
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.href = url + 'checkout/successOrder'
                                }
                            }
                        );
                }, 2000);

            } else if (data
                .response == 'error'
            ) {
                $("#confirmPaymentInformation")
                    .modal("hide")
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                    footer: '<a href="">Why do I have this issue?</a>'
                })
            } else {
                $("#confirmPaymentInformation").modal("hide")
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',

                })
            }


        },
        error: function(error) {
            console.log(error)
        }
    })
})
}

function stripPyments(enpointurl){
    var owner = $('#owner');
    var cardNumber = $('#cardNumber');
    var cardNumberField = $('#card-number-field');
    var CVV = $("#cvv");
    var expiryDate = $("#exp-date");
    var mastercard = $("#mastercard");
    var confirmButton = $('#confirm-purchase');
    var visa = $("#visa");
    var amex = $("#amex");
    var exp_month = String(expiryDate.val()).substr(0,3)
    var exp_year = String(expiryDate.val()).substr(4,6)

    var shippingNumber = $('#shippingnumber').val()
    var payment_mode = $('.payment:checked').val()
    let firstname = $('#firstName').val()
    let lastName = $('#lastName').val()
    let county = $('#county').val()
    let checkoutRegion = $('#region').val()
    let delivery_address = $('#delivery_address').val()
    let emailAddress = $('#email_address').val()
    let mpesaNumber = $('#phoneNumber').val()
    let pickupnotes = $('#pickupnotes').val()

    var cardaform = $("#paymentCard")
            cardaform.find('#token').val('');
            Stripe.card.createToken({
                number: cardNumber.val(),
                cvc: CVV.val(),
                exp_month:parseInt(exp_month),
                exp_year: parseInt(exp_year)
            }, function(status, response){
                if(response.error){
                    Command: toastr['error'](response.error.message)
                }else{
                    var data = {
                        'shippingphoneNumber': shippingNumber,
                        'payment_mode': payment_mode,
                        'firstname': firstname,
                        'lastName': lastName,
                        'delivery_address': delivery_address,
                        'emailAddress': emailAddress,
                        'county': county,
                        'checkoutRegion': checkoutRegion,
                        'pickupnotes': pickupnotes,
                        'token': response.id
                    }
                    //sett the token value
                    var token =$("token").val();
                    cardaform.find('[name="token"]').val(response.id)
                    $.ajax({
                        url: url + enpointurl,
                        method: 'post',
                        dataType: 'json',
                        data:data,
                        beforeSend: function(){
                            $('#loadpaymentinfo').modal('show')
                        },
                        success: function(res){
                            if(res.success === true){
                                
                                let timerInterval
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")

                                    new swal({
                                        title: "Order successfully placed!",
                                        text: data.message,
                                        html: 'Redirecting in <b></b> milliseconds.',
                                        icon: "success",
                                        allowOutsideClick: false,
                                        timer: 5000,
                                        didOpen: () => {
                                            Swal.showLoading()
                                            const b = Swal.getHtmlContainer()
                                                .querySelector('b')
                                            timerInterval = setInterval(() => {
                                                b.textContent = (Swal
                                                        .getTimerLeft() / 1000)
                                                    .toFixed(0)
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
                                    
                                }, 3500)
                                
    
                            }else if(res.success != true){
                                $("#loadpaymentinfo").modal('hide')
                                Command:toastr['warning'](res.data)
                            }

                            if(res.response == 'warning'){
                                setTimeout(function() {    
                                    $("#loadpaymentinfo").modal("hide")
                                    Command: toastr['warning'](res.message)
                                    $("#guestemailAddress").css("border", "1px solid red").focus()
                                }, 3500)
                                
                            }
                            if(res.firstname_error){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    $("#guestcheckout_name").text(res.firstName_error)
                                    $("#guestfirstName").css("border", "1px solid red").focus()
                                    Command: toastr["error"](res.firstname_error)
                                }, 3500)  
                            }
                            if(res.lastname_error){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    $("#guestlastName").css("border", "1px solid red").focus()
                                    Command: toastr["error"](res.lastname_error)
                                    
                                }, 3500)
                                
                            }
                            if(res.email_error){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    $("#guestemailAddress").css("border", "1px solid red").focus()
                                    Command: toastr["error"](res.email_error)
                                }, 3500)
                                
                            }
                            if(res.phonenumber_error){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    $("#guestphoneNumber").css("border", "1px solid red").focus()
                                    Command: toastr["error"](res.phonenumber_error)
                                }, 3500)
                                
                            }
                            if(res.mpesaphonenumber_error){
                                setTimeout(function() {
                                    $("#loadpaymentinfo").modal("hide")
                                    Command: toastr["error"](res.mpesaphonenumber_error)
                                }, 3500)
                                
                            }
                            
                        }
                    })
                }
            })
}

function CheckoutStripePayment(){

    var owner = $('#owner');
    var cardNumber = $('#cardNumber');
    var cardNumberField = $('#card-number-field');
    var CVV = $("#cvv");
    var expiryDate = $("#exp-date");
    var mastercard = $("#mastercard");
    var confirmButton = $('#confirm-purchase');
    var visa = $("#visa");
    var amex = $("#amex");
    var exp_month = String(expiryDate.val()).substr(0,3)
    var exp_year = String(expiryDate.val()).substr(4,6)

        var phone_number = $('#confirmationNumber').val()
        var payment_mode = $('.payment:checked').val()

        let firstname = $('#firstName').val()
        let lastName = $('#lastName').val()
        let companyName = $('#companyName').val()
        let county = $('#county').val()
        let checkoutRegion = $('#checkoutRegion').val()
        let checkoutStreetNames = $('#checkoutStreetNames').val()
        let emailAddress = $('#emailAddress').val()
        let phoneNumber = $('#phoneNumber').val()
        let pickupnotes = $('#pickupnotes').val()
        let terms = $('#defaultCheck10:checked').val()

    var cardaform = $("#paymentCard")  
    cardaform.find('#token').val('');
    
    Stripe.card.createToken({
        number: cardNumber.val(),
        cvc: CVV.val(),
        exp_month:parseInt(exp_month),
        exp_year: parseInt(exp_year)
    }, function(status, response){
        if(response.error){
            bootbox.alert(response.error.message);
        }else{
            var data = {
                'phone_number': phone_number,
                'payment_mode': payment_mode,
                'firstname': firstname,
                'lastName': lastName,
                'companyName': companyName,
                'county': county,
                'checkoutRegion': checkoutRegion,
                'checkoutStreetNames': checkoutStreetNames,
                'emailAddress': emailAddress,
                'phoneNumber': phoneNumber,
                'pickupnotes': pickupnotes,
                'token': response.id
            }
            //sett the token value
            var token =$("token").val();
            cardaform.find('[name="token"]').val(response.id)
            $.ajax({
                url: url + 'checkout/guestPayments',
                method: 'post',
                dataType: 'json',
                data:data,
                beforeSend: function(){
                    $('#loadpaymentinfo').modal('show')
                },
                success: function(res){
                    if(res.success === true){
                    
                        let timerInterval
                        setTimeout(function() {
                            $("#loadpaymentinfo").modal("hide")

                            new swal({
                                title: "Order successfully placed!",
                                text: res.message,
                                html: 'Redirecting in <b></b> milliseconds.',
                                icon: "success",
                                allowOutsideClick: false,
                                timer: 5000,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer()
                                        .querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = (Swal
                                                .getTimerLeft() / 1000)
                                            .toFixed(0)
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.href = $("#checkoutRedirectUrl").val()
                                        
                                }
                            });
                            
                        }, 3500)
                        
                    }else if(res.success != true){
                        $("#loadpaymentinfo").modal('hide')
                        Command:toastr['warning'](res.data)
                    } 
                }
            })
        }
    })
}