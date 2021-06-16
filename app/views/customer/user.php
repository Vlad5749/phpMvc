<div class="customerPanel">
    <p> Ім'я: <span class="customerName"> <?php echo $customer['first_name'] . " " .$customer['last_name']?></span><span class="pull-right"><?= \Core\Url::getLink('/customer/changePass', 'Змінити пароль'); ?></span></p>
    <p> Місто: <span class="city"> <?php echo $customer['city'] ?> </span><span class="pull-right"><?= \Core\Url::getLink('/customer/edit', 'Відредагувати дані'); ?></span></p>
    <p> Телефон: <span class="phone"><?php echo $customer['telephone']?></span></p>
    <p> Email: <span class="email"><?php echo $customer['email'] ?></span></p>
</div>
