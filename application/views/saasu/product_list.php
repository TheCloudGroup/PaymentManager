<?php $this->load->view('includes/menu') ?>
<div class="content">
    <h3>Products</h3>
    <div class="demo_jui">
    <table id="data_table" width="100%">
        <thead>
            <tr>
                <th>Add</th>
                <th>Product ID</th>
                <th>code</th>
                <th>description</th>
                <th>stockOnHand</th>
                <th>rrpInclTax</th>
                <th>sellingPrice</th>
            </tr>
        </thead>
        <tbody>
           <?php foreach ($products['inventoryItemList']->inventoryItemListItem as $product):?>
                <tr>
                    <td>

                    </td>
                    <td><?= anchor("site/add_to_cart/$product->inventoryItemUid/1/$product->rrpInclTax/$product->code" ,"$product->inventoryItemUid", 'id="click"'); ?> </td>
                    <td><?= $product->code ?> </td>
                    <td><?= $product->description ?> </td>
                    <td><?= $product->stockOnHand ?> </td>
                    <td><?= $product->rrpInclTax ?> </td>
                    <td><?= $product->sellingPrice ?> </td>
                </tr>
            <?php endforeach; ?>
               
        </tbody>
    </table>
    </div>
    <p>
        <label for ="item">Item Name</label>
    <br/>
        <input type="text" id="item" name="item">
    </p>

    <p>
        <input type="submit" name="submit" id="submit_item" value="Submit Item"/>
    </p>
</div>