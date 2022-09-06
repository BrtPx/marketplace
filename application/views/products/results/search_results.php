<?php foreach ($products as $product) : ?>
    <div class="col-md-3 box">
        <?php if ($product->discount_price != null) :
            $amount = $product->selling_price - $product->discount_price;
            $discount = ($amount / $product->selling_price) * 100; ?>
            <div class="offer_7">
                <p><?= '-' . round($discount) . '%'; ?></p>
            </div>
        <?php endif; ?>
        <div class="wrap-img-sec-7">
            <?php echo '<img style="cursor:pointer;" id="produImage" onclick="viewProductImage(\'' . $product->slug . '\', \'' . $product->product_id . '\')" src="' . imagebaseURL . $product->product_thumbnail . '" alt="">'; ?>
        </div>
        <div class="wrap-box-sec-7">
            <div class="wrap-p-sec-7">
                <p><a href="<?= base_url($product->slug) ?>"><?= substr($product->product_title, 0, 30) . '...'; ?></a></p>
            </div>
            <div class="wrap-sec-7-bottom">
                <?php if ($product->discount_price) {
                    echo '<p class="current_price_7">KES ' . number_format($product->discount_price) . '</p>';
                    echo '<p class="previouse_price_7">KES ' . number_format($product->selling_price) . '</p>';
                } else {
                    echo '<p class="previouse_price_7">KES ' . number_format($product->selling_price) . '</p>';
                }
                ?>
                <?php
                if ($product->product_size || $product->product_color) {
                    echo '<a class="btn btn_item_7" onclick="viewProductImage(\'' . $product->slug . '\', \'' . $product->product_id . '\')">Select options</a>';
                } else {
                    echo '<a class="btn btn_item_7" onclick="addGeneralCart(event, ' . $product->id . ')">add to cart</a>';
                }

                ?>

            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- == -->