<div class="wrap-middle">
        <div class="wrap-directory">
            <ul class="directory-ul">
                <li><a href="#">Cart</a></li> <img src="<?= base_url()?>assets/img/arrow-right.svg" alt="">
                <li><a class="directory-active" href="#">Information</a></li> <img src="<?= base_url()?>assets/img/arrow-right.svg" alt="">
                <li><a href="#">Shipping</a></li> <img src="<?= base_url()?>assets/img/arrow-right.svg" alt="">
                <li><a href="#">Payment</a></li>
            </ul>
        </div>

        <form class="form_box">
            <div class="wrap-checkout">
                <div class="wrap_h3">
                    <h3>Checkout</h2>
                </div>
                <!-- checkout left-->
                <div class="checkout-left">
                    <!-- ===== -->
                        <!-- wrap social icons -->
                        <?php if($this->session->userdata('user_login') != 1):?>
                            <div class="wrap-social-icons">
                                <p class="mt-4">For customized customer experience? <a class="" style="text-decoration: none; color: #B92227; font-weight: bold;" href="<?= base_url('account-login');?>">Click here to login </a></p>
                            </div>
                            <?php endif; ?>
                        <!-- ~~~~~~~~~~~wrap social icons end~~~~~~~~~~~~~~~ -->
                            <!--billing & shipping-->
                                <div class="billing_shipping">
                                    <h5 class="mb-4">Billing & Shipping</h5>
                                    
                                </div>
                            <!-- ~~~~~~~~~~~billing & shpping end -->
                                <!-- wrap form  -->
                                <?php if($this->session->userdata('user_login') != 1):?>
                                <div class="wrap_input_box" id="updateAddress" >
                                    <!-- === -->
                                        <div class="wrap_input">
                                            <label for="firstName">First Name <span class="start_1">*</span></label>
                                            <input id="guestfirstName" class="input_checkout" type="text" placeholder="Shane Doe">
                                        </div>
                                    <!-- `````` -->
                                    <div class="wrap_input">
                                    <label for="lastName">Last Name <span class="start_1">*</span></label>
                                            <input id="guestlastName" class="input_checkout" type="text" placeholder="Last name">
                                        </div>
                                    <!-- === -->
                                        <div class="wrap_input">
                                            <label for="email_address">Email Address <span class="start_1">*</span></label>
                                            <input id="guestemail_address" class="input_checkout" type="text" placeholder="Your email address">
                                        </div>
                                    <!-- `````` -->
                                    <!-- === -->
                                        <div class="wrap_input">
                                            <label for="shippingnumber">Phone(Enter M-PESA Number Only For Pay Now Option) <span class="start_1">*</span></label>
                                            <input id="guestshippingnumber" class="input_checkout" type="text" placeholder="Shipping phone">
                                        </div>
                                 
                                        <div class="wrap_input">
                                            <label for="delivery_address">Delivery address <span class="start_1">*</span></label>
                                            <input id="guestdelivery_address" class="input_checkout" type="text" placeholder="House number and street name">
                                        </div>
                                    <!-- `````` -->
                                    <!-- === -->
                                        
                                    <!-- `````` -->

                                </div>
                                <?php else: if($address):
                                    $address = $this->db->get_where('ptz_address', array('user_id' => $this->session->userdata('user_id')))->row();
                                    $county = $this->db->get_where('ptz_counties', array('county_code'=> $address->county))->row()->county_name;
                                    ?>
                                    <?php endif; ?>
                                    
                                <div class="wrap_input_box" id="updateAddress" >
                                    <!-- === -->
                                        <div class="wrap_input">
                                            <label for="firstName">First Name <span class="start_1">*</span></label>
                                            <input id="firstName" class="input_checkout" type="text" placeholder="Shane Doe" <?php if($address):?> value="<?= $address->firstname ?>"
                                        <?php else:?>
                                        value=""<?php endif; ?> >
                                        </div>
                                    <!-- `````` -->
                                    <div class="wrap_input">
                                    <label for="lastName">Last Name <span class="start_1">*</span></label>
                                            <input id="lastName" class="input_checkout" type="text" placeholder="Last name" <?php if($address):?> value="<?= $address->lastname ?>"
                                        <?php else:?>
                                        value=""<?php endif; ?> >
                                        </div>
                                    <!-- === -->
                                        <div class="wrap_input">
                                            <label for="email_address">Email Address <span class="start_1">*</span></label>
                                            <input id="email_address" class="input_checkout" type="text" placeholder="Your email address" <?php if($address):?> value="<?= $address->email ?>"
                                        <?php else:?>
                                        value=""<?php endif; ?> >
                                        </div>
                                    <!-- `````` -->
                                    <!-- === -->
                                        <div class="wrap_input">
                                            <label for="shippingnumber">Phone(Enter M-PESA Number Only For Pay Now Option) <span class="start_1">*</span></label>
                                            <input id="shippingnumber" class="input_checkout" type="text" placeholder="Shipping phone" <?php if($address):?> value="<?= $address->phone ?>"
                                        <?php else:?>
                                        value=""<?php endif; ?> >
                                        </div>
                                    <!-- `````` -->
                                    <!-- === -->
                                    <?php if($address):?>
                                        <div class="wrap_input"> 
                                            <label for="county">Country / City <span class="start_1">*</span></label>
                                            <select id="county" name="shippingCounty" class="form-select select_checkout" aria-label="Default select example">
                                                <option id="">---Select county---</option>
                                                <?php foreach ($counties as $county): ?>
                                                    <option value="<?= $county->county_code; ?>"
                                                    <?= ($address->county == $county->county_code) ? 'selected' : '' ?>
                                                    ><?= $county->county_name; ?></option>
                                                <?php endforeach; ?>
                                                </select>
                                        </div>
                                    <?php else:?>
                                        <div class="wrap_input"> 
                                            <label for="county">Country / City <span class="start_1">*</span></label>
                                            <select id="county" name="shippingCounty" class="form-select select_checkout" aria-label="Default select example">
                                                <option id="">---Select county---</option>
                                                <?php foreach ($counties as $county): ?>
                                                    <option value="<?= $county->county_code; ?>"
                                                    
                                                    ><?= $county->county_name; ?></option>
                                                <?php endforeach; ?>
                                                </select>
                                        </div>
                                    <?php endif; ?>
                                    <!-- `````` -->
                                    <!-- === -->
                                        <div class="wrap_input">
                                            <label for="region">Region <span class="start_1">*</span></label>
                                            <select id="region" name="shippingRegion" class="form-select select_checkout" aria-label="Default select example">
                                                <option id="selected_region" >---Select---</option>
                                                </select>
                                        </div>
                                    <!-- `````` -->
                                    <!-- === -->
                                        <div class="wrap_input">
                                            <label for="delivery_address">Delivery address <span class="start_1">*</span></label>
                                            <input id="delivery_address" class="input_checkout" type="text" placeholder="House number and street name" <?php if($address):?> value="<?= $address->street ?>"
                                        <?php else:?>
                                        value=""<?php endif; ?> >
                                        </div>
                                    <!-- `````` -->
                                    <!-- === -->
                                        
                                    <!-- `````` -->

                                </div>
                                
                                <?php endif; ?>
                                <!-- ~~~~~~~~~~~~~~~~wrap form~~~~~~~~~~~~  -->
                </div>
                <!-- ~~~~~~~~~~~~~~~checkout left end~~~~~~~~~~~~~~~~ -->

                <!-- checkout right -->
                <div class="checkout-right">
                    <div class="wrap_order_summary">
                        <h4>Order Summary</h4>
                        <div class="wrap_products">
                            <div class="products_title">
                                <span class="span-md">PRODUCT</span>
                                <span class="span-sm">QUANTITY</span>
                                <span class="span-sm">SUB TOTAL</span>
                            </div>
                            <!-- product table -->
                            <?php if($cart['cart']):?>
                                <div class="product_table" style="max-height: 300px; overflow-y:auto; cursor:pointer;">
                                    <?php foreach($cart['cart'] as $cartdata):?>
                                    <div class="product_row">
                                        <div class="product_img">
                                            <img src="<?= imagebaseURL.$cartdata['options']['Image'] ?>" alt="">
                                        </div>
                                        <div class="product_details">
                                            <div class="details_p">
                                                <p><?= $cartdata['name']; ?></p>
                                            </div>
                                            <div class="details_quantity">
                                                <div class="span_tab">QUANTITY <span class="span_col">: </span> </div>
                                                <span class="ml-5" style="margin-left:10%"><?= $cartdata['qty']; ?></span>
                                            </div>
                                            <div class="details_total">
                                                <div class="span_tab">SUB TOTAL <span class="span_col">: </span> </div>
                                                <p><?= 'KES '.number_format($cartdata['subtotal']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    
                                </div>
                            <?php endif; ?>
                            <!-- ````````` -->
                            <!-- form box two -->
                                <div class="wrap_form_2">
                                    <div class="wrap_gift_card">
                                        <input type="text" placeholder="Gift Card or Discount Code">
                                        <a class="btn" href="#">Apply</a>
                                    </div>
                                    <div class="wrap_subtotal">
                                        <h6>Subtotal</h6>
                                        <h6><?= 'KES '.number_format($cart['cartTotal'])?></h6>
                                    </div>
                                    <div class="wrap_delivery">
                                        <div class="wrap_delivery_top">
                                            <h6>Delivery Charges</h6>
                                            <img src="<?= base_url()?>assets/img/help.svg" alt="">
                                        </div>
                                        <div class="wrap_delivery_bottom">
                                            <p>Shipping, taxes, and discounts codes calculated at checkout. Orders will be processed in KES.</p>
                                        </div>
                                    </div>
                                    <div class="wrap_discount">
                                        <h6>Discount</h6>
                                        <h6>KES 0</h6>
                                    </div>
                                    <div class="wrap_order_total">
                                        <h6>Order Total</h6>
                                        <h6><?= 'KES '.number_format($cart['cartTotal'])?></h6>
                                    </div>
                                    <div class="wrap_pay">
                                        <h6 class="mt-2">How would you like to pay?</h6>
                                        <div class="wrap_check">
                                            <!-- ===== -->
                                               <!-- <div class="form-check">
                                                    <div class="wrap_check_child">
                                                        <input class="form-check-input checkbox payment" type="radio" value="1" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Pay with Mpesa
                                                        </label>
                                                    </div>
                                                    <a class="check_btn_mpesa" href="#">LIPA NA <img src="<?= base_url()?>assets/img/mpesa.svg" alt=""></a>
                                                </div>
                                                <div class="check_information">
                                                    <div class="check_infromation_top">
                                                        <p class="mb-3">Make your payment directly via your Phone. Please use your Order
                                                ID as the payment reference. Your order will not be shipped until the
                                                funds have cleared in our account.</p>
                                                    </div>
                                                
                                                <!-- <div class="js-form-message form-group mb-10">
                                                    <label class="form-label" for="signinSrPasswordExample2">Phone Number</label>
                                                    <input type="text" class="form-control patazon-border-radius" name="phoneNumber" id="phoneNumber"
                                                        autocomplete="off">
                                                </div>
                                                <span class="text-danger" id="validatempesa"></span>     
                                            </div>
                                                </div>
                                            <!-- ```1`` -->
                                            <!-- ===== -->
                                            
                                                <div class="form-check">
                                                    <div class="wrap_check_child">
                                                        <input class="form-check-input checkbox payment" type="radio" value="4" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Buy now Pay Later
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="check_information">
                                                    <div class="check_infromation_top">
                                                        <p class="mb-3">Please Click the order button to proceed with buy now pay later.</p>
                                                    </div>
                                                    
                                                    <div class="">
                                                        <a id="direct-lipalater" class="btn font-weight-light mb-2 mt-1 font-size-sl-50" href="javascript:;"  style="font-size: 20px !important; font-weight:bold !important; cursor: pointer !important;">Lipa mdogo mdogo     with 
                                                            <img class="img-fluid" src="<?= base_url(); ?>assets/img/images/lipa-later-logo.png" style="witdth:50%;">
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                            <!-- ``2``` -->
                                            <!-- ===== -->
                                                <div class="form-check">
                                                    <div class="wrap_check_child">
                                                        <input class="form-check-input checkbox payment" type="radio" value="2" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Cash On Delivery
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="check_information">
                                                    <div class="check_infromation_top">
                                                        <p class="mb-3">Pay with cash or mpesa mobile money transfer upon safe delivery.</p>
                                                    </div>
                                                    <p>From your phone:</p>
                                                    <ol>
                                                        <li>Go to Safaricom Menu</li>
                                                        <li>Select M-PESA</li>
                                                        <li>Select Lipa na MPESA</li>
                                                        <li>Select Buy Goods and Services</li>
                                                        <li>Enter Till number: 9169061</li>
                                                        <li>Enter Amount</li>
                                                        <li>Enter your M-PESA PIN and press "OK"</li>
                                                    </ol>
                                                </div>
                                            <!-- ``3``` -->
                                            <!-- ===== -->
                                                <div class="form-check last_check_wrap">
                                                    <div class="wrap_check_child">
                                                        <input class="form-check-input checkbox payment" type="radio" value="3" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Payment with Credit/Debit Card
                                                        </label>
                                                    </div>
                                                    <div id="credit_cards">
                                                        <img id="visa" src="<?= base_url()?>assets/img/319.svg" alt="">
                                                        <img id="mastercard" src="<?= base_url()?>assets/img/Group.svg" alt="">
                                                        <img id="amex" src="<?= base_url()?>assets/img/Group.svg" alt="">
                                                    </div>
                                                </div>
                                                <div class="check_information">
                                                <input type="hidden" value="<?php echo $this->config->item('stripe_public_key') ?>" id="stripesecrete" >
                                                    <div class="check_info_4">
                                                        <div class="info_4_input_wrap">
                                                            <label for="card_name">Name on card</label>
                                                            <input id="owner" name="owner" type="text">
                                                        </div>
                                                        <div class="info_4_input_wrap">
                                                            <label for="card_number">Card Number</label>
                                                            <input id="cardNumber" name="cardNumber" type="text" placeholder="1234 1234 1234 1234">
                                                        </div>
                                                        <div class="info_4_input_wrap_bottom">
                                                            <div class="info_bottom">
                                                                <label for="card_date">Expiry Date</label>
                                                                <input id="exp-date" name="exp-date" type="text" placeholder="MM / YY">
                                                            </div>
                                                            <div class="info_bottom">
                                                                <label for="card_code">Security Code</label>
                                                                <input id="cvv" name="cvv" type="text" placeholder="CVC">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- ``4``` -->
                                        </div>
                                        <?php if($this->session->userdata('user_login') != 1):?>
                                            <div class="wrap_pay_btn">
                                                <button class="btn btn_pay guestplaceOrderButton">Complete Purchase</button>
                                            </div>
                                        <?php else: ?>
                                            <div class="wrap_pay_btn">
                                                <button class="btn btn_pay placeOrderButton">Complete Purchase</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <!-- ````````````` -->
                        </div>
                    </div>
                </div>
                <!-- ~~~~~~~~~~~~~~~~~~checkout right~~~~~~~~~~~~~~~~~~~ -->
    
            </div>
        </form>
    </div>
<?php $this->load->view('common/scroll-nav'); 
$this->load->view('common/footer');
?>

    