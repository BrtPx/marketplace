<div class="wrap_bg" style="background-color: #F7F6F2 !important">
        <!-- <div class="nav_after_header">
            <ul>
                <li><a href="#">Home</a></li><span><i class="fas fa-chevron-right"></i></span>
                <li><a href="#">Register With Lipalater</a></li><span><i class="fas fa-chevron-right"></i></span>
            </ul>
        </div> -->
    <div class="container-fluid p-10">
        <div class="row justify-content-center">
            <div class="col-11 text-center mt-2 mb-2">
                <div class="card px-3 pt-4 pb-0 mt-0 mb-3">
                    <div id="lipalater-message"></div>
                    <h4 id="heading">Register With Lipalater</h4>
                    <p align="justify" >NOTE :Please provide your details below as they appear on you national identification card.</p>
                    <form id="msform" class="submitLipalaterdata"action="<?= base_url('');?>" method="post">
                        <!-- progressbar -->
                        <ul class="mt-10" id="progressbar" >
                            <li class="active2" id="personal"><strong>Personal Info</strong></li>
                            <li id="payment"><strong>Occupation Info</strong></li>
                            <li id="account"><strong>Account Info</strong></li>
                            <li id="confirm"><strong>Finish</strong></li>
                        </ul>
                        <!-- <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div><br>  -->
                        <!-- fieldsets -->
                        
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h5 class="">Personal Information:</h5>
                                    </div>
                                    <div class="col-5">
                                        <h6 class="steps">Step 1 - 4</h6>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <label class="fieldlabels">First Name: *</label> <input type="text" name="first_name" placeholder="Enter your First Name"autocomplete="off" /> 
                                        <div class="text-danger mt-2" id="ll_firstNameError" style="font-size: 12px;"></div>
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="fieldlabels">Last Name: *</label> <input type="text" name="last_name" placeholder="Enter your Last Name"autocomplete="off" autocomplete="off"/>
                                            <div class="text-danger mt-2" id="ll_lastNameError" style="font-size: 12px;"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fieldlabels">Phone Number: *</label> <input type="text" name="phone_number" placeholder="Enter your phone number" autocomplete="off"/> 
                                        <div class="text-danger mt-2" id="ll_phoneError" style="font-size: 12px;"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fieldlabels">National ID : *</label> <input type="text" name="id_number" placeholder="Provide your national ID"autocomplete="off" />
                                        <div class="text-danger mt-2" id="ll_nationalIdError" style="font-size: 12px;"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fieldlabels">Date of Birth *</label> <input type="date" name="date_of_birth"autocomplete="off"/>
                                        <div class="text-danger mt-2" id="ll_dobError" style="font-size: 12px;"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fieldlabels">Marital Status*</label>
                                            <select class="mb-4 mr-3 fieldlabels" name="customerMarital"autocomplete="off" >
                                                <option value="">Select Marital Status</option>
                                                <option value="single">single</option>
                                                <option value="married">married</option>
                                            </select><br>
                                        <div class="text-danger mt-2" id="ll_maritalError" style="font-size: 12px;"></div> 
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fieldlabels">Select Gender*</label>
                                            <select style="width:100%" class="fieldlabels" name="customerGender" autocomplete="off" >
                                                <option value="">Select Gender</option>
                                                <option value="male">male</option>
                                                <option value="female">female</option>
                                            </select>
                                        <div class="text-danger mt-2" id="ll_genderError" style="font-size: 12px;"></div>
                                    </div>
                                </div> 
                                
                            </div> <input type="button" id='info' name="next" class="next action-button" value="Next" /> 
                        </fieldset>
                        <!-- next -->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h5 class="">Occupational Details:</h5>
                                    </div>
                                    <div class="col-5">
                                        <h4 class="steps">Step 2 - 4</h4>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <label  class="fieldlabels">Select Employment Type*</label>
                                        <select class="mb-4 mr-3" name="employmentStatus" id="employmentStatus" onchange="employmentType(this.value)" >
                                            <option value="">Select</option>
                                            <option value="Employed">employed</option>
                                            <option value="Self-Employed">self employed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 sector d-none">
                                        <label class="fieldlabels">Select Employment Sector*</label>
                                        <select class="mb-4 mr-3" name="employmentSector" id="employmentSector" onchange="changeOccupation(this.value)" >
                                            <option value="">Select</option>
                                            <option value="Private-Sector">Private sector</option>  
                                            <option value="Government-Sector">Government Sector</option>
                                        </select>
                                    </div>
                                    
                                    <!-- ======= SELF EMPLOYED INPUTS ======= -->
                                    <div class="col-md-6 self_employed d-none">
                                        <label class="fieldlabels">Select Business Type*</label>
                                        <select class="mb-4 mr-3" name="businessType" id="businessType" onchange="changeOccupation(this.value)" >
                                            <option value="">Select</option>
                                            <option value="student">Student</option>  
                                            <option value="freelancer">Freelancer</option>
                                            <option value="sole_proprietorship">Sole Proprietorship</option>
                                            <option value="partnership">Partnership</option>
                                            <option value="limited_company">Limited Company</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 self_employed d-none">
                                        <label class="fieldlabels">Business Name*</label><input type="text" name="business_name" id="business_name" placeholder="Enter your business Name" />                                     
                                    </div>
                                    <div class="col-md-6 self_employed d-none">
                                        <label class="fieldlabels">How do you recieve payments?*</label>
                                        <select class="mb-4 mr-3" name="getPaymentMode" id="getPaymentMode" onchange="changeOccupation(this.value)" >
                                            <option value="">Select</option>
                                            <option value="bank">Bank</option>  
                                            <option value="mobile_money">Mobile Money</option>
                                            <option value="cash">Cash</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 self_employed d-none">
                                        <label class="fieldlabels">Business Location*</label><input type="text" name="business_location" id="business_location" placeholder="Eg. Ronald Ngala Street RNG Plaza Nairobi." />                                     
                                    </div>
                                    <div class="col-md-6 self_employed d-none">
                                        <label class="fieldlabels">Average monthly personal expenses*</label><input type="number" name="personalExpense" id="personalExpense" placeholder="Ksh 0.00" />                                     
                                    </div>
                                    <div class="col-md-6 self_employed d-none">
                                        <label class="fieldlabels">Is your business Registered?*</label>
                                        <select class="mb-4 mr-3" name="business_registered" id="business_registered">
                                            <option value="">Select</option>
                                            <option value="registered">Yes</option>  
                                            <option value="not_registered">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 self_employed d-none">
                                        <label class="fieldlabels">Bussiness Industry?*</label>
                                        <select class="mb-4 mr-3" name="businessIndustry" id="businessIndustry" onchange="changeOccupation(this.value)">
                                            <option value="">Select</option>
                                            <option value="Accounting Auditing and Finance">Accounting Auditing and Finance</option>  
                                            <option value="Administrative and Office">Administrative and Office</option>
                                            <option value="Agriculture and Farming">Agriculture and Farming</option>
                                            <option value="Building and Architecture">Building and Architecture</option>
                                            <option value="Community and Social Services">Community and Social Services</option>
                                            <option value="Consulting and Strategy">Consulting and Strategy</option>
                                            <option value="Creative and Design">Creative and Design</option>
                                            <option value="Customer service and Support">Customer service and Support</option>
                                            <option value="Employability and Soft Skills">Employability and Soft Skills</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Food sciences and catering">Food sciences and catering</option>
                                            <option value="Health and Safety">Health and Safety</option>
                                            <option value="Hospitality, Leisure & Travel">Hospitality,Leisure & Travel</option>
                                            <option value="Marketing and Communication">Marketing and Communication</option>
                                            <option value="Medical and Pharmaceutical">Medical and Pharmaceutical</option>
                                            <option value="Natural sciences">Natural sciences</option>
                                            <option value="Project and Product management">Project and Product management</option>
                                            <option value="Quality Control and Assurance">Quality Control and Assurance</option>
                                            <option value="Real estate and Property Management">Real estate and Property Management</option>
                                            <option value="Research, Teaching, Training">Research, Teaching and Training</option>
                                            <option value="Sales">Sales</option>
                                            <option value="Security">Security</option>
                                            <option value="Supply Chain and Development">Supply Chain and Development</option>
                                            <option value="Trade and Services">Trade and Services</option>
                                            <option value="Transport and Logistics">Transport and Logistics</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 self_employed d-none">
                                        <label class="fieldlabels">Gross monthly bussiness revenue*</label><input type="number" name="monthlyBusinessRevenue" id="monthlyBusinessRevenue" placeholder="Ksh 0.00" />                                     
                                    </div>
                                    <div class="col-md-6 self_employed d-none">
                                        <label class="fieldlabels"> Average monthly expenses*</label><input type="number" name="monthlyBusinessExpenses" id="monthlyBusinessExpenses" placeholder="Ksh 0.00" />                                     
                                    </div>

                                        <!-- ====== PRIVATE SECTOR INPUTS ====== -->
                                    <div class="col-md-6 private_sector d-none">
                                        <label class="fieldlabels">Who is your employer?*</label><input type="text" name="employerName" id="employerName" placeholder="Enter your company Name" />                                     
                                    </div>
                                    <div class="col-md-6 private_sector d-none">
                                        <label class="fieldlabels">Job Function?*</label>
                                        <select class="mb-4 mr-3" name="jobFunction" id="jobFunction">
                                            <option value="">Select</option>
                                            <option value="Accounting Auditing and Finance">Accounting Auditing and Finance</option>  
                                            <option value="Administrative and Office">Administrative and Office</option>
                                            <option value="Agriculture and Farming">Agriculture and Farming</option>
                                            <option value="Building and Architecture">Building and Architecture</option>
                                            <option value="Community and Social Services">Community and Social Services</option>
                                            <option value="Consulting and Strategy">Consulting and Strategy</option>
                                            <option value="Creative and Design">Creative and Design</option>
                                            <option value="Customer service and Support">Customer service and Support</option>
                                            <option value="Employability and Soft Skills">Employability and Soft Skills</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Food sciences and catering">Food sciences and catering</option>
                                            <option value="Health and Safety">Health and Safety</option>
                                            <option value="Hospitality, Leisure & Travel">Hospitality,Leisure & Travel</option>
                                            <option value="Marketing and Communication">Marketing and Communication</option>
                                            <option value="Medical and Pharmaceutical">Medical and Pharmaceutical</option>
                                            <option value="Natural sciences">Natural sciences</option>
                                            <option value="Project and Product management">Project and Product management</option>
                                            <option value="Quality Control and Assurance">Quality Control and Assurance</option>
                                            <option value="Real estate and Property Management">Real estate and Property Management</option>
                                            <option value="Research, Teaching, Training">Research, Teaching and Training</option>
                                            <option value="Sales">Sales</option>
                                            <option value="Security">Security</option>
                                            <option value="Supply Chain and Development">Supply Chain and Development</option>
                                            <option value="Trade and Services">Trade and Services</option>
                                            <option value="Transport and Logistics">Transport and Logistics</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 private_sector d-none">
                                        <label class="fieldlabels">Select your job level?*</label>
                                        <select class="mb-4 mr-3" name="jobLevel" id="jobLevel">
                                            <option value="">Select</option>
                                            <option value="Intern">Intern</option>  
                                            <option value="Associate">Associate</option>
                                            <option value="Junior Manager">Junior Manager</option>
                                            <option value="Mid level manager">Mid level manager</option>
                                            <option value="Senior Manager">Senior Manager</option>
                                            <option value="Executive Manager">Executive Manager</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 private_sector d-none">
                                        <label class="fieldlabels">How do you recieve payments?*</label>
                                        <select class="mb-4 mr-3" name="modeOfPayment1" id="modeOfPayment1" onchange="changeOccupation(this.value)" >
                                            <option value="">Select</option>
                                            <option value="bank">Bank</option>  
                                            <option value="mobile_money">Mobile Money</option>
                                            <option value="cash">Cash</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 private_sector d-none">
                                        <label class="fieldlabels">What is your Net monthly income?*</label><input type="number" name="netMonthlyIncome1" id="netMonthlyIncome1" placeholder="Ksh 0.00" />                                     
                                    </div>
                                    <div class="col-md-6 private_sector d-none">
                                        <label class="fieldlabels">What is your  monthly expences?*</label><input type="number" name="monthlyExpenses1" id="monthlyExpenses1" placeholder="Ksh 0.00" />                                     
                                    </div>

                                        <!-- ====== GOVERNMENT SECTOR INPUTS ====== -->
                                    <div class="col-md-6 government_sector d-none">
                                        <label class="fieldlabels">Who is your employer ?*</label><input type="text" name="companyName" id="companyName" placeholder="Enter company name" />                                     
                                    </div>
                                    <div class="col-md-6 government_sector d-none">
                                        <label class="fieldlabels">What is your Job Group?*</label><input type="text" name="customerjobGroup" id="customerjobGroup" placeholder="Enter job group A-T" />                                     
                                    </div>
                                    <div class="col-md-6 government_sector d-none">
                                        <label class="fieldlabels">How do you recieve payments?*</label>
                                        <select class="mb-4 mr-3" name="paymentMode" id="paymentMode">
                                            <option value="">Select</option>
                                            <option value="bank">Bank</option>  
                                            <option value="mobile_money">Mobile Money</option>
                                            <option value="cash">Cash</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 government_sector d-none">
                                        <label class="fieldlabels">What is your Net monthly income?*</label><input type="number" name="netMonthlyIncome" id="netMonthlyIncome" placeholder="Ksh 0.00" />                                     
                                    </div>
                                    <div class="col-md-6 government_sector d-none">
                                        <label class="fieldlabels">What is your  monthly expences?*</label><input type="number" name="monthlyExpenses" id="monthlyExpenses" placeholder="Ksh 0.00" />                                     
                                    </div>
                                    
                                </div>
                                
                            </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <!-- next -->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h5 class="">Account Information:</h5>
                                    </div>
                                    <div class="col-5">
                                        <h4 class="steps">Step 3 - 4</h4>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <label class="fieldlabels">Email: *</label> <input type="email" name="ll_email" id="ll_email" placeholder="Enter your email address" /> 
                                    <div class="text-danger mt-2" id="ll_emailError" style="font-size: 12px;"></div>
                                </div>                               
                                <div class="col-md-12">
                                    <label class="fieldlabels">Password: *</label> <input type="password" name="ll_password" id="ll_password" placeholder="Enter your Password" /> 
                                        <div class="text-danger mt-2" id="ll_passwordError" style="font-size: 12px;"></div>
                                </div>  
                                <div class="col-md-12">
                                    <label class="fieldlabels">Confirm Password: *</label> <input type="password" name="confPassword" id="confPassword" placeholder="Please your Confirm Password" />
                                    <div class="text-danger mt-2" id="ll_confPasswordError" style="font-size: 12px;"></div>
                                </div>  
                            </div> 
                            <input type="button" name="" class="next action-button" value="Submit" />
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />

                        </fieldset>
                        <!-- next -->      
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h5 class="">Finish:</h5>
                                    </div>
                                    <div class="col-5">
                                        <h4 class="steps">Step 4 - 4</h4>
                                    </div>
                                </div> <br><br>
                                <h2 class="text-center"><strong>SUCCESS !</strong></h2> <br>
                                <div class="row justify-content-center">
                                    <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                                </div> <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <h5 class="text-center">You Have Successfully Signed Up</h5>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>