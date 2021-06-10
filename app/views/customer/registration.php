<?php 
$fields = 
        ['last_name' => ["Прізвище", ""],
         'first_name' => ["Ім'я", ""],
         'telephone' => ["Мобільний телефон", ""],
         'email' => ["Електронна адреса", ""],
         'city' => ["Місто", ""],
         'password' => ["Пароль", ""],
         'confirm_password' => ["Підтвердіть пароль", ""]];?>

<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<div>
    <?php foreach ($fields as $key => $value) : ?>
    
    <p class="<?php echo $value[1]; ?>"><?php echo $value[0]; ?>: <br>
        <input <?php if ($key === 'password' || $key === 'confirm_password') 
                    echo 'type="password"'; else echo 'type="text"';?>
               name="<?php echo $key; ?>" 
               value="<?php if ((filter_input(INPUT_POST, $key)) !== null) {
                   echo filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
               } ?>">
    <?php
    if(isset($errors[$key])) {
        echo '<span class="registrationError"> *' . $errors[$key] . '</span>'; 
    }?></p>
    
    <?php endforeach; ?>
    
    <p class=""><?php if ($errors !== true) { 
        echo '<span class="registrationError">*Помилка реєстрації</span>';
    }?></p>
</div>
<input type="submit" value="Зареєструватися">
</form>

<?php

if ($errors !== true) {
    $errors = $this->get('errors');
}
