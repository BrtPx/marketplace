<?php $this->load->view('common/header2'); ?>

<div class="wrap-dashboard">
    <div class="wrap-dashboard">
        <?php $this->load->view('common/customerbar');?>

        <div class="dashboard-details">
            <div class="upload">
                <h4>General Details</h4>
            </div>
            <!-- upload end -->
            <form class="p-form">

                <div class="product-price">
                    <div class=" product-price-child">
                        <div class="p-text">
                            <h5 class="mb-4">Change Password</h5>
                        </div>
                        <div class="row wrap-p-data-3">
                            <div class="col-md-3 data-3-child">
                                <div class="data-child">
                                    <label for="b_name">Current Password</label>
                                    <input id="b_pass" type="password">
                                </div>
                                <div class="text-danger" id="currentpass"></div>
                            </div>
                            <div class="col-md-3 data-3-child">
                                <div class="data-child">
                                    <label for="m_name">New Password</label>
                                    <input id="m_pass" type="password">
                                </div>
                                <div class="text-danger" id="newpass"></div>
                            </div>
                            <div class="col-md-6 data-3-child">
                                <div class="data-child">
                                    <label for="e_name">Retype New Password﻿</label>
                                    <input id="e_pass" type="password">
                                </div>
                                <div class="text-danger" id="confirmpass"></div>
                            </div>
                            <div class="data-3-child">
                                <div class="data-child">
                                    <!-- <label for="s">Password tips</label> -->
                                    <!-- <input id="s" type="date"> -->
                                </div>
                            </div>
                            <div class="input_form_wrapper">
                            
                            <input type="button" id="passwordchng" class="btn btn-danger w-100" value="SUBMIT">
                        </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div> 

<?php $this->load->view('common/footer'); ?>