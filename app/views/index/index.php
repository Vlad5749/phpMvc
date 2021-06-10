<h3>Привіт<?php if (isset($_SESSION['id'])) {echo ', ' . $customer['first_name'] . " " . $customer['last_name'];}else {echo ", неавторизований користувач";} ?></h3>
<?php 

if (isset($_SESSION['id'])) {
    $customer = $this->get('customer');
}



/*
var_dump($_COOKIE);
var_dump(session_id());
var_dump(session_name());
var_dump($_SESSION);
 */

?>
