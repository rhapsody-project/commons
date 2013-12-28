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
namespace Rhapsody\Commons\Traits;

/**
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Traits
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
trait AuditTrait
{

	/**
	 * The reference to the user that created this object.
	 * @var mixed
	 */
	protected $author;

	/**
	 * The date that this object was created.
	 * @var \DateTime
	 */
	protected $created;

	/**
	 * The date and time when the object was last modified.
	 * @var \DateTime
	 */
	protected $lastModified;

	/**
	 * The reference to the user that last modified the object.
	 * @var mixed
	 */
	protected $lastModifiedBy;

	public function getAuthor()
	{
		return $this->author;
	}

	public function getCreated()
	{
		return $this->created;
	}

	public function getLastModified()
	{
		return $this->lastModified;
	}

	public function getLastModifiedBy()
	{
		return $this->lastModifiedBy;
	}

	public function setAuthor($author)
	{
		$this->author = $author;
	}

	public function setCreated($created)
	{
		$this->created = $created;
	}

	public function setLastModified($lastModified)
	{
		$this->lastModified = $lastModified;
	}

	public function setLastModifiedBy($lastModifiedBy)
	{
		$this->lastModifiedBy = $lastModifiedBy;
	}
}

?>