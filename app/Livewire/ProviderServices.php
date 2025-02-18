<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use App\Models\Service;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProviderServices extends Component
{
    public $title;
    public $description;
    public $price;
    public $availability = true;
    public $home_service = false;
    public $category_id;
    public $showForm = false;
    public $proveedor;
    public $selectedService = null;

    public $showFormCategory = false;
    public $category_description;
    public $category_name;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'price' => 'required|numeric|min:0',
        'availability' => 'boolean',
        'home_service' => 'boolean',
        'category_id' => 'required|exists:categories,id',
    ];


    public function saveCategory()
    {
        // Validación de los campos
        $this->validate([
            'category_name' => 'required|string|max:255|unique:categories,name',
            'category_description' => 'nullable|string|max:500',
        ]);
    
        try {
            // Crear la nueva categoría
            Category::create([
                'name' => $this->category_name,
                'description' => $this->category_description,
                'slug' => Str::slug($this->category_name),
            ]);
    
            // Limpiar los campos y cerrar el formulario
            $this->category_name = '';
            $this->category_description = '';
            $this->showFormCategory = false;
    
            // Mensaje de éxito
            session()->flash('message', 'Categoría guardada exitosamente.');
    
        } catch (\Illuminate\Database\QueryException $e) {
            // Verificar si es un error de duplicado
            if ($e->getCode() == 23000) {
                session()->flash('error', 'La categoría ya existe. Por favor, elige otro nombre.');
            } else {
                session()->flash('error', 'Hubo un error al guardar la categoría. Intenta nuevamente.');
            }
        }
    }
    

    public function toggle()
    {
        $this->showFormCategory = !$this->showFormCategory;
    }

    public function mount()
    {
        $this->proveedor = Proveedor::where('user_id', Auth::id())->first();
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function saveService()
    {
        // Validación de los campos
        $this->validate([
            'title' => 'required|string|max:255|unique:services,title',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric',
            'availability' => 'required|boolean',
            'home_service' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        try {
            if ($this->selectedService) {
                // Actualizar el servicio existente
                $service = Service::find($this->selectedService);
                if ($service) {
                    $service->update([
                        'title' => $this->title,
                        'description' => $this->description,
                        'price' => $this->price,
                        'availability' => $this->availability,
                        'home_service' => $this->home_service,
                        'category_id' => $this->category_id,
                        'slug' => Str::slug($this->title),
                    ]);
    
                    session()->flash('message', 'Servicio actualizado exitosamente.');
                }
            } else {
                // Crear un nuevo servicio
                if ($this->proveedor) {
                    Service::create([
                        'proveedor_id' => $this->proveedor->id,
                        'title' => $this->title,
                        'description' => $this->description,
                        'price' => $this->price,
                        'availability' => $this->availability,
                        'home_service' => $this->home_service,
                        'category_id' => $this->category_id,
                        'slug' => Str::slug($this->title),
                    ]);
    
                    session()->flash('message', 'Servicio guardado exitosamente.');
                } else {
                    session()->flash('error', 'No se encontró un proveedor asociado.');
                }
            }
    
            $this->resetForm();
            $this->toggleForm();
    
        } catch (\Illuminate\Database\QueryException $e) {
            // Verificar si es un error de duplicado
            if ($e->getCode() == 23000) {
                session()->flash('error', 'El servicio ya existe. Por favor, elige otro título.');
            } else {
                session()->flash('error', 'Hubo un error al guardar el servicio. Intenta nuevamente.');
            }
        }
    }
    

    public function deleteService($id)
    {
        $service = Service::find($id);
        if ($service) {
            $service->delete();
            session()->flash('message', 'Servicio eliminado exitosamente.');
        }
    }

    public function editService($id)
    {
        $service = Service::find($id);
        if ($service) {
            $this->selectedService = $id;
            $this->title = $service->title;
            $this->description = $service->description;
            $this->price = $service->price;
            $this->availability = $service->availability;
            $this->home_service = $service->home_service;
            $this->category_id = $service->category_id;
            $this->showForm = true;
        }
    }

    public function resetForm()
    {
        $this->reset(['title', 'description', 'price', 'availability', 'home_service', 'category_id', 'selectedService']);
    }

    public function render()
    {
        $categories = Category::all();
        $proveedor = $this->proveedor;
        $services = $proveedor ? Service::where('proveedor_id', $proveedor->id)->get() : collect();
        return view('livewire.provider-services', compact('proveedor', 'services','categories'));
    }
}
