<?php
namespace Rhapsody\Commons\Markup;

interface MarkupParserInterface
{

	/**
	 *
	 */
	function getName();

	/**
	 *
	 * @param unknown $text
	 */
	function parse($text);
}