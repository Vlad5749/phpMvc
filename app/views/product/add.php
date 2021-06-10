<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<div>
    <p class="editSku">sku: <br><input  type="text" name="sku"></p>
    <p class="editProductName">Назва товару: <br><input type="text" name="name"></p>
    <p class="editPrice">Ціна: <br><input type="text" name="price"></p>
    <p class="editQty">Кількість: <br><input type="text" name="qty"></p>
    <p class="editDescription">Описання: <br><textarea class="inputDescription" name="description"></textarea>></p>
</div>
<br>
<input type="submit" value="Додати товар">
</form>

<?php
