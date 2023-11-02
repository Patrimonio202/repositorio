<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-carrousel />
    </div>

   

    <div class="container my-6 px-6 mx-auto">
        <section>
            <h1 class=" text-center text-lg uppercase font-semibold text-gray-700 ">               
                Multimedia destacada
            </h1>

                {{-- @livewire('destacada-posts', ['posts' => $posts])    --}}
                <livewire:destacada-posts :lazy=false />            

        </section>
    </div>
        <!--Multimedia publicada -->
        <div class="container my-4 px-6 mx-auto " >
            <section>
                <h1 class=" text-center text-lg uppercase font-semibold text-gray-700 ">              
                    Ultima información multimedia
                </h1>
               
                    @livewire('multimedia-publicada') 
             
    
            </section>
        </div>    
         <!--Hasta aqui -->


    <!--flowbite -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script> --}}
    <script src="/vendor/flowbite/js/cdnjs.cloudflare.com_ajax_libs_flowbite_1.8.1_flowbite.min.js"></script>
    <!--hasta aqui -->
    <script>
        // const changeState= () =>{
       function changeState(idpost){
           const split = idpost.split('-') 
           const fas=document.getElementById(idpost);
           //me gusta
           if(split[0]=='fas' || split[0]=='fastc'){                
               fas.classList.toggle('fa-regular');
               fas.classList.toggle('fa-thumbs-up');
               fas.classList.toggle('fa-lg');

               fas.classList.toggle('fa-solid');
               fas.classList.toggle('fa-thumbs-up');
               fas.classList.toggle('fa-lg');  
           }
          // document.getElementById("fas").classList.add("fa-solid", "fa-thumbs-up", "fa-lg");
            //me encanta
            if(split[0]=='encantaj' || split[0]=='encantajtc'){               
               fas.classList.toggle('fa-regular');
               fas.classList.toggle('fa-heart');
               fas.classList.toggle('fa-lg');

               fas.classList.toggle('fa-solid');
               fas.classList.toggle('fa-heart');
               fas.classList.toggle('fa-lg');  
           }

           //compartir
           if(split[0]=='compartirj' || split[0]=='compartirjtc'){
                alert('Modulo en proceso de construccion');
           }
           
         }
       
   </script>

@push('js')
   
<script>
   
    // Livewire.on('glider', ()=> { 
      //  document.addEventListener('DOMContentLoaded', () => {           
            new Glider(document.querySelector('.glider'), {
             slidesToShow: 1,
             slidesToScroll: 1,
             draggable: true,
             dots: '.dots',
             arrows: {
                 prev: '.glider-prev',
                 next: '.glider-next'
             }, 
             responsive: [
                 {
                     breakpoint:640,
                     settings:{
                         slidesToShow: 2.5,
                         slidesToScroll: 2,
                     }
                 },
                 {
                     breakpoint:768,
                     settings:{
                         slidesToShow: 3.5,
                         slidesToScroll: 3,
                     }
                 },
                 {
                     breakpoint:1024,
                     settings:{
                         slidesToShow: 3.5,
                         slidesToScroll: 3,
                     }
                 },
                 {
                     breakpoint:1280,
                     settings:{
                         slidesToShow: 3.5,
                         slidesToScroll: 3,
                     }
                 },
             ]
         });
      
  // });

 </script>
@endpush

</x-app-layout>
