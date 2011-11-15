<div id="head">
    <!--<div>
        <h2>The Cloud Group</h2></div>
    <p> Welcome <?php echo ($this->session->userdata['firstname']) ?></p>
    <div> -->
    <ul id="menu">
        <li><?= anchor('site/saasu_dashboard', 'Dashboard') ?></li>
        <li><?= anchor('quotes/get_quotes', 'Quotes') ?></li>
        <li><?= anchor('site/orders','Orders') ?></li>
        <li><?= anchor('site/get_invoices', 'Invoices') ?></li>
        <li><?= anchor('site/get_payments', 'Payments') ?></li>
        <li><?= anchor('site/contact_details', 'My Details') ?></li>
        <li><?= anchor('site/products', 'Products') ?></li>
<!--        <li><?= anchor('site/tickets', 'Tickets') ?></li>-->
<!--        <li><?= anchor('site/suppliers', 'My Trading Partners') ?></li> -->
        <li><?= anchor('site/logout', 'Settings') ?></li>
        <li><?= anchor('site/logout', 'Log Out') ?></li>
    </ul>
    </div>