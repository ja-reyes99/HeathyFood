<?php

namespace App\Http\Controllers;

use App\Models\HealthyFood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Facades\File;
class HealthyFoodController extends Controller
{


    public function createRecipe(Request $request){

        $validated= Validator::make($request->all(),[
            "nombre"=>"required",
            "foto"=>"required|file",
            "descripcion"=>"required",
            "preparacion"=>"required"
        ],[
            "nombre.required"=>"El nombre es obligatorio",
            "foto.required"=>"La foto es requerida",
            "foto.file"=>"La foto debe de ser un fichero",
            "descripcion.required"=>"La descripcion es requerida",
            "preparacion.required"=>"La preparacion es requerida",
        ]);

        
        
        // Storage::disk('local')->put( $request->file('foto'), 'fotos');
         
        if($validated->fails()){
            return response()->json($validated->errors(),422);
        }

        $file = $request->file('foto')->store("fotos");
        // $file = $request->file('foto');
        // $name = $file->getClientOriginalName();
        // File::makeDirectory(storage_path('fotos/' . $name));

        // Image::make($file)->save($ruta);
        $request->file('foto')->move(public_path("/fotos"),$request->file('foto')->getClientOriginalName());
        $newRecipe=new HealthyFood();
        $newRecipe->set_nombre($request->nombre);
        $newRecipe->set_foto( $request->file('foto')->getClientOriginalName());
        $newRecipe->set_descripcion($request->descripcion);
        $newRecipe->set_preparacion($request->preparacion);
        $newRecipe->create();
        return response()->json("Recipe created successfully");
    }

    public function getRecipie($id){  
        $recipe=new HealthyFood();
        $recipe->set_id($id);
        
        return response()->json($recipe->getRecipe());
    }

    public function getAllRecipies(Request $request){
        $recipe=new HealthyFood();
        return response()->json($recipe->getAllRecipies());

    }
    public function updateRecipie(Request $request){
        $validated= Validator::make($request->all(),[
            "id"=>"required",
            "nombre"=>"required",
            "descripcion"=>"required",
            "preparacion"=>"required"
        ],[
            "id.required"=>"Falta el id de la receta",
            "nombre.required"=>"El nombre es obligatorio",
            "descripcion.required"=>"La descripcion es requerida",
            "preparacion.required"=>"La preparacion es requerida",
        ]);
        
        if($validated->fails()){
            return response()->json($validated->errors(),422);
        }
        $updateRecipie=new HealthyFood();
        $updateRecipie->set_id($request->id);
        $updateRecipie->set_nombre($request->nombre);
        $updateRecipie->set_descripcion($request->descripcion);
        $updateRecipie->set_preparacion($request->preparacion);

        $updateRecipie->updateRecipies();
        return response()->json("Recipe updated successfully");
                
    }

    public function deleteRecipie(Request $request){
        $deleteRecipie=new HealthyFood();
        $deleteRecipie->set_id($request->id);
        $deleteRecipie->deleteRecipies();
        return response()->json("Recipe delete successfully");
    }

    public function showView(){
        return view("recipies");
    }
}
