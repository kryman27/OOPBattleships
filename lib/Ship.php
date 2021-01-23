<?php

class Ship
{
    private $id;
    
    private $name;
    
    private $weaponPower = 0;
    
    private $jediFactor = 0;
    
    private $strength = 0;
    
    private $underRepair;
    
    public function __construct($name)
    {
        $this->name = $name;
        // randomly put this ship under repair
        $this->underRepair = mt_rand(1, 100) < 30;
    }
    
    public function isFunctional()
    {
        return !$this->underRepair;
    }
    
    public function sayHello()
    {
        echo 'Hello!';
    }
    
    public function getName()
    {
        return strtoupper($this->name);
    }
    
    function setName($name)
    {
        $this->name = $name;
    }
    
    function getWeaponPower()
    {
        return $this->weaponPower;
    }

    function getJediFactor()
    {
        return $this->jediFactor;
    }

    function setWeaponPower($weaponPower)
    {
        $this->weaponPower = $weaponPower;
    }

    function setJediFactor($jediFactor)
    {
        $this->jediFactor = $jediFactor;
    }
        
    public function setStrength($number)
    {
        if(!is_numeric($number)) {
            throw new Exception('Strength must be a number, duh!');
        }
        
        $this->strength = $number;
    }
    
    public function getStrength()
    {
        return $this->strength;
    }
    
    function getId()
    {
        return $this->id;
    }
    
    
    /*
     * @param int $id
     */
    function setId($id): void
    {
        $this->id = $id;
    }
            
    public function getNameAndSpecs($useShortFormat = false)
    {
        if ($useShortFormat) {
            return sprintf(
                '%s: %s/%s/%s',
                $this->name,
                $this->weaponPower,
                $this->jediFactor,
                $this->strength
            );
        } else {
            return sprintf(
                '%s: w:%s, j:%s, s:%s',
                $this->name,
                $this->weaponPower,
                $this->jediFactor,
                $this->strength
            );
        }
    }
    
    public function doesGivenShipHaveMoreStrength($givenShip)
    {
        return $givenShip->strength > $this->strength;
    } 
    
}