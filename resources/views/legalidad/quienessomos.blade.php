
<x-app-layout>
    <div class="py-24  mx-auto sm:px-6 lg:px-8 dark:bg-gray-900 dark:text-gray-700 overflow-hidden">
    
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap -mx-3 mb-10">
                    <!-- Sección: Quienes Somos -->
                    <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-lg bg-white m-5 max-w-7xl mx-auto sm:px-6 lg:px-8 dark:bg-gray-800 text-gray-800 dark:text-gray-100" data-aos="fade-up">
                        <div class="relative flex flex-col min-w-0 break-words border-stone-200 bg-light/30">
                            <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                                <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl font-semibold text-dark">
                                    <i class="fas fa-users text-2xl mr-2 text-indigo-500"></i> ¿Quiénes Somos?
                                </h3>
                            </div>
                            <div class="flex flex-wrap items-center py-8 pt-6 px-9">
                                <div class="w-full sm:w-1/2 pr-4 mb-4 sm:mb-0">
                                    <p class="text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                                        En <strong>Trabajo Local</strong>, somos una plataforma diseñada para conectar a profesionales y técnicos con clientes que buscan servicios de calidad en su área. Nuestro objetivo es facilitar el acceso a oportunidades laborales y ayudar a los trabajadores independientes a expandir su negocio a través de una plataforma confiable y accesible.
                                        <br><br>
                                        Aquí podrás encontrar expertos en diversas áreas como plomería, carpintería, electricidad, diseño gráfico, desarrollo web y mucho más. Con <strong>Trabajo Local</strong>, encontrar al profesional adecuado para tus necesidades nunca ha sido tan fácil.
                                    </p>
                                </div>
                               
                            </div>
                        </div>
                    </div>
        
                    <!-- Sección: Visión -->
                    <div class="relative flex-[1_auto] flex flex-col sm:flex-row items-center justify-between break-words min-w-0 bg-clip-border rounded-lg bg-white m-5 max-w-7xl mx-auto sm:px-6 lg:px-8 dark:bg-gray-800 text-gray-800 dark:text-gray-100" data-aos="fade-up" data-aos-delay="200">
                        <div class="relative flex flex-col min-w-0 break-words border-stone-200 bg-light/30 sm:w-1/2">
                            <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                                <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl font-semibold text-dark">
                                    <i class="fas fa-bullseye text-2xl mr-2 text-green-500"></i> Visión
                                </h3>
                            </div>
                            <div class="flex-auto block py-8 pt-6 px-9">
                                <p class="text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                                    Nuestra visión en <strong>Trabajo Local</strong> es ser la plataforma líder en conexión entre clientes y profesionales independientes, promoviendo el empleo y el crecimiento de negocios locales. Queremos ser el puente entre la demanda y la oferta de servicios en cada comunidad, impulsando el emprendimiento y la confianza en el talento local.
                                </p>
                            </div>

                            
                        </div>
                       
                    </div>
        
                    <!-- Sección: Misión -->
                    <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-lg bg-white m-5 max-w-7xl mx-auto sm:px-6 lg:px-8 dark:bg-gray-800 text-gray-800 dark:text-gray-100" data-aos="fade-up" data-aos-delay="400">
                        <div class="relative flex flex-col min-w-0 break-words border-stone-200 bg-light/30">
                            <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                                <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl font-semibold text-dark">
                                    <i class="fas fa-hand-holding-heart text-2xl mr-2 text-blue-500"></i> Misión
                                </h3>
                            </div>
                            <div class="flex flex-wrap items-center py-8 pt-6 px-9">
                                <p class="text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                                    Nuestra misión es conectar a profesionales y técnicos con clientes en busca de servicios de calidad, ofreciendo una plataforma accesible, segura y eficiente. Queremos impulsar el crecimiento del trabajo independiente y facilitar la contratación de expertos locales en diversas áreas.
                                </p>
                            </div>
                        </div>
                    </div>
        
                   
        
                </div>
            </div>
        
    </div>


    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
<script>
    // Inicializar AOS después de cargar la página
    AOS.init({
        duration: 500, // Duración de la animación en milisegundos
        once: true, // Ejecutar la animación solo una vez
    });

    // Función para cerrar la notificación
    function closeNotification() {
            document.getElementById('notification').style.display = 'none';
        }
</script>

</x-app-layout>
