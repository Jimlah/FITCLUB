<?php

require_once(__DIR__ . './Controller.php');
require_once(__DIR__ . './../model/ClassModel.php');

class ClassController extends Controller
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
        $class = ClassModel::all();

        return $class;
    }

    /**
     * Store new class details
     *
     * @param  mixed $id
     * @return void
     */
    public function store($data)
    {
        $this->notPublic(alert("FITSESSID"));
        $this->notMember(alert("FITSESSID"));

        foreach ($data as $key => $value) {
            if (!isset($data[$key]) || empty($data[$key])) {
                return ucfirst($key) . " is required";
            }
        }

        foreach ($data as $key => $value) {
            $data[$key] = filterInputs($value, "string");
        }

        $class = ClassModel::where("name = '{$data["name"]}'");

        if ($class == []) {
            ClassModel::create([$data]);
            flash('msg', 'You have successfully created a new class');
            return true;
        }

        return false;
    }

    /**
     * Edit class details
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
     * Update class details
     *
     * @param  mixed $id
     * @return void
     */
    public function update($id, $data)
    {
        $this->notPublic(alert("FITSESSID"));
        $this->notMember(alert("FITSESSID"));
        
        foreach ($data as $key => $value) {
            if (!isset($data[$key]) || empty($data[$key])) {
                return ucfirst($key) . " is required";
            }
        }

        foreach ($data as $key => $value) {
            $data[$key] = filterInputs($value, "string");
        }

        ClassModel::update($id, $data);

        flash('msg', 'You have successfully updated your class');

        return true;
    }

    /**
     * Show Class Details
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
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
     * Delete Class 
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $this->notPublic(alert("FITSESSID"));
        $this->notMember(alert("FITSESSID"));
        ClassModel::delete($id);

        header("Location: /class.php");
        exit();
        return;
    }
}
