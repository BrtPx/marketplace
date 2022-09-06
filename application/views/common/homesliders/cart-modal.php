<div class="modal fade" id="loadpaymentinfo" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row" align="center">
                    <div class="col-md-12">
                        <img src="<?= base_url(); ?>assets/img/images/loader.gif" alt="" width="100" class="loading"><br>
                        <span> &nbsp;&nbsp;Loading please wait... </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addCard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal_dialog">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 0;">
          <button type="button" class="btn-close btn_close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="modal-body modal_body d-flex" >
            <div id="resImage" class=""></div>
            <!-- <img width="25" height="25" class="me-2" src="<?= base_url() ?>assets/img/tick.svg" alt=""> -->
          <p id="cartmessage" >You have succesfully added brookside whole milk 500ml To your cart</p>
        </div>
        <div class="modal-footer pb-4" style="border-top: 0;">
          <button type="button" id="viewCart" class="btn btn_modal">VIEW CART</button>
          <button type="button" id="continueshopping" class="btn btn_modal">CONTINUE SHOPPING</button>
          <button type="button" id="proceedcheckout" class="btn btn_modal">CHECKOUT</button>
        </div>
      </div>
    </div>
  </div>