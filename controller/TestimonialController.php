<?php

require_once(__DIR__ . './Controller.php');
require_once(__DIR__ . './../model/TestimonialModel.php');

class TestimonialController extends Controller
{

    public function __construct()
    {
        
    }
    /**
     * return the current user class
     *
     * @param  mixed $data
     * @return void
     */
    public function index()
    {
        $user = TestimonialModel::all();

        return $user;
    }

    /**
     * edit testimonial details
     *
     * @param  mixed $id
     * @return void
     */
    public function store($data)
    {
        $this->notPublic(alert("FITSESSID"));
        $this->notMember(alert("FITSESSID"));
        
        
    }

    /**
     * edit testimonial details
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $this->notPublic(alert("FITSESSID"));
        $this->notMember(alert("FITSESSID"));
        $class = ClassModel::find($id);

        if ($class === []) {
            header("Location: _404.php");
            exit();
        }

        return $class;
    }


        /**
     * edit testimonial details
     *
     * @param  mixed $id
     * @return void
     */
    public function update($data)
    {
        $this->notPublic(alert("FITSESSID"));
        $this->notMember(alert("FITSESSID"));
        
        foreach ($data as $key => $value) {
            if (!isset($data[$key]) || empty($data[$key])) {
                return ucfirst($key) . " is required";
            }
        }

        $data['user_id'] = alert("FITSESSID")["id"];
        $data['password'] = password_hash(filterInputs($data['password'], "string"), PASSWORD_DEFAULT);


        $user = UserModel::where("email = '{$data["email"]}'");


        return "Unable to register";
    }
    
    /**
     * show testimonial Details
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $this->notPublic(alert("FITSESSID"));
        $class = ClassModel::find($id);

        if ($class === []) {
            header("Location: _404.php");
            exit();
        }

        return $class;
    }
}
