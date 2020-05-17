<?php
namespace Woo\Page\Home;

use Woo\Component\Html\Html;
use Woo\Page\Home\UserDb;

class Homepage
{
	function Index()
	{
		// Get users from database
		$users = UserDb::GetUsers();

		// Page header
		Html::Header();

		?>

			<div id="box">
				<img src="/media/img/woo-marker.png" width="256" height="256">
				<h1> Welcome. It is sample page. </h1>
			</div>

			<style>
				html, body{margib: 0px; padding: 0px;}
				#box{margin-top: 50px; float: left; width: 100%; overflow: hidden; display: flex; flex-direction: column; align-items: center; font-family: Arial; color: #800080; }
				#box img{border-radius: 100px;}
			</style>

		<?php

		// Page footer
		Html::Footer();
	}
}
?>