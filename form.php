<table>
	<form action="index.php?action=reg" method="POST">
		<tr>
			<td>Имя</td>
			<td><input type="text" name="login" ></td>
		</tr>
		<tr>
			<td>Пароль</td>
			<td><input type="password" name="password" ></td>
		</tr>
		<tr>
			<td>Пароль</td>
			<td><input type="password" name="password2"></td>
		</tr>
		<tr>
			<td>Кто вы?</td>
			<td>
				<select id="select" name="statut" onchange = "changeFields()">
					<option value="Студент">Студент</option>
					<option value="Преподаватель">Преподаватель</option>
					<option value="Библиотекарь">Библиотекарь</option>
				</select>
			</td>
		</tr>
		<tr class="hidden" name="student">
			<td>Направление</td>
			<td><select name="spec">
			
				<?php
					include_once("connect.php");
					$query = "SELECT * FROM direction";
					$q = mysql_query($query) or die(mysql_error());
					try {
						if ($q){
							while ($row = mysql_fetch_row($q)) {
								$direction[$row[1]] = $row[0];
								echo "<option value='".$row[0]."'>".$row[1]."</option>";
							}
							mysql_free_result($q);
						}
					}
					catch (Exception $e) {
						echo "Exception";
					}
				?>
			</select>
			
			</td>
		</tr>
		<tr class="hidden" name="student">
			<td>Номер зач. кн.</td>
			<td><input  type="text" name="no_kn"></td>
		</tr>
		<tr class="hidden" name="prepod">
			<td>Список дисциплин</td>
			<td><input  type="text" name="subjects" onfocus = 'onmouseOver()' onblur = 'onmouseOut()'>
			<div id = 'parentID'></div></td>
		</tr>
		<tr class="hidden" name="prepod">
			<td>Стаж</td>
			<td><input  type="text" name="experience"></td>
		</tr>
		<tr class="hidden" name="librarian">
			<td>Статус</td>
			<td>
				<select id="select" name="status">
					<option value="Младший">Младший</option>
					<option value="Старший">Старший</option>
				</select>
			</td>
		</tr>
		<div id = 'paste'></div>
		<tr>
			<td><input type="submit" value="Отправить" name="submit" ></td>
			<td><a href = './index.php?action=in'>Войти</a></td>
		</tr>
	</form>
</table>

<script>
	function onmouseOver(){
		var div = document.getElementById('parentID');
		str = "Через запятую";
		div.innerHTML = str;
	}
	function onmouseOut(){
		var div = document.getElementById('parentID');
		div.removeChild(div.firstChild);
	}
</script>

<script>
function hideAll(rawNames) {
	for (i in rawNames) {
		rawsToHide = document.getElementsByName(rawNames[i])
		for (i in rawsToHide) {
			if (typeof rawsToHide[i] == "object") {
				rawsToHide[i].setAttribute("class","hidden")
			}
		}
	}
}
function changeFields() {
	rawNames = {'Студент':'student','Преподаватель':'prepod','Библиотекарь':'librarian'}
	selectedRawName = document.getElementById("select").value
	rawsToShow = document.getElementsByName(rawNames[selectedRawName])
	
	hideAll(rawNames)
	
	for (i in rawsToShow) {
		if (typeof rawsToShow[i] == "object") {
			rawsToShow[i].setAttribute("class","visible")
		}
	}
}
changeFields();
		
</script>
