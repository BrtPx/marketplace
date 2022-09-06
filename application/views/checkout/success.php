<?php $this->load->view('templates/header')?>
<div class="" ></div>
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <div class="container my-5 success-payment patazon-border-radius" style="padding: 50px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background-color: #F5F5F5;">
                    <div class="row">
                        <div class="offset-md-3 col-md-6">
                            <div class="mb-5 text-center pb-3 border-bottom border-color-1">
                                    <h1 class="font-size-sl-50 font-weight-light mb-2 text-success">Thank you for your purchase!!</h1>
                                    <img class="text-center mb-2" align="center" src="<?= base_url('uploads/others/tick.svg'); ?>" width="100" alt="">
                                    <h6 class="font-size-sl-35 font-weight-light mb-3 ">Your order # is: <b><?php echo $this->session->userdata('orderid')?></b>.</h6>
                                    <p class="text-gray-90 font-size-18 mb-0 font-weight-light"> An email containing order confirmation details and tracking info has been sent to <b><?php echo $this->session->userdata('email')?></b>,<br> click the button below to continue shopping</p>
                                </div>

                    
                            <div class="text-center pb-5">
                                <a href="<?= base_url('shop') ?>" type="submit"
                                    class="btn btn-warning px-5 text-white mb-2" onclick="backToPreviousPage()">Back to shopping</a>
                                    <a href="<?= base_url('') ?>" type="submit"
                                    class="btn btn-primary-dark-w px-5 text-white" onclick="backToPreviousPage()">Take me back</a>
                            </div>
                        </div>
                    </div>
                    
                   
                </div>

            </div>
        </div>

<?php $this->load->view('templates/footer')?>