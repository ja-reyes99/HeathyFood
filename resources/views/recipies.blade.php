@extends('test')

@section('content')
<div class="container">
<h1 class="text-center">Healthy food</h1>
<button type="button" class="btn btn-primary" id="createRecipiesButton" data-toggle="modal" data-target="#createRecipe">
    Crear Receta
</button>
<input type="hidden" id="path"value={{public_path()}}></input>


    <div class="container mt-3">

        <div class="row" id="list"></div>

    </div>


<div class="modal fade" id="createRecipe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear receta</h5>
        <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form >
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control mt-2" id="name" placeholder="Nombre">
                    </div>
            
                </div>
                <div class="row">

                    <div class="col">
                            <textarea class="form-control mt-2" id="description" rows="3" placeholder="Descripción"></textarea>
                    </div>
                </div>
                <div class="row">

                    <div class="col">
                            <textarea class="form-control mt-2" id="preparation" rows="3" placeholder="Preparación"></textarea>
                    </div>
                </div>

                <div class="row">

                    <div class="col">
                            <input type="file" accept="image/*" class="form-control mt-2" id="image">
                    </div>
                </div>

                <div id="errMessage" class="ml-2">


                </div>
            </div>

            

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save">Crear Receta</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </form>
    </div>
  </div>
</div>

</div>



<div class="modal fade" id="deleteRecipie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar receta</h5>
        <button type="button" id="closeDeleteRecipie"class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idDelete">
        ¿Seguro que desea eliminar esta receta?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="deleteConfirm" class="btn btn-primary">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="updateRecipie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar recetas</h5>
        <button type="button" class="closeUpdate" id="cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form >
            <div class="modal-body">
                <input type="hidden" id="idUpdate">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control mt-2" id="editName" placeholder="Nombre">
                    </div>

                </div>
                <div class="row">

                    <div class="col">
                            <textarea class="form-control mt-2" id="editDescription" rows="3" placeholder="Descripción"></textarea>
                    </div>
                </div>
                <div class="row">

                    <div class="col">
                            <textarea class="form-control mt-2" id="editPreparation" rows="3" placeholder="Preparación"></textarea>
                    </div>
                </div>

                

                <div id="errMessageUpdate" class="ml-2">


                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateSave">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </form>
    </div>
  </div>
</div>

<div class="modal fade" id="viewRecipie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="recipìesTitle"></h5>
        <button type="button" class="closeUpdate" id="cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
        <div class="modal-body">

            <h4>Descripción</h4>
            <div id="descriptionContent"></div>
            <h4>Preparación</h4>
            <div id="preparationContent"></div>
        </div>      

        
    </div>
  </div>
</div>

@endsection
