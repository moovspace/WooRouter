<?php
namespace Woo\App\Router;

class ErrorPage
{
    static function Error()
    {
		?>

		<div id="box">
			<img src="/media/img/error.jpg" width="256" height="256">
			<h1>Error 404! Page not found!</h1>
		</div>

		<style>
			#box{margin-top: 50px; float: left; width: 100%; overflow: hidden; display: flex; flex-direction: column; align-items: center; font-family: Arial; color: purple}
		</style>

		<?php
    }
}
?>