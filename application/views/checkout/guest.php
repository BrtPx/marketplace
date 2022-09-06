<?php $this->load->view('templates/header'); ?>


<!-- breadcrumb -->
<div class="bg-gray-13 bg-md-transparent">
    <div class="container">
        <!-- breadcrumb -->
        <div class="my-md-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                    <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Guest Checkout</li>
                </ol>
            </nav>
        </div>
        <!-- End breadcrumb -->
    </div>
</div>
<!-- End breadcrumb -->

<div class="container">
    <div class="mb-1 bg-warning p-3" style="border-radius: 15px 15px 0 0;color: #fff;">
        <h1 class="text-center">Checkout</h1>
    </div>

    <form class="js-validate" novalidate="novalidate" id="payment_form">
        <div class="row">
            <div class="col-lg-5 order-lg-2 mb-2 mb-lg-0">
                <div class="pl-lg-3 bg-white p-3 patazon-border-radius mb-3">
                    <div class="rounded-lg" style="background-color: #f6f6f6;">
                        <!-- Order Summary -->
                        <div class="p-4 checkout-table">
                            <!-- Title -->
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">Your order</h3>
                            </div>
                            <!-- End Title -->

                            <!-- Product Content -->
                            <table class="table col-12">
                                <thead>
                                    <tr>
                                        <th class="product-image">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-subtotal">Subtotal</th>
                                    </tr>
                                </thead>

                                <tbody id="checkoutProducts" class=""></tbody>

                                <tfoot>
                                    <tr>
                                        <th colspan=" 3">Discount</th>
                                        <td id="couponDiscountPrice"></td>
                                    </tr>
                                    <tr>
                                        <th colspan=" 3">Shipping</th>
                                        <td id="shippingAmount">*Shipping within CBD @ 100ksh</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <td><strong id="cartPageTotals"></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- End Product Content -->

                            <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                <!-- Basics Accordion -->
                                <div id="basicsAccordion1">
                                    <!-- Card -->
                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                        <div class="p-3" id="basicsHeadingOne">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input payment" id="stylishRadio1" value="1"
                                                    name="stylishRadio" checked>
                                                <label class="custom-control-label form-label" for="stylishRadio1"
                                                    data-toggle="collapse" data-target="#basicsCollapseOnee"
                                                    aria-expanded="true" aria-controls="basicsCollapseOnee">
                                                    Mpesa
                                                </label>
                                            </div>
                                        </div>
                                        <div id="basicsCollapseOnee"
                                            class="collapse show border-top border-color-1 border-dotted-top bg-dark-lighter"
                                            aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion1">
											<div class="">
												<img class="img-fluid" src="<?= base_url() ?>uploads/others/mpesa2.jpg" style="width:100%;">
											</div>
                                            <div class="p-4">
                                            
                                                Make your payment directly via your Phone. Please use your Order
                                                ID as the payment reference. Your order will not be shipped until the
                                                funds have cleared in our account. <br><br>
                                                
                                                <div class="js-form-message form-group">
                                                    <label class="form-label" for="signinSrPasswordExample2">Phone Number</label>
                                                    <input type="text" class="form-control patazon-border-radius" name="phoneNumber" id="confirmationNumber"
                                                        autocomplete="off">
                                                </div>
                                                <span class="text-danger" id="validatempesa"></span>    
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <!-- End Card -->

                                    <!-- Card -->
                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                        <div class="p-3" id="basicsHeadingTwo">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input payment"
                                                    id="secondStylishRadio1" name="stylishRadio" value="2">
                                                <label class="custom-control-label form-label" for="secondStylishRadio1"
                                                    data-toggle="collapse" data-target="#basicsCollapseTwo"
                                                    aria-expanded="false" aria-controls="basicsCollapseTwo">
                                                    Cash on delivery
                                                    
                                                </label>
                                            </div>
                                        </div>
                                        <div id="basicsCollapseTwo"
                                            class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                            aria-labelledby="basicsHeadingTwo" data-parent="#basicsAccordion1">
											<div class="">
												<img class="img-fluid" src="<?= base_url(); ?>uploads/payment/cod.jpeg" style="witdth:100%;">
											</div>
                                            <div class="p-2">
                                            Pay with cash or mpesa mobile money transfer upon safe delivery.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->
								<!-- Card -->
                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                        <div class="p-3" id="basicsHeadingThree">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input payment" id="thirdstylishRadio1"
                                                    name="stylishRadio" value="3">
                                                <label class="custom-control-label form-label" for="thirdstylishRadio1"
                                                    data-toggle="collapse" data-target="#basicsCollapseThree"
                                                    aria-expanded="false" aria-controls="basicsCollapseThree">
                                                    Card payments
                                                </label>
                                            </div>
                                        </div>
                                        <div id="basicsCollapseThree"
                                            class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                            aria-labelledby="basicsHeadingThree" data-parent="#basicsAccordion1">
                                            <div class="p-4">
                                                <form id="paymentCard" >
													<input type="hidden" id="guestRedirectUrl" value="<?php echo base_url('payments/successOrder'); ?>">
                                                <input type="hidden" value="<?php echo $this->config->item('stripe_public_key') ?>" id="stripesecrete" >
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label">Name on Card</label>
                                                        <input type="text" class="form-control" name="owner" style="border-radius: 5px;" 
                                                            autocomplete="off" id="owner" >
                                                            <input type="hidden" value="<?= base_url('payments/guestPayments') ?>" id="stripeurl">
                                                    </div>
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label">Card Number</label>
                                                        <input type="text" class="form-control" name="cardNumber" id="cardNumber" size="20" style="border-radius: 5px;" 
                                                            autocomplete="off">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="js-form-message form-group">
                                                                <label class="form-label">Expiry date</label>
                                                                <input type="text" class="form-control" name="exp-date" id="exp-date" style="border-radius: 5px;" placeholder="mm/YYYY" size="4"
                                                                    autocomplete="off">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="js-form-message form-group">
                                                                <label class="form-label">Security Code</label>
                                                                <input type="text" class="form-control" name="cvv" placeholder="CVC" id="cvv" style="border-radius: 5px;" size="4" 
                                                                    autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" id="credit_cards">
                                                        <img src="<?= base_url() ?>assets/images/visa.jpg" id="visa">
                                                        <img src="<?= base_url() ?>assets/images/mastercard.jpg" id="mastercard">
                                                        <img src="<?= base_url() ?>assets/images/amex.jpg" id="amex">
                                                    </div>
                                                    
                                                    <input type="hidden" id="token" name="token" value="" />
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                                <!-- End Basics Accordion -->
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="guesterms">
                                    <label class="form-check-label form-label" for="guesterms">
                                        I have read and agree to the website <a href="<?= base_url('terms') ?>" class="text-blue">terms and
                                            conditions </a>
                                        <span class="text-danger">*</span>
                                    </label>
                                </div><br>
                            </div>
                            <div id="ters_service"></div>
                            <button type="submit"
                                class="d-none btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 d-md-inline-block text-white ordersuccess guestplaceOrderButton">Place
                                order</button>
							
                        </div>
                        <!-- End Order Summary -->
                    </div>
                </div>
            </div>

            <div class="col-lg-7 order-lg-1 pb-0 mb-5">
				<div class="bg-white p-3 patazon-border-radius">
                <div id="shipping-message"></div>
                    <!-- Title -->
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title mb-0 pb-2 font-size-25">Customer Details</h3>
                    </div>
                    <!-- End Title -->
                
                    <!-- Billing Form -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                                <label class="form-label">
                                    First name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control patazon-border-radius" name="firstName" id="guestfirstName"
                                    placeholder="First name" >
                                        <div class="text-danger mt-2" id="guestcheckout_name"></div>
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                                <label class="form-label">
                                    Last name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control patazon-border-radius" name="lastName" id="guestlastName"
                                    placeholder="last name">
                                        <div class="text-danger mt-2" id="guestcheckout_lastname"></div>
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                                <label class="form-label">
                                    Email address
                                    <span class="text-danger">*</span>
                                </label>
                                
                                <input type="email" class="form-control patazon-border-radius" name="emailAddress" id="guestemailAddress"placeholder="Enter email address" >
                                        <div class="text-danger mt-2" id="guestcheckout_email"></div>
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                                <label class="form-label">
                                    Phone
                                </label>
                                <input type="text" class="form-control patazon-border-radius" placeholder="Enter phone number"
                                    name="guestphoneNumber" id="guestphoneNumber"
                                     
                                    data-success-class="u-has-success">
                                        <div class="text-danger mt-2" id="guestcheckout_phone"></div>
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="w-100"></div>
                    </div>
                    <!-- End Billing Form -->

                    <?php //endif;?>

                    <!-- Input -->
                    <div class="js-form-message mb-6">
                        <label class="form-label">
                            Pickup notes (optional)
                        </label>

                        <div class="input-group patazon-border-radius">
                            <textarea class="form-control p-5 patazon-border-radius" rows="4" name="text" id="guestpickupnotes"
                                placeholder="Notes about where you want your items to be delivered, e.g. Gate dropoff or appertment number."></textarea>
							<button type="submit"
                                class="btn mt-4 btn-primary-dark-w btn-block btn-pill d-sm-inline-block d-md-none font-size-20 mb-3 text-white ordersuccess guestplaceOrderButton">Place
                                order</button>
                        </div>
                    </div>
                    <!-- End Input -->
            </div>
			</div>
        </div>
    </form>
</div>


<?php $this->load->view('templates/footer'); ?>
