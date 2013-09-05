<?php
if(sizeof($data)>1) //если есть данные 
	{
	foreach($data as $valuta)
		{
		if($valuta['visible'])
			{
			$out_vis .= '<tr>
				<td>('.$valuta['vname'].') '.iconv('utf-8','cp1251',$valuta['desc']).'</td>
				<td>'.$valuta['nominal'].'</td>
				<td>'.$valuta['vprice'].'</td><td>'.$valuta['lupdate'].'</td>
				<td><img src="/test/images/DeleteRed.png" id="'.$valuta['vname'].'" class="visible" alt="Удалить" title="Удалить"></td>
				<td><img src="/test/images/update.png" id="'.$valuta['vid'].'" class="update" alt="Обновить" title="Обновить"></td>
			</tr>';
			}
		else
			{
			$out_add .= '<option value="'.$valuta['vname'].'">('.$valuta['vname'].') '.iconv('utf-8','cp1251',$valuta['desc']).'</option>';
			}
		}
		
	?>
	Доступные валюты 
	<select id="add_valute">
	<?=$out_add?>
	</select><input type="button" id="add_btn" value="Добавить">
	<br/><br/>
	<table cellpadding="5" border="2">
	<tr><td>Название</td><td>Номинал</td><td>Цена, руб.</td><td>Время обновления</td><td></td><td></td></tr>
	<?=$out_vis?>
	</table>
	<?php
	}
	?>
<br/>	
<input id="go_update" type="button" value="Скачать/Обновить валюты">

<script type="text/javascript">
$('#add_btn').click(function () // Клик по кнопке добавить
		{ 
		$.get('/test/main/add?vname='+$('#add_valute').val()+'&'+Math.random(), function(data) 
			{
			$('#info_block').html(data);
			});
		});

$('.visible').click(function() { // Клик по картинке удаления
		$.get('/test/main/del?vname='+$(this).attr('id')+'&'+Math.random(), function(data) 
			{
			$('#info_block').html(data);
			});
    });
	
$('.update').click(function() { // Клик по картинке удаления
		$.get('/test/main/single_update?vid='+$(this).attr('id')+'&'+Math.random(), function(data) 
			{
			$('#info_block').html(data);
			});
    });

$('#go_update').click(function () // Клик по кнопке обновить
		{ 
		$.get('/test/main/update?'+Math.random(), function(data) 
			{
			$('#info_block').html(data);
			});
		});
</script>