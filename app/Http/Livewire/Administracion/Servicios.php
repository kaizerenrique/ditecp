<?php

namespace App\Http\Livewire\Administracion;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Servicio;

class Servicios extends Component
{
    use WithPagination;  

    public $buscar;

    public $nombre;
    public $tipo;
    public $costo;
    public $moneda;
    public $descrip;

    public $modalAgregarServicio = false;

    protected $queryString = [
        'buscar' => ['except' => '']
    ];

    public function render()
    {
        $servicios = Servicio::where('nombre', 'like', '%'.$this->buscar . '%')  //buscar por nombre de usuario
                    ->orWhere('moneda', 'like', '%'.$this->buscar . '%') //buscar por correo de usuario
                    ->orWhere('descrip', 'like', '%'.$this->buscar . '%') //buscar por correo de usuario
                    ->orderBy('id','desc') //ordenar de forma decendente
                    ->paginate(10); //paginacion          

        return view('livewire.administracion.servicios',[
            'servicios' => $servicios
        ]);
    }

    //Actualizar tabla para corregir falla de busqueda
    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function servicioAdd()
    {
        $this->reset(['nombre']);
        $this->reset(['tipo']);
        $this->reset(['costo']);
        $this->reset(['moneda']);
        $this->reset(['descrip']);
        $this->modalAgregarServicio = true;
    }

    protected $rules = [
        'nombre' => 'required|min:6',
        'tipo' => 'required',
        'costo' => 'required|numeric',
        'moneda' => 'required',
        'descrip' => 'required|min:6',
    ];

    public function guardarServicio()
    {
        $this->validate();

        Servicio::create([
            'nombre' => $this->nombre,
            'tipo' => $this->tipo,
            'costo' => $this->costo,
            'moneda' => $this->moneda,
            'descrip' => $this->descrip,
        ]);

        $this->modalAgregarServicio = false;
    }
}
