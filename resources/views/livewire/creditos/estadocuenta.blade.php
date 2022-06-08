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

          <p><strong>Nombres: </strong> {{ $Razon_social }} </p>
          <ul class="list-unstyled">
            <li><i class="fa fa-newspaper-o"></i> <strong>DNI:</strong> {{ $Nro_documento}} </li>
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
    <div class="well profile_view col-md-12 col-sm-12">
      <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="vigente-tab" data-toggle="tab" href="#vigente" role="tab" aria-controls="vigente" aria-selected="true">Creditos</a>
        </li>


      </ul>
      <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="vigente" role="tabpanel" aria-labelledby="vigente-tab">
          <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
              <thead>
                <tr class="headings">
                  <th class="column-title">Pagaré</th>
                  <th class="column-title">F.Otorga</th>
                  <th class="column-title">T. Producto</th>
                  <th class="column-title">Saldo</th>
                  <th class="column-title">F.Ult.Pago</th>
                  <th class="column-title">Ubicación</th>
                  <th class="column-title">Tipo</th>
                  <th class="column-title">Acción</th>
                </tr>
              </thead>
              <tbody>


                @foreach ($credVig as $r)

                <tr>
                  <td>{{ $r ? $r->Nro_pagare : "no definido" }}</td>
                  <td>{{ date_format(new DateTime(substr($r->Fecha_otorgado ,0,10)),'d-m-Y')  }}</td>
                  <td>{{ $r->TIPO_PRES}}</td>
                  <td>{{ number_format($r->Saldo_prestamo,2) }}</td>
                  <td> {{ date_format(new DateTime(substr($r->Fecha_ult_pago ,0,10)),'d-m-Y')  }}</td>
                  <td>asd</td>
                  <td>asd</td>
                  <td class="text-center">

                    <button type="button" wire:click.prevent="DetCredito( {{ $r->idPrestamos }}, {{ $r->idPersonas }} )" class="btn btn-success btn-sm">
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


      </div>


    </div>

  </div>


  <div class="clearfix"></div>

  <div class="col-md-12 col-sm-12  ">
    <div class="x_panel">


      <div class="x_title">
        <h2>Detalle de Crédito </h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>

        </ul>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="movimientos-tab" data-toggle="tab" href="#movimientos" role="tab" aria-controls="movimientos" aria-selected="true">Movimientos</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="cronogramas-tab" data-toggle="tab" href="#cronogramas" role="tab" aria-controls="cronogramas" aria-selected="false">Cronogramas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="relacion-tab" data-toggle="tab" href="#relacion" role="tab" aria-controls="relacion" aria-selected="false">Relacion</a>
          </li>
          @if($repro)
          <li class="nav-item">
            <a class="nav-link" id="reprogra-tab" data-toggle="tab" href="#reprogra" role="tab" aria-controls="reprogra" aria-selected="false">Reprogramaciones</a>
          </li>

          @endif
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="movimientos" role="tabpanel" aria-labelledby="movimientos-tab">

            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">

                    <th class="column-title">Fecha </th>
                    <th class="column-title">Forma Pago</th>
                    <th class="column-title">Nro Cuo. </th>
                    <th class="column-title">Capital</th>
                    <th class="column-title">Interes </th>
                    <th class="column-title">Mora </th>
                    <th class="column-title">Mora Atra. </th>
                    <th class="column-title">Igv </th>
                    <th class="column-title">Redondeo </th>
                    <th class="column-title">Total </th>
                  </tr>
                </thead>

                <tbody>

                  @foreach ($movimientos as $r)
                  <tr class="even pointer">

                    <td class=" "> {{ date_format(new DateTime(substr($r->Fecha_mov ,0,10)),'d-m-Y')  }}
                    </td>
                    <td class=" ">{{ $r->nom_forma }}</td>
                    <td class=" ">{{ $r->nro_cuota }}</td>
                    <td class="a-right a-right ">{{ number_format($r->capital,2) }}</td>
                    <td class="a-right a-right ">{{ number_format($r->interes,2) }}</td>
                    <td class="a-right a-right ">{{ number_format($r->mora,2) }}</td>
                    <td class="a-right a-right ">{{ number_format($r->mora_atrasada,2) }}</td>
                    <td class="a-right a-right ">{{ number_format($r->IGV,2) }}</td>
                    <td class="a-right a-right ">{{ number_format($r->otrosingresos,2) }}</td>
                    <td class="a-right a-right ">{{ number_format($r->total,2) }}</td>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div class="tab-pane fade" id="cronogramas" role="tabpanel" aria-labelledby="cronogramas-tab">
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">

                    <th class="column-title">N. Cuo. </th>
                    <th class="column-title">F. Vcmto</th>
                    <th class="column-title">Total </th>
                    <th class="column-title">Capital</th>
                    <th class="column-title">Interes </th>
                    <th class="column-title">Igv </th>
                    <th class="column-title">Cap. Pag. </th>
                    <th class="column-title">Int. Pag </th>
                    <th class="column-title">IGV Pag </th>
                    <th class="column-title">Estado </th>
                    <th class="column-title">F. Pago </th>
                    <th class="column-title">Atraso </th>
                  </tr>
                </thead>

                <tbody>

                  @foreach ($cronogramas as $r)
                  <tr class="even pointer">

                    <td class=" ">{{ $r->NRO_CUOTA }}</td>
                    <td class=" ">{{ date_format(new DateTime(substr($r->Fecha_vcmto ,0,10)),'d-m-Y')  }}</td>
                    <td class=" ">{{ number_format($r->total,2) }}</td>
                    <td class="a-right a-right ">{{ number_format($r->Cuota_capital,2) }}</td>
                    <td class="a-right a-right ">{{ number_format($r->Cuota_interes,2) }}</td>
                    <td class="a-right a-right ">{{ number_format($r->Cuota_Igv,2) }}</td>
                    <td class="a-right a-right ">{{ number_format($r->pago_capital,2) }}</td>
                    <td class="a-right a-right ">{{ number_format($r->Pago_interes,2) }}</td>
                    <td class="a-right a-right ">{{ number_format($r->Pago_IGV,2) }}</td>
                    <td class="a-right a-right ">{{ $r->estado }}</td>
                    <td class="a-right a-right ">{{ date_format(new DateTime(substr($r->Fecha_pago ,0,10)),'d-m-Y') }}</td>
                    <td class="a-right a-right ">{{ $r->dias }}</td>

                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

          </div>
          <div class="tab-pane fade" id="relacion" role="tabpanel" aria-labelledby="relacion-tab">
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">

                    <th class="column-title">Código</th>
                    <th class="column-title">Apellidos y Nombres</th>
                    <th class="column-title">DNI </th>
                    <th class="column-title">Telefono </th>
                    <th class="column-title">Vinculo</th>

                  </tr>
                </thead>

                <tbody>

                  @foreach ($relacionado as $r)
                  <tr class="even pointer">

                    <td class=" ">{{ $r->Nro_documento }}</td>
                    <td class=" ">{{ $r->Razon_social }}</td>
                    <td class=" ">{{ $r->Nro_documento }}</td>
                    <td class=" ">{{ $r->Telf_Fijo }}</td>
                    <td class=" ">{{ $r->TIPO }}</td>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

          </div>
          <div class="tab-pane fade" id="reprogra" role="tabpanel" aria-labelledby="reprogra-tab">
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">

                    <th class="column-title">F. Repro</th>
                    <th class="column-title">Cap. Rep.</th>
                    <th class="column-title">Int. Rep. </th>
                    <th class="column-title">Cuo. Rep </th>
                    <th class="column-title">Nro Cuo.</th>
                    <th class="column-title">Nvo Plazo</th>
                    <th class="column-title">Cuota Ant.</th>
                    <th class="column-title">Cuota Nva.</th>

                    <th class="column-title">Fec. C. Rep.</th>
                    <th class="column-title">Fecha 1er C.</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach ($repro as $r)
                  <tr class="even pointer">

                    <td class=" ">
                      {{ date_format(new DateTime(substr($r->Fecha_Repro ,0,10)),'d-m-Y')  }}

                    </td>
                    <td class=" ">{{ number_format($r->capital_Repro,2) }}</td>
                    <td class=" ">{{ number_format($r->Interes_Repro,2) }}</td>
                    <td class=" ">{{ $r->CuotaRepro }}</td>
                    <td class=" ">{{ $r->nroCuotasRepro }}</td>
                    <td class=" ">{{ $r->Plazo_nuevo }}</td>
                    <td class=" ">{{ number_format($r->Cuota_anterior,2) }}</td>
                    <td class=" ">{{ number_format($r->Cuota_nueva,2) }}</td>

                    <td class=" "> {{ date_format(new DateTime(substr($r->Fecha_cuota_repro ,0,10)),'d-m-Y')  }}
                    </td>
                    <td class=" ">{{ date_format(new DateTime(substr($r->Fecha_primcuota_repro ,0,10)),'d-m-Y')  }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

          </div>


        </div>





      </div>

    </div>
  </div>

  <div class="clearfix"></div>
  <div class="row">

    <!-- /.col -->
    <div class="col-md-12">


      <div class="table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <th>Prestamo:</th>
              <td>{{ number_format($prestamo,2) }}</td>
              <th>Plazo:</th>
              <td>{{ $plazo }}</td>
              <th>Dias Atrasados:</th>
              <td>{{ number_format($diasAtra,2) }}</td>
            </tr>
            <tr>
              <th>Tasa:</th>
              <td>{{ number_format($tasa,2) }}%</td>
              <th>Frecuencia:</th>
              <td>{{ $frecuencia }}</td>
              <th>Mora por dia:</th>
              <td>{{ number_format($moraDia,2) }}</td>

            </tr>
            <tr>
              <th>Capital pagado:</th>
              <td>{{ number_format($capPag,2) }}</td>
              <th>Cuotas Pagadas:</th>
              <td>{{ $cuotPag }}</td>
              <th>Mora Total:</th>
              <td>{{ number_format($moraTotal,2) }}</td>
            </tr>
            <tr>
              <th>Saldo Capital:</th>
              <td>{{ number_format($saldoCap,2) }}</td>
              <th>Cuotas Pendientes:</th>
              <td>{{ $cuotPend }}</td>
              <th>Pagos por Moras:</th>
              <td>{{ number_format($pagoMora,2) }}</td>
            </tr>
            <tr>
              <th>Deuda Total:</th>
              <td>{{ number_format($deudaTot,2) }}</td>
              <th>Cuotas Vencidas:</th>
              <td>{{ $cuotVenc }}</td>
              <th>Saldo de Mora:</th>
              <td>{{ number_format($saldoMora,2) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->





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
      title: 'CONFIRMAR',
      text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
      type: 'warning',
      showCancelButton: true,
      cancelButtonText: 'Cerrar',
      cancelButtonColor: '#fff',
      confirmButtonColor: '#3B3F5C',
      confirmButtonText: 'Aceptar',
    }).then(function(result) {
      if (result.value) {
        window.livewire.emit('deleteRow', id)
        swal.close()
      }
    });
  }
</script>