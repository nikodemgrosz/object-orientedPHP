<?php
////////////////////KLASA PIZZA
class Pizza{
    private $Nazwa;
    public $Cena;
    public $Sos;
    public $Ciasto;
    public $Skladniki=[];
    public function __construct($Nazwa,$Sos,$Ciasto,$Skladniki){
        $this->setNazwa($Nazwa);
        $this->Sos = $Sos;
        $this->Ciasto = $Ciasto;
        $this -> Skladniki = $Skladniki;
        $this->oblicz_cene(); 
    }
    public function setNazwa($Nazwa)
    {
        $this->Nazwa = $Nazwa;

    }
    public function getNazwa(){
        return $this->Nazwa;
    }
    public function oblicz_cene(){
        $this -> Cena = 0;
        if($this->Ciasto == "cienkie"){
            $this->Cena = $this ->Cena + 10;
        }
        if($this->Ciasto == "grube"){
            $this->Cena = $this ->Cena + 15;
        }
        $this ->Cena = $this -> Cena + count($this->Skladniki)*5;
        
    }
    public function dodaj_skladnik($Skladnik){
        array_push($this->Skladniki,$Skladnik);
    }
    public function Info(){
        
        $this -> oblicz_cene();
        echo "Wybrana pizza to: ".$this->Nazwa."<br>";
        echo "Cena: ".$this->Cena."<br>";
        echo "Sos: ".$this->Sos."<br>";
        echo "Rodzaj ciasta: ".$this->Ciasto."<br>";
        echo "Składniki pizzy:<br>";
        foreach ($this->Skladniki as $Skladnik) {
            echo $Skladnik."<br>";
        }
    }
}
////////////////////////////// KLASA ZAMOWIENIE
    class Zamowienie  {
        public $numer;
        public $data;
        public $status;
        public $lista = [];
        public function __construct($numer) {
            $this->numer = $numer;
            $this->data = date('d-m-Y H:i:s');
            $this->status = "Nowy";
        }
        public function dodajPizze($pizza){
            array_push($this->lista,$pizza);
        }
        public function zakonczZamowienie(){
            $this->status = "zakonczony";   
        }
        public function wyswietlZamowienie(){
            echo "Numer zamowienia to: ".$this->numer."<br>";
            echo "Data: ".$this->data."<br>";
            echo "Status: ".$this->status."<br>";
            echo "Lista: <br>";
        foreach ($this->lista as $nowapizza) {
            $nowapizza -> Info();
        }

        }
        
    }
////////////////////////// KLASA LISTA ZAMOWIEN   
    class listaZamowien{
        public $zamowienia = [];
       public function dodajZamowienie($zamowienia){
        array_push($this -> zamowienia, $zamowienia);
       }
       public function usunZamowienie($numer){
        for($i=0;$i<count($this->zamowienia);$i++){
            if($numer==$this->zamowienia[$i]->numer){
                $this -> Zamowienia[$i] -> status = "usunieto";
        }
       }
       
    }
    public function wyswietlZamowienia($status){
        for($i = 0;$i<count($this->zamowienia);$i++){
            if($this->zamowienia[$i]->status == $status){
                $this -> zamowienia[$i] -> wyswietlZamowienie();
            }
        }
    }
}

    $pizza1 = new Pizza("Capricciosa","pomidorowy","grube",["pieczarki","ser","szynka"]);
    $pizza2 = new Pizza("Margaritta","ostry-mieszany","cienkie",["ananas","krewetki","nutella","zylc","frytki","kiełbasa"]);
    echo $pizza1 -> Info();
    
    echo "<br><br>";
    echo $pizza2 -> Info();
  
    echo "<br><br>";
   
    $z1 = new Zamowienie("1");
    echo "<br><br>";
    $z1 -> dodajPizze($pizza1);
    $z1 -> zakonczZamowienie();
    $z2 = new Zamowienie ("2");
    $z2 -> dodajPizze($pizza2);

    $lista1 = new listaZamowien();
    $lista1 -> dodajZamowienie($z1);
    $lista1 -> dodajZamowienie($z2);
    echo "<br><br>";
    $lista1 -> wyswietlZamowienia("zakonczony");
    echo "<br><br>";
    $lista1 -> wyswietlZamowienia("Nowy");
?>