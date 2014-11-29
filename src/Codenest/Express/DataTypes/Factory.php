<?php
namespace Codenest\Express\DataTypes;


class Factory {
	protected $dataTypes = [
					//Integer 2
					 'Increments'		 => 'Type',
					 'BigIncrements'		 => 'Type',

					//String
					 'Char'		 => 'Type',
					 'String'		 => 'Type',
					 'Text'		 => 'Type',
					 'MediumText'		 => 'Type',
					 'LongText'		 => 'Type',
					 'Email'		 => 'Type',
					 'Url'		 => 'Type',

					 //Integer 7
					 'Integer'		 => 'Type',
					 'BigInteger'		 => 'Type',
					 'MediumInteger'		 => 'Type',
					 'TinyInteger'		 => 'Type',
					 'SmallInteger'		 => 'Type',
					 'UnsignedInteger'		 => 'Type',
					 'UnsignedBigInteger'	=> 'Type',

					 //Other Numeric :3
					 'Float'		 => 'Type',
					 'Double'		 => 'Type',
					 'Decimal'		 => 'Type',

					 //Bool :1
					 'Boolean'		 => 'Type',

					 //Enum Str :1
					 'Enum'		 => 'Type',

					 //Enum Integer :1
					 'IntegerEnum'		 => 'Type',

					 //Collaction
					 'JsonSerialized'		 => 'Type',

					 //DateTime : 4
					 'Date'		 => 'Type',
					 'DateTime'		 => 'Type',
					 'Time'		 => 'Type',
					 'Timestamp'		 => 'Type',

					 //Custom Eloqunt - Timestamps 
					 'NullableTimestamps'	=> 'Type',
					 'Timestamps'		 => 'Type',
					 'SoftDeletes'		 => 'Type',
					 'Binary'		 => 'Type',

					 //Custom Eloqunt - String 2
					 'Morphs'		 => 'Type',

		];

}

