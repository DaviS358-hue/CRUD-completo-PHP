<?php
class Address{
    private string $street;
    private string $number;
    private string $neighborhood;
    private string $city;
    private  string $cep;




    public function __construct(string $street,int $number,string $neighborhood, string $city, string $cep){
        $this->street = $street;
        $this->number = $number;
        $this->neighborhood = $neighborhood;
        $this->city = $city;
        $this->cep = $cep;
        
    }

    public function getStreet(): string{
        return $this->street;
    }

    public function setStreet(string $newStreet): void{
        $this->street = $newStreet;
    }

    public function getNumber(): string{
        return $this->number;
    }

    public function setNumber(string $newNumber): void{
        $this->number = $newNumber;
    }

    public function getNeighborhood() : string{
        return $this->neighborhood;
    }

    public function setNeighborhood(string $newNeighborhood) : void{
         $this->neighborhood = $newNeighborhood;
    }


    public function getCity(): string{
        return $this->city;
    }

    public function setCity(string $city){
        $this->city = $city;
    }

    
    public function getCep(): string{
        return $this->cep;
    }

    public function  setCep(string $newCep){
        $this->cep = $newCep;
    }
    

    
}



?>