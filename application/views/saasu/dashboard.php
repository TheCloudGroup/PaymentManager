<?php $this->load->view('includes/menu')?>
<div class="content">
<h1>Welcome to The Cloud Group Dashboard!</h1>

<?php print_r($invoices) ;?>

You have <?= count($invoices['invoiceList'])?> Invoices outstanding
<table border="1">
    <thead>
        <th>Invoice number</th>
        <th>Summary</th>
	<th>Due Date</th>
	<th>Invoice Date</th>
        <th>Total Due</th>
    </thead>
<? foreach ($invoices['invoiceList'] as $invoice):?>
<tr>
    <td><?=$invoice->invoiceNumber?></td>
    <td><?=$invoice->summary?></td>
    <td><?=$invoice->dueDate?></td>
    <td><?=$invoice->invoiceDate?></td>
    <td><?=$invoice->amountOwed?></td>
</tr>
<? endforeach;?>
<tr>
    <td colspan="4">Total Outstanding</td>
    <td></td>
</tr>
</table>
</div>