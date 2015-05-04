<table border = 0>
	<form action="index.php?action=showing" method="POST" id = 'id_form'>
		<tr>
			<td>Название</td>
			<td><input type="text" name="name" onblur=""></td>
		</tr>
		<tr>
			<td>Дата начала</td>
			<td><input type="text" name="startDate"></td>
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
            $query = "insert into `show`(name, date_start, time)".
                " values('".$_POST['name']."','".$_POST['startDate']."',".$_POST['duration'].");";
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