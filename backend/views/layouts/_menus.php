<?php
use yii\helpers\Url;
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="<?=url::to(['category/index'])?>" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>Categories</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?=url::to(['brend/index'])?>" class="nav-link">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Brends</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?=url::to(['banner/index'])?>" class="nav-link">
                <i class="nav-icon fas fa-images"></i>
                <p>Banners</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?=url::to(['product/index'])?>" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>Products</p>
            </a>
        </li>
    </ul>
</nav>