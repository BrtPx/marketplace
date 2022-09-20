<div class="wrap_bg">

    <div class="container">
        <div class="mb-5">
            <h1 class="text-center">Contact Us</h1>
        </div>
        <div class="row mb-10">
            <div class="col-lg-7 col-xl-6 mb-8 mb-lg-0">
                <div class="mr-xl-6">
                    <div class="border-bottom border-color-1">
                        <h4 class="section-title mb-0 pb-2">Leave us a Message</h4>
                    </div>
                    <p class="max-width-830-xl text-gray-90 bg-white p-3">
                        Our range of services are designed to ensure optimum levels of convenience and customer satisfaction with the retail process, these services include; our lowest price guarantee, 7-day free return policy*, order and delivery-tracking, dedicated customer service support and many other premium services.
                        <br>
                        As we continue to expand the mall, our scope of services will increase in variety, simplicity and affordability; join us and enjoy the increasing benefits.
                        <br>
                        We are highly customer-centric and are committed towards finding innovative ways of improving our customers' shopping experience; fill in the fields below to give us some feedback.
                        <br><br>Thank you and we hope you enjoy your experience with us.
                    <div class="emailCenterSuccess_msg"></div>
                    <form class="js-validate" novalidate="novalidate" id="customerEmailCenter">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-4">
                                    <label class="form-label">
                                        First name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="firstName" id="customerMsgFirstName" placeholder="" aria-label="" required="" data-msg="Please enter your frist name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                                    <small class="text-danger" id="firstName_error"></small>
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-4">
                                    <label class="form-label">
                                        Last name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="lastName" id="customerMsgLastName" placeholder="" aria-label="" required="" data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success">
                                    <small class="text-danger" id="lastName_error"></small>
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-4">
                                    <label class="form-label">
                                        Email Address
                                    </label>
                                    <input type="text" class="form-control" name="msg_email" id="customerMsgEmail" placeholder="" aria-label="" data-msg="Please enter an email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                    <small class="text-danger" id="email_error"></small>
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-4">
                                    <label class="form-label">
                                        Subject
                                    </label>
                                    <input type="text" class="form-control" name="msg_subject" id="customerMsgSubject" placeholder="" aria-label="" data-msg="Please enter subject." data-error-class="u-has-error" data-success-class="u-has-success">
                                    <small class="text-danger" id="customerSubject_error"></small>
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-12">
                                <div class="js-form-message mb-4">
                                    <label class="form-label">
                                        Your Message
                                    </label>
                                    <div class="input-group">
                                        <textarea class="form-control p-5" rows="4" name="msg_text" id="customerMsgMessage" placeholder=""></textarea>
                                    </div>
                                    <small class="text-danger" id="message_error"></small>
                                </div>
                            </div>
                            <input type="hidden" id="customerSendMailURL" value="<?= base_url('home/send_customer_email'); ?>">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-danger px-10 btn-block " id="customerMessageForm">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 col-xl-6 bg-white p-3">
                <div class="mb-6">
                    <iframe src="https://maps.google.com/maps?q=RNG%20PLAZA&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="288" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title mb-0 pb-2 font-size-25">Our Address</h3>
                </div>
                <address class="mb-6 text-lh-23">
                    RNG Plaza 6th floor,<br>
                    Ronald Ngala Street,<br>
                    Nairobi-Kenya
                    <div class="">Support<a href="tel:0700588885">(+254)700588885</a></div>
                    <div class="">Email: <a class="text-blue text-decoration-on" href="mailto:info@patazone.co.ke">info@patazone.co.ke</a></div>
                </address>
                <h5 class="font-size-14 font-weight-bold mb-3">Opening Hours</h5>
                <div class="">Monday to Friday: 8am-5pm</div>
                <div class="mb-6">Saturday to Sunday: 8am-2pm</div>

            </div>
        </div>
    </div>
</div>
<?php $this->load->view('common/scroll-nav'); ?>