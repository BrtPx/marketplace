<?php $this->load->view('common/header2'); ?>
<div class="wrap-dashboard">
        <?php $this->load->view('common/customerbar'); ?>
        <div class="dashboard-details">
            <div class="main_wrapper">
                <div class="main_sec_title">
                    <h2>Order Details</h2>
                </div>
                <div class="order_no">
                    <h4>Order#  <?= $orderId; ?></h4>
                </div>
                <div class="sec_1">
                    <div class="left_sec">
                        <table id="product_table">
                            <tr class="product_title">
                                <th class="text-center">Product</th>
                                <th>Price(KES)</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                            <?php  $input = substr($order->date_created,0,10); 
                                    $dat = strtotime($input);
                                    $date = date('d/M/Y', $dat); 
                            
                            foreach($ordersItems as $items):?>
                            <tr style="border-bottom: 1px solid #D7D7D7;">
                                <td>
                                    <div class="product_img_content">
                                        <div class="img_product">
                                            <img src="<?= imagebaseURL.$items->product_image; ?>" width="121" height="121" alt="">
                                        </div>
                                        <div class="content_product">
                                            <p><?= $date; ?></p>
                                            <p><?= $items->product_name; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="center_text">
                                    <p class="price_row"><?= number_format($items->product_price) ?></p>
                                </td>
                                <td class="center_text">
                                    <p class="price_row"><?= $items->product_qty; ?></p>
                                </td>
                                <td class="center_img">
                                    <div class="img_action">
                                        <a href="javascript:;"><img src="<?= base_url()?>assets/img/images/eye.svg" alt=""></a>
                                        <a href="javascript:;"><img src="<?= base_url()?>assets/img/images/delete.svg" alt=""></a>
                                    </div>
                                </td>
                                
                            </tr>
                            <?php endforeach; ?>
                            <!-- <tr>
                                <td>
                                    <div class="product_img_content">
                                        <div class="img_product">
                                            <img src="<?= base_url()?>assets/img/images/img_product_2.png" alt="">
                                        </div>
                                        <div class="content_product">
                                            <p>31 Aug 2021</p>
                                            <p>Xiaomi Mi 11 Ultra 8GB 256GB 6.81" 20mp selfie 50MP</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="center_text">
                                    <p class="price_row">1,650</p>
                                </td>
                                <td class="center_img">
                                    <div class="img_action">
                                        <a href="#"><img src="<?= base_url()?>assets/img/images/eye.svg" alt=""></a>
                                        <a href="#"><img src="<?= base_url()?>assets/img/images/delete.svg" alt=""></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product_img_content">
                                        <div class="img_product">
                                            <img src="<?= base_url()?>assets/img/images/img_product_3.png" alt="">
                                        </div>
                                        <div class="content_product">
                                            <p>31 Aug 2021</p>
                                            <p>Xiaomi Mi 11 Ultra 8GB 256GB 6.81" 20mp selfie 50MP</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="center_text">
                                    <p class="price_row">1,650</p>
                                </td>
                                <td class="center_img">
                                    <div class="img_action">
                                        <a href="#"><img src="<?= base_url()?>assets/img/images/eye.svg" alt=""></a>
                                        <a href="#"><img src="<?= base_url()?>assets/img/images/delete.svg" alt=""></a>
                                    </div>
                                </td>
                            </tr> -->
                        </table>
                    </div>    
                    <div class="right_sec">
                        <div class="right_sec_content">
                            <p>Invoice #: 16835973</p>
                            <p>Payment: <?= $order->payment_mode; ?></p>
                            <p>Order Status: <?= $order->order_status; ?></p>
                        </div>
                        <div class="right_sec_footer">
                            <p>Total Amount: <span class="total_amout_class">KES <?= number_format($order->amount_paid); ?></span></p>
                        </div>
                    </div>
                </div>
                <div class="sec_2">
                    <div class="sec_shop_info">
                        <table id="table_2">
                            <tr class="table_row_header">
                                <th class="shop_info_title"><p>Customer</p></th>
                                <th class="shop_info_title"><p>Shipping Information</p></th>
                                <th class="shop_info_title shop_info_title_2"><p>Action</p></th>
                            </tr>
                            <tr>
                                <td class="table_2_td">
                                <?php $county = $this->db->get_where('ptz_counties', array('county_code' => $address->county))->row()->county_name; ?>
                                    <div class="sec_2_inner_content">
                                        <p class="shop_desc"><?= $address->firstname.' '.$address->lastname; ?></p>
                                        <p class="shop_desc"><?= $address->street.', '.$address->region.' '.$county.' Kenya'; ?></p>
                                    </div>
                                </td>
                                <td class="table_2_td">
                                    <div class="sec_2_inner_content">
                                        <p class="shop_desc_2">Provider: Wells Fargo</p>
                                        <p class="shop_desc_2">Tracking  Code: 3546576879-6</p>
                                        <p class="shop_desc_2">Tracking  Link: <a href="#">Click Here</a></p>
                                    </div>
                                </td>
                                <td class="table_2_td">
                                    <div class="sec_2_inner_content table_2_td_2">
                                        <button class="ready_to_ship"><a href="#">Ready to Ship</a></button>
                                        <button class="cancel"><a href="#">Cancel Order</a></button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
    
            </div>
        </div>
    </div>

<?php $this->load->view('common/footer'); ?>