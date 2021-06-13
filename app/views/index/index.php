<h3>Привіт<?php if (isset($_SESSION['id'])) {echo ', ' . $customer['first_name'] . " " . $customer['last_name'];}else {echo ", неавторизований користувач";} ?></h3>
<?php 

if (isset($_SESSION['id'])) {
    $customer = $this->get('customer');
}
?>
