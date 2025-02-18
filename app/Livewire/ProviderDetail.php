<?php

namespace App\Livewire;

use App\Models\Proveedor; // Cambiado de Doctor a Provider
use App\Models\ProviderLike; // Cambiado de DoctorLike a ProviderLike

use App\Models\Customer; // Supongo que "Customer" se refiere al paciente
use Livewire\Component;
use App\Models\Certificate;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProviderDetail extends Component
{
    public $providerId;
    public $provider;
    public $rating;
    public $review;
    public $reviews = [];
    public $reviewsPerPage = 5; // Cantidad inicial de reseñas a cargar
    public $reviewsOffset = 0; // Offset para la paginación
    public $liked = false;
    public $likesCount;
    public $isModalOpen = false;  // Variable para controlar el modal
    public $appointment_datetime; 
    public  $customerName;  // Variable para la fecha de la cita
    public $perPage = 5;

    public function mount($providerId)
    {
        $this->providerId = $providerId;
        $this->provider = Proveedor::with('user')->findOrFail($providerId);
        $this->likesCount = ProviderLike::where('provider_id', $this->providerId)->count();

        $this->loadReviews();

        // Verificar si el usuario autenticado ya dio "me gusta"
        $user = auth()->user();
        if ($user) {
            $this->liked = ProviderLike::where('user_id', $user->id)
                                     ->where('provider_id', $this->providerId)
                                     ->exists();
        }
    }

    public function checkIfLiked()
    {
        $user = auth()->user();
        $this->liked = ProviderLike::where('user_id', $user->id)
                                 ->where('provider_id', $this->providerId)
                                 ->exists();
    }

    public function likeProvider()
    {
        $user = auth()->user();

        // Verificar si el usuario tiene el rol 'customer'
        if ($user->role !== 'client') {
            session()->flash('error', 'Solo los clientes pueden dar "me gusta" a los proveedores.');
            return;
        }

        // Verificar si ya existe un "me gusta" de este cliente para este proveedor
        $existingLike = ProviderLike::where('user_id', $user->id)
                                    ->where('provider_id', $this->providerId)
                                    ->first();

        if ($existingLike) {
            // Si existe, eliminar el "me gusta"
            $existingLike->delete();
            $this->liked = false; // Actualizar estado local
            $this->likesCount--;  // Decrementar contador
        } else {
            // Si no existe, agregar un nuevo "me gusta"
            ProviderLike::create([
                'user_id' => $user->id,
                'provider_id' => $this->providerId,
            ]);
            $this->liked = true;  // Actualizar estado local
            $this->likesCount++;  // Incrementar contador
        }
    }

    public function loadReviews()
    {
        $this->reviews = $this->provider->ratings()
            ->with('user') // Relaciona el usuario que envió la reseña
            ->latest() // Ordena desde la más reciente
            ->offset($this->reviewsOffset) // Empieza desde el offset
            ->limit($this->reviewsPerPage) // Carga un máximo de 5 reseñas
            ->get()
            ->toArray();
    }

    public function loadMoreReviews()
    {
        $this->reviewsOffset += $this->reviewsPerPage;
        $additionalReviews = $this->provider->ratings()
            ->with('user')
            ->latest()
            ->offset($this->reviewsOffset)
            ->limit($this->reviewsPerPage)
            ->get()
            ->toArray();

        $this->reviews = array_merge($this->reviews, $additionalReviews); // Combina las reseñas existentes con las nuevas
    }

    public function submitRating()
    {
        // Verificar si el usuario es un cliente
        $user = auth()->user();
        if ($user->role !== 'client') { // Suponiendo que 'role' es un campo en el modelo User que determina el tipo de usuario
            session()->flash('error', 'Solo los clientes pueden calificar a los proveedores.');
            return;
        }

        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:255',
        ]);

        $this->provider->ratings()->create([
            'rating' => $this->rating,
            'review' => $this->review,
            'user_id' => auth()->id(),
        ]);

        $this->provider->update([
            'average_rating' => $this->provider->ratings()->avg('rating'),
            'reviews_count' => $this->provider->ratings()->count(),
        ]);

        session()->flash('message', 'Tu calificación ha sido registrada.');

        // Limpia los campos del formulario
        $this->reset(['rating', 'review']);

        // Recarga las reseñas
        $this->reviewsOffset = 0;
        $this->loadReviews();
    }

    // Método para abrir o cerrar el modal
    public function toggleModal()
    {
        $this->isModalOpen = !$this->isModalOpen;
    }

  

    public function loadMore()
    {
        $this->perPage += 5; // Incrementa las publicaciones mostradas
    }

    public function render()
    {
        // Asegúrate de que estás obteniendo el proveedor por su ID y luego las publicaciones
        $provider = Proveedor::with('awards')->find($this->providerId);

        $providers = Proveedor::where('specialty', $provider->specialty)
                             ->where('id', '!=', $provider->id) // Excluir el proveedor actual
                             ->take($this->perPage)
                             ->get();

        $certificates = Certificate::where('user_id', $provider->user->id)->get();
        $provider = \App\Models\Proveedor::find($this->providerId);
        $services = Service::where('proveedor_id', $this->providerId)->get();

        return view('livewire.provider-detail', [
           // 'posts' => $provider->user->posts()->take($this->perPage)->get(), // Obtener publicaciones a través de user
            'providers' => $providers, 
            'certificates' => $certificates,
            'awards' => $provider->awards,
            'services' => $services, 
        ]);
    }
}
