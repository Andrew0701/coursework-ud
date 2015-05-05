<b>Создать выставку</b><br><br>
<table border = 0>
	<form action="index.php?action=showing" method="POST" id = 'id_form' name = 'form_show'>
		<tr>
			<td>Название</td>
			<td><input type="text" name="name" onblur=""></td>
		</tr>
		<tr>
			<td>Дата начала</td>
			<td><input type="text" name="startDate" onblur = 'check_date(this)'>
				<br>Формат гггг-мм-дд</td>
		</tr>
		<tr>
			<td>Продолжительность (дней)</td>
			<td><input type="text" name="duration"></td>
		</tr>
        <tr>
            <td><input type='submit' value='Создать выставку' name='create'></td>
        </tr>
	</form>
</table>

<script>
	function check_date(elem){
		var reg_contacts = /^([0-9]{4})-([0-9]{2})-([0-9]{2})$/;
		if (reg_contacts.test(document.form_show.startDate.value) == false){
			alert('Неверный формат даты');
			document.form_show.create.disabled = true;
		}else{
			document.form_show.create.disabled = false;
		}
	}
</script>

<?php
if (isset($_POST['create']))
{
    foreach( ['name','startDate','duration'] as $field ) {
        if ($_POST[$field] == '') {
            echo 'Необходимо заполнить все поля!';
            return;
        }
    }
    
    try {
        include_once("connect.php");

        $query = "select * from resource where name = '".$_POST['name']."'";
        $sql = mysql_query($query) or die(mysql_error());

        if (mysql_num_rows($sql) > 0){
            echo "Выставка с таким названием уже есть";
            return;
        }
        else {
            $query = "insert into `show`(name, date_start, time)
             values('".$_POST['name']."','".$_POST['startDate']."',".$_POST['duration'].");";
            $sql = mysql_query($query) or die(mysql_error());
            echo "Выставка создана";
            return;
        }
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
}
?>
