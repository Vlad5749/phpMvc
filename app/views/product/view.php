<?php $product = $this->get('product'); ?>

    <div class="productPanel">
        <p class="viewSku">Код: <span class="vSku"><?php echo $product['sku']?></span></p>
        <p class="viewProductName"> Назва товару: <span class="vProductName"><?php echo $product['name']; ?></span><p>
        <p class="viewPrice"> Ціна: <span class="vPrice"><?php echo $product['price']?> </span> грн</p>
        <p class="viewQty"> Кількість: <span class="vQty"><?php echo $product['qty']?></span></p>
        <p><?php if(!$product['qty'] > 0) { echo 'Нема в наявності'; } ?></p>
        <p class="viewDescription"> Описання: <span class="vDescription"><?php echo $product['description']?></span></p>
        <p>
            <?= \Core\Url::getLink('/product/edit', 'Редагувати', array('id'=>$product['id'])); ?><br>
            <?= \Core\Url::getLink('/product/delete', 'Видалити', array('id'=>$_GET['id'])); ?>
        </p>
    </div>
