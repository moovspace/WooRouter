<?php
namespace Woo\Component;

/**
 * Sample component
 */
abstract class Component
{
	/**
	 * Html content
	 *
	 * @return string Html content
	 */
	function Show($arr)
	{
		return '';
	}

	/**
	 * Head links: css, js
	 *
	 * @return string Head links
	 */
	function Head()
	{
		return '';
	}
}
?>