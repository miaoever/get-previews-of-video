<html>
<head>
<title>Get preview from youku.com </title>
</head>
<body style="text-align:left">
<form action="test.php" method="post">
<span style="margin-left:40px">input the url:</span>
<input style= "width:500px" name="video" type="text" value="http://"/>
<input name="submit" type="submit" value="Submit"/>
</li>
</form>
<ul style="text-align:left">
	<li>URL pattern for Youku: http://v.youku.com/<span style="color:red">v_show</span>/id_xxxxxxxxxxxxxxx.html</li>
	<li>URL pattern for Tudou: http://www.tudou.com/<span style="color:red">programs</span>/view/3YEcNCi0cV</li>
</ul>
<?php
if ( isset( $_POST["video"]) != ""  )
{	
	$curl = curl_init();
	$url = trim($_POST["video"]);
//	echo $url;
	if ( stripos($url,'youku.com') !== false )
	{
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($curl);
		preg_match( '/id="s_sina2".*?pic=(.*?)".?target=/', $data , $result );
		echo '<div style="margin:40px">Preview from youku.com <br />';
		echo '<a target="_blank" href="'.$url.'"> <img src="'. $result[1].'" /></a></div>';
	}else{
		if ( stripos($url, 'tudou.com') !== false )
		{
			curl_setopt($curl, CURLOPT_URL, $url);
	                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                	$data = curl_exec($curl);
                	preg_match( "/thumbnail = pic = '(.*?)'/", $data , $result );
			echo '<div style="margin:40px">Preview from tudou.com <br />';
			echo '<a target="_blank" href="'.$url.'"> <img src="'. $result[1].'" /></a></div>';
		}
	
	}

	curl_close($curl);
}	

?>
</body>
</html>
