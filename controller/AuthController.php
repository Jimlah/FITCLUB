<?php

require_once(__DIR__ . './Controller.php');
require_once(__DIR__ . './../model/UserModel.php');
require_once(__DIR__ . './../model/ClassModel.php');

class AuthController extends Controller
{

    // function __construct()
    // {
        
    // }
    
    /**
     * register a new user
     *
     * @param  mixed $data
     * @return void
     */
    public function register($data)
    {
        $this->loggedIn(alert('FITSESSID'));

        foreach ($data as $key => $value) {
            if (!isset($data[$key]) || empty($data[$key])) {
                return ucfirst($key) . " is required";
            }
        }

        if ($data['password'] !== $data['password1']) {
            return "Incorrect Password confirmation";
        }

        $data['firstname'] = filterInputs($data['firstname'], "string");
        $data['lastname'] = filterInputs($data['lastname'], "string");
        $data['class'] = filterInputs($data['class'], "int");
        $data['email'] = filterInputs($data['email'], "email");
        $data['password'] = password_hash(filterInputs($data['password'], "string"), PASSWORD_DEFAULT);

        $user = UserModel::where("email = '{$data["email"]}'");

        if ($user !== []) {
            flash('msg', "Email Already registered");
            return;
        }

        $id = UserModel::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'class' => $data['class']
        ]);


        if ($id) {
            flash('msg', "You have successfully registered");
            header("Location: /login.php");
            exit();
            return;
        }

        // flash('msg', "Unable to register");
        return ;
    }
    
    /**
     * log a new user in
     *
     * @param  mixed $data
     * @return void
     */
    public function login($data)
    {
        $this->loggedIn(alert('FITSESSID'));

        foreach ($data as $key => $value) {
            if (!isset($data[$key]) || empty($data[$key])) {
                return ucfirst($key) . " is required";
            }
        }

        $user = UserModel::where("email = '{$data["email"]}'");

        // Checks if it does not return an empty array
        if ($user !== []) {
            
            if (password_verify($data['password'], $user[0]['password'])) {
            
                register_session('FITSESSID', $user[0]);
                
                flash('msg', "You have successfully logged in");
                header("Location: /dashboard/index.php");
                exit();
            }
            flash('msg', "Incorrect Password");
            return;
        }

        flash('msg', "Unable to Login");
        return ;
    }
    
    /**
     * show the user Login page
     *
     * @return void
     */
    public function showLogin()
    {
        $this->loggedIn(alert("FITSESSID") );

        return ;
    }
    
    /**
     * show Register page
     *
     * @return array
     */
    public function showRegister()
    {
        $this->loggedIn(alert("FITSESSID") );

        $class = ClassModel::all();

        return $class;
    }


    public function logout()
    {
        session_abort();
        session_destroy();

        header("Location: /login.php");
    }
}
