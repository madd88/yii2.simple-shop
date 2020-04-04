<?php
/* @var $productList */

/* @var $pagination */
/* @var $message */
use yii\helpers\Html;
use yii\bootstrap4\LinkPager;
?>

<?php $this->title = "Товары";
if (! empty($message)) {
    echo '<h1>' . $message . '</h1>';
}
?>
   <div class="row">
        <?php foreach ($productList as $product): ?>

            <div class="col-lg-4 col-md-6 mb-2">
                <div class="card h-100">
                    <!-- Изображение -->
                    <img class="card-img-top product-img"
                         src="<?= $product->img ?>"
                         alt="..."
                         width="140"
                    />
                    <!-- Текстовый контент -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="/product/<?= $product->id; ?>"><?= $product->name ?></a>
                        </h5>
                        <h6><?= $product->price; ?></h6>
                        <p class="card-text">Описание</p>
                        <a href="#" class="add-to-cart btn btn-primary btn-success mt-auto" data-product-id="<?= $product->id; ?>">В корзину</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>


        <?php endforeach; ?>
    </div>


<?= LinkPager::widget(['pagination' => $pagination]) ?>