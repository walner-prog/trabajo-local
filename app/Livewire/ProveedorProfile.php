<?php

namespace App\Livewire;

use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class ProveedorProfile extends Component
{
    use WithPagination;

    public $specialty = '';
    public $city = '';
    public $search = '';
    public $perPage = 20;
    public $experienceYears = '';

    // Variables temporales para los filtros
    public $tempSpecialty = '';
    public $tempCity = '';
    public $tempSearch = '';
    public $tempExperienceYears = '';

    protected $paginationTheme = 'tailwind';

    protected $queryString = [
        'specialty' => ['except' => ''],
        'city' => ['except' => ''],
        'search' => ['except' => ''],
        'experienceYears' => ['except' => ''],
    ];

    public function updating($property)
    {
        if (in_array($property, ['specialty', 'city', 'search', 'experienceYears'])) {
            $this->resetPage();
        }
    }

    public function applyFilters()
    {
        $this->specialty = $this->tempSpecialty;
        $this->city = $this->tempCity;
        $this->search = $this->tempSearch;
        $this->experienceYears = $this->tempExperienceYears;
        $this->resetPage();
    }

    public function showProveedor($proveedorId)
    {
        return redirect()->route('proveedor.detalle', ['proveedor' => $proveedorId]);
    }

    public function render()
    {
        $proveedores = Proveedor::query()
            ->when($this->specialty, function ($query) {
                $query->where('specialty', 'like', "%{$this->specialty}%");
            })
            ->when($this->city, function ($query) {
                $query->where('city', 'like', "%{$this->city}%");
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('specialty', 'like', "%{$this->search}%")
                        ->orWhere('city', 'like', "%{$this->search}%")
                        ->orWhereHas('user', function ($q) {
                            $q->where('name', 'like', "%{$this->search}%");
                        });
                });
            })
            ->when($this->experienceYears, function ($query) {
                $query->where('experience_years', '>=', $this->experienceYears);
            })
            ->join('users', 'proveedores.user_id', '=', 'users.id')
            ->select('proveedores.*')
            ->orderBy('users.name')
            ->paginate($this->perPage);

        return view('livewire.proveedor-profile', ['proveedores' => $proveedores]);
    }
}
