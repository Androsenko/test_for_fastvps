<?php
if(sizeof($data)>1) //���� ���� ������ 
	{
	foreach($data as $valuta)
		{
		if($valuta['visible'])
			{
			$out_vis .= '<tr>
				<td>('.$valuta['vname'].') '.iconv('utf-8','cp1251',$valuta['desc']).'</td>
				<td>'.$valuta['nominal'].'</td>
				<td>'.$valuta['vprice'].'</td><td>'.$valuta['lupdate'].'</td>
				<td><img src="/test/images/DeleteRed.png" id="'.$valuta['vname'].'" class="visible" alt="�������" title="�������"></td>
				<td><img src="/test/images/update.png" id="'.$valuta['vid'].'" class="update" alt="��������" title="��������"></td>
			</tr>';
			}
		else
			{
			$out_add .= '<option value="'.$valuta['vname'].'">('.$valuta['vname'].') '.iconv('utf-8','cp1251',$valuta['desc']).'</option>';
			}
		}
		
	?>
	��������� ������ 
	<select id="add_valute">
	<?=$out_add?>
	</select><input type="button" id="add_btn" value="��������">
	<br/><br/>
	<table cellpadding="5" border="2">
	<tr><td>��������</td><td>�������</td><td>����, ���.</td><td>����� ����������</td><td></td><td></td></tr>
	<?=$out_vis?>
	</table>
	<?php
	}
	?>
<br/>	
<input id="go_update" type="button" value="�������/�������� ������">

<script type="text/javascript">
$('#add_btn').click(function () // ���� �� ������ ��������
		{ 
		$.get('/test/main/add?vname='+$('#add_valute').val()+'&'+Math.random(), function(data) 
			{
			$('#info_block').html(data);
			});
		});

$('.visible').click(function() { // ���� �� �������� ��������
		$.get('/test/main/del?vname='+$(this).attr('id')+'&'+Math.random(), function(data) 
			{
			$('#info_block').html(data);
			});
    });
	
$('.update').click(function() { // ���� �� �������� ��������
		$.get('/test/main/single_update?vid='+$(this).attr('id')+'&'+Math.random(), function(data) 
			{
			$('#info_block').html(data);
			});
    });

$('#go_update').click(function () // ���� �� ������ ��������
		{ 
		$.get('/test/main/update?'+Math.random(), function(data) 
			{
			$('#info_block').html(data);
			});
		});
</script>