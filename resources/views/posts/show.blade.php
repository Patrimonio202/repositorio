<x-app-layout>

   @livewire('showlw', compact('post', 'similares'))  


    @push('js')
        <script src="{{ asset('vendor/wheelzoom/wheelzoom.js') }}"></script>
        <script>
            wheelzoom(document.querySelector('img.zoom'));

            function full_view(ele) {
                //     // alert('leo el mejor');            
                let src = ele.parentElement.querySelector(".img-source").getAttribute("src");

                document.querySelector("#img-viewer").querySelector("img").setAttribute("src", src);
                document.querySelector("#img-viewer").style.display = "block";
            }

            function close_model() {
                document.querySelector("#img-viewer").style.display = "none";
            }
        </script>

       

    @endpush
</x-app-layout>
