document.addEventListener("DOMContentLoaded", () => {
    console.log("Hello World!");
});

$(document).ready(function(){

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

            url:"controller/projectController.php",

            method:"POST",

            data:{createFacture:json},

            success:function(data)

            {

                $('#form').fadeOut();

                $('#datasenttocontroller').html(data);

            }

        });

    });

});
