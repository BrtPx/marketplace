<?php $this->load->view('common/header2');?>
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
                    <div class="product-price-child">
                        <div class="p-text">
                            <h5 class="mb-4">Personal Price</h5>
                        </div>
                        <div class="row wrap-p-data-3">
                            <div class="col-md-3 data-3-child">
                                <div class="data-child">
                                    <label for="b_name">Fist Name</label>
                                    <input id="b_name" type="text" value="<?= $userInfo->firstname; ?>">
                                </div>
                            </div>
                            <div class="col-md-3 data-3-child">
                                <div class="data-child">
                                    <label for="m_name">Last Name</label>
                                    <input id="m_name" type="text" value="<?= $userInfo->lastname; ?>"  >
                                </div>
                            </div>
                            <div class="col-md-3 data-3-child">
                                <div class="data-child">
                                    <label for="e_name">Email</label>
                                    <input id="e_name" type="email" value="<?= $userInfo->email; ?>" >
                                </div>
                            </div>
                            <div class="col-md-3 data-3-child">
                                <div class="data-child">
                                    <label for="sdf">Phone Number</label>
                                    <input id="sdf" type="number" value="<?= $userInfo->phone; ?>" >
                                </div>
                            </div>
                            <div class="col-md-3 data-3-child">
                                <div class="data-child">
                                    <label for="f">Gender(optional)</label>
                                    <!-- <input id="v_name" type="text"> -->
                                    <select id="f">
                                        <option value="a">select</option>
                                        <option value="a">Male</option>
                                        <option value="a">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 data-3-child">
                                <div class="data-child">
                                    <label for="s">Birth Day(optional)</label>
                                    <input id="s" type="date">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-danger w-100" value="SAVE">
                        </div>
                    </div>
                </div>

                <div class="product-variant">
                    <div class="product-variant-child">
                        <div class="p-text">
                            <h5 class="mb-4">Shipping Address</h5>
                        </div>
                        <div class="wrap-p-data-3">
                            <div class="data-3-child">
                                <?php if($address):?>
                                <div class="data-child">
                                    <div class="address-box">
                                        <h5><?= $address->firstname.' '. $address->lastname ?></h5>
                                        <?php $county = $this->db->get_where('ptz_counties', array('county_code' => $address->county))->row()->county_name; ?>
                                        <ul class="address-ul">
                                            <li><?= $address->street?></li>
                                            <li><?= $address->region .', '.$county; ?></li>
                                            <li>+254 <?= substr($address->phone, 1); ?></li>
                                        </ul>
                                        <div class="address-bottom">
                                            <p class="p-green">Default address</p>
                                        </div>
                                    </div>
                                    
                                    <div class="input-address">
                                        <input type="text" placeholder="Set as Default">
                                        <a href="#" class="img-address">
                                            <img src="<?= base_url()?>assets/img/images/pencil-edit-button-svgrepo-com 2.svg" alt="">
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                            </div>
                            <div class="data-3-child">
                            <?php if($address):?>
                                <div class="data-child">
                                    <div class="address-box">
                                        <h5><?= $address->firstname.' '. $address->lastname ?></h5>
                                        <ul class="address-ul">
                                            <li><?= $address->street?></li>
                                            <li><?= $address->region .', '.$county; ?></li>
                                            <li>+254 <?= substr($address->phone, 1); ?></li>
                                        </ul>
                                        <div class="address-bottom">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="input-address">
                                        <input type="text" placeholder="Set as Default">
                                        <div class="img-address">
                                            <img src="<?= base_url()?>assets/img/images/pencil-edit-button-svgrepo-com 2.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>  

<?php $this->load->view('common/footer'); ?>