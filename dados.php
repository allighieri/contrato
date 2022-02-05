<?php
	
		$texto = $_GET['texto'];		
		$texto = preg_replace('/^\h*\v+/m', '', $texto);		
		$array_data = explode(PHP_EOL, $texto);

		$final_data = array();
		foreach ($array_data as $data){
			$format_data = explode(':',$data);
			$final_data[trim($format_data[0])] = trim($format_data[1]);
		}

		echo "<pre>";
		print_r($final_data);

		echo $final_data['Email'];
		echo $final_data['Nome completo'];





		



?>


<form actio="dados.php" method="get">
	<label>Texto</label>
	<textarea name="texto" value=""></textarea>
	<input type="submit" value="Enviar">
</form>
