<?php

$customers = $this->get('customer');

foreach ($customers as $customer) :  
?>
    <div class="customerPanel">
        <p> Ім'я: <span class="customerName"> <?php echo $customer['first_name'] . " " .$customer['last_name']?></span></p>
        <p> Місто: <span class="city"> <?php echo $customer['city'] ?> </span></p>
        <p> Телефон: <span class="phone"><?php echo $customer['telephone']?></span></p>
        <p> Email: <span class="email"><?php echo $customer['email'] ?></span></p>
    </div>

<?php endforeach; ?>
