<!DOCTYPE html>
<html>
	<head>
		<title>Benson Calorie Calculator</title>
		<link type="text/css" rel="stylesheet" href="calorieCalc.css">
	</head>
		<?php

				include 'resturant.php';
				$resturants = array();

				$resturant = glob("resturants/*.txt");

				foreach($resturant as $resturantTxt){

					$longStr = file_get_contents($resturantTxt);
					$resturantObj = new resturant($longStr);
					array_push($resturants, $resturantObj);
				}
		?>
	<body>



		<div class="topnav">
		  <a href="#home">Home</a>
		  <a href="#news">Calorie Calc</a>
		  <a href="#contact">Members</a>
		  <a href="#about">About</a>
		  <a href="#tipsbox">Tips and Tricks</a>
		</div>

		<div class="checkBoxes">

			<form class="boxForm">
				<?php

					foreach($resturants as $restObj){
						echo "<h3>" . $restObj->getResturantName() . "</h3>";
						$restObj->displayCheckBox();
					}

				?>

				<br>
			
			</form>

		</div>

		<div class="total">

			<input type="button" value="Calculate Calories" onclick="calculateCalories()">
			<br>
			<script>

				function calculateCalories(){

					var calValues = [];
					var checkboxes = document.getElementsByClassName('checkBox');

					for (var i = 0; i < checkboxes.length; i++) {

				  			calValues[i] = parseInt(checkboxes[i].value);

					}	

					var totalCal = 0;
					for(var i = 0; i < calValues.length; i++){
						if(checkboxes[i].checked){
							totalCal += calValues[i];
						}
					}

					document.getElementById('totalCal').innerHTML = totalCal;

				}

			</script>


			<h2>Total Calories:</h2>
			<p id="totalCal"></p>

		</div>

	</body>

<html>