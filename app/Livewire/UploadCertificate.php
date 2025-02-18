<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Certificate;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Auth;

class UploadCertificate extends Component
{
    use WithFileUploads;

    public $certificate;
    public $title;
    public $showForm = false;
    public $proveedor; 
    public $confirmingDelete = false; // Para confirmar la eliminación
    public $certificateIdToDelete = null; // ID del certificado a eliminar
    public $editingCertificate = null;
    

    protected $rules = [
        'certificate' => 'required|file|mimes:pdf|max:10240',
        'title' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->proveedor = Proveedor::where('user_id', Auth::id())->first();

        if (!$this->proveedor) {
            abort(404, 'Doctor no encontrado.');
        }
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function uploadCertificate()
    {
        $this->validate();
    
        // Si estamos editando un certificado existente
        if ($this->editingCertificate) {
            $certificate = Certificate::find($this->editingCertificate);
    
            // Actualizar el certificado
            $certificate->update([
                'title' => $this->title,
            ]);
    
            // Si hay un archivo nuevo, lo subimos
            if ($this->certificate) {
                $path = $this->certificate->store('certificates', 'public');
                $certificate->update([
                    'file_path' => $path,
                ]);
            }
    
            session()->flash('message', 'Certificado actualizado con éxito');
        } else {
            // Si es un nuevo certificado, lo creamos
            Certificate::create([
                'user_id' => Auth::id(),
                'file_path' => $this->certificate->store('certificates', 'public'),
                'title' => $this->title,
            ]);
    
            session()->flash('message', 'Certificado subido con éxito');
        }
    
        $this->reset(); // Limpiar los campos
        $this->toggleForm(); // Ocultar el formulario
        $this->showForm = false;
    }

    public function editCertificate($id)
{
    $this->editingCertificate = $id;
    $certificate = Certificate::find($id);

    if ($certificate) {
        $this->title = $certificate->title;
        // Si necesitas cargar otros campos, como el archivo, puedes hacerlo aquí
    }

    $this->toggleForm(); // Mostrar el formulario de edición
}


    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->certificateIdToDelete = $id;
    }

    public function deleteCertificate()
    {
        $certificate = Certificate::find($this->certificateIdToDelete);
        if ($certificate) {
            $certificate->delete();
            session()->flash('message', 'Certificado eliminado con éxito');
           
        }

        $this->confirmingDelete = false;
        $this->certificateIdToDelete = null;
    }

    public function render()
    {
        return view('livewire.upload-certificate', [
            'proveedor' => $this->proveedor,
            'certificates' => Certificate::where('user_id', Auth::id())->get()
        ]);
    }
}
