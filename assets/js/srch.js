$('#searchProducts').keyup(function () {
    $("#searchResult").html('')
    var searchField = $.trim($(this).val())
    var url2 = 'https://sellercenter.patazone.co.ke/'
    var data = {
        searchKey: searchField
    }

    if (searchField.length >= 2) {
        $.get(url + 'home/get_search_data', data, function (response) {
            const data = JSON.parse(response)
            if (data.response == 'error') {
                $("#searchResult").append(
                    `<li class="list-group-item text-center py-3">${data.message}</li>`
                )
            } else {
                var productError = ''
                $.each(data, function (key, value) {
                    if (value.product_qty > 0) {
                        $("#searchResult").append(
                            `<li class="list-group-item" style="position:relative; display:block; padding: 0.32rem 1.25rem; margin-bottom:-1px; background-color:#fff; border: 1px solid #e7eaf3;">
                                        <a style="text-decoration:none; color: #000" href="${url + value.slug}" class="searchLinks">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img class="img-fluid max-width-60 p-1 border border-color-1 mr-2" src="${url2 + value.product_thumbnail}" width="50" alt="">
                                                </div>
                                                <div class="col-10">
                                                    ${value.product_title} -- <strong>${(value.discount_price != '') ? `${'Ksh.' + numberWithCommas(value.discount_price)}` : `${'Ksh.' + numberWithCommas(value.selling_price)}`}</strong>
                                                </div>
                                            </div>
                                        </a>
                                    </li>`
                        )
                    } else {
                        productError = `<li class="list-group-item text-center py-3">Product not Found.</li>`
                    }
                })
                $("#searchResult").append(productError)
            }
        })
    }
})

$("#mobileSearch").keyup(function () {
    $("#searchResultz").html('')
    var searchKey = $.trim($(this).val())
    var data = {
        searchKey: searchKey
    }

    if (searchKey.length > 2) {
        $.get(url + 'home/get_search_data', data, function (response) {
            const data = JSON.parse(response)
            if (data.response == 'error') {
                $("#searchResultz").append(


                    `<li class="list-group-item text-center py-3">${data.message}</li>`
                )
            } else {
                $.each(data, function (key, value) {
                    if (value.is_varified == 'yes') {
                        $("#searchResultz").append(
                            `<li class="list-group-item">
                                <a style="text-decoration:none; color: #000" href="${url + 'home/getProductdetails/'}${value.slug}" class="searchLinks">
                                    <div class="row">
                                        <div class="col-2">
                                            <img class="img-fluid p-1 border border-color-1 mr-2" src="${endpoint + value.product_thumbnail}" width="100" alt="">
                                        </div>
                                        <div class="col-10">
                                        ${value.product_title.substring(0, 30).toLowerCase()}... <br /> <strong>${(value.discount_price != '') ? `${'Ksh.' + numberWithCommas(value.discount_price)}` : `${'Ksh.' + numberWithCommas(value.selling_price)}`}</strong>
                                        </div>
                                    </div>
                                </a>
                            </li>`
                        )
                    }
                })
            }
        })
    }
})

// 

function numberWithCommas(money) {
    return money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Add to cart function
$(document).ready(function () {
    $(".addtocart").on('click', function (e) {
        e.preventDefault()
        const color = $('#color').val()
        const material = $('#material').val()
        const id = $('#productID').val()
        const qty = $('#productQuantity').val()
        const data = {
            p_color: color,
            p_id: id,
            p_material: material,
            p_qty: qty
        }
        $.ajax({
            url: url + 'home/add_to_cart/' + id,
            method: 'post',
            dataType: 'json',
            data: data,
            beforeSend: (() => {

            }),
            success: ((response) => {
                if (response.response == 'success') {
                    $('.cart-total').empty()
                    $('#crt').empty()
                    $('.cart-total').append(response.cartCount)
                    $('#crt').append(numberWithCommas('KES ' + response.cartTotal))
                    $('#cartmessage').text(response.message)
                    setTimeout(function () {
                        // $("#loadpaymentinfo").modal("hide")
                        $("#addCard").modal(
                            "show")
                    }, 20)
                    $('#resImage').html(`<img width="50" style="margin-top:0 !important" class="me-2" src="${endpoint + response.image}" alt="">`)

                    // Command: toastr["success"](response.message)
                } else if (response.response == 'error') {
                    Command: toastr["error"](response.message)
                }
            }),
            error: ((err) => {
                console.log(err)
            })
        })
    })

    $('#continueshopping').on('click', (() => {
        window.location.href = url;
    }))

    $('#viewCart').on('click', (() => {
        window.location.href = url + 'shopping/cart/'
    }))

    $('#guestCheckout').on('click', (() => {

        window.location.href = url + 'guest-checkout';
    }))

    $('#proceedcheckout').on('click', (() => {

        window.location.href = url + 'checkout';
    }))

    $('#signout').on('click', (() => {
        window.location.href = url + 'auth/user_logout';
    }))

    $('#signin').on('click', (() => {
        window.location.href = url + 'account-login';
    }))

    $('#createaccount').on('click', (() => {
        window.location.href = url + 'create-an-account';
    }))

    $('#myaccount').on('click', (() => {
        window.location.href = url + 'customer/account/index';
    }))

    $('.useraccounts').on('click', (() => {
        window.location.href = url + 'customer/account/index'
    }))
})
// Remove from cart
function removeFromCart(id) {
    $.ajax({
        url: url + 'home/remove_item_from_cart/' + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            if (data.response == 'success') {
                cartData()
                Command: toastr["success"](data.message)

            } else if (data.response == 'error') {
                Command: toastr["error"](data.message)
            }
        }
    })
}


// Function to decrement cart items
function decrementCartItems(id) {
    $.get(url + 'home/decrement_cart_items/' + id, function (response) {
        const data = JSON.parse(response)
        if (data.response == 'success') {
            cartData()

            Command: toastr["success"](data.message)
        } else if (data.response == 'error') {

            Command: toastr["error"](data.message)
        }
    })
}

// Function to Increment cart Items
function incrementCartItem(id) {
    $.get(url + 'home/increment_cart_items/' + id, function (response) {
        const data = JSON.parse(response)
        if (data.response == 'success') {
            cartData()
            Command: toastr["success"](data.message)
        } else if (data.response == 'error') {
            Command: toastr["error"](data.message)
        }
    })
}

function cartData() {
    $.ajax({
        url: url + 'home/get_cart_details',
        method: 'get',
        dataType: 'json',
        success: ((response) => {
            if (response.cartTotal > 0) {
                var row = ''
                $.each(response.cart, ((key, value) => {
                    $('#cartdata').empty()
                    row += `
                 <div class="table_row_outer">
                     <div class="table_img">
                         <div class="table_row_inner">
                         <button onclick="removeFromCart(\'${value.rowid}'\)" class="click_remove"></button>
                             
                             <div class="table_1_img">
                                 <img src="${endpoint + value.options.Image}" width="80" alt="">
                             </div>
                         </div>
                         <div class="table_row_inner">
                             <div class="table_data_title_1">
                                 <p class="table_data_title_responsive">Product</p>
                                 <p class="table_data_desc">${value.name}</p>
                             </div>
                         </div>
                     </div>
                     <div class="table_data">
                         <div class="table_row_inner">
                             <div class="table_data_title_1">
                                 <p class="table_data_title_responsive">Unit Price</p>
                                 <p class="table_data_desc">${'KES.' + numberWithCommas(value.price)}</p>
                             </div>
                         </div>
                         <div class="table_row_inner">
                             <div class="table_row_inner_button">
                                 <p class="table_data_title_responsive">Quantity</p>
                                 <div class="cart_button_plus_minus_1">
                                     <span class="minus_1" onclick="decrementCartItems(\'${value.rowid}'\)">-</span>
                                     <input type="number" class="input_inc_dec" min="1" value="${value.qty}">
                                     <span class="plus_1" onclick="incrementCartItem(\'${value.rowid}'\)">+</span>
                                 </div>
                             </div>
                         </div>
                         <div class="table_row_inner">
                             <div class="table_data_title_1">
                                 <p class="table_data_title_responsive">Sub Total</p>
                                 <p class="table_data_desc">${'KES.' + numberWithCommas(value.subtotal)}</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 `

                }))
                $('#cartdata').append(row)
                // $('#totalpricepayment').empty()
                $('#subtotal').empty()
                $('#total').empty()
                $('#crt').empty()
                $('.cart-total').empty()
                $('#subtotal').append(
                    numberWithCommas('KES ' + response.cartTotal)
                )
                $('#total').append(
                    numberWithCommas('KES ' + response.cartTotal)
                )
                $('#crt').append(numberWithCommas('KES ' + response.cartTotal))

                $('.cart-total').append(response.cartCount)

            } else {
                $('#loadcart').empty()
                $('#crt').empty()
                $('.cart-total').empty()
                $('#totalpricepayment').empty()
                $('#crt').append(numberWithCommas('KES ' + response.cartTotal))
                $('.cart-total').append(response.cartCount)
                $('#loadcart').append(
                    `<div class="bg-white" style="border-radius: 0 0 5px 5px;">
                        <div class="" id=""
                        style="padding: 50px 60px; text-align: center; margin-bottom: 20px;">
                        <img src="${url + 'assets/img/shopping-cart.png'}" title="patazone cart icon" width="100" />
                        <h4 class="text-danger">
                            Cart is Empty!
                        </h4>
                        <p>Your shopping items will appear here... click <a href="${url}">Here</a> to start
                            shopping.</p>
                    </div>`
                )
            }
        })
    })
}

function addGeneralCart(e, id) {
    e.preventDefault()
    const color = $('#color').val()
    const material = $('#material').val()
    // const id = $('#productID').val()
    const qty = $('#productQuantity').val()
    const data = {
        p_color: color,
        p_id: id,
        p_material: material,
        p_qty: qty
    }
    $.ajax({
        url: url + 'home/add_to_cart/' + id,
        method: 'post',
        dataType: 'json',
        data: data,
        beforeSend: (() => {

        }),
        success: ((response) => {
            if (response.response == 'success') {
                $('.cart-total').empty()
                $('#crt').empty()
                $('.cart-total').append(response.cartCount)
                $('#crt').append(numberWithCommas('KES ' + response.cartTotal))
                $('#cartmessage').text(response.message)
                setTimeout(function () {
                    $("#addCard").modal(
                        "show")
                }, 20)
                $('#resImage').html(`<img width="100" height="100" style="margin-top:0 !important" class="me-2" src="${endpoint + response.image}" alt="">`)
            } else if (response.response == 'error') {
                Command: toastr["error"](response.message)
            }
        }),
        error: ((err) => {
            console.log(err)
        })
    })
}

function viewProductImage(slug, id) {
    window.location.href = url + slug;
}

// Page scroll
var page = 21;
$(window).scroll(() => {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        // page++;
        page += 20;
        loadMoreData(page);
    }
});

function loadMoreData(page) {
    $.ajax({
        url: '?page=' + page,
        type: 'get',
        beforeSend: function () {
            $('.ajax-load').show();
        }
    }).done((data) => {
        if (data == "") {
            $('.ajax-load').html("");
            return;
        }
        setTimeout(function () {

            $('.ajax-load').hide();
            $('#post-data').append(data);
        }, 200)
    }).fail((jqXHR, ajaxOptions, throwError) => {
        alert('server not responding');
        console.log(throwError);
    })
}

//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}