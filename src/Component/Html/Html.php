<?php
namespace Woo\Component\Html;

class Html
{
	static function Header($title = '', $desc = '', $keywords = '', $head = '')
	{
		?>
			<!DOCTYPE html>
			<html lang="pl">
			<head>
				<title> <?php echo $title ?> </title>
				<meta charset="UTF-8">
				<meta http-equiv="X-UA-Compatible" content="ie=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
				<meta name="description" content="<?php echo $desc ?>">
				<meta name="keywords" content="<?php echo $keywords ?>">
				<meta name="author" content="">

				<?php
					self::Favicon();
					self::Cache();
				?>

				<!-- fonts -->
				<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700,900" rel="stylesheet">

				<!-- Script -->
				<script src="/main.js"></script>

				<!-- Style -->
				<link rel="stylesheet" href="/style.css">

				<?php echo $head; ?>

				<script> </script>
				<style type="text/css"> </style>

			</head>
			<body>
		<?php
	}

	static function Footer()
	{
		?>
			</body>
			</html>
		<?php
	}

	static function Cache(){
		?>
			<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
			<meta http-equiv="Cache-Control" content="post-check=0, pre-check=0">
			<meta http-equiv="Pragma" content="no-cache" />
			<meta http-equiv="Expires" content="1" />
		<?php
	}

	static function Favicon()
	{
		?>
			<link rel="shortcut icon" href="/favicon/favicon.ico" type="image/x-icon">
			<link rel="icon" href="/favicon/favicon.ico" type="image/x-icon">
		<?php
	}
}
?>