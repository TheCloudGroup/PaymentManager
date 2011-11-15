<?php $this->load->view('includes/menu') ?>
<div class="content">
    <?php print_r($quotes); ?>
    <h2>My Quotes</h2>
    <div class="demo_jui">

        <table id="data_table" width="100%">
            <thead>
                <tr>
                    <th>Quote Number</th>
                    <th>Quote Date</th>
                    <th>Quote Valid to</th>                    
                    <th>Total Inc GST</th>
                    <th>Summary</th>
                </tr>
            </thead>

            <?php foreach ($quotes['invoiceList']->invoiceListItem as $quote):?>
            
            <tr>
               <td><a href='../quotes/quote_detail/<?=$quote->invoiceUid?>' ><?=$quote->invoiceNumber?></a></td>

                <td><?=$quote->invoiceDate?></td>
                <td><?=$quote->dueDate?></td>
                <td><?=$quote->totalAmountInclTax?></td>
                <td><?=$quote->summary?></td>
                </tr>
                <?php endforeach;?>
        </table>
    </div>
</div>