<div class="modal fade" id="confirmPaymentInformation" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <!-- Single Product Body -->
                        <div class="row">
                            <div class="col-md-5">
                                <div class="js-slide">
                                    <a href="" id="productURL">
                                        <img class="img-fluid" src="<?= base_url('assets/img/images/mpesalogo.png')?>"
                                            id="" alt="Mpesa Logo" width="400">
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class=" mb-2">
                                    <h4><b style="font-size: 1rem; margin-bottom: 10px;">Pay with Safaricom M-PESA on
                                            your phone.</b></h4><br>
                                    <ol>
                                        <li>On the M-PESA Menu Go to "<b>Lipa Na M-PESA</b> and Select Buy Goods</li>
                                        <li>Enter the <b>Till Number: 718-6558</b> Patazon Marketplace</li>
                                        <li>Enter the total amount</li>
                                        <li>Enter your M-PESA PIN Confirm that all details are correct and press OK</li>
                                        <li>You will receive an M-PESA payment confirmation message on your mobile
                                            phone.</li>
                                        <li>Click place order button to confirm your order.</li>
                                    </ol>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 col-sm-12">
                            <button type="submit" id="paymentConfirmation"
                                class="btn px-5 btn-warning transition-3d-hover float-right m-auto"><i
                                    class="ec ec-check mr-2 font-size-20"></i> Confirm Payment</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Single Product Body -->
        </div>
    </div>
</div>
