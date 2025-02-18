<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Rol</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="flex justify-center items-center min-h-screen">
        <div class="max-w-md w-full bg-white shadow-xl rounded-lg p-8 mt-10 transform transition-all duration-300 hover:scale-105">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Seleccionar Rol</h2>
            <p class="text-sm text-gray-600 mb-6 text-center">
                ¿Eres un Proveedor  o un cliente en busca de un servicio? Por favor, selecciona tu rol para continuar.
            </p>
            
            <form action="{{ route('set-role', $user->id) }}" method="POST" class="space-y-6">
                @csrf

                <div class="flex flex-col space-y-4">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="role" value="proveedor" class="accent-blue-500 rounded-full focus:ring-2 focus:ring-blue-500" required>
                        <span class="text-gray-700 font-medium">Proveedor</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="role" value="client" class="accent-blue-500 rounded-full focus:ring-2 focus:ring-blue-500">
                        <span class="text-gray-700 font-medium">cliente</span>
                    </label>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Continuar
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
