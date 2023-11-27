document.addEventListener("DOMContentLoaded", () => {
    console.log("Hello World!");
});

$(document).ready(function(){
    //$('#add_service').fadeOut();
    //$('#addService').fadeOut();
    $('#forcomporter').hide();

    $('#user').keyup(function(){

        var query = $(this).val();

        if(query != '')

        {

            $.ajax({

                url:"search.php",

                method:"POST",

                data:{query:query},

                success:function(data)

                {

                    $('#userList').fadeIn();

                    $('#userList').html(data);

                }

            });

        }

    });

    $(document).on('click', 'li', function(){

        $('#user').val($(this).text());

        $('#userList').fadeOut();

    });


    $("#createFacture").on('click', function (){
        let formData = new FormData(document.querySelector("#form"));
        var object = {};
        formData.forEach((value, key) => object[key] = value);
        var json = JSON.stringify(object);

        $.ajax({

            url:"projectController.php",

            method:"POST",

            data:{createFacture:json},

            success:function(data)

            {
                $('#forfacture').hide();
                //$('#create_facture').fadeOut();
                //$('#form').fadeOut();

                //$('#datasenttocontroller').html(data);
                //$('#add_service').fadeIn();
                //$('#addService').fadeIn();
                $('#forcomporter').show();
                $('#idFacture').val(data);

            }

        });

    });

    $('#idService').on('change', function (){
        let value = $('#idService').val();
        $.ajax({
            url:"projectController.php",

            method: "POST",

            data:{idService:value},

            success:function (data) {

                $('#prix').val(data);
                $('#quantity').val(1);

                $('#total').val($('#prix').val() * $('#quantity').val());

            }
        })

    });

    $("#remise").on('change', function (){
        let remise = (this).value.split('-');
        let prixOne = $('#prix').val();
        if (remise[1] != undefined && prixOne != "" ){
            let oneremise = (remise[1] * prixOne) / 100;
            $("#sub").html(oneremise);
        }
    })

    $('.quantity-right-plus').click(function(e){

        // Stop acting like a button
        e.preventDefault();

        let quantity = parseInt($('#quantity').val());
        let newOne = quantity + 1;

        // If is not undefined
        $('#quantity').val( newOne );


        $('#total').val( $('#prix').val() * newOne );

        // Increment

    });

    $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

        // Increment
        if(quantity>1){
            var newOne = quantity - 1 ;
            $('#quantity').val(newOne);
            $('#total').val($('#prix').val() * quantity);
        }

    });


    $('#ajouter').on('click', function (){
        let formData = new FormData(document.querySelector("#addService"));
        var object = {};
        formData.forEach((value, key) => object[key] = value);
        var json = JSON.stringify(object);

        $.ajax({

            url:"projectController.php",

            method:"POST",

            data:{addDesignation:json},

            success:function(data)

            {
                $('#create_facture').fadeOut();
                $('#form').fadeOut();

                //$('#datasenttocontroller').html(data);
                $('#add_service').fadeIn();
                $('#addService').fadeIn();
                $('#idFacture').val(data);

            }

        });
    })


});
