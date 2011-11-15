<?php $this->load->view('includes/menu') ?>
<div class="content">
    <h2>My Orders</h2>
     <!--   <?=anchor('site/get_invoices/paid','Paid')?> -->
    <div class="demo_jui">
    <table id="data_table" width="100%">
        <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Invoice Date</th>
                <th>Due Date</th>
                <th>Amount Paid</th>
                <th>Amount Owed</th>
                <th>totalAmountInclTax</th>
                <th>Summary</th>
                <th>Status</th>
                <th>Status</th>
            </tr>
        </thead>
        <?php foreach ($orders['invoiceList']->invoiceListItem as $invoice):?>
            <tr>
                <td><a href='../site/invoice_detail/<?=$invoice->invoiceUid?>/<?=$invoice->invoiceStatus?>' >
                <?=$invoice->invoiceNumber?></a></td>
                <td><?=$invoice->invoiceDate?></td>
                <td><?=$invoice->dueDate?></td>
                <td>$<?=$invoice->totalAmountPaid?></td>
                <td>$<?=$invoice->amountOwed?></td>
                <td>$<?=$invoice->totalAmountInclTax?></td>
                <td><?=$invoice->summary?></td>
                <td><?=$invoice->paidStatus?></td>
                <td><?=$invoice->invoiceStatus?></td>
            </tr>
        <?php endforeach ;?>
                </table>
    </div>

</div>