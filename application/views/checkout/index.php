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
                            <div class="wrap-social-icons">
                                <ul class="social-icons">
                                    <li><a class="btn facebook" href="#"><span class="a-text-1">Facebook Login</span><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="btn twitter" href="#"><span class="a-text-1">Twitter Login</span><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="btn google" href="#"><span class="a-text-1">Google Login</span><i class="fab fa-google"></i></a></li>
                                </ul>
                                <p class="mt-4">By clicking any of the social login buttons you agree to the terms of privacy policy described <a href="#">here</a></p>
                            </div>
                        <!-- ~~~~~~~~~~~wrap social icons end~~~~~~~~~~~~~~~ -->
                            <!--billing & shipping-->
                                <div class="billing_shipping">
                                    <h5 class="mb-4">Billing & Shipping</h5>
                                    <?php if($address):
                                        $county = $this->db->get_where('ptz_counties', array('county_code'=> $address->county))->row()->county_name;
                                        $region = $this->db->get_where('ptz_regions', array('id'=> $address->region))->row()->region_name;
                                        $street = $this->db->get_where('ptz_streets', array('id'=> $address->street))->row()->street_name;
                                        ?>
                                        <div class="edit_information">
                                            <!-- edit phone -->
                                            <div class="edit_phone">
                                                <span class="edit_t">Phone</span>
                                                <!-- <span class="edit_span_middle" id="ChangePhoneNumber">074256336379</span> -->
                                                <input class="edit_span_middle input_class_editable class_number" type="text" readonly value="<?= $address->phone;?>">
                                                <span class="edit_a"><p class="change_phone_number">Change</p></span>
                                            </div>
                                            <!-- edit ship to -->
                                            <div class="edit_ship">
                                                <span class="edit_t">Ship to</span>
                                                <!-- <span class="edit_span_middle">Utawala, Riara Ridge Villas, Nairobi</span> -->
                                                <input class="edit_span_middle input_class_editable class_location" type="text" readonly value="<?= $region.', '.$street.', '.$county; ?>">
                                                <span class="edit_a"><p class="change_ship_location">Change</p></span>
                                            </div>
                                            <!-- edit delivery -->
                                            <div class="edit_delivery">
                                                <span class="edit_t">Delivery</span>
                                                <span class="edit_span_middle">Same Day Delivery within Nairobi (Free)</span>
                                                <span class="edit_a"></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <!-- ~~~~~~~~~~~billing & shpping end -->
                                <!-- wrap form  -->
                                <?php if($address):
                                    $county = $this->db->get_where('ptz_counties', array('county_code'=> $address->county))->row()->county_name;
                                    $region = $this->db->get_where('ptz_regions', array('id'=> $address->region))->row()->region_name;
                                    $street = $this->db->get_where('ptz_streets', array('id'=> $address->street))->row()->street_name;
                                    ?>
                                <div class="wrap_input_box" id="updateAddress" >
                                    <!-- === -->
                                        <div class="wrap_input">
                                            <label for="firstName">First Name <span class="start_1">*</span></label>
                                            <input id="firstName" class="input_checkout" type="text" placeholder="Shane Doe">
                                        </div>
                                    <!-- `````` -->
                                    <div class="wrap_input">
                                    <label for="lastName">Last Name <span class="start_1">*</span></label>
                                            <input id="lastName" class="input_checkout" type="text" placeholder="Last name">
                                        </div>
                                    <!-- === -->
                                        <div class="wrap_input">
                                            <label for="email_address">Email Address <span class="start_1">*</span></label>
                                            <input id="email_address" class="input_checkout" type="text" placeholder="Your email address">
                                        </div>
                                    <!-- `````` -->
                                    <!-- === -->
                                        <div class="wrap_input">
                                            <label for="shippingnumber">Phone(Enter M-PESA Number Only For Pay Now Option) <span class="start_1">*</span></label>
                                            <input id="shippingnumber" class="input_checkout" type="text" placeholder="Shipping phone">
                                        </div>
                                    <!-- `````` -->
                                    <!-- === -->
                                        <div class="wrap_input">
                                            <label for="county">Country / City <span class="start_1">*</span></label>
                                            <select id="county" name="shippingCounty" class="form-select select_checkout" aria-label="Default select example">
                                                <option id="selected_country" >---Select county---</option>
                                                <?php foreach ($counties as $county): ?>
                                                    <option value="<?= $county->county_code; ?>"><?= $county->county_name; ?></option>
                                                <?php endforeach; ?>
                                                </select>
                                        </div>
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
                                            <input id="delivery_address" class="input_checkout" type="text" placeholder="House number and street name">
                                        </div>
                                    <!-- `````` -->
                                    <!-- === -->
                                        
                                    <!-- `````` -->

                                </div>
                                <?php endif;?>
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
                                                <div class="form-check">
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
                                                
                                                <div class="js-form-message form-group mb-10">
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
                                                        <input class="form-check-input checkbox payment" type="radio" value="2" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Pay with Mpesa Xpress
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="check_information">
                                                    <div class="check_infromation_top">
                                                        <p class="mb-3">Please follow the instructions below to proceed with the M-PESA Payment.</p>
                                                    </div>
                                                    <p>From your phone:</p>
                                                    <ol>
                                                        <li>Go to Safaricom Menu</li>
                                                        <li>Select M-PESA</li>
                                                        <li>Select Lipa na MPESA</li>
                                                        <li>Select Buy Goods and Services</li>
                                                        <li>Enter Till number: 1234567890</li>
                                                        <li>Enter Amount</li>
                                                        <li>Enter your M-PESA PIN and press "OK"</li>
                                                    </ol>
                                                </div>
                                            <!-- ``2``` -->
                                            <!-- ===== -->
                                                <div class="form-check">
                                                    <div class="wrap_check_child">
                                                        <input class="form-check-input checkbox payment" type="radio" value="3" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Cash On Delivery
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="check_information">
                                                    <div class="check_infromation_top">
                                                        <p class="mb-3">Please follow the instructions below to proceed with the M-PESA Payment.</p>
                                                    </div>
                                                    <p>From your phone:</p>
                                                    <ol>
                                                        <li>Go to Safaricom Menu</li>
                                                        <li>Select M-PESA</li>
                                                        <li>Select Lipa na MPESA</li>
                                                        <li>Select Buy Goods and Services</li>
                                                        <li>Enter Till number: 1234567890</li>
                                                        <li>Enter Amount</li>
                                                        <li>Enter your M-PESA PIN and press "OK"</li>
                                                    </ol>
                                                </div>
                                            <!-- ``3``` -->
                                            <!-- ===== -->
                                                <div class="form-check last_check_wrap">
                                                    <div class="wrap_check_child">
                                                        <input class="form-check-input checkbox payment" type="radio" value="4" name="flexRadioDefault" id="flexRadioDefault1">
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
                                        <div class="wrap_pay_btn">
                                            <button class="btn btn_pay placeOrderButton">Complete Purchase</button>
                                        </div>
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

    <div id="nav_scroll" class="scroll-nav">
        <div class="scroll-nav-child">
            <ul class="scroll-nav-ul">
                <li>
                    <a class="nav-as-active" href="#">
                        <div class="wrap-icon">
                            <svg width="29" height="24" viewBox="0 0 29 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="path-active" fill-rule="evenodd" clip-rule="evenodd" d="M11.2941 24V15.5294H16.9412V24H24V12.7059H28.2353L14.1176 0L0 12.7059H4.23529V24H11.2941Z" fill=""/>
                            </svg>
                        </div>
                        <span>Home</span>
                    </a>
                </li>
                <!-- === -->
                <li>
                    <a href="#">
                        <div class="wrap-icon">
                            <svg width="25" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect class="path-normal" x="0.5" y="14.6904" width="10.04" height="10.5455" rx="1.5" stroke=""/>
                                <rect class="path-normal" x="13.748" y="14.6904" width="10.04" height="10.5455" rx="1.5" stroke=""/>
                                <rect class="path-normal" x="0.5" y="0.835938" width="10.04" height="10.5455" rx="1.5" stroke=""/>
                                <rect class="path-normal" x="13.748" y="0.835938" width="10.04" height="10.5455" rx="1.5" stroke=""/>
                            </svg>
                        </div>
                        <span>Categories</span>
                    </a>
                </li>
                <!-- === -->
                <li>
                    <a href="#">
                        <div class="wrap-icon">
                            <svg width="27" height="29" viewBox="0 0 27 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="path-normal" d="M18.1495 12.7419C17.8204 12.7419 16.5646 12.2607 16.5646 12.034C16.5646 5.37365 16.7944 0.833464 13.3034 0.833464C9.75558 0.833464 9.79999 5.23775 9.79999 12.388C9.79999 12.6146 9.05181 12.7419 8.72262 12.7419C8.39344 12.7419 7.64526 12.2607 7.64526 12.034C7.64526 4.32816 8.74772 0 13.2994 0C18.2736 0 18.6882 5.91467 18.6882 12.034C18.6923 12.268 18.4787 12.7419 18.1495 12.7419Z" fill=""/>
                                <path class="path-normal" d="M13.002 10.8496H16.1257C16.0827 10.9518 16.0571 11.0656 16.0571 11.1902C16.0571 11.5609 16.2807 11.8362 16.521 11.9962C16.7637 12.1577 17.0696 12.2401 17.3818 12.2401C17.6962 12.2401 18.0021 12.1553 18.2438 11.9934C18.4813 11.8342 18.7065 11.5598 18.7065 11.1902C18.7065 11.0655 18.6811 10.9517 18.6384 10.8496H25.4251L22.9717 27.5323H13.002H3.03225L0.578907 10.8496H7.36608C7.32306 10.9518 7.29748 11.0656 7.29748 11.1902C7.29748 11.5609 7.52106 11.8362 7.76141 11.9962C8.00411 12.1577 8.31 12.2401 8.62218 12.2401C8.93657 12.2401 9.2425 12.1553 9.48421 11.9934C9.7217 11.8342 9.94688 11.5598 9.94688 11.1902C9.94688 11.0655 9.92152 10.9517 9.87879 10.8496H13.002Z" stroke=""/>
                            </svg>
                        </div>
                        <span>Cart</span>
                    </a>
                </li>
                <!-- === -->
                <li>
                    <a href="#">
                        <div class="wrap-icon">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="path-normal" fill-rule="evenodd" clip-rule="evenodd" d="M15.079 27L13.1826 25.2736C6.44687 19.1657 2 15.1373 2 10.1935C2 6.16512 5.16512 3 9.19346 3C11.4692 3 13.6534 4.0594 15.079 5.73351C16.5046 4.0594 18.6888 3 20.9646 3C24.9929 3 28.158 6.16512 28.158 10.1935C28.158 15.1373 23.7112 19.1657 16.9755 25.2866L15.079 27Z" stroke=""/>
                            </svg>
                        </div>
                        <span>Favourites</span>
                    </a>
                </li>
                <!-- === -->
                <li>
                    <a href="#">
                        <div class="wrap-icon">
                            <svg width="22" height="26" viewBox="0 0 22 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="path-normal-1" d="M11.1408 25L11.1408 24.5H11.1408L11.1408 25ZM1 19.5577L0.500057 19.5502L0.497722 19.705L0.583336 19.8341L1 19.5577ZM21.2817 19.5577L21.6984 19.8341L21.784 19.705L21.7816 19.5502L21.2817 19.5577ZM11.1408 1.5C13.6703 1.5 15.7113 3.54093 15.7113 6.07042H16.7113C16.7113 2.98865 14.2226 0.5 11.1408 0.5V1.5ZM15.7113 6.07042C15.7113 8.59991 13.6703 10.6408 11.1408 10.6408V11.6408C14.2226 11.6408 16.7113 9.1522 16.7113 6.07042H15.7113ZM11.1408 10.6408C8.61134 10.6408 6.57041 8.59991 6.57041 6.07042H5.57041C5.57041 9.1522 8.05906 11.6408 11.1408 11.6408V10.6408ZM6.57041 6.07042C6.57041 3.54093 8.61134 1.5 11.1408 1.5V0.5C8.05906 0.5 5.57041 2.98865 5.57041 6.07042H6.57041ZM11.1408 24.5C7.22971 24.5 3.57865 22.5406 1.41666 19.2813L0.583336 19.8341C2.9306 23.3727 6.89454 25.5 11.1408 25.5L11.1408 24.5ZM1.49994 19.5653C1.50991 18.904 1.84489 18.2784 2.47245 17.6902C3.10211 17.1002 3.99222 16.5826 5.01476 16.1549C7.06188 15.2987 9.51897 14.8521 11.1408 14.8521V13.8521C9.38244 13.8521 6.79445 14.3266 4.6289 15.2324C3.5451 15.6857 2.53697 16.2593 1.78865 16.9606C1.0382 17.6638 0.51544 18.5297 0.500057 19.5502L1.49994 19.5653ZM11.1408 14.8521C12.7541 14.8521 15.2113 15.2986 17.2608 16.155C18.2845 16.5827 19.1762 17.1004 19.8072 17.6906C20.4362 18.2789 20.7718 18.9045 20.7817 19.5653L21.7816 19.5502C21.7662 18.5293 21.242 17.6633 20.4903 16.9603C19.7407 16.2591 18.731 15.6855 17.6463 15.2323C15.4789 14.3267 12.891 13.8521 11.1408 13.8521V14.8521ZM20.865 19.2813C18.703 22.5406 15.052 24.5 11.1408 24.5L11.1408 25.5C15.3872 25.5 19.3511 23.3727 21.6984 19.8341L20.865 19.2813Z" fill=""/>
                            </svg>
                        </div>
                        <span>Account</span>
                    </a>
                </li>
                <!-- === -->
            </ul>
        </div>
    </div>