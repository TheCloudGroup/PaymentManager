<?php $this->load->view('includes/menu') ?>
<div class="content">
    <?php var_dump($contact) ?>
    <?php var_dump($invoice) ?>
    <?= $result ?>
    <?php $this->load->helper('form') ?>
    <?= form_open('site/process_payment') ?>
    <div class="form">
        <?= form_label('First Name', 'firstname'); ?>
        <?= form_input('FirstName', $contact['contact']->givenName) ?><br/>
        <?= form_label('Last Name', 'lastname') ?>
        <?= form_input('LastName', $contact['contact']->familyName) ?><br/>
        <?= form_label('Email', '') ?>
        <?= form_input('EmailAddress', $contact['contact']->email) ?><br/>
        <?= form_label('Postal Address', '') ?>
        <?= form_textarea('Address', $contact['contact']->postalAddress->street . "\r\n" .
                $contact['contact']->postalAddress->city) ?><br/>
        <?= form_label('Postcode', '') ?>
        <?= form_input('Postcode', $contact['contact']->postalAddres->postCode) ?><br/>
        <?= form_label('Invoice Number', '') ?>
        <?= form_input('Invoice Description', $invoice[0]['invoice']->invoiceNumber) ?><br/>
        <?= form_label('Invoice Reference', '') ?>
        <?= form_input('ewayCustomerInvoiceRef', $invoice[0]['invoice']['uid']) ?><br/>
        <?= form_label('Cardholder Name', '') ?>
        <?= form_input('cardholdername', 'Card Holders Name') ?><br/>
        <?= form_label('Card Number', '') ?>
        <?= form_input('cardnumber', 'Card Number') ?><br/>
        <?= form_label('Expiry Month', '') ?>
        <?= form_input('cardexpirymonth', 'Card Expiry Month') ?><br/>
        <?= form_label('Expiry Year', '') ?>
        <?= form_input('cardexpiryyear', 'Card Expiry Year') ?><br/>
        <?= form_label('Total Amount', '') ?>
        <?= form_input('amount', 'Total Amount') ?><br/>
        <?= form_submit('Submit', 'Charge It!'); ?>
        <?= form_close(); ?>
    </div>
</div>