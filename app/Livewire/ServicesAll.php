<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Service;
use App\Models\Category;

class ServicesAll extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = [];
    public $availabilityFilter = 1;
    public $homeServiceFilter;

    protected $queryString = ['search', 'categoryFilter', 'availabilityFilter'];

    public function resetFilters()
{
    $this->search = '';
    $this->categoryFilter = [];
   // $this->availabilityFilter = null;
}


    public function render()
    {
        $services = Service::query()
            ->when($this->search, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%')
                             ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryFilter, function ($query) {
                return $query->whereIn('category_id', $this->categoryFilter);
            })
            ->when($this->availabilityFilter !== null, function ($query) {
                return $query->where('availability', $this->availabilityFilter);
            })
            ->when($this->homeServiceFilter !== null, function ($query) {
                return $query->where('home_service', $this->homeServiceFilter);
            })
            ->paginate(12);

        $categories = Category::all();  // Obtener todas las categorías para los filtros

        return view('livewire.services-all', [
            'services' => $services,
            'categories' => $categories,
        ]);
    }


    public function applyFilters()
    {
        // Llamamos a render para que Livewire recargue los datos con los filtros aplicados
        $this->render();
    }
}