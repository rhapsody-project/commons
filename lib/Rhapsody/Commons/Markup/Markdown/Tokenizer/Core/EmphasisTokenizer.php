<?php
/* Copyright (c) 2013 Rhapsody Project
 *
 * Licensed under the MIT License (http://opensource.org/licenses/MIT)
 *
 * Permission is hereby granted, free of charge, to any
 * person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the
 * Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software,
 * and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice
 * shall be included in all copies or substantial portions of
 * the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY
 * KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 * PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
 * OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT
 * OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Rhapsody\Commons\Markup\Markdown\Tokenizer\Core;

use Rhapsody\Commons\Markup\Markdown\Tokenizer\AbstractTokenizer;

/**
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Markup\Markdown\Tokenizer\Core
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
class EmphasisTokenizer implements IMarkdownToken
{

	/**
   * {@inheritDoc}
   * @see \Rhapsody\Commons\Markup\Markdown\Tokenizer\AbstractTokenizer::regex()
   */
  public static function regex()
	{

	}

	public function evaluate(&$subject, $top, $blockquote, $callback)
	{
		$regex = EmphasisTokenizer::regex();
	}
	/*

function doItalicsAndBold($text) {
	$token_stack = array('');
	$text_stack = array('');
	$em = '';
	$strong = '';
	$tree_char_em = false;

	while (1) {
		#
		# Get prepared regular expression for seraching emphasis tokens
		# in current context.
		#
		$token_re = $this->em_strong_prepared_relist["$em$strong"];

		#
		# Each loop iteration search for the next emphasis token.
		# Each token is then passed to handleSpanToken.
		#
		$parts = preg_split($token_re, $text, 2, PREG_SPLIT_DELIM_CAPTURE);
		$text_stack[0] .= $parts[0];
		$token =& $parts[1];
		$text =& $parts[2];

		if (empty($token)) {
			# Reached end of text span: empty stack without emitting.
			# any more emphasis.
			while ($token_stack[0]) {
				$text_stack[1] .= array_shift($token_stack);
				$text_stack[0] .= array_shift($text_stack);
			}
			break;
		}

		$token_len = strlen($token);
		if ($tree_char_em) {
			# Reached closing marker while inside a three-char emphasis.
			if ($token_len == 3) {
				# Three-char closing marker, close em and strong.
				array_shift($token_stack);
				$span = array_shift($text_stack);
				$span = $this->runSpanGamut($span);
				$span = "<strong><em>$span</em></strong>";
				$text_stack[0] .= $this->hashPart($span);
				$em = '';
				$strong = '';
			} else {
				# Other closing marker: close one em or strong and
				# change current token state to match the other
				$token_stack[0] = str_repeat($token{0}, 3-$token_len);
				$tag = $token_len == 2 ? "strong" : "em";
				$span = $text_stack[0];
				$span = $this->runSpanGamut($span);
				$span = "<$tag>$span</$tag>";
				$text_stack[0] = $this->hashPart($span);
				$$tag = ''; # $$tag stands for $em or $strong
			}
			$tree_char_em = false;
		} else if ($token_len == 3) {
			if ($em) {
				# Reached closing marker for both em and strong.
				# Closing strong marker:
				for ($i = 0; $i < 2; ++$i) {
					$shifted_token = array_shift($token_stack);
					$tag = strlen($shifted_token) == 2 ? "strong" : "em";
					$span = array_shift($text_stack);
					$span = $this->runSpanGamut($span);
					$span = "<$tag>$span</$tag>";
					$text_stack[0] .= $this->hashPart($span);
					$$tag = ''; # $$tag stands for $em or $strong
				}
			} else {
				# Reached opening three-char emphasis marker. Push on token
				# stack; will be handled by the special condition above.
				$em = $token{0};
				$strong = "$em$em";
				array_unshift($token_stack, $token);
				array_unshift($text_stack, '');
				$tree_char_em = true;
			}
		} else if ($token_len == 2) {
			if ($strong) {
				# Unwind any dangling emphasis marker:
				if (strlen($token_stack[0]) == 1) {
					$text_stack[1] .= array_shift($token_stack);
					$text_stack[0] .= array_shift($text_stack);
				}
				# Closing strong marker:
				array_shift($token_stack);
				$span = array_shift($text_stack);
				$span = $this->runSpanGamut($span);
				$span = "<strong>$span</strong>";
				$text_stack[0] .= $this->hashPart($span);
				$strong = '';
				} else {
				array_unshift($token_stack, $token);
				array_unshift($text_stack, '');
				$strong = $token;
				}
				} else {
				# Here $token_len == 1
					if ($em) {
					if (strlen($token_stack[0]) == 1) {
					# Closing emphasis marker:
						array_shift($token_stack);
						$span = array_shift($text_stack);
						$span = $this->runSpanGamut($span);
						$span = "<em>$span</em>";
						$text_stack[0] .= $this->hashPart($span);
						$em = '';
					} else {
						$text_stack[0] .= $token;
						}
						} else {
						array_unshift($token_stack, $token);
						array_unshift($text_stack, '');
						$em = $token;
						}
				}
		}
		return $text_stack[0];
	}

	 */
}
