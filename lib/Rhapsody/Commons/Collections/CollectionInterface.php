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
namespace Rhapsody\Commons\Collections;

use Countable, IteratorAggregate, ArrayAccess;

interface CollectionInterface extends Countable, IteratorAggregate, ArrayAccess
{

	/**
	 * Add an element, <tt>$object</tt>, to this collection.
	 *
	 * @param mixed $object the object to add.
	 * @return true if the collection was modified as a result of this action.
	 * @throws UnsupportedOperationException if this collection does not
	 *   support the add operation.
	 * @throws ClassCastException if o cannot be added to this collection due
	 *   to its type.
	 * @throws NullPointerException if o is null and this collection doesn't
	 *   support the addition of null values.
	 * @throws IllegalArgumentException if o cannot be added to this
	 *   collection for some other reason.
	 */
	function add($object);

	/**
	 * Add the contents of a given <tt>$collection</tt> to this collection.
	 *
	 * @param mixed $collection the collection to add. May be either a
	 * 		primitive <tt>array</tt> or an instance of an <tt>Iterable</tt>
	 * 		interface.
	 * @return true if the collection was modified as a result of this action.
	 * @throws UnsupportedOperationException if this collection does not
	 *   support the addAll operation.
	 * @throws ClassCastException if some element of c cannot be added to this
	 *   collection due to its type.
	 * @throws NullPointerException if some element of c is null and this
	 *   collection does not support the addition of null values.
	 * @throws NullPointerException if c itself is null.
	 * @throws IllegalArgumentException if some element of c cannot be added
	 *   to this collection for some other reason.
	 */
	function addAll($collection);

	/**
	 * Clear the collection, such that a subsequent call to <tt>isEmpty()</tt>
	 * would return true.
	 *
	 * @throws UnsupportedOperationException if this collection does not
	 *   support the clear operation.
	 */
	function clear();

	/**
	 * Test whether this collection contains a given <tt>$object</tt> as one
	 * of its elements.
	 *
	 * @param mixed $object the element to look for.
	 * @return true if this collection contains at least one element e such that
	 *   <code>o == null ? e == null : o.equals(e)</code>.
	 * @throws ClassCastException if the type of o is not a valid type for this
	 *   collection.
	 * @throws NullPointerException if o is null and this collection doesn't
	 *   support null values.
	 */
	function contains($object);

	/**
	 * Test whether this collection contains every element in a given collection.
	 *
	 * @param c the collection to test for.
	 * @return true if for every element o in c, contains(o) would return true.
	 * @throws ClassCastException if the type of any element in c is not a valid
	 *   type for this collection.
	 * @throws NullPointerException if some element of c is null and this
	 *   collection does not support null values.
	 * @throws NullPointerException if c itself is null.
	 */
	function containsAll(Collection<?> c);

	/**
	 * Test whether this collection is equal to some object. The Collection
	 * interface does not explicitly require any behaviour from this method, and
	 * it may be left to the default implementation provided by Object. The Set
	 * and List interfaces do, however, require specific behaviour from this
	 * method.
	 * <p>
	 * If an implementation of Collection, which is not also an implementation of
	 * Set or List, should choose to implement this method, it should take care
	 * to obey the contract of the equals method of Object. In particular, care
	 * should be taken to return false when o is a Set or a List, in order to
	 * preserve the symmetry of the relation.
	 *
	 * @param o the object to compare to this collection.
	 * @return true if the o is equal to this collection.
	 */
	function equals(Object o);

	/**
	 * Obtain a hash code for this collection. The Collection interface does not
	 * explicitly require any behaviour from this method, and it may be left to
	 * the default implementation provided by Object. The Set and List interfaces
	 * do, however, require specific behaviour from this method.
	 * <p>
	 * If an implementation of Collection, which is not also an implementation of
	 * Set or List, should choose to implement this method, it should take care
	 * to obey the contract of the hashCode method of Object. Note that this
	 * method renders it impossible to correctly implement both Set and List, as
	 * the required implementations are mutually exclusive.
	 *
	 * @return a hash code for this collection.
	 */
	function hashCode();

	/**
	 * Test whether this collection is empty, that is, if size() == 0.
	 *
	 * @return true if this collection contains no elements.
	 */
	function isEmpty();

	/**
	 * Remove a single occurrence of an object from this collection. That is,
	 * remove an element e, if one exists, such that <code>o == null ? e == null
	 *   : o.equals(e)</code>.
	 *
	 * @param o the object to remove.
	 * @return true if the collection changed as a result of this call, that is,
	 *   if the collection contained at least one occurrence of o.
	 * @throws UnsupportedOperationException if this collection does not
	 *   support the remove operation.
	 * @throws ClassCastException if the type of o is not a valid type
	 *   for this collection.
	 * @throws NullPointerException if o is null and the collection doesn't
	 *   support null values.
	 */
	function remove(Object o);

	/**
	 * Remove all elements of a given collection from this collection. That is,
	 * remove every element e such that c.contains(e).
	 *
	 * @param c The collection of objects to be removed.
	 * @return true if this collection was modified as a result of this call.
	 * @throws UnsupportedOperationException if this collection does not
	 *   support the removeAll operation.
	 * @throws ClassCastException if the type of any element in c is not a valid
	 *   type for this collection.
	 * @throws NullPointerException if some element of c is null and this
	 *   collection does not support removing null values.
	 * @throws NullPointerException if c itself is null.
	 */
	function removeAll(Collection<?> c);

	/**
	 * Remove all elements of this collection that are not contained in a given
	 * collection. That is, remove every element e such that !c.contains(e).
	 *
	 * @param c The collection of objects to be retained.
	 * @return true if this collection was modified as a result of this call.
	 * @throws UnsupportedOperationException if this collection does not
	 *   support the retainAll operation.
	 * @throws ClassCastException if the type of any element in c is not a valid
	 *   type for this collection.
	 * @throws NullPointerException if some element of c is null and this
	 *   collection does not support retaining null values.
	 * @throws NullPointerException if c itself is null.
	 */
	function retainAll(Collection<?> c);

	/**
	 * Copy the current contents of this collection into an array.
	 *
	 * If an array, <tt>$arr</tt>, is passed as an argument, this function
	 * will copy the current contents of this collection into the specified
	 * array, effectively resulting in a merger of this collection and the
	 * array passed
	 *
	 * @return an array of type Object[] and length equal to the size of this
	 *   collection, containing the elements currently in this collection, in
	 *   any order.
	 */
	function toArray($arr = array());

	/**
	 * Copy the current contents of this collection into an array. If the array
	 * passed as an argument has length less than the size of this collection, an
	 * array of the same run-time type as a, and length equal to the size of this
	 * collection, is allocated using Reflection. Otherwise, a itself is used.
	 * The elements of this collection are copied into it, and if there is space
	 * in the array, the following element is set to null. The resultant array is
	 * returned.
	 * Note: The fact that the following element is set to null is only useful
	 * if it is known that this collection does not contain any null elements.
	 *
	 * @param a the array to copy this collection into.
	 * @return an array containing the elements currently in this collection, in
	 *   any order.
	 * @throws ArrayStoreException if the type of any element of the
	 *   collection is not a subtype of the element type of a.
	 */
	//<T> T[] toArray(T[] a);
}
