<?php $this->load->view('includes/menu')?>

<div class="content">
    <h1>My Suppliers</h1>
    <table border="1">
    <?php foreach ($suppliers as $row): ?>
        <tr>
            <td><?=$row['Provider_Name']?></td>
        </tr>
        <?php endforeach;?>
    </table>
</div>

