$(document).ready(function(){
    console.log($("#path").val());
    getAllRecipies()
    $("#save").on("click",function(){
        createRecipe()
    })

    $("#createRecipiesButton").on("click",function(){
        $("#errMessage").empty()
    })

    
})


function getAllRecipies(){
    $(".delete").unbind("click")
    $("#deleteConfirm").unbind("click")
    $("#updateSave").unbind("click")
    $.ajax({
    url : 'api/getAllRecipies',
    type : 'get',
    success : function(data) {


        data.forEach(element => {
            $("#list").append("<div class='card mt-2 ml-2' style='width: 18rem;'>\
            <img class='card-img-top' src='"+element.foto+ "' alt='Card image cap'>\
            <div class='card-body'><h5 class='card-title'>"+element.nombre+"</h5>\
            <p class='card-text'>"+element.descripcion+"</p>\
            <a class='btn btn-primary ml-1 viewRecipie' data-toggle='modal' data-target='#viewRecipie' data-id="+element.id+">Ver</a>\
            <a class='btn btn-warning ml-1 update' data-toggle='modal' data-target='#updateRecipie' data-id="+element.id+">Editar</a>\
            <a class='btn btn-danger ml-1 delete'  data-toggle='modal' data-target='#deleteRecipie' data-id="+element.id+">Borrar</a></div></div>")
       });


       $(".delete").on("click",function(){//PASS ID IN MODAL
           $("#idDelete").val($(this).data("id"))
       })
       $("#deleteConfirm").on("click",function (){
            deleteRecipie()
       })

       $(".update").on("click",function(){
            $("#idUpdate").val($(this).data("id"))
            getRecipie()
            $("#errMessageUpdate").empty()
       })
       $("#updateSave").on("click",function(){
            updateRecipie()
       })
       
       $(".viewRecipie").on("click",function(){
            let id=$(this).data("id");
            viewRecipie(id);
       })
       
       
    },

    error : function(err) {
        console.log(err);
    },

    complete : function(xhr, status) {
        
    }
});
}


function createRecipe(){
    console.log($("#image")[0].files[0])
    var formData = new FormData();
    var files = $('#image')[0].files[0];
    formData.append('foto',files);
    formData.append("nombre",$("#name").val());
    formData.append("descripcion",$("#description").val());
    formData.append("preparacion",$("#preparation").val());
   
    $.ajax({
        url : 'api/createRecipe',
        type : 'post',
        data :formData,
        dataType : 'json',
        processData: false,
        contentType: false,
        success : function(data) {
            $("#createRecipe").modal({ show:false });
            $('#cerrar').click();
            $("#list").empty()
            getAllRecipies()

            //INPUTS EMPTY

            $("#name").val("");
            $("#description").val("");
            $("#preparation").val("");
            $('#image').val("")
        },

        error : function(err) {
            console.log(err);
            $.each(err.responseJSON,function(ini,ele){
                $("#errMessage").append("<p class='text-danger'>"+ele+"</p>")
            })

        },

        complete : function(xhr, status) {
            
        }
    });
}



function deleteRecipie(){
    $.ajax({
        url : 'api/deleteRecipie',
        type : 'delete',
        data :{
            id:$("#idDelete").val()
        },
        dataType : 'json',

        success : function(data) {
            $("#closeDeleteRecipie").click()
            $("#list").empty()
            getAllRecipies()
        },
        error : function(err) {
        
        },

        complete : function(xhr, status) {
            
        }
    });
}



function getRecipie(){
   let id= $("#idUpdate").val()
    $.ajax({
        url : 'api/getRecipie/'+id,
        type : 'get',
        dataType : 'json',

        success : function(data) {
            $("#editName").val(data.nombre)
            $("#editDescription").val(data.descripcion)
            $("#editPreparation").val(data.preparacion)
        },
        error : function(err) {
            
        },

        complete : function(xhr, status) {
            
        }
    });
}




function updateRecipie(){
    $.ajax({
        url : 'api/updateRecipie/',
        type : 'post',
        dataType : 'json',
        data:{
            "id": $("#idUpdate").val(),
            "nombre":$("#editName").val(),
            "descripcion":$("#editDescription").val(),
            "preparacion":$("#editPreparation").val()
        },
        success : function(data) {
            $("#list").empty()
            getAllRecipies()
            $("#idUpdate").val(""),
            $("#editName").val(""),
            $("#editDescription").val(""),
            $("#editPreparation").val("")
            $(".closeUpdate").click()
        },
        error : function(err) {
            $.each(err.responseJSON,function(ini,ele){
                $("#errMessageUpdate").append("<p class='text-danger'>"+ele+"</p>")
            })
        },
        complete : function(xhr, status) {
            
        }
    });
}

function viewRecipie(id){
    $("#recipìesTitle").text("")
    $("#descriptionContent").text("")
    $("#preparationContent").text("")
    // console.log(id);
    $.ajax({
        url : 'api/getRecipie/'+id,
        type : 'get',
        dataType : 'json',
        success : function(data) {
            console.log(data)
            $("#recipìesTitle").text(data.nombre)
            $("#descriptionContent").text(data.descripcion)
            $("#preparationContent").text(data.preparacion)
        },
        error : function(err) {

        },
        complete : function(xhr, status) {
            
        }
    });
}
