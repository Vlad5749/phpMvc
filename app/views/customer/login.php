<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<div class="enterPanel">
    <p class="editSku">Електронна пошта: <br><input  type="text" name="email"></p>
    <p class="editSku">Пароль: <br><input  type="password" name="password"></p>
    <p class=""><?php if ($this->get("error")) { 
        echo '<span class="registrationError">*Невірна електронна пошта або пароль</span>';
    }?></p>
    <input class="enterButton" type="submit" value="Увійти">
</div>
</form>
