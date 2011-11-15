
<div class="content">
    <h1>Sign Up Form</h1>
<?=form_open('saasu/signup','')?>
        <ul>
            <li>First Name<input type="text" name="givenName" ></li>
            <li>Last Name<input type="text" name="familyName" ></li>
            <li>Company<input type="text" name="organisationName"></li>
            <li>Company Website<input type="text" name="CompanyWebsite"></li>
            <li>Personal Website<input type="text" name="PersonalWebsite"></li>
            <li>Email<input type="text" name="email"></li>
            <li>Mobile<input type="text" name="Mobile"></li>
            <li>Other Phone<input type="text" name="OtherPhone"></li>
            <li>Postal Address</li>
            <li>Street<input type="text" name="PostalStreet"></li>
            <li>City<input type="text" name="PostalCity"></li>
            <li>State<input type="text" name="PostalState"></li>
            <li>PostCode<input type="text" name="PostalPostCode"></li>
            <li>Country<input type="text" name="PostalCountry"></li>
            <li>Other Address</li>
            <li>Street<input type="text" name="OtherStreet"></li>
            <li>City<input type="text" name="OtherCity"></li>
            <li>State<input type="text" name="OtherState"></li>
            <li>PostCode<input type="text" name="OthePostCode"></li>
            <li>Country<input type="text" name="OtheCountry"></li>
            <li>Password<input type="password" name="password"></li>
        </ul>
<?        echo form_submit('Submit', 'Submit');?>
<?= form_close();?>
</div>