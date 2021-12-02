<?php

	class resturant{

		private $longStr;
		private $resturantName;
		private $itemCount;
		private $resturantTime;
		private $mealItem = array();

		public function __construct($longStr){

			$this->longStr = $longStr;

			$restStrStart = 0;
			$restStrEnd = strpos($longStr, "\n", $restStrStart);
			$this->resturantName = substr($longStr, $restStrStart, $restStrEnd - $restStrStart);

			$itemCountStrStart = $restStrEnd + 1;
			$itemCountStrEnd = strpos($longStr, "\n", $itemCountStrStart);
			$itemCountStr = substr($longStr, $itemCountStrStart, $itemCountStrEnd - $itemCountStrStart);
			$this->itemCount = (int) $itemCountStr;

			$restTimeStart = $itemCountStrEnd;
			$restTimeEnd = strpos($longStr, "\n", $restTimeStart + 1);
			$this->resturantTime = substr($longStr, $restTimeStart, $restTimeEnd - $restTimeStart);

			$bodyStrName = "body:";
			$bodyStrStart = strpos($longStr, $bodyStrName, $restTimeEnd) + 5;
			$bodyStr = substr($longStr, $bodyStrStart, strlen($longStr));

			for($i = 0; $i < $this->itemCount; $i++){ 

				//txt file items are starting at 0
				$curItemIdStr = "id" . $i;

				$curItemIdStart = strpos($bodyStr, $curItemIdStr);
				$curItemIdEnd =  strpos($bodyStr, "\n", $curItemIdStart);
				$itemId = substr($bodyStr, $curItemIdStart, $curItemIdEnd - $curItemIdStart);

				$curItemStr = "item";
				$curItemStart = strpos($bodyStr, $curItemStr, $curItemIdEnd) + 5;
				$curItemEnd = strpos($bodyStr, "\n", $curItemStart);
				$name = substr($bodyStr, $curItemStart, $curItemEnd - $curItemStart);

				$curCalStr = "cal"; 
				$curCalStart = strpos($bodyStr, $curCalStr, $curItemEnd) + 3;
				$curCalEnd = strpos($bodyStr, "\n", $curCalStart);  
				$calories = substr($bodyStr, $curCalStart, $curCalEnd - $curCalStart);

				$mealItemObj = new mealItem($itemId, $name, $calories);
				$this->mealItem[$i] =  $mealItemObj;

			}
			

			
		}

		public function getResturantName(){
			return$this->resturantName;
		}

		public function setResturantName($newResturantName){
			$this->resturantName = $newResturantName;
		}

		public function getItemCount(){
			return $this->itemCount;
		}

		public function setItemCount($newItemCount){
			$this->itemCount = $newItemCount;
		}

		public function getResturantTime(){
			return $this->resturarantTime;
		}

		public function setResturantTime($newResturantTime){
			$this->resturantTime = $newResturantTime;
		}

		public function getMealItem(){
			return $this->mealItems;
		}

		//debugging based function to make sure every object has the correct data
		public function displayData(){

			echo "<p>" . $this->longStr . "</p>";
			echo "<p>" . $this->resturantName . "</p>";
			echo "<p> ItemCount: " . $this->itemCount . "</p>";
			echo "<p>" . $this->resturantTime . "</p><br>";

			foreach($this->mealItem as $mealItemObj){

				echo "<p>" . $mealItemObj->getItemId()	. "</p>";		
				echo "<p>" . $mealItemObj->getName()	. "</p>";
				echo "<p>" . $mealItemObj->getCalories()	. "</p>";
				echo "<br> <br>";

			}
		}

		public function displayCheckBox(){


			foreach($this->mealItem as $mealItemObj){

				echo "<input name=\"" . $mealItemObj->getName() .  "\" class=\"checkBox\"type=\"checkbox\" id=\"" . $mealItemObj->getItemId() . "\" value = \"" . $mealItemObj->getCalories() . "\">";
				echo "<label for=\"" . $mealItemObj->getName() . "\" class = \"item\"> " . $mealItemObj->getName() . "</label>"; 
				echo "<label for=\"" . $mealItemObj->getName() . "\" class = \"calories\"> " . $mealItemObj->getCalories() . " Calories </label>";
				echo "<br>"; 


			}
		}



	}

	class mealItem{
		private $itemId;
		private $name;
		private $calories;

		public function __construct($itemId, $name, $calories){

					$this->itemId = $itemId;
					$this->name = $name;
					$this->calories = $calories;
		}

		public function getitemId(){
			return $this->itemId;
		}

		public function setItemId($newItemId){
			$this->itemId = $newItemId;
		}

		public function getName(){
			return $this->name;
		}

		public function setName($newName){
			$this->name = $newName;
		}

		public function getCalories(){
			return (int) $this->calories;
		}

		public function setCalories($newCalories){
			$this->calories = $newCalories;
		}
	}

?>