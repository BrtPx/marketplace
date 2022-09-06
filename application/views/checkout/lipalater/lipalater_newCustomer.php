<div class="wrap_bg" style="background-color: #F7F6F2 !important">
        <!-- <div class="nav_after_header">
            <ul>
                <li><a href="#">Home</a></li><span><i class="fas fa-chevron-right"></i></span>
                <li><a href="#">First Time Customer</a></li><span><i class="fas fa-chevron-right"></i></span>
            </ul>
        </div> -->
        
        <div class="container-fluid p-10">
            <div class="row justify-content-center">
                <div class="col-11  text-center mt-3 mb-2">
                    <div class="card px-3 pt-4 pb-0 mt-3 mb-3">
                        <h2 id="heading"></h2>
                        <p id="registrationInfo">NOTE: If you are buying for the first time with Lipalater, kindly provide your details for verification before you proceed to registration.</p>
                        <form class="newCustomerVerificationOTP lipalaterregister"action="<?= base_url('lipalater/firstTimeCustomerVerification')?>" id="msform">
                            <fieldset>
                                <div class="row form-card">
                                    <div class="">
                                        <div class="col-7">
                                            <h2 class="">OTP Information:</h2>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="fieldlabels">First Name:*</label> 
                                        <input type="text" name="first_name"  id="lipalate_firstName" placeholder=" Enter your First Name" />
                                        <div class="text-danger mt-2" id="firstNameError_msg" style="font-size: 12px;"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fieldlabels">Last Name: *</label> 
                                        <input type="text" name="last_name"  id="lipalater_lastName" placeholder="Enter your Last Name" />
                                        <div class="text-danger mt-2" id="lastNameError_msg" style="font-size: 12px;"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fieldlabels">Phone Number: *</label>
                                        <input type="text" name="phone_number" id="lipalaterCustomerPhone"  placeholder="Enter your phone number" /> 
                                        <div class="text-danger mt-2" id="phoneError_msg" style="font-size: 12px;"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fieldlabels">National ID *</label> 
                                        <input type="number" name="id_number" id="lipalaterNationalId" placeholder="provide your national ID" />
                                        <div class="text-danger mt-2" id="idNumberError_msg" style="font-size: 12px;"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fieldlabels">Date of Birth</label> 
                                        <input type="date" name="date_of_birth" id="lipalater_dob" min="1960-01-01" max="2004-12-31" />
                                        <div class="text-danger mt-2" id="dobError_msg" style="font-size: 12px;"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fieldlabels">Country code *</label> 
                                        <select class="fieldlabels"  name="country_code" id="country_code" >
                                            <option value="KE" selected>Kenya</option>
                                            <option value="UG">Uganda</option>
                                            <option value="RW">Nigeria</option>
                                            <option value="NG">Rwanda</option>
                                        </select>
                                        <div class="text-danger mt-2" id="countryCode_error" style="font-size: 12px;"></div>
                                    </div>
                                </div> 
                                <div class="input_form_wrapper">
                                    <button type="submit"  id="newCustomerVerifyButton" class="btn btn-danger submit w-25 ">submit</button>
                                </div>

                            </fieldset>
                            <p class="mb-3">Already have a Lipalater Account?<a style="text-decoration: none;" href="javascript:;" id="lll">&nbsp;SignIn here</a></p>
                        </form>
                        <form action="<?= base_url('lipalater/validateExistingCustomer') ?>" class="lipalaterlogin mb-5" id="msform">
                            <fieldset>
                                <div class="row form-card">
                                    <div class="">
                                        <div class="col-7">
                                            <h3 class="">Login Details:</h3>
                                        </div>
                                    </div> 
                                    <div class="col-md-12 form-outline">
                                        <label class="fieldlabels">National ID *</label> 
                                        <input type="number" name="ll_id" id="ll_id" placeholder="provide your national ID" />
                                        <label class="fieldlabels">Phone Number: *</label>
                                        <input type="number" name="ll_Phone_number" id="ll_phoneLabel" placeholder="Enter your phone number" /> 
                                    </div>
                    
                                </div> 
                                <div class="input_form_wrapper">
                                    <button type="submit" class="btn btn-danger submit w-25" id="existingCustomerButton">submit</button>
                                </div>
                            </fieldset>
                            <p class="mb-3">Already have OTP code ?<a href="javascript:;"data-bs-toggle="modal" data-bs-target="#llOtpmodal">Click here</a></p>
                            <p class="mb-3">Don't have a Lipalater Account?<a style="text-decoration: none;" href="https://app.lipalater.com/ke/customer/signup" target="blank" id="llr">&nbsp; Register here</a></p>
                        </form>
                        <form class="lipalaterlogins mb-5 finish" id="msform">
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="text-center"><strong id="status">SUCCESS !</strong></h2> <br>
                                    <div class="row justify-content-center">
                                        <div class="col-3" id="icons">  </div>
                                        
                                    </div> <br><br>
                                    <div id="lldisplay">
                                        <div class="row justify-content-center">
                                        
                                            <div class="col-md-6 text-center">
                                                <label class="fieldlabels" style="font-size: 20px !important">Status: </label>  
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <label class="" style="color: green; font-weight: bold; font-size: 30px" id="limitstatus"><span >Active</label>
                                            </div>    
                                        </div><br>
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 text-center">
                                                <label class="fieldlabels" style="font-size: 20px !important">Awarded Credit Limit: </label>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <label class="fieldlabels credit_limit" style="font-weight: bold;" id="awardLimit"></label>
                                            </div>
                                        </div><br>
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 text-center">
                                                <label class="fieldlabels" style="font-size: 20px !important">Available Credit Limit: </label>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <label class="fieldlabels credit_available" style="font-weight: bold;" id="avaLimit"> </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="card-body container" id="loandetail">
                                            <div class="row justify-content-center">
                                                
                                                <div class="col-md-6 text-center">
                                                    <label class="fieldlabels" style="font-size: 20px !important">Loan Amount: </label>  
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <label class="" style="color: green; font-weight: bold; font-size: 30px" id="loanamount"><span ></label>
                                                </div>    
                                            </div><br>
                                            <div class="row justify-content-center">
                                                <div class="col-md-6 text-center">
                                                    <label class="fieldlabels" style="font-size: 20px !important">Upfront Fee: </label>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <label class="fieldlabels" style="font-weight: bold;" id="upfrontpay"></label>
                                                </div>
                                            </div><br>
                                            <div class="row justify-content-center">
                                                <div class="col-md-6 text-center">
                                                    <label class="fieldlabels" style="font-size: 20px !important">First payment: </label>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <label class="fieldlabels" style="font-weight: bold;" id="firstpay"> </label>
                                                </div>
                                            </div><br>
                                            <div class="row justify-content-center">
                                                <div class="col-md-6 text-center">
                                                    <label class="fieldlabels" style="font-size: 20px !important">Monthly Payment: </label>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <label class="fieldlabels" style="font-weight: bold;" id="montlhlypay"> </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br><br>
                            <div class="row justify-content-center">
                                <div class="col-12 text-center">
                                    <h5 class="text-center lipatext"></h5>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <input type="button" name="" id="llcancel" class="action-button-previous" value="Cancel" />&nbsp;&nbsp;
                                <input type="button" name="" id="lipaOrder" class="action-button " value="Place order" />
                            </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- Modal -->
<div class="modal fade form-card" id="llOtpmodal" tabindex="-1" aria-labelledby="llOtpmodal" aria-hidden="true">
        <div class="modal-dialog modal_dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 0;">
            <button type="button" class="btn-close btn_close" data-bs-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
            </div>
            <div class="modal-body modal_body d-flex">
                    <form class=""  id="verify_otp_message">
                            <h2 class="h4 text-center mb-1">OTP Confirmation.</h2>
                            <p class="m-0">Enter the code that was sent to you via SMS to complete your order.</p>
                        <div class="form-card p-3">
                            <div class="" id="otpmessage_error"></div>   
                            <label class="fieldlabels"id="ll_OTPLabel">Enter OTP Code *</label> 
                            <input type="number" name="" id="otpSMS" /> 
                        </div>
                    </form>
            </div> 
            <div class="modal-footer pb-4" style="border-top: 0;">                                    
                <button type="button" class="btn btn_modal"id="otpSubmitButton">Submit</button>
            </div>          
        </div>
        </div>
    </div>

    