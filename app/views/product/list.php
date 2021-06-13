<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<select name='sort'>
    <option <?php if (filter_input(INPUT_POST, 'sort') ===  null && isset($_COOKIE['select'])){
            if ($_COOKIE['select'] === 'price_ASC') {echo 'selected';}
        } elseif (filter_input (INPUT_POST, 'sort') === 'price_ASC') {echo 'selected';}
        ?> value="price_ASC">від дешевших до дорожчих</option>
    
    <option <?php if (filter_input(INPUT_POST, 'sort') ===  null && isset($_COOKIE['select'])){
            if ($_COOKIE['select'] === 'price_DESC') {echo 'selected';}
        } elseif (filter_input (INPUT_POST, 'sort') === 'price_DESC') {echo 'selected';}
        ?> value="price_DESC">від дорожчих до дешевших</option>
        
    <option <?php if (filter_input(INPUT_POST, 'sort') ===  null && isset($_COOKIE['select'])){
            if ($_COOKIE['select'] === 'qty_ASC') {echo 'selected';}
        } elseif (filter_input (INPUT_POST, 'sort') === 'qty_ASC') {echo 'selected';}
        ?> value="qty_ASC">по зростанню кількості</option>
            
    <option <?php if (filter_input(INPUT_POST, 'sort') ===  null && isset($_COOKIE['select'])){
            if ($_COOKIE['select'] === 'qty_DESC') {echo 'selected';}
        } elseif (filter_input (INPUT_POST, 'sort') === 'qty_DESC') {echo 'selected';}
        ?> value="qty_DESC">по спаданню кількості</option>
</select><br><br>

Ціна від: <input type="text" name="from" value="<?php echo $from; ?>"> Ціна до: <input type="text" name="to" value="<?php echo $to ?>"><br><br>
<input type="submit" value="Застосувати">
</form>

<?php if (\Core\Helper::isAdmin()) : ?>
<div class="productPanel"><p>
        <?= \Core\Url::getLink('/product/add', 'Додати товар'); ?>
</p></div>
<?php endif; ?>

<?php
$from = $this->get('from');
$to = $this->get('to');
$products = $this->get('products');

foreach($products as $product)  :
?>
    <div class="productPanel">
        <p class="sku">Код: <?php echo $product['sku']?></p>
        <h4><?php echo $product['name']?></h4>
        <p> Ціна: <span class="price"><?php echo $product['price']?></span> грн</p>
        <p> Кількість: <?php echo $product['qty']?></p>
        <p><?php if(!$product['qty'] > 0) { echo 'Нема в наявності'; } ?></p>
        <p><?php if (\Core\Helper::isAdmin()) { echo \Core\Url::getLink('/product/edit', 'Редагувати', array('id'=>$product['id']));} ?></p>
        <p><?= \Core\Url::getLink('/product/view', 'Переглянути', array('id'=>$product['id'])); ?></p>
    </div>
    
<?php endforeach; ?>
