
<?php
echo "Value :".Dick::showDick();
$bal = new Dick();
Dick::showDick();
echo "Value :".Dick::showDick();
$bal = new Dick();
Dick::showDick();

class Dick
{
	public static $uglyDick = "NULL";
	public function __construct()
	{
		if (self::$uglyDick === "NULL"){
			self::$uglyDick='Huge';
		}

		//echo "New Dick".self::$uglyDick;

	}

	public static function showDick()
	{
		echo self::$uglyDick;
	}


}

	?>

