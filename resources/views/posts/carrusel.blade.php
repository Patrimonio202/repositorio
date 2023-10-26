<x-app-layout>
    <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

        <!-- Article -->
        <article class="overflow-hidden rounded-lg shadow-lg">

            <a href="#">
                <img alt="Placeholder" class="block h-auto w-full" src="https://picsum.photos/600/400/?random">
            </a>

            <header>
                <div class="flex items-center justify-between leading-tight p-2 md:p-1">
                    <h1 class="text-lg px-2">
                        <a class="font-bold text-xl no-underline hover:underline text-black" href="#">
                            Article Title
                        </a>
                    </h1>
                    <p class="text-grey-darker text-sm px-4">
                        14/4/19
                    </p>
                </div>
                {{-- <div class="flex items-center justify-between leading-tight p-2 md:p-4">
                    <p class="text-gray-700 text-base">
                        Tipo de archivo Imagen
                    </p>
                </div> --}}
            </header>

            <footer class="flex items-center justify-between leading-none px-2">
                {{-- <a class="flex items-center no-underline hover:underline text-black" href="#">
                    <img alt="Placeholder" class="block rounded-full" src="https://picsum.photos/32/32/?random">
                    <p class="ml-2 text-sm">
                        Author Name
                    </p>
                </a> --}}
                <div>
                    <span
                        class="inline-block bg-green-600 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Video</span>

                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>

                </div>
                <div class="flex items-center justify-between leading-tight md:p-4">
                    <a class="text-grey-darker hover:text-red-dark " href="#"> 
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M352 224c53 0 96-43 96-96s-43-96-96-96s-96 43-96 96c0 4 .2 8 .7 11.9l-94.1 47C145.4 170.2 121.9 160 96 160c-53 0-96 43-96 96s43 96 96 96c25.9 0 49.4-10.2 66.6-26.9l94.1 47c-.5 3.9-.7 7.8-.7 11.9c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-25.9 0-49.4 10.2-66.6 26.9l-94.1-47c.5-3.9 .7-7.8 .7-11.9s-.2-8-.7-11.9l94.1-47C302.6 213.8 326.1 224 352 224z"/></svg>
                    </a>
                    <a class="no-underline text-grey-darker hover:text-red-dark px-1" href="#">
                        {{-- <span class="">Like</span> --}}
                        {{-- <i class="fas fa-heart"></i> --}}

                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/></svg>

                    </a>

                    <a class="text-grey-darker hover:text-red-dark " href="#"> 
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.1s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z"/></svg>
                    </a>
                </div>


            </footer>

        </article>
        <!-- END Article -->

    </div>
    <!-- END Column -->
    <div class="max-w-sm rounded overflow-hidden shadow-lg">
        <img class="w-full" src="https://picsum.photos/600/400/?random" alt="Sunset in the mountains">
        <div class="px-6 py-1">
            {{-- <div class="font-bold text-xl mb-2">The Coldest Sunset</div> --}}
            <a href="#" class="font-bold text-xl mb-2">The Coldest Sunset</a>
            <p class="float-right">14-03-2022</p>


            {{-- <p class="text-gray-700 text-base">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
              </p> --}}
            <p class="text-gray-700 text-base">
                Tipo de archivo Imagen
            </p>
        </div>
        <div class="px-6 pt-4 pb-2">
            <span
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
            <span
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
            <span
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
        </div>
    </div>


    <x-embed url="https://www.youtube.com/watch?v=zLX_GcXt2pI&list=RDzLX_GcXt2pI&start_radio=1&ab_channel=ManuelMedrano" aspect-ratio="4:3" />


    <!-- Container for demo purpose -->
<div class="container my-24 px-6 mx-auto">

    <!-- Section: Design Block -->
    <section class="mb-32 text-gray-800 text-center">
  
      <h2 class="text-3xl font-bold mb-12 pb-4 text-center">Latest articles</h2>
  
      <div class="grid lg:grid-cols-3 gap-6 xl:gap-x-12">
        <div class="mb-6 lg:mb-0">
          <div class="relative block bg-white rounded-lg shadow-lg">
            <div class="flex">
              <div
                class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg mx-4 -mt-4"
                data-mdb-ripple="true" data-mdb-ripple-color="light">
                <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/024.webp" class="w-full" />
                <a href="#!">
                  <div
                    class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed opacity-0 hover:opacity-100 transition duration-300 ease-in-out"
                    style="background-color: rgba(251, 251, 251, 0.15)"></div>
                </a>
              </div>
            </div>
            <div class="p-6">
              <h5 class="font-bold text-lg mb-3">My paradise</h5>
              <p class="text-gray-500 mb-4">
                <small>Published <u>13.01.2022</u> by
                  <a href="" class="text-gray-900">Anna Maria Doe</a></small>
              </p>
              <p class="mb-4 pb-2">
                Ut pretium ultricies dignissim. Sed sit amet mi eget urna
                placerat vulputate. Ut vulputate est non quam dignissim
                elementum. Donec a ullamcorper diam.
              </p>
              <a href="#!" data-mdb-ripple="true" data-mdb-ripple-color="light"
                class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Read
                more</a>
            </div>
          </div>
        </div>
  
        <div class="mb-6 lg:mb-0">
          <div class="relative block bg-white rounded-lg shadow-lg">
            <div class="flex">
              <div
                class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg mx-4 -mt-4"
                data-mdb-ripple="true" data-mdb-ripple-color="light">
                <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/031.webp" class="w-full" />
                <a href="#!">
                  <div
                    class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed opacity-0 hover:opacity-100 transition duration-300 ease-in-out"
                    style="background-color: rgba(251, 251, 251, 0.15)"></div>
                </a>
              </div>
            </div>
            <div class="p-6">
              <h5 class="font-bold text-lg mb-3">Travel to Italy</h5>
              <p class="text-gray-500 mb-4">
                <small>Published <u>12.01.2022</u> by
                  <a href="" class="text-gray-900">Halley Frank</a></small>
              </p>
              <p class="mb-4 pb-2">
                Suspendisse in volutpat massa. Nulla facilisi. Sed aliquet
                diam orci, nec ornare metus semper sed. Integer volutpat
                ornare erat sit amet rutrum.
              </p>
              <a href="#!" data-mdb-ripple="true" data-mdb-ripple-color="light"
                class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Read
                more</a>
            </div>
          </div>
        </div>
  
        <div class="mb-0">
          <div class="relative block bg-white rounded-lg shadow-lg">
            <div class="flex">
              <div
                class="relative overflow-hidden bg-no-repeat bg-cover relative overflow-hidden bg-no-repeat bg-cover shadow-lg rounded-lg mx-4 -mt-4"
                data-mdb-ripple="true" data-mdb-ripple-color="light">
                <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/081.webp" class="w-full" />
                <a href="#!">
                  <div
                    class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed opacity-0 hover:opacity-100 transition duration-300 ease-in-out"
                    style="background-color: rgba(251, 251, 251, 0.15)"></div>
                </a>
              </div>
            </div>
            <div class="p-6">
              <h5 class="font-bold text-lg mb-3">Chasing the sun</h5>
              <p class="text-gray-500 mb-4">
                <small>Published <u>10.01.2022</u> by
                  <a href="" class="text-gray-900">Joe Svan</a></small>
              </p>
              <p class="mb-4 pb-2">
                Curabitur tristique, mi a mollis sagittis, metus felis mattis
                arcu, non vehicula nisl dui quis diam. Mauris ut risus eget
                massa volutpat feugiat. Donec.
              </p>
              <a href="#!" data-mdb-ripple="true" data-mdb-ripple-color="light"
                class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Read
                more</a>
            </div>
          </div>
        </div>
      </div>
  
    </section>
    <!-- Section: Design Block -->
  
  </div>
  <!-- Container for demo purpose -->

  <section class="w-full">
    <div class="flex justify-center">
        <div class="max-w-6xl text-center">
            <h2 class="py-4 text-3xl border-solid border-gray-300 border-b-2">Lasts posts</h2>
            <div class="flex flex-wrap justify-between">
             
                <article style="width:300px" class="text-left p-2">
                    <h3 class="py-4 text-xl">leo titulo</h3>
                    <p>leo body <a class="font-bold text-blue-600 no-underline hover:underline" href="#">Read more</a></p>
                </article>
               
            </div>
        </div>
    </div>
</section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</x-app-layout>
