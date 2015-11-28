<html>
	<head>
		<title>text matching</title>
	</head>
	
<body>

<?php

	//input file
	$fp = fopen("../inputFile/product.txt", "r");
	
	if (!$fp)
	{
		echo "<p><strong>ไม่มีไฟล์"."พยายามอีกครั้งภายหลัง</strong></p></body></html>";
		exit;
	}
?>
	<div align="center">
		<form action="" name="form" method="get">
			<h4>searching</h4>
			<input type="text" name="search" id="search">
			<input type="submit" name="submit" id="submit" value="seaarch">
		</form>
	</div>
<?php
	if(isset($_GET['search'])){
	$text = $_GET['search'];
		header('Content-type:text-plain');
	
		while (!feof($fp))
		{
			$product= fgets($fp, 100);
			$pattern = preg_quote($searchfor, '/');
			$pattern = "/^.*$pattern.*\$/m";
			$text = file_get_contents($file);
		}
		function suffixes($pattern, &$suffixes)
		{
			$m = strlen($pattern);
 
			$suffixes[$m - 1] = $m;
			$g = $m - 1;
 
			for ($i = $m - 2; $i >= 0; --$i) 
			{
				if ($i > $g && $suffixes[$i + $m - 1 - $f] < $i - $g) 
				{
				$suffixes[$i] = $suffixes[$i + $m - 1 - $f];
      			} 
	  			else {
	  				if ($i < $g) 
	  				{
	  			$g = $i;
         	}
		 	$f = $i;
 
		 	while ($g >= 0 && $pattern[$g] == $pattern[$g + $m - 1 - $f]) 
		 	{
            	$g--;
         	}
		 	$suffixes[$i] = $f - $g;
      	}
   	}
}
 
function badCharacters($pattern, &$badChars)
{
   $m = strlen($pattern);
 
   for ($i = 0; $i < $m - 1; ++$i) {
      $badChars[$pattern{$i}] = $m - $i - 1;
   }
}
 
function goodSuffixes($pattern, &$goodSuffixes)
{
   $m 		= strlen($pattern);
   $suff 	= array();
 
   suffixes($pattern, $suff);
 
   for ($i = 0; $i < $m; $i++) {
      $goodSuffixes[$i] = $m;
   }
 
   for ($i = $m - 1; $i >= 0; $i--) {
      if ($suff[$i] == $i + 1) {
         for ($j = 0; $j < $m - $i - 1; $j++) {
            if ($goodSuffixes[$j] == $m) {
               $goodSuffixes[$j] = $m - $i - 1;
            }
         }
      }
   }
 
   for ($i = 0; $i < $m - 2; $i++) {
      $goodSuffixes[$m - 1 - $suff[$i]] = $m - $i - 1;
   }
}
 
function boyer_moore($pattern, $text)
{
   $n = strlen($text);
   $m = strlen($pattern);
 
   $goodSuffixes 	= array();
   $badCharacters 	= array();
 
   goodSuffixes($pattern, &$goodSuffixes);
   badCharacters($pattern, &$badCharacters);
 
   $j = 0;
   while ($j < $n - $m) {
      for ($i = $m - 1; $i >= 0 && $pattern[$i] == $text[$i + $j]; $i--);
      if ($i < 0) {
         echo $j;
         $j += $goodSuffixes[0];
      } else {
         $j += max($goodSuffixes[$i], $badCharacters[$text[$i + $j]] - $m + $i + 1);
      }
   }
}
function radix_sort($pattern,$text)
{
	$temp = $output = array();
	$len = count($input);
 
    for ($i = 0; $i < $len; $i++) {
		$temp[$input[$i]] = ($temp[$input[$i]] > 0) 
			? ++$temp[$input[$i]]
			: 1;
    }
 
    ksort($temp);
 
    foreach ($temp as $key => $val) {
		if ($val == 1) {
			$output[] = $key; 
		} else {
			while ($val--) {
				$output[] = $key;
			}
        }
    }
	boyer_moore(, );
    return $output;
}
fclose($fp);
?>
</body>
</html>
