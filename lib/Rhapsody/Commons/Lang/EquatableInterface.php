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
namespace Rhapsody\Commons\Lang;

/**
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Lang
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
interface EquatableInterface
{

	/**
	 * <p>Indicates whether some other object is "equal to" this one.</p>
	 *
	 * <p>The equals method implements an equivalence relation on non-null
	 * object references:
	 * <ul>
	 *   <li>It is <i>reflexive</i>: for any non-null reference value x,
	 *       x.equals(x) should return true.</li>
	 *   <li>It is <i>symmetric</i>: for any non-null reference values x and y,
	 *       x.equals(y) should return true if and only if y.equals(x) returns
	 *       true.</li>
	 *   <li>It is <i>transitive</i>: for any non-null reference values x, y,
	 *       and z, if x.equals(y) returns true and y.equals(z) returns true,
	 *       then x.equals(z) should return true.</li>
	 *   <li>It is <i>consistent</i>: for any non-null reference values x and y,
	 *       multiple invocations of x.equals(y) consistently return true or
	 *       consistently return false, provided no information used in equals
	 *       comparisons on the objects is modified.</li>
	 *   <li>For any non-null reference value x, x.equals(null) should return
	 *       false.</li>
	 * </ul></p>
	 *
	 * <p>The equals method for class Object implements the most discriminating
	 * possible equivalence relation on objects; that is, for any non-null
	 * reference values x and y, this method returns true if and only if x and
	 * y refer to the same object (x == y has the value true).</p>
	 *
	 * <p>Note that it is generally necessary to override the hashCode method
	 * whenever this method is overridden, so as to maintain the general contract
	 * for the hashCode method, which states that equal objects must have equal
	 * hash codes.</p>
	 *
	 * @param object $object
	 * @return boolean
	 */
	function equals($object);
}