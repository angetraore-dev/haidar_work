document.addEventListener("DOMContentLoaded", () => {
    console.log("Hello World!");
});

$(document).ready(function(){
    $('#add_service').fadeOut();
    $('#addService').fadeOut();

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
                $('#create_facture').fadeOut();
                $('#form').fadeOut();

                //$('#datasenttocontroller').html(data);
                $('#add_service').fadeIn();
                $('#addService').fadeIn();
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

                let qte = parseInt($('#quantity').val());

                $('#total').val(prix * 1);

            }
        })

    });


    var quantitiy=1;
    $('#total').val(prix * 1);
    $('.quantity-right-plus').click(function(e){

        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

        $('#quantity').val(quantity + 1);


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
            $('#quantity').val(quantity - 1);
        }
    });

    $('#quantity').on('change', function (){
       let prix = parseInt($('#prix').val());
       let qte = parseInt($('#quantity').val());

       $('#total').val(prix * qte);
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
