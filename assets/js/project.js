document.addEventListener("DOMContentLoaded", () => {
    console.log("Hello World!");
});

$(document).ready(function(){
    //$('#add_service').fadeOut();
    //$('#addService').fadeOut();
    $('#forcomporter').hide();
    $('.amountremisesub').fadeOut();
    $('#displayFacture').fadeOut();

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

        let checkRemise = (this).value;

        if (checkRemise != 0 || checkRemise != "0"){

            $('.amountremisesub').fadeIn();

            let PercentRemise = checkRemise.split('-');

            //let total = $('#total').val();
            let total = $('#prix').val() * parseInt($('#quantity').val());

            //Amount to Substract to Total
            //let AmountRemise = (PercentRemise[1] * total) / 100;

            let AmountRemise = (PercentRemise[1] * total) / 100 ;

            //Amount to Substract to Total displayed in p
            $("#sub").html(AmountRemise);

            //Update Total
            $('#total').val( total - AmountRemise);

        } else if ( checkRemise === "0" ){
            $('.amountremisesub').fadeOut();
            let total = $('#prix').val() * parseInt($('#quantity').val());

            //Update Total
            $('#total').val( total);

        }


    });

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

            $('#total').val($('#prix').val() * newOne);
        }

    });


    $("#ajouter").on('click', function (e){

        e.preventDefault();

        let form = document.querySelector("#addService");

        let formData = new FormData(form);
        let obj = {};

        formData.forEach((value, key) => obj[key] = value);

        let jsonD = JSON.stringify(obj);

        $.ajax({

            url:"projectController.php",

            method:"POST",

            data:{addDesignation:jsonD},

            success:function(data)

            {

                //$('#forfacture').fadeOut();
                //$('#create_facture').fadeOut();
                //$('#form').fadeOut();

                //$('#add_service').fadeIn();
                //$('#addService').fadeIn();
                //$('#idFacture').val(data);


                //disponible pour un eventual echo depiuis le controller

                $('#retourderequest').html(data);


            }

        });

    });

    $('#save').on('click', function (e) {

        e.preventDefault();

        let idFacture = $('#saveValue').val();

        $.ajax({

            url:"projectController.php",

            method:"POST",

            data:{savedFacture:idFacture},

            success:function(data)
            {
                $('#forfacture').fadeOut();

                $('#forcomporter').fadeOut();


                $('#displayFacture').fadeIn();

                //Must sent ID Facture to get all Data for One Facture
                $('.theFacture').html(data);
            }



        });






    })


});
