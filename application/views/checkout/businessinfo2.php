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
                    <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Enter your business details</li>
                </ol>
            </nav>
        </div>
        <!-- End breadcrumb -->
    </div>
</div>
<!-- End breadcrumb -->

<div class="container">
    <div class="bg-warning p-3" style="border-radius: 15px 15px 0 0;">
        <h1 class="text-center text-white">Business Infomation</h1>
    </div>

    <div class="bg-white p-3 mb-4">
        <form action="" class="js-validate" novalidate="novalidate" id="">
            <div class="row">
                <div class="col-lg-5 order-lg-2 mb-2 mb-lg-0">
                    <div class="mb-4 pl-lg-3 patazon-border-radius">
                        <div class="rounded-lg" style="background-color: #f6f6f6;">
                            <!-- Order Summary -->
                            <div class="p-4 mb-4 checkout-table">
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
                                
                                <div id="ters_service"></div>
                                <button type="submit" disabled
                                    class="d-none btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 d-md-inline-block text-white ordersuccess guestplaceOrderButton">Place
                                    order</button>
                                
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
                                
                            </div>
                            <!-- End Order Summary -->
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-7 order-lg-1 pb-0 mb-5">
                    <div class="">
                    <div id="lipalater-message"></div>
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">More info about your business. <a href="<?= base_url('payments/clearLipalaterFormFields')?>" class="btn btn-default btn-sm btn-rounded float-right mb-2">Refresh <i class="fas fa-sync" style="color: #ee121a;"></i></a></h3>
                        </div>
                        <!-- End Title -->
                    
                        <!-- Billing Form -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-3">
                                    <label class="form-label">
                                        Next of kin full name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control patazon-border-radius" name="nextOfKinName" id="nextOfKinName"
                                        placeholder="Enter next of kin full name" value="<?= $this->session->userdata('first_name') ? $this->session->userdata('first_name') : ''?>">
                                            <div class="text-danger mt-2" id="ll_nextOfKinNameError" style="font-size: 12px;"></div>
                                </div>
                                <!-- End Input -->
                            </div>
    
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-3">
                                    <label class="form-label">
                                        Relationship
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control patazon-border-radius" name="relationship" id="relationship"
                                        placeholder="Enter relation" value="<?= $this->session->userdata('last_name') ? $this->session->userdata('last_name') : ''?>">
                                            <div class="text-danger mt-2" id="ll_relationshipError" style="font-size: 12px;"></div>
                                </div>
                                <!-- End Input -->
                            </div>
    
                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-3">
                                    <label class="form-label">
                                        Next of kin mobile number
                                        <span class="text-danger">*</span>
                                    </label>
                                    
                                    <input type="text" class="form-control patazon-border-radius" name="nextOfKinPhone" id="nextOfKinPhone" placeholder="Enter next of kin phone number like +2547********" 
                                    value="<?= $this->session->userdata() ? '' : ''?>">
                                    <div class="text-danger mt-2" id="ll_nextOfKinPhoneError" style="font-size: 12px;"></div>
                                </div>
                                <!-- End Input -->
                            </div>
    
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-3">
                                    <label class="form-label">
                                        Where do you live?
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="countyName" id="countyName" class="form-control patazon-border-radius">
                                        <option value="">Select county -- Empty --</option>
                                        <option value="Single" <?= $this->session->userdata('') === '' ? '' :  ''?>>Single</option>
                                        <option value="Married" <?= $this->session->userdata('') === '' ? '' :  ''?>>Married</option>
                                    </select>
                                    <div class="text-danger mt-2" id="ll_countyNameError" style="font-size: 12px;"></div>
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-3">
                                    <label class="form-label">
                                        Business Mobile Number
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control patazon-border-radius" placeholder="Enter phone number"
                                        name="dateOfBirth" id="dateOfBirth" min="1960-01-01" max="2004-12-31"
                                        value="<?= $this->session->userdata('date_of_birth') ? $this->session->userdata('date_of_birth') : ''?>"
                                        data-success-class="u-has-success">
                                            <div class="text-danger mt-2" id="ll_dobError" style="font-size: 12px;"></div>
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-3">
                                    <label class="form-label">
                                        Business Email Address (Optional)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="customerMarital" id="customerMarital" class="form-control patazon-border-radius">
                                        <option value="">Select Marital Status -- Empty --</option>
                                        <option value="Single" <?= $this->session->userdata('marital_status') === 'Single' ? 'selected' :  ''?>>Single</option>
                                        <option value="Married" <?= $this->session->userdata('marital_status') === 'Married' ? 'selected' :  ''?>>Married</option>
                                    </select>
                                    <div class="text-danger mt-2" id="ll_maritalError" style="font-size: 12px;"></div>
                                </div>
                                <!-- End Input -->
                            </div>
                            
                            <!-- ====== BACK AND NEXT BUTTONS ======= -->
                            <div class="col-6 col-md-6 mr-auto">
                                <a  href="<?= base_url('lipalater-employment-details')?>" class="btn btn-outline-info font-size-15 float-left btn-block"><i class="fas fa-arrow-left"></i> Back</a>
                            </div>
                            
                            <div class="col-6 col-md-6 ml-auto">
                                <a  href="<?= base_url('company-details')?>" id="submitOccupationalDetails" class="btn btn-info font-size-15 float-right text-white btn-block">Next <i class="fas fa-arrow-right"></i></a>
                            </div>
    
                            <div class="w-100"></div>
                        </div>
                        <!-- End Billing Form -->                        

                        <span class="form-check-label form-label mt-3" for="guesterms">
                        Aready have an account with lipalater? <a href="javascript:;" class="text-blue" onclick="buyWithLipalater()">Click Here</a>
                        </span>
                    </div>
                </div>
            </div>
        </form>

        <!-- Place Order Button -->
        <div class="pb-3">
            <button type="submit" disabled class="btn btn-primary-dark-w btn-block btn-pill d-sm-inline-block d-md-none font-size-20 text-white">
                Place Order
            </button>
        </div>
    </div>
</div>


<?php $this->load->view('templates/footer'); ?>
