<?
	//considera os numeros na array como id de quem vai participar da parada
	$a = array(1,2,3,4,5,6,7,8,9);
	print_r(sorteia($a));
	
	function sorteia($a)
	{
		$b = $a;
		$c = array();
		$i = 0;

		shuffle($a);

		while($i<count($a))
		{
			if($a[$i]==$b[$i])
			{
				$i=0;
				shuffle($a);
			}
			else
				$i++;
		}

		foreach($b as $k => $v)
			$c[] = array($v, $a[$k]);

		return $c;
	}

?>
