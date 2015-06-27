<?php
/* @var $this SiteController */

// $this->pageTitle='Заказы';
?>



<p>Список заказанных книг:</p>
<form action="index.php?r=site/zakaz" method="post">
<table>
	<thead>
		<tr>
			<td><strong>ID-товара</strong></td>
			<td><strong>Номер заказа</strong></td>
			<td><strong>Название</strong></td>
			<td><strong>ISBN</strong></td>
			<td><strong>Количество</strong></td>
			<td><strong>Цена</strong></td>
			<td><strong>Сумма</strong></td>
			<td><strong>Статус</strong></td>
			<td><strong>Выбор</strong></td>
		</tr>
	</thead>
	<tbody>
		<?
		// $zakazy = Yii::app()->session['zakazy'];
		// var_dump($zakazy);
		foreach($zakazy as $val){?>
			<tr>
				<td><?=$val["id_b"]?></td>
				<td><?=$val["id_z"]?></td>
				<td><?=$val["title_b"]?></td>
				<td><?=$val["isbn_b"]?></td>
				<td><?=$val["col_tovara_z"]?></td>
				<td><?=$val["prise_b"]?></td>
				<td><?=($val["prise_b"]*$val["col_tovara_z"])?></td>
				<td><?=$val["title_s"]?></td>
				<td><input type="checkbox" name="ids[<?=$val["id_z"]?>]" /></td>
			</tr>
		<?}?>
	</tbody>
</table>
<input type="submit" name='oform' value="Оформить выбранные"/>
<input type="submit" name='cancel' value="Отменить выбранные"/>
<input type="submit" name='del' value="Удалить выбранные"/>
</form>