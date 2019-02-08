<?php


namespace Juanparati\PowerBI\Models;


use Juanparati\PowerBI\Exceptions\ModelException;


/**
 * Class Model.
 *
 * @package Juanparati\PowerBI\Models
 */
abstract class Model implements \JsonSerializable
{

	/**
	 * Required fields
	 *
	 * @var array
	 */
	protected $required = [];


	/**
	 * Cache used for the listed properties collected with reflection.
	 *
	 * @var null
	 */
	protected $properties = [];


	/**
	 * Model constructor.
	 *
	 * @param array $values
	 */
	public function __construct(array $values = [])
	{

		// Obtain a list of public properties
		$reflection = new \ReflectionClass(static::class);
		$properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);
		$this->properties = array_map(function ($prop) { return $prop->getName(); }, $properties);


		// Autodetect required fields (Those that are not null by default)
		if (empty($this->required))
		{
			foreach ($this->properties as $property)
			{
				if (null !== $this->{$property})
					$this->required[] = $property;
			}
		}


		// Assign values
		foreach ($values as $prop => $value)
		{
			if (in_array($prop, $this->properties))
				$this->{$prop} = $value;
		}
	}


	/**
	 * Modify the behaviour when this object is serialized as JSON.
	 *
	 * @return array|mixed
	 * @throws ModelException
	 */
	public function jsonSerialize ()
	{
		$model = [];

		foreach ($this->properties as $property)
		{
			$value = $this->{$property};

			if (!empty($value))
				$model[$property] = $this->{$property};
			else if (in_array($property, $this->required))
				throw new ModelException("Field $property is required");
		}

		return $model;
	}

}
