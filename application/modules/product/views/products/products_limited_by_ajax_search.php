<?php
if (isset($products)) {
    $html = NULL;
    $i = 0;

    foreach ($products as $prod) {

        ?>
        <tr>
            <td><?php echo ++$i; ?>
            </td>

            <td>
                <?php echo $prod->sku; ?>
            </td>

            <td>
                  <?php echo $prod->product_title ?>

            </td>

            <td  ><?php echo $prod->purchase_price; ?></td>
            <td class="table_data" contenteditable  type="text" class="form-control" data-row_id="<?php echo $prod->product_id; ?>" data-column_name="product_stock"><?php echo $prod->product_stock; ?></td>


             
        </tr>
        <?php
    }


}
?> 