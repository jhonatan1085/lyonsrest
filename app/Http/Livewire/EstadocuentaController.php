<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads; //trait para subir imagenes de livewire
use Livewire\WithPagination;
use DB;
use Carbon\Carbon;

use Livewire\Component;

class EstadocuentaController extends Component
{

   

    use WithFileUploads;
    use WithPagination;

    public $clientes, $ApPat, $ApMat, $Nombres, $total, $Cuenta, $cuentacare, $Razon_social, $Nro_documento, $direccion, $distrito, $Telf_Fijo, $Telf_Cel;
    public $credVig, $movimientos, $cronogramas, $relacionado, $idprestamo, $repro;
    public $prestamo, $tasa, $capPag, $saldoCap, $deudaTot, $plazo, $frecuencia, $cuotPag, $cuotPend, $cuotVenc;
    public $diasAtra, $moraDia, $moraTotal, $pagoMora, $saldoMora;


    public $search, $pageTitle, $componentName; //propiedades publicas
    private $pagination = 5;
    public function mount()
    { //metodo que se ejecuta al inicio, sirve para inicializar 
        $this->PageTitle = 'Listado';
        $this->ComponentName = 'Usuarios';
        $this->status = 'Elegir';
        $this->clientes = [];
        $this->credVig = [];
        $this->movimientos = [];
        $this->cronogramas = [];
        $this->relacionado = [];
        $this->repro = [];
        $this->idprestamo = 0;
        $this->total = 0;
        $this->Cuenta = '';
        $this->Razon_social = '';


        /* $this->prestamo = 0;
        $this->tasa  = 0;
        $this->capPag = 0;
        $this->saldoCap = 0;
        $this->deudaTot = 0;
        $this->plazo = 0;
        $this->frecuencia = '';
        $this->cuotPag  = 0;
        $this->cuotPend = 0;
        $this->cuotVenc = 0;
        $this->diasAtra = 0;
        $this->moraDia = 0;
        $this->moraTotal = 0;
        $this->pagoMora = 0;
        $this->saldoMora = 0;

*/
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
        $this->movimientos = [];
        $this->cronogramas = [];
        $this->relacionado = [];
        $this->repro = [];
        // $this->clientes = DB::select("exec UP_SEL_ConsultarClientes '3','','','', '" . $this->ApPat . "','" . $this->ApMat . "','" . $this->Nombres . "',''");
        $this->clientes = DB::table('personas')
            ->leftJoin('Socios', 'Socios.idpersonas', '=', 'personas.idPersonas')
            ->select('Socios.Cuenta', 'personas.Razon_social', 'personas.idPersonas')
            ->where("personas.Apellido_paterno", "like", $this->ApPat . "%")
            ->where("personas.Apellido_materno", "like", $this->ApMat . "%")
            ->where("personas.nombres", "like", $this->Nombres . "%")
            ->orderByDesc('personas.Apellido_paterno')
            ->orderByDesc('personas.Apellido_materno')
            ->orderByDesc('personas.nombres')->get();
    }
    protected $listeners = [ //para escuchar los eventos
        'BuscarCliente' => 'BuscarCliente'
    ];

    public function BuscarCliente($id)
    {
        $this->resetUI();
        $info = DB::select("exec UP_SEL_ConsultarClientes '1'," . $id . ",'','', '','','',''");


        foreach ($info as $row) {
            $this->Cuenta = $row->Cuenta;
            $this->cuentacare =  $row->cuentacare;
            $this->Razon_social =  $row->Razon_social;
            $this->Nro_documento =  $row->Nro_documento;
            $this->direccion =  $row->direccion;
            $this->distrito =  $row->distrito;
            $this->Telf_Fijo =  $row->Telf_Fijo;
            $this->Telf_Cel =  $row->Telf_Cel;
        }



        $this->DetPrestamos($id);

        $this->emit('hide-modal', 'Usuario Registrado');
    }

    public function DetCredito($id, $idper)
    {


        $this->movimientos = DB::select("exec UP_SEL_ConsultarMovPrestamo '" . $id . "'");
        $this->cronogramas = DB::select("exec UP_SEL_ConsultarCronogramas '" . $id . "'");
        $this->relacionado = DB::select("exec UP_SEL_ConsultarGarantes '" . $id . "'");
        $this->repro = DB::select("exec UP_SEL_ConsultarReprogramacion '" . $id . "'");
        $date = Carbon::now();


        $infopres = DB::select("exec UP_SEL_PrestamosInfo '" . $id . "','" . $date . "'");
        


        foreach ($infopres as $row) {
        
            $this->prestamo = $row->prestamo;
            $this->tasa  = $row->tasainteres;
            $this->capPag = $row->capPag;
            $this->saldoCap = $row->saldoCap;
            $this->deudaTot = $row->deudatotal;
            $this->plazo = $row->Plazos;
            $this->frecuencia = $row->frecuencia;
            $this->cuotPag  = $row->cuoPagadas;
            $this->cuotPend = $row->cuoPendiente;
            $this->cuotVenc = $row->cuoAtrasadas;
            $this->diasAtra = $row->DiasAtrasados;
            $this->moraDia = $row->moradia;
            $this->moraTotal = $row->DiasAtrasados * $row->moradia;
            $this->pagoMora = $row->pagomora;
            $this->saldoMora = $this->moraTotal - $this->pagoMora;
        }

        $this->DetPrestamos($idper);
    }

    public function DetPrestamos($idper)
    {


        $this->credVig = DB::table('Prestamos as pre')
            ->Join('TipoPrestamos as tp', DB::raw('tp.idTipoPrestamo'), '=', DB::raw('pre.Tipo_prestamo'))
            ->select('pre.idPersonas', 'pre.idPrestamos', 'pre.Nro_pagare', 'pre.Fecha_otorgado', 'pre.Saldo_prestamo', 'pre.Fecha_ult_pago', 'tp.Descripcion as TIPO_PRES')
            ->where("pre.idPersonas", "=", $idper)
            ->where("pre.Saldo_prestamo", ">", 0)
            ->orderByDesc('pre.Fecha_otorgado')->limit(5)->get();
    }

    public function resetUI()
    {
        $this->clientes = [];
        $this->credVig = [];
        $this->movimientos = [];
        $this->cronogramas = [];
        $this->relacionado = [];
        $this->repro = [];
        $this->ApPat = '';
        $this->ApMat = '';
        $this->Nombres = '';
        $this->Razon_social = '';
    }
}
