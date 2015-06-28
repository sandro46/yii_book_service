<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=$book->title_b;
// $this->breadcrumbs=array(
	// 'Login',
// );
?>

<h1>Подробный просмотр книги <?=$book->title_b?></h1>
<p>ID по версии поставщика: <?=$book->id_b?></p>
<p>Автор(ы): <?=$book->author_b?></p>
<p><h4>Анотация:</h4>
	<?=$book->desc_b?>
</p>
<p>Количество страниц: <?=$book->col_pages_b?></p>
<p>ISBN: <?=$book->isbn_b?></p>


