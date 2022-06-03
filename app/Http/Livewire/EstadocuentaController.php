<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads; //trait para subir imagenes de livewire
use Livewire\WithPagination;
use DB;

use Livewire\Component;

class EstadocuentaController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $clientes,$ApPat, $ApMat, $Nombres, $total, $Cuenta, $cuentacare,$Razon_social,$Nro_documento,$direccion,$distrito,$Telf_Fijo,$Telf_Cel;
    public $credVig;
    public $search, $pageTitle, $componentName; //propiedades publicas
    private $pagination = 5;
    public function mount()
    { //metodo que se ejecuta al inicio, sirve para inicializar 
        $this->PageTitle = 'Listado';
        $this->ComponentName = 'Usuarios';
        $this->status = 'Elegir';
        $this->clientes = [];
        $this->credVig = [];
        $this->total = 0;
        $this->Cuenta = '';
        $this->Razon_social= '';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {

        return view('livewire.creditos.estadocuenta')
            ->extends('layouts.theme.app')
            ->section('content');
    }


    public function Buscar()
    {
        $this->credVig = [];
        $this->clientes = DB::select("exec UP_SEL_ConsultarClientes '3','','','', '" . $this->ApPat . "','" . $this->ApMat . "','" . $this->Nombres . "',''");
       
    }
    protected $listeners = [ //para escuchar los eventos
        'BuscarCliente' => 'BuscarCliente'
    ];

    public function BuscarCliente($id)
    {
        $this->resetUI();
        $info = DB::select("exec UP_SEL_ConsultarClientes '1',". $id .",'','', '','','',''");
        
        foreach($info as $row)
        {
            $this->Cuenta = $row->Cuenta; 
            $this->cuentacare =  $row->cuentacare; 
            $this->Razon_social =  $row->Razon_social; 
            $this->Nro_documento =  $row->Nro_documento; 
            $this->direccion =  $row->direccion; 
            $this->distrito =  $row->distrito; 
            $this->Telf_Fijo =  $row->Telf_Fijo; 
            $this->Telf_Cel =  $row->Telf_Cel; 
        }

        
        $this->credVig = DB::select("exec UP_SEL_BuscarPrestamo '". $id ."','%%','S'");
//dd($this->credVig);

  
        $this->emit('hide-modal', 'Usuario Registrado');
        
    }

    public function resetUI()
    {
        $this->clientes = [];
        $this->credVig = [];
        $this->ApPat = '';
        $this->ApMat = '';
        $this->Nombres = '';
        $this->Razon_social= '';
    }


}
