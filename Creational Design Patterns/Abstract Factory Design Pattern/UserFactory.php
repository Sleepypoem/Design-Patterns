<?php

/*

Abstract Factory es un patrón de diseño creacional que nos permite producir familias de objetos relacionados sin especificar sus clases concretas.

*/

//interfaz de usuarios con los metodos del usuario
interface UserInterface
{
    public function showData();
}

//Fabrica abstracta
interface FactoryInterface
{
    public function create($data);
}

//la clase usuario que implementa la interfaz de usuarios
class User implements UserInterface
{
    protected $name;
    protected $email;

    function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function showData()
    {
        return "Hi i'm $this->name, and my email is: $this->email";
    }
}

//La fabrica de usuarios, usando el patron Factory creamos una fabrica que se encarga de crear usuarios
class UserFactory implements FactoryInterface
{
    public function create($data): User
    {
        return new User($data["name"], $data["email"]);
    }
}

// Desde aqui es solo para probar las clases, primero una funcion que crea usuarios aleatorios.


function randomUser()
{
    $res = [];
    $res["name"] = "User" . rand(1, 20);
    $res["email"] = "Email" . rand(2000, 3000) . "@mail.com";
    return $res;
}

//instancia a la fabrica de usuarios y abajo una lista de usuarios
$user_factory = new UserFactory();
$users_list = [];

//se llena una lista con usuarios random para luego leer sus datos e imprimirlos en pantalla

for ($i = 0; $i < 10; $i++) {
    $users_list[] = $user_factory->create(randomUser());
}

echo "------------------------------------------Normal User------------------------------------------\n";
foreach ($users_list as $user) {
    echo $user->showData() . PHP_EOL;
}

echo "-----------------------------------------------------------------------------------------------\n";
//Probamos añadir un nuevo tipo de usuario y su respectiva fabrica

class PremiumUser extends User implements UserInterface
{
    protected $VIPTokens;

    function __construct($name, $email, $VIPTokens)
    {
        parent::__construct($name, $email);
        $this->VIPTokens = $VIPTokens;
    }

    //sobreescribiendo la funcion del padre
    function showData()
    {
        return parent::showData() . ", and i have $this->VIPTokens Tokens";
    }
}

class PremiumUserFactory implements FactoryInterface
{
    public function create($data): PremiumUser
    {
        return new PremiumUser("Premium " . $data["name"], $data["email"], $data["VIPTokens"]);
    }
}


$premium_user_factory = new PremiumUserFactory();
$premium_users_list = [];

function randomPremiumUser()
{
    $res = [];
    $res["name"] = "User" . rand(1, 20);
    $res["email"] = "Email" . rand(2000, 3000) . "@mail.com";
    $res["VIPTokens"] = rand(0, 200);
    return $res;
}

for ($i = 0; $i < 10; $i++) {
    $premium_users_list[] = $premium_user_factory->create(randomPremiumUser());
}

echo "------------------------------------------Premium User------------------------------------------\n";
foreach ($premium_users_list as $user) {
    echo $user->showData() . PHP_EOL;
}

echo "-----------------------------------------------------------------------------------------------\n";