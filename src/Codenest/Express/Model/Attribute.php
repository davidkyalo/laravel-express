<?php
namespace Codenest\Express\Model;

class Attribute {

	protected $Name;
	protected $DataType;
	protected $DataTypeOptions;
	protected $InDb = True;
	protected $DbColumn;
	protected $DbColumnType;
	protected $DbColumnOptions;

	protected $Unique = False;
	protected $Primary = False;

	protected $Default = Null;
	protected $Rules = '';
	protected $RuleSet = [];
	protected $Nullable = False;
	protected $Blank = False;

	protected $foreignKey = False;
	protected $foreignModel = Null;
	
	protected $rulesMade = False;
	protected $getter;
	protected $getter;
	protected $readable = Ture;
	protected $writable = True;
	protected $validatEvents;

	public function __construct($Name, $DataType, Array  $DataTypeOptions = [] ) {
		$this->Name = $Name;
		$this->dataType($DataType, $DataTypeOptions);
		$this->setValidateEvents();
	}

	public function getDataType() {
		return [ 'type' => $this->DataType, 'options' => $this->options ];
	}

	public function setValidateEvents(Array $events = ['create', 'update']) {
		$this->ValidatEvents = $events;
		$this->ruleSet([]);
		return $this;
	}

	public function name($value) {
		$this->Name = $value;
		return $this;
	}

	public function dataType($DataType, Array $options = []){
		$this->DataType = $DataType;
		$this->DataTypeOptions = $options;
		return $this;
	}

	public function inDb($value = True) {
		$this->InDb = $value;
		return $this;
	}

	public function dbColumn($value) {
		$this->DbColumn = $value;
		return $this;
	}

	public function dbColumnType($type, Array $options = []) {
		$this->DbColumnType = $type;
		$this->DbColumnOptions = $options;
		return $this;
	}

	public function _default($value) {
		$this->Default = $value;
		return $this;
	}

	public function rules($value) {
		$this->Rules = $value;
		return $this;
	}

	public function ruleSet(Array $value) {
		$ruleSet = [];
		foreach ($this->ValidatEvents as $event) {
			$ruleSet[$event] = isset($value[$event]) ? Null;
		}
		$this->RuleSet = $ruleSet;
		return $this;
	}

	public function nullable($value = Ture) {
		$this->Nullable = $value;
		return $this;
	}

	public function blank($value = True) {
		$this->Blank = $value;
		return $this;
	}

	public function _private(){
		$this->readable = False;
		$this->writable = False;
		return $this;
	}

	public function readOnly($value = True) {
		$this->readable = True;
		$this->writable = False
		return $this;
	}

	public function _public(){
		$this->readable = True;
		$this->writable = True;
		return $this;
	}

	public function get($callable) {
		$this->readable = True;
		$this->getter = $callable;
		return $this;
	}

	public function set($callable) {
		$this->writable = True;
		$this->setter = $callable;
		return $this;
	}



	public function getSet( $getCallable, $setCallable ) {
		$this->get($getCallable);
		$this->set($setCallable);
		return $this;
	}

	public function foreign($key = Null, $model = Null) {
		$this->foreignKey = $this->getOption($key, True);
		$this->foreignModel = $model;
		$this->_private();
	}

	public function unique($value = True) {
		$this->Unique = $value;
		return $this;
	}

	public function primary($value = True) {
		$this->Primary = $value;
		return $this;
	}

	public function isForeignKey(){
		return $this->foreignKey ? True : False;
	}

	public function getRules($event = Null) {
		$this->makeRules();
		return is_null($event) || !isset($this->RuleSet[$event])
					? $this->Rules
					: $this->RuleSet[$event];

	}

	public function getRuleSet() {
		$this->makeRules();
		return $this->RuleSet;
	}

	protected function makeRules() {
		if($this->rulesMade)
			return;

		if(!$this->Nullable && !$this->Blank) {
			$this->Rules = strpos($this->Rules , 'required') === False
								? 'required|' . $this->Rules
								: $this->Rules;
		}

		foreach ($this->RuleSet as $event => $rules) {
			$rules = $this->getOption($rules, $this->Rules);
			if(!$this->Nullable && !$this->Blank) {
				$rules = strpos($rules, 'required') === False
										? 'required|' . $rules
										: $rules;

			}
			$this->RuleSet[$event] = $rules;
		}
		$this->rulesMade = True;
	}


	protected function getOption($value, $default) {
		if(is_array($value) && count($value) == 0)
			return $default;

		return is_null($value) ? $default : $value;
	}

	public function __get($var) {

		$var = lcfirst($var);
		if(property_exists( $this, $var))
			return $this->var;

	}

	public function __call( $method,  $parameters ) {
        if($method === 'default'){
            return $this->_default(array_pop($parameters));
        }
        elseif ($method === 'private') {
        	return $this->_private();
        }
        elseif ($method === 'public') {
        	return $this->_public();
        }
    }

}