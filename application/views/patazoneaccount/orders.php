<?php $this->load->view('common/header2'); ?>
<div class="wrap-dashboard">
        <?php $this->load->view('common/customerbar');?>
        <div class="dashboard-details">
            <div class="main_content">
                <?php if($orders):?>
                <div class="sec1">
                    <div class="sec_heading">
                        <h2>Order History</h2>
                    </div>
                    <div class="input_table_data">
                        <div class="search_keyword_date">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" placeholder="Keyword">
                                </div>
                                <div class="col-md-3">
                                    <select id="inputState" class="form-select">
                                        <option selected>Status</option>
                                        <option>Delivered</option>
                                        <option>Returned</option>
                                        <option>Cancelled</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="Date Form">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="Date To">
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="form-control input_submit_header" value="Search">
                                </div>
                            </div>
                        </div>
                        <div class="table_data">
                            <table class="table table_design" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="th_width" scope="col">Order ID & Date</th>
                                        <th class="th_width" scope="col">Details</th>
                                        <th class="th_width" scope="col">Price(KES)</th>
                                        <th class="th_width" scope="col">Status</th>
                                        <th class="th_width" scope="col">Delivery Status</th>
                                        <th class="th_width" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($orders as $order):
                                        $input = substr($order->date_created,0,10); 
                                        $dat = strtotime($input);
                                        $date = date('d/M/Y', $dat);
                                        $time = substr($order->date_created,12,19); 
                                        $totalOrderItems = $this->db->get_where('ptz_cart', array('order_id' => $order->order_id))->num_rows();
                                    
                                        ?>
                                    <tr>
                                        <td scope="row">
                                            <p><?= $order->order_id?></p>
                                            <p><?= $date; ?></p>
                                        </td>
                                        <td>
                                           <p><?= ($totalOrderItems == 1) ? $totalOrderItems.' Item':$totalOrderItems.' Items'; ?> </p>
                                           <p><?= $time; ?></p>
                                        </td>
                                        <td>
                                            <p><?= number_format($order->amount_paid); ?></p>
                                        </td>
                                        <?php if($order->is_paid == 0 ):?>
                                            <td>
                                                <p>Payment Pending</p>
                                            </td>
                                        <?php else: ?> 
                                            <td>
                                                <p>Payment Complete</p>
                                            </td>
                                        <?php endif; ?>
                                        <?php if($order->order_status == 'Cancelled'): ?>
                                            <td>
                                                <p class="cancelled">Cancelled</p>
                                            </td>
                                        <?php elseif($order->order_status == 'Complete'):?>
                                            <td>
                                                <p class="delivered">Delivered</p>
                                            </td>
                                        <?php elseif($order->order_status == 'Processing'):?>
                                            <td>
                                                <p class="delivered">Processing</p>
                                            </td>
                                        <?php elseif($order->order_status == 'Recieved'):?>
                                            <td>
                                                <p class="returned">Recieved</p>
                                            </td>
                                        <?php else:?>
                                            <td>
                                                <p class="delivered">Pending</p>
                                            </td>
                                        <?php endif; ?>
                                        <td>
                                            <button onclick="getOrderDetails('<?= base_url('customer/account/orderdatails/'.base64_encode($order->order_id))?>')" class="table_button">View</button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                    <div class="sec1">
                        <div class="sec_heading">
                            <h2>Order History</h2>
                        </div>
                        <div class="input_table_data">
                                <div class="search_keyword_date">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <div class="m-auto">
                                                <p >You have not placed any order yet. Click <a class="text-danger" style="text-decoration: none;" href="<?= base_url(''); ?>"> Here </a> to start shopping.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $this->load->view('common/footer'); ?>