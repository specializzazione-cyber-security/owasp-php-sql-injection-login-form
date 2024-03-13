<?php


namespace App\Modules\Http\Controller;

use PDO;
use App\Modules\App;
use BadMethodCallException;
use App\Modules\Http\Controller\BaseController;
use PDOException;

class PublicController extends BaseController{
    
    public function login(){

        return view('login');
    }

    public function tryLogin(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        try{
            $user = $this->findUser($email,$password);
        }
        catch(PDOException $e){
            echo "Errore nell'esecuzione della query: " . $e->getMessage();
            return false;
        }

       if(!$user){
        return redirect('/login');
       }

       $_SESSION['user'] = $user;

       return redirect('/');
    }

    
    public function findUser($email,$password){
        $query = "select * from users where email=:email and password=:password limit 1";
        $db = App::$app->database->pdo;
        $sth = $db->prepare($query);
        $sth->bindParam(':email', $email);
        $sth->bindParam(':password', $password);
        $sth->execute();
        $data = $sth->fetchAll();
        
        return reset($data);
    }

    public function logout(){
        App::$app->regenerateSession();
        return redirect('/');
    }
}