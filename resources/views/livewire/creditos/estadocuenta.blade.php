<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>{{ $ComponentName }}</h3>
        </div>

       
        

       

    </div>

    
    <div class="clearfix"></div>

    <div class="col-md-4 col-sm-4  profile_details">
      <div class="well profile_view col-sm-12">
        <div class="col-sm-12">
          <h4 class="brief"><i>Datos de Cliente</i></h4>
          <div class="left col-md-12 col-sm-12">
            
            <p><strong>Nombres: </strong> {{ $Razon_social}}  </p>
            <ul class="list-unstyled">
                <li><i class="fa fa-newspaper-o"></i> <strong>DNI:</strong> {{ $Nro_documento}}  </li>
                <li><i class="fa fa-building"></i> <strong>Direccion:</strong> {{ $direccion}} - {{ $distrito}} </li>
              <li><i class="fa fa-phone"></i> <strong>Telefonos: </strong>{{ $Telf_Fijo}} - {{ $Telf_Cel}}</li>
            </ul>
          </div>
          
        </div>
        <div class=" profile-bottom text-center">

          <div class=" col-sm-12 emphasis">

            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#theModal">
                <i class="fa fa-search"> </i> Buscar
            </button>
             
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-sm-8  profile_details">
        <div class="well profile_view">
            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="vigente-tab" data-toggle="tab" href="#vigente" role="tab" aria-controls="vigente" aria-selected="true">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="vigente" role="tabpanel" aria-labelledby="vigente-tab">
                
                <div class="table-responsive">
                  <table class="table table-bordered table-striped mt-1">
                      <thead>
                          <tr>
                              <th>Pagaré</th>
                              <th>F.Otorga</th>
                              <th>T_Producto</th>
                              <th>Saldo</th>
                              <th>F.Ult.Pago</th>
                              <th>Ubicación</th>
                              <th>Tipo</th>
                              <th>Acción</th>
                          </tr>
                      </thead>
                      <tbody>
                         
                          @foreach ($credVig as $r)
  
                          <tr>
                              <th>{{ $r->Nro_pagare}}</th>
                              <th>{{ $r->Fecha_otorgado}}</th>
                              <td>{{ $r->DES_PRES }}</td>
                              <td>{{ number_format($r->Saldo_prestamo,2) }}</td>
                              <td>{{ $r->Fecha_ult_pago }}</td>
                              <td>{{ $r->UBICACION }}</td>
                              <td>{{ $r->Amp_ref }}</td>
                              <td class="text-center">

                                <button type="button"  wire:click="Desactive({{$r->idPrestamos}})"  class="btn btn-success btn-sm"> 
                                  <i class="fa fa-check">
                                  </i> 
                              </button>
                              </td>
                              
                              
                          </tr>
                          @endforeach
                          
                      </tbody>
                  </table>
                  
              </div>

              </div>

              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                    booth letterpress, commodo enim craft beer mlkshk aliquip
              </div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                    booth letterpress, commodo enim craft beer mlkshk 
              </div>
            </div>
        </div>
        
      </div>


        @include('livewire.creditos.modal')


</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('user-added', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });

        window.livewire.on('user-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });

        window.livewire.on('user-deleted', msg => {
            noty(msg)
        });

        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });

        window.livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide')
        });

        window.livewire.on('user-withsales', msg => {
            noty(msg)
        });
        window.livewire.on('user-active-desactive', msg => {
            noty(msg)
        });


    });


    function Confirm(id) {

        swal({
            title: 'CONFIRMAR'
            , text: '¿CONFIRMAS ELIMINAR EL REGISTRO?'
            , type: 'warning'
            , showCancelButton: true
            , cancelButtonText: 'Cerrar'
            , cancelButtonColor: '#fff'
            , confirmButtonColor: '#3B3F5C'
            , confirmButtonText: 'Aceptar'
        , }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                swal.close()
            }
        });
    }

</script>