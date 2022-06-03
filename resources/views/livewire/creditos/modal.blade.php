@include('common.modalHead')
<div class="row">
    <div  class="col-md-12 col-sm-12 ">

  <div>
            <div class="col-md-3 col-sm-3  form-group has-feedback">
                <input type="text" wire:model.defer="ApPat" class="form-control has-feedback-left"  placeholder="Apellido Paterno">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-3 col-sm-3  form-group has-feedback">
                <input type="text" wire:model.defer="ApMat" class="form-control has-feedback-left"  placeholder="Apellido Materno">
               
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-4 col-sm-4  form-group has-feedback">
                <input type="text" wire:model.defer="Nombres" class="form-control has-feedback-left"  placeholder="Nombres">
               
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-2 col-sm-2  form-group has-feedback">
                <a href="javascript:void(0)" wire:click="Buscar()" class="btn btn-dark mtmobile" tile="Edit">
                    <i class="fa fa-edit"></i>
                </a>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-1">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Cliente</th>
                            <th>Aceptar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($total>0)
                                <tr><td colspan="4"><h6 class="text-center">No hay ventas en la fecha seleccionada</h6></td></tr>
                        
                        @else
                        @foreach ($clientes as $r)

                        <tr>
                            <th scope="row">{{ $r->Cuenta}}</th>
                            <td>{{ $r->Razon_social }}</td>
                            
                            <td class="text-center">

                                <button type="button" wire:click.prevent="BuscarCliente({{$r->idPersonas}})" class="btn btn-primary">ACTUALIZAR</button>
                                
                               
                            </td>
                            
                            
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                
            </div>

    </div>
</div>
@include('common.modalFooterSin')
