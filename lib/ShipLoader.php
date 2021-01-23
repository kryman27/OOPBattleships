<?php

class ShipLoader
{
    private $pdo;
    
    private string $dbDsn;
    private  $dbUser;
    private $dbPass;

    public function __construct(string $dbDsn, $dbUser, $dbPass)
    {
        $this->dbDsn = $dbDsn;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
    }
    
    public function getShips()
    {
        $ships = array();

        $shipsData = $this->queryForShips();

        foreach ($shipsData as $shipData) {
           $ships[] = $this->createShipFromData($shipData);
        }

        return $ships;
    }

    public function findOneById(int $id): ?Ship
    {
        
        $statement = $this->getPDO()->prepare('SELECT * FROM ship WHERE id = :id');
        $statement->execute(array('id' => $id));
        $shipArray = $statement->fetch(PDO::FETCH_ASSOC);
        
        if (!$shipArray)
        {
            return null;
        }
        
        return $this->createShipFromData($shipArray);
    }

    private function createShipFromData(array $shipData): Ship
    {
        $ship = new Ship($shipData['name']);
        $ship->setId($shipData['id']);
        $ship->setWeaponPower($shipData['weapon_power']);
        $ship->setJediFactor($shipData['jedi_factor']);
        $ship->setStrength($shipData['strength']);
        
        return $ship;
    }
    
    /**
     * @return Ship[]
     */
    private function queryForShips(): array
    {
        $statement = $this->getPDO()->prepare('SELECT * FROM ship');
        $statement->execute();
        $shipsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $shipsArray;
    }
    
    /**
     * @return PDO
     */
    private function getPDO(): ?PDO
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO($this->dbDsn, $this->dbUser, $this->dbPass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
                
        return $this->pdo;
    }
}
