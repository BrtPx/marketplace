<section class="input_create_account">
        <div class="main_input_sec">
            <div class="input_inner_wrapper">
                <div class="input_title">
                    <h2>Create Your Account & Shop With Confidence.</h2>
                   
                </div>
                <div class="form_input_s">
                    <form id="registerForm" action="<?= base_url('auth/register_user');?>" method="post" >
                        <div class="input_form_wrapper">
                            <label for="fullName" class="label_form_title">First Name</label>
                            <input type="text" placeholder="Shane" id="firstName" name="firstname" autocomplete="off">
                          
                        </div>
                        <div class="input_form_wrapper">
                            <label for="fullName" class="label_form_title">Last Name</label>
                            <input type="text" placeholder="Doe" id="lastName" name="lastname" autocomplete="off">
                     
                        </div>
                        <div class="input_form_wrapper input_email">
                            <label for="emailAddress">Email Address</label>
                            <input type="email" placeholder="user@email.com" id="email" name="email" class="input_before" autocomplete="off">
                            
                        </div>
                        <div class="input_form_wrapper input_phone">
                            <label for="phone">Phone</label>
                            <input type="number" placeholder="Phone number" id="phone" name="phone" class="input_before" autocomplete="off">
                           
                        </div>
                        <div class="input_form_wrapper input_password">
                            <label for="password">Password</label>
                            <input type="password" placeholder="****************" id="password" name="password" class="input_before password" autocomplete="off">
                            <button type="button" class="eye" id="eye" onclick="toggle()">
                                <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.0002 0.75C5.8335 0.75 2.27516 3.34167 0.833496 7C2.27516 10.6583 5.8335 13.25 10.0002 13.25C14.1668 13.25 17.7252 10.6583 19.1668 7C17.7252 3.34167 14.171 0.75 10.0002 0.75ZM10.0002 11.1667C7.70016 11.1667 5.8335 9.3 5.8335 7C5.8335 4.7 7.70016 2.83333 10.0002 2.83333C12.3002 2.83333 14.1668 4.7 14.1668 7C14.1668 9.3 12.3002 11.1667 10.0002 11.1667ZM10.0002 4.5C8.621 4.5 7.50016 5.62083 7.50016 7C7.50016 8.37917 8.621 9.5 10.0002 9.5C11.3793 9.5 12.5002 8.37917 12.5002 7C12.5002 5.62083 11.3793 4.5 10.0002 4.5Z" fill="" class="svg_class_color" />
                                </svg>
                            </button>
                        </div>
                        <div class="input_form_wrapper input_password">
                            <label for="password">Confirm Password</label>
                            <input type="password" placeholder="****************" id="confirmpassword" name="confirmpassword" class="input_before password" autocomplete="off"> 
                            <button type="button" class="eye" id="eye" onclick="toggle2()">
                                <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.0002 0.75C5.8335 0.75 2.27516 3.34167 0.833496 7C2.27516 10.6583 5.8335 13.25 10.0002 13.25C14.1668 13.25 17.7252 10.6583 19.1668 7C17.7252 3.34167 14.171 0.75 10.0002 0.75ZM10.0002 11.1667C7.70016 11.1667 5.8335 9.3 5.8335 7C5.8335 4.7 7.70016 2.83333 10.0002 2.83333C12.3002 2.83333 14.1668 4.7 14.1668 7C14.1668 9.3 12.3002 11.1667 10.0002 11.1667ZM10.0002 4.5C8.621 4.5 7.50016 5.62083 7.50016 7C7.50016 8.37917 8.621 9.5 10.0002 9.5C11.3793 9.5 12.5002 8.37917 12.5002 7C12.5002 5.62083 11.3793 4.5 10.0002 4.5Z" fill="" class="svg_class_color" />
                                </svg>
                            </button>
                        </div>
                        <div class="input_form_wrapper">
                            <input type="submit" class="submit" value="Sign Up">
                            <p>Already have  an account!  <a href="<?=base_url('account-login');?>" class="login_link">Login.</a></p>
                            <p class="signup_text">Or Sign Up With Social Accounts</p>
                        </div>
                        <div class="wrap-social-icons">
                            <ul class="social-icons">
                                <li><a class="btn google" href="#"><span class="a-text-1">Google Login</span><i class="fab fa-google"></i></a></li> 
                       
                            </ul>
                            <p class="mt-4 text-center input_bottom_text">By clicking any of the social login buttons you agree to the terms of privacy policy described <a href="#" class="link_here">here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>