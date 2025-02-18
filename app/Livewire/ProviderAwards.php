<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Award;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Auth;

class ProviderAwards extends Component
{
    public $award_name;
    public $awarding_institution;
    public $year;
    public $description;
    public $showForm = false;
    public $proveedor; 
    public $selectedAward = null; 
    
    protected $rules = [
        'award_name' => 'required|string|max:255',
        'awarding_institution' => 'required|string|max:255',
        'year' => 'required|integer|digits:4',
        'description' => 'nullable|string|max:1000',
    ];

    public function mount()
    {
        // Obtener el proveedor relacionado con el usuario autenticado
        $this->proveedor = Proveedor::where('user_id', Auth::id())->first();
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    // Método para guardar o actualizar un premio
    public function saveAward()
    {
        $this->validate();

        if ($this->selectedAward) {
            // Actualizar premio existente
            $award = Award::find($this->selectedAward);
            if ($award) {
                $award->update([
                    'award_name' => $this->award_name,
                    'awarding_institution' => $this->awarding_institution,
                    'year' => $this->year,
                    'description' => $this->description,
                ]);

                session()->flash('message', 'Premio actualizado exitosamente.');
            }
        } else {
            // Crear nuevo premio si el proveedor existe
            if ($this->proveedor) {
                Award::create([
                    'proveedor_id' => $this->proveedor->id,
                    'award_name' => $this->award_name,
                    'awarding_institution' => $this->awarding_institution,
                    'year' => $this->year,
                    'description' => $this->description,
                ]);

                session()->flash('message', 'Premio guardado exitosamente.');
            } else {
                session()->flash('error', 'No se encontró un proveedor asociado.');
            }
        }

        $this->resetForm();
        $this->toggleForm();
    }

    public function deleteAward($id)
    {
        $award = Award::find($id);
        if ($award) {
            $award->delete();
            session()->flash('message', 'Premio eliminado exitosamente.');
        }
    }

    public function editAward($id)
    {
        $award = Award::find($id);
        if ($award) {
            $this->selectedAward = $id;
            $this->award_name = $award->award_name;
            $this->awarding_institution = $award->awarding_institution;
            $this->year = $award->year;
            $this->description = $award->description;
            $this->showForm = true;
        }
    }

    public function resetForm()
    {
        $this->reset(['award_name', 'awarding_institution', 'year', 'description', 'selectedAward']);
    }

    public function render()
    {
        $proveedor = $this->proveedor;

        $awards = $proveedor ? Award::where('proveedor_id', $proveedor->id)->get() : collect();

        return view('livewire.provider-awards', compact('proveedor', 'awards'));
    }
}
