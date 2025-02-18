<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
     
  
     
    </head>
    <body>
        
        <div class="py-24  bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
            
            <div class="w-full mx-auto sm:px-6 lg:px-8 ">
                <div class="flex justify-center">
                    <div class="relative flex flex-col min-w-0 break-words border-stone-200 bg-light/30 max-w-4xl w-full">
                        <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                            <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl/tight text-dark">
                                <span class="mr-3 font-semibold text-dark mb-3">
                                  
                                
                                   
                                   
                                </span>
                            </h3>
                        </div>
                        
        
                        <div class="flex-auto block py-8 pt-6 px-9">
                            <livewire:provider-detail :provider-id="$proveedor->id" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


  

  


        <script>
            function toggleBio() {
                const bioText = document.getElementById('bio-text');
                const button = event.target;
                if (bioText.classList.contains('line-clamp-3')) {
                    bioText.classList.remove('line-clamp-3');
                    button.innerText = 'Ver menos';
                } else {
                    bioText.classList.add('line-clamp-3');
                    button.innerText = 'Ver más';
                }
            }
        </script>
        
        
        <script>
            // Función para expandir o colapsar las reseñas
            function toggleReview(reviewId) {
                const reviewText = document.getElementById(`review-${reviewId}`);
                const button = event.target;
        
                // Comprobar si el texto está colapsado o no
                if (reviewText.classList.contains('line-clamp-3')) {
                    reviewText.classList.remove('line-clamp-3');
                    button.innerText = 'Ver menos';
                } else {
                    reviewText.classList.add('line-clamp-3');
                    button.innerText = 'Ver más';
                }
            }
        </script>


    </body>
    </html>
  
   



</x-app-layout>

