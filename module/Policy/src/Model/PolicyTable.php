<?php 
	namespace Policy\Model;

	/**
	 * 
	 */
	use Zend\Db\TableGateway\TableGatewayInterface;

	class PolicyTable
	{
		protected $tableGateway;

		function __construct(TableGatewayInterface $tableGateway)
		{
			$this->tableGateway = $tableGateway;
		}

		public function fetchAll(){
			return $this->tableGateway->select();
		}

		public function saveData($policy){
			$data = [
				'first_name' => $policy->getFirstName(),
				'last_name' => $policy->getLastName(),
				'start_date' => $policy->getStartDate(),
				'end_date' => $policy->getEndDate(),
				'policy_number' => $policy->getPolicyNumber(),
				'premium' => $policy->getPremium(),
			];

			if($policy->getId()){
				$this->tableGateway->update($data, [
					'id' => $policy->getId(),
				]);
			}else{
				$this->tableGateway->insert($data);
			}

			// return $this->tableGateway->insert($data);

		}

		public function getPost($id){
			$data = $this->tableGateway->select([
				'id' => $id
			]);
			return $data->current();
		}

		public function deletePost($id){
			$this->tableGateway->delete([
				'id' => $id
			]);
		}
		
	}
?>