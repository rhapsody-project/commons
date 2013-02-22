<?php
namespace Rhapsody\CommonsBundle\Json;

/**
 * <p>
 * Rhapsody implementation of the PHP 5.4 {@link \JsonSerializable} interface
 * that exposes the same method used by the PHP library to perform JSON
 * serialization on objects. Unlike the PHP 5.4 interface, this interface does
 * not have deep integration with the JSON encode function,
 * {@link http://www.php.net/manual/en/function.json-encode.php json_encode()}.
 * </p>
 * <p>
 * In order to encode an object as JSON, you must explicitly call json_encode()
 * on the result returned by {@link JsonSerializableInterface::jsonSerialize()}
 * </p>
 *
 * @author Sean.Quinn
 * @since 1.0
 */
interface JsonSerializableInterface
{
	/**
	 * Derives an object from a passed <tt>$json</tt> string.
	 *
	 * @param string $json
	 * @return mixed the object.
	 */
	static function fromJson($json);

	/**
	 * Serializes the object to a value that can be natively transformed into
	 * a valid JSON string, by the {@link http://www.php.net/manual/en/function.json-encode.php json_encode()}
	 * function.
	 *
	 * @return string the json representation of the object.
	 */
	function jsonSerialize();

	/**
	 * Alias to {@link JsonSerializableInterface::jsonSerialize()}
	 */
	function toJson();
}