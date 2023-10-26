<x-app-layout>
    <div class="container my-4 px-6 mx-auto ">
        <section>
            <h1 class="text-lg uppercase font-semibold text-gray-700 ">
                Ultima información multimedia
            </h1>

            @livewire('multimedia-publicada')


        </section>
    </div>


    {{-- <form action="{{ route('posts.meencanta') }}" method="post" id="ajax-form">
        @csrf
        <input type="text" name="id" value="1">
        <div class="mb-3 text-center">
            <button class="btn btn-success btn-submit">Submit</button>
        </div>
    </form> --}}

    <!--hasta aqui -->
    <script>
        // const changeState= () =>{
        function changeState(idpost) {
            const split = idpost.split('-')
            const fas = document.getElementById(idpost);
            //me gusta
            if (split[0] == 'fas' || split[0] == 'fastc') {
                fas.classList.toggle('fa-regular');
                fas.classList.toggle('fa-thumbs-up');
                fas.classList.toggle('fa-lg');

                fas.classList.toggle('fa-solid');
                fas.classList.toggle('fa-thumbs-up');
                fas.classList.toggle('fa-lg');
            }
            // document.getElementById("fas").classList.add("fa-solid", "fa-thumbs-up", "fa-lg");
            //me encanta
            if (split[0] == 'encantaj' || split[0] == 'encantajtc') {
                fas.classList.toggle('fa-regular');
                fas.classList.toggle('fa-heart');
                fas.classList.toggle('fa-lg');

                fas.classList.toggle('fa-solid');
                fas.classList.toggle('fa-heart');
                fas.classList.toggle('fa-lg');
                //botonmeinteresa();
            }

            //compartir
            if (split[0] == 'compartirj' || split[0] == 'compartirjtc') {
                alert('Modulo en proceso de construccion');
            }

        }


       function botonmeinteresa() {
            //alert('Precionaste click en el botono me interesa');
            // $.ajax({
            //     url: '/post/meencanta',
            //     method:'post',
            //     data:$("#form1").serialize()

            // }).done(function(res){
            //     alert(res);
            // });
       }

            // $('#ajax-form').submit(function(e) {
            //     e.preventDefault();  // previene la recarga de la pagina
            //     var url = $(this).attr("action");
            //     let formData = new FormData(this);
            //     $.ajax({
            //         type: 'POST',
            //         url: url,
            //         data: formData,
            //         contentType: false,
            //         processData: false,
            //         success: (response) => {
            //             alert('Form submitted successfully');
            //             location.reload();
            //         },
            //         error: function(response) {
            //             //$('#ajax-form').find(".print-error-msg").find("ul").html('');
            //             //$('#ajax-form').find(".print-error-msg").css('display', 'block');
            //             //$.each(response.responseJSON.errors, function(key, value) {
            //               //  $('#ajax-form').find(".print-error-msg").find("ul").append('<li>' +
            //                 //    value + '</li>');
            //             //});
            //         }
            //     });
            // });
        
    </script>



</x-app-layout>
