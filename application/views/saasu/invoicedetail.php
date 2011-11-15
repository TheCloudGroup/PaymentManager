<?php $this->load->view('includes/menu') ?>
<div class="content">

    <?php print_r($invoice) ?>
    <div style="float:left">
    <?= $invoice[1]->contactGivenName?>
    <?= $invoice[1]->contactFamilyName?><br />
    <?= $invoice[1]->contactOrganisationName?>
    </div>
    <div style="float:right">
    <?= $invoice[1]->shipToContactGivenName?>
    <?= $invoice[1]->shipToContactLastName?><br />
    <?= $invoice[1]->shipToContactOrganisation?>
    </div>
    <div style="clear: both">
    <table border="1">
        <tr>
            <th>Invoice Number</th>
            <td><?=$invoice[0]['invoice']->invoiceNumber ?></td>
        </tr>
        <tr>
            <th>Due Date</th>
            <td><?=$invoice[0]['invoice']->dueOrExpiryDate ?></td>
        </tr>
        <tr>
            <th>Summary</th>
            <td><?=$invoice[0]['invoice']->summary ?></td>
        </tr>
    </table>
    <table border="1">
        <?php
        if ($invoice[0]['invoice']->layout == 'I') {

            echo
            '<tr>
            <th>Quantity</th>
            <th>Item</th>
            <th>Description</th>
            <th>Tax Code</th>
            <th>Price Inc GST</th>
            <th>Discount</th>
        </tr>';

            foreach ($invoice[0]['invoice']->invoiceItems->itemInvoiceItem as $y) {
                echo "<tr>";
                echo "<td>" . $y->quantity . "</td>";
                echo "<td>" . $y->inventoryItemUid . "</td>";
                echo "<td>" . $y->description . "</td>";
                echo "<td>" . $y->taxCode . "</td>";
                echo "<td>" . $y->unitPriceInclTax . "</td>";
                echo "<td>" . $y->percentageDiscount . "</td>";
                echo "</tr>";
            }
        } elseif ($invoice[0]['invoice']->layout == 'S') {

            echo
            '<tr>
            <th>Description</th>
            <th>Tax Code</th>
            <th>Total Amount</th>
        </tr>';

            foreach ($invoice[0]['invoice']->invoiceItems->serviceInvoiceItem as $x) {
                echo "<tr>";
                echo "<td>" . $x->description . "</td>";
                echo "<td>" . $x->taxCode . "</td>";
                echo "<td>" . $x->totalAmountInclTax . "</td>";
                echo "</tr>";
            };
        };
        ?>
        <?php
        ?>
    </table>
    <table>
        <tr>
            <td>Total Amount</td>
            <td><?=$invoice[1]->totalAmountInclTax ?></td>
        </tr>
        <tr>

            <td>Amount Paid</td>
            <td>$<?=$invoice[1]->totalAmountPaid ?></td>
        </tr>
        <tr>

            <td>Amount Owed</td>
            <td>$<?=$invoice[1]->amountOwed ?></td>
        </tr>
         <tr>

            <td>Amount Owed</td>
            <td><?=$invoice[1]->amountOwed?></td>
        </tr>


    </table>
    </div>
    <!--     <?=anchor("site/accept_quote/" . $invoice['invoice']['uid'], "Accept Quote") ?> -->
<?php $uid = $invoice[0]['invoice']['uid'] ?>
<?=anchor("site/pay_invoice/$uid", "Pay Invoice") ?><br/>
<?= anchor_popup("site/print_pdf/$uid", "Print PDF") ?>
</div>