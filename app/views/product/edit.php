<?php $product = $this->get('product'); ?>

<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<div>
    <p class="editSku">sku: <br><input type="text" name="sku" value="<?php echo $product['sku']; ?>"></p>
    <p class="editProductName">Назва товару: <br><input type="text" name="name" value="<?php echo $product['name']; ?>"></p>
    <p class="editPrice">Ціна: <br><input type="text" name="price" value="<?php echo $product['price']; ?>"></p>
    <p class="editQty">Кількість: <br><input type="text" name="qty" value="<?php echo $product['qty']; ?>"></p>
    <p class="editDescription">Описання: <br><textarea class="inputDescription" name="description"><?php echo $product['description']; ?></textarea>></p>
</div>
<br>
<input type="submit" name="confirm" value="Підтвердити редагування">
</form>

<p>
<?= \Core\Url::getLink('/product/delete', 'Видалити', array('id'=>$_GET['id'])); ?>
</p>

<?php
