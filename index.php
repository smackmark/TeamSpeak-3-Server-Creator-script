<?php
////////////////////////////////////////////////////
//// Simple TeamSpeak Server Creator v1.0      ////
//// Copyright: @smck1337                     ////
//// Twitter: @smck1337                      ////
//// GITHUB: smck1337                       ////
///////////////////////////////////////////////

	date_default_timezone_set('Europe/Budapest');
	require_once("libraries/TeamSpeak3/TeamSpeak3.php");
	include 'data/config.php';
	
	
    $connect = "serverquery://".$USER_QUERY.":".$PASS_QUERY."@".$HOST_QUERY.":".$PORT_QUERY."";
    $ts3 = TeamSpeak3::factory($connect);
	
	if (isset($_POST["create"])) {
		
		$servername = $_POST['servername'];
        $slots = 50;
		$unixTime = time();
		$realTime = date('[Y-m-d]-[H:i]',$unixTime);
		
		if(!empty($_POST['port'])) {
			
			$port = $_POST['port'];
			try
			{
				$new_ts3 = $ts3->serverCreate(array(
				"virtualserver_name" => $servername,
				"virtualserver_maxclients" => 50,
				"virtualserver_port" => $port,
				"virtualserver_name_phonetic" => $realTime,
				"virtualserver_hostbutton_tooltip" => "Free TS3 Szerver",
				"virtualserver_hostbutton_url" => "http://freets.endlesscs.hu/",
				"virtualserver_hostbutton_gfx_url" => "http://freets.endlesscs.hu/images/rr.png",
				));
				
				$token = $new_ts3['token'];
				
			}
			catch(Exception $e)
			{
				echo "Error (ID " . $e->getCode() . ") <b>" . $e->getMessage() . "</b>";
			}
			} else{
			
			try
			{
				$new_ts3 = $ts3->serverCreate(array(
				"virtualserver_name" => $servername,
				"virtualserver_maxclients" => $slots,
				"virtualserver_name_phonetic" => $realTime,
				"virtualserver_hostbutton_tooltip" => "Free TS3 Szerver",
				"virtualserver_hostbutton_url" => "http://freets.endlesscs.hu/",
				"virtualserver_hostbutton_gfx_url" => "http://freets.endlesscs.hu/images/rr.png",
				));
				
				$token = $new_ts3['token'];
				$portran = $new_ts3['virtualserver_port'];
				
			}
			catch(Exception $e)
			{
				echo "Error (ID " . $e->getCode() . ") <b>" . $e->getMessage() . "</b>";
			}
			
		}
		
		
	}
?>
<!DOCTYPE html>
<html lang="hu" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <title>Ingyen TS3 Szerver :: endlesscs.hu</title>
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
	</head>
    <body>
        <div class="container">
            <header>
				<h1>freets.endlesscs.hu</h1>
				<h2><b>Ingyen TeamSpeak Szerver Generátor v1.0</b></h2>
			</header>
            <section>				
                <div id="container_demo" >
                    <div id="wrapper">
                        <div id="login" class="animate form">
							<?php 
								if (isset($_POST["create"])) {
								?>
								<form  method="post" autocomplete="off"> 
									
									<h1>a szerver elkészült!</h1> 
									
									<p> 
										<label  class="uname" data-icon="u" > Szervernév:</label>
										<input readonly type="text" value="<?php echo $servername; ?>"/>
									</p>
									
									<p> 
										<label  class="uname" data-icon="u" > Admin token:</label>
										<input readonly type="text" value="<?php echo $token; ?>"/>
									</p>
									
									<p> 
										<label  class="uname" data-icon="u" > IP cím:</label>
										<input readonly type="text" value="164.132.180.137:<?php if(!empty($_POST['port'])) { echo $port; } else{ echo $portran; }  ?>"/>
									</p>
									
								</form>
								
								<?php } 
								else{
								?>
								<form  method="post" autocomplete="off"> 
									<h1>beállítások</h1> 
									<p> 
										<label  class="uname" data-icon="u" > Szervernév</label>
										<input  name="servername" required="required" type="text" placeholder="Szervernév"/>
									</p>
									
									<p> 
										<label class="youpasswd" data-icon="p"> Férőhely (max. 50)</label>
										<input name="slots" required="required" type="text" placeholder="50" /> 
									</p>
									
									<p> 
										<label class="youpasswd" data-icon="p"> Szerver Port</label>
										<input name="port" type="text" placeholder="9987 nem engedélyezett" /> 
									</p>
									
									<p class="login button"> 
										<input type="submit" name="create" value="készít!" /> 
									</p>
								</form>
							<?php } ?>
						</div>
						
					</div>
				</div>  
			</section>
			<footer>
<div class="col-md-9">
<p><strong>Copyright &copy; 2017<span style="text-decoration: underline;"><a href="http://freets.endlesscs.hu/"> freets.endlesscs.hu</a></span></strong></p>
<br /><strong> Ingyenes TeamSpeak szerverek az <span style="text-decoration: underline;"><a href="http://www.endlesscs.hu/">endlesscs.hu</a></span>&nbsp;csapata &aacute;ltal.</strong><br /><strong> Ingyen 50 f&eacute;rőhely, semmi hirdet&eacute;s, lagmentes-stabil - DDoS v&eacute;dett szerverek.</strong></div>
      </div>
			</footer>
		</div>
	</body>
</html>																							