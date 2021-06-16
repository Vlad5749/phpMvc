<?php $user = \Core\Helper::getCustomer();?>
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
    <p>Прізвище:<br><input type="text" name="last_name" value="<?php echo $user['last_name']; ?>"></p>
    <p>Ім'я:<br><input type="text" name="first_name" value="<?php echo $user['first_name']; ?>"></p>
    <p>Мобільний телефон:<br><input type="text" name="telephone" value="<?php echo $user['telephone']; ?>"></p>
    <p>Місто:<br><input type="text" name="city" value="<?php echo $user['city']; ?>"></p>
    <p> <?php if ($error !== false) {echo "<span class=\"changePassError\">*$error</span>";} ?></p>
    <p><input type="submit" value="Підтвердити зміни"></p>
</form>

<?php
if ($this->get('error') !== false) {
    $error = $this->get('error');
}