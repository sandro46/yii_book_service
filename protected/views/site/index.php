<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>



<p>Список найденных книг:</p>
<form action="index" method="get"></form>

<table >
	<thead>
	<form action=<?=$this->createUrl('site/index')?> method="get">
		<tr>
			<td></td>
			<td><input type="text" name="title_b" placeholder='Поиск по Названию'></td>
			<td><input type="text" name="author_b" placeholder='Поиск по авторам'></td>
			<td></td>
			<td></td>
			<td><input type="submit" name='search' value='Найти/Очисть'></td>
		</tr>
	</form>
		<tr>
			<td><strong>ID</strong></td>
			<td><strong>Название</strong></td>
			<td><strong>Авторы</strong></td>
			<td><strong>ISBN</strong></td>
			<td><strong>Цена</strong></td>
			<td><strong>Количество</strong></td>
		</tr>
	</thead>
<form action="index.php?r=site/zakaz" method="post">
	<tbody>
		<?foreach($allBooks as $book){?>
			<tr>
				<td><?=$book->id_b?></td>
				<td><?=$book->title_b?></td>
				<td><?=$book->author_b?></td>
				<td><?=$book->isbn_b?></td>
				<td><?=$book->prise_b?></td>
				<td><input type='text' style='width: 30px; text-align: center' name='col_books[<?=$book->id_b?>]' value='0' /></td>
			</tr>
		<?}?>
	</tbody>
</table>
<input type="submit" name='zakaz' value="заказать"/>
</form>