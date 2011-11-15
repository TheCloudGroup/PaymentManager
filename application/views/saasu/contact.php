<?php $this->load->view('includes/menu') ?>
<div class="content">
    <?php var_dump($contact) ?>
    <?php var_dump($eway) ?>

    <?=form_open()?>
    <div class="form">
        <?= form_label('First Name'); ?>
        <?= form_input('firstname', $contact['contact']->givenName); ?><br/>
        <?= form_label('Last Name'); ?>
        <?= form_input('familyname', $contact['contact']->familyName); ?><br/>
        <?= form_label('Company'); ?>
        <?= form_input('organisationname', $contact['contact']->organisationName); ?><br/>
        <?= form_label('Company Website'); ?>
        <?= form_input('organisationwebsite', $contact['contact']->organisationWebsite); ?><br/>
        <?= form_label('Personal Website'); ?>
        <?= form_input('personalwebsite', $contact['contact']->websiteUrl); ?><br/>
        <?= form_label('Email'); ?>
        <?= form_input('email', $contact['contact']->email); ?><br/>
        <?= form_label('Mobile'); ?>
        <?= form_input('mobilephone', $contact['contact']->mobilePhone); ?><br/>
        <?= form_label('Other Phone'); ?>
        <?= form_input('otherphone', $contact['contact']->otherPhone); ?><br/>
        <?= form_label('Postal Address'); ?><br/>
        <?= form_label('Street'); ?>
        <?= form_input('postalstreet', $contact['contact']->postalAddress->street); ?><br/>
        <?= form_label('City'); ?>
        <?= form_input('postalcity', $contact['contact']->postalAddress->city); ?><br/>
        <?= form_label('State'); ?>
        <?= form_input('postalstate', $contact['contact']->postalAddress->state); ?><br/>
        <?= form_label('Post Code'); ?>
        <?= form_input('postalpostcode', $contact['contact']->postalAddress->postCode); ?><br/>
        <?= form_label('Country'); ?>
        <?= form_input('postalcountry', $contact['contact']->postalAddress->country); ?><br/>
        <?= form_label('Other Address'); ?><br/>
        <?= form_label('Street'); ?>
        <?= form_input('otherstreet', $contact['contact']->otherAddress->street); ?><br/>
        <?= form_label('City'); ?>
        <?= form_input('othercity', $contact['contact']->otherAddress->city); ?><br/>
        <?= form_label('State'); ?>
        <?= form_input('otherstate', $contact['contact']->otherAddress->state); ?><br/>
        <?= form_label('Post Code'); ?>
        <?= form_input('otherpostcode', $contact['contact']->otherAddress->postCode); ?><br/>
        <?= form_label('Country'); ?>
        <?= form_input('othercountry', $contact['contact']->otherAddress->country); ?><br/>
        <?= form_label('Name on Credit Card'); ?>
        <?= form_input('ccname', $eway->QueryCustomerResult->CCName); ?><br/>
        <?= form_label('Credit Card Number'); ?>
        <?= form_input('ccnumber', $eway->QueryCustomerResult->CCNumber); ?><br/>
        <?= form_label('Expiry Month'); ?>
        <?= form_input('ccexpirymonth', $eway->QueryCustomerResult->CCExpiryMonth); ?><br/>
        <?= form_label('Expiry Year'); ?>
        <?= form_input('ccexpiryyear', $eway->QueryCustomerResult->CCExpiryYear); ?><br/>
    </div>
<?=form_close();?>
<?= anchor("site/query_managed_customer", "query customer") ?>
</div>