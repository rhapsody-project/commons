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
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Lang
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
interface InternableInterface {

  /**
   * <p>Invokes the method <tt>$methodName</tt> in the context of the
   * current object (<tt>$this</tt>), returning the results from the
   * method call.</p>
   *
   * <p>The <tt>__callIntern</tt> method allows certain method types (e.g.
   * <tt>public</tt> and <tt>protected</tt>) to be called dynamically. The
   * purpose of this method is to permit marginal access to restricted
   * methods under certain circumstances.</p>
   *
   * <p>This method should never be called directly from the code unless
   * it is unavoidable. It is primarily meant as a place holder for access
   * to, and the execution of, methods in lieu of <code>Trait</code> and
   * proper <code>Closure</code> support. When these language constructs
   * become fully implemented this method will be deprecated and slated for
   * removal.</p>
   *
   * @param string $methodName
   * @param mixed... $args a variable number of arguments that will be
   *		treated as parameters to be passed to <tt>$methodName</tt>.
   * @return mixed the results from the call to method <tt>$methodName</tt>
   *		with the parameters <tt>$args</tt>.
   */
  public function __callIntern($methodName);
}
?>