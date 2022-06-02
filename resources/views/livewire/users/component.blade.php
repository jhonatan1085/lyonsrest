<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>{{ $ComponentName }}</h3>
        </div>

        <div class="title_right">
            @include('common.searchbox')
          </div>


    </div>

    <div class="clearfix"></div>

    <div class="row" style="display: block;">
        <div class="col-sm-12 col-md-12 ">
            <div class="x_panel">
                <div class="x_title">
                    
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#theModal">Nuevo Usuario</button>
                    
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>USUARIO</th>
                                    <th>TELEFONO</th>
                                    <th>EMAIL</th>
                                    <th>PERFIL</th>
                                    <th>STATUS</th>
                                    <th>IMAGEN</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $r)

                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $r->name }}</td>
                                    <td>{{ $r->phone }}</td>
                                    <td>{{ $r->email }}</td>
                                    <td>{{ $r->profile }}</td>
                                    <td class="text-center">
  
                                        
                                    
                                        @if($r->status == 'Active') 
                                        
                                        <button type="button"  wire:click="Desactive({{$r->id}})"  class="btn btn-success btn-sm"> 
                                            <i class="fa fa-check-circle">
                                            </i> 
                                        </button>

                                        @else
                                        
                                        <button type="button" wire:click="Active({{$r->id}})" class="btn btn-danger btn-sm"> 
                                            <i class="fa fa-times-circle">
                                            </i> 
                                        </button>
                                        @endif
                                    </td>
                                    <td>@mdo</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" wire:click="edit({{$r->id}})" class="btn btn-dark mtmobile" tile="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="Confirm('{{$r->id}}')" class="btn btn-dark " tile="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


        @include('livewire.users.modal')


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
