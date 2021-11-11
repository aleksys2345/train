<?php
/**
 * Created by PhpStorm.
 * User: kondakov.a
 * Date: 10.11.2021
 * Time: 9:24
 */


echo Form::open(array('url' => asset('go'), 'method' => 'POST'));
//ФИО, , Артикул товара, Бренд товара
echo Form::label('fio', 'ФИО');
echo Form::text('fio','Кондаков Алексей Евгеньевич');
echo "<br>";
echo Form::label('comment', 'Комментарий клиента');
echo Form::text('comment','asec');
echo "<br>";
echo Form::label('art', 'Артикул товара');
echo Form::text('art','Резак для пиццы Tramonto, 20.2х7.0 см 6474 Gipfel');
echo "<br>";
echo Form::label('brand', 'Бренд товара');
echo Form::text('brand','Gipfel');
echo "<br>";
echo Form::submit('Отправить');

echo Form::token() . Form::close();

?>


