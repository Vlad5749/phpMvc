<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<div>
    <p>Поточний пароль: <br><input type="password" name="password"></p>
    <p>Новий пароль: <br><input type="password" name="new_password"></p>
    <p>Повторіть пароль: <br><input type="password" name="confirm_new_password"></p>
    <p> <?php if ($error !== false) {echo "<span class=\"changePassError\">*$error</span>";} ?></p>
    <input class="changePassButton" type="submit" name="confirm" value="Змінити">
</div><br>
</form>
<?php
if ($this->get('error') !== false) {
    $error = $this->get('error');
}
