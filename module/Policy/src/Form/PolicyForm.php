<?php 
	namespace Policy\Form;

	use Zend\Form\Form;

	/**
	 * 
	 */
	class PolicyForm extends Form
	{
		
		function __construct($name = null)
		{
			parent::__construct('policy');
			$this->setAttribute('method', 'POST');

			$this->add([
				'name' => 'id',
				'type' => 'hidden'
			]);

			$this->add([
				'name' => 'first_name',
				'type' => 'text',
				'options' => [
					'label' => 'First Name'
				]
			]);

			$this->add([
				'name' => 'last_name',
				'type' => 'text',
				'options' => [
					'label' => 'Last Name'
				],
				'attributes' => [
					'required' => 'required'
				]
			]);

			$this->add([
				'name' => 'start_date',
				'type' => 'date',
				'options' => [
					'label' => 'Start Date'
				],
				'attributes' => [
					'required' => 'required'
				]
			]);

			$this->add([
				'name' => 'end_date',
				'type' => 'date',
				'options' => [
					'label' => 'Start Date'
				],
				'attributes' => [
					'required' => 'required'
				]
			]);

			$this->add([
				'name' => 'policy_number',
				'type' => 'number',
				'options' => [
					'label' => 'Policy Number'
				],
				'attributes' => [
					'required' => 'required'
				]
			]);

			$this->add([
				'name' => 'premium',
				'type' => 'number',
				'options' => [
					'label' => 'Premium'
				]
			]);

			$this->add([
				'name' => 'submit',
				'type' => 'submit',
				'attributes' => [
					'value' => 'Save',
					'id' => 'buttonSave'
				]
			]);


		}
	}
?>