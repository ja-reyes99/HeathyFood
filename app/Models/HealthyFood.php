<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class HealthyFood 
{
    private $id;
    private $nombre;
    private $foto;
    private $descripcion;
    private $preparacion;


    function __construct(){}
    
    public function get_id(){
        return $this->id;
     }

    public function set_id($id){
        $this->id = $id;
    } 

    public function get_nombre(){
        return $this->nombre;
     }

    public function set_nombre($nombre){
        $this->nombre = $nombre;
    }

    
    public function get_foto(){
        return $this->foto;
     }

    public function set_foto($foto){
        $this->foto = $foto;
    }

    public function get_descripcion(){
        return $this->descripcion;
     }

    public function set_descripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    
    public function get_preparacion(){
        return $this->preparacion;
     }

    public function set_preparacion($preparacion){
        $this->preparacion = $preparacion;
    }

    public function create(){
        DB::table("healthy_food")->insert([
            "nombre"=>$this->nombre,
            "descripcion"=>$this->descripcion,
            "foto"=>$this->foto,
            "preparacion"=>$this->preparacion
        ]);

    }
    public function getRecipe(){
       return DB::table("healthy_food")->where("id",$this->id)->first();
    }
    public function getAllRecipies(){
        return DB::table("healthy_food")->get();
    }

    public function updateRecipies(){
        DB::table("healthy_food")->where("id",$this->id)
        ->update([
            "nombre"=>$this->nombre,
            "descripcion"=>$this->descripcion,
            "preparacion"=>$this->preparacion
        ]);
    }
    public function deleteRecipies(){
        DB::table("healthy_food")->where("id",$this->id)->delete();
    }
}
