<?php $this->load->view('includes/menu') ?>
<div class="content">
    <h2>Your Payments</h2>
   <!-- <?php var_dump($payments); ?> -->
    <div class="demo_jui">
    <table id="data_table" width="100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Amount</th>
                <th>Invoice Number</th>
                <th>PaymentID</th>
            </tr>
        </thead>
        <? foreach ($payments as $payitems): ?>
            <tr>
                <td><?=$payitems['invoicePayment']->date ?></td>
                <td><?=$payitems['invoicePayment']->invoicePaymentItems->invoicePaymentItem->amount ?></td>
                <td><?=$payitems['invoicePayment']->invoicePaymentItems->invoicePaymentItem->invoiceUid ?></td>
                <td><?=$payitems['invoicePayment']['uid'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
</div>