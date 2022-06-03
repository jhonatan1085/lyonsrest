<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>{{ $ComponentName }}</h3>
        </div>

       
        

       

    </div>

    
    <div class="clearfix"></div>

    <div class="col-md-4 col-sm-4  profile_details">
      <div class="well profile_view">
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