<?php

namespace Core\Model;

use Laminas\Db\TableGateway\TableGatewayInterface;
use RuntimeException;

class AbstractCoreModelTable {
    
    protected $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getBy(array $params) {
        $rowset = $this->tableGateway->select($params);
        $row = $rowset->current();
        if(!$row) {
            throw new RuntimeException('Não foi possível localizar a linhas.');
        }

        return $row;
    }

    public function save(array $data) {
        if(isset($data['id'])) {
            $id = (int)$data['id'];

            if(!$this->getBy(['id' => $id])) {
                throw new RuntimeException(sprintf('Não foi possível atualizar. Identificador %d; não existe', $id));
            }

            $this->tableGateway->update($data, ['id' => $id]);

            return $this->getBy(['id' => $id]);
        }

        $this->tableGateway->insert($data);
        return $this->getBy(['id' => $this->tableGateway->getLastInsertValue()]);
    }

    public function delete($id) {
        $this->tableGateway->delete(['$id' => (int)$id]);
    }

}