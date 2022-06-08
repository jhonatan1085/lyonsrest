<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads; //trait para subir imagenes de livewire
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;

class UsersController extends Component
{

    use WithFileUploads;
    use WithPagination;

    //propiedades publicas

    public $name, $phone, $email, $status, $image, $password, $selected_id, $fileLoaded, $profile;
    public $search, $pageTitle, $componentName; //propiedades publicas
    private $pagination = 5;

    public function mount()
    { //metodo que se ejecuta al inicio, sirve para inicializar 
        $this->PageTitle = 'Listado';
        $this->ComponentName = 'Usuarios';
        $this->status = 'Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {


        if (strlen($this->search) > 0) {
            $data = User::where('name', 'like', '%' . $this->search . '%')
                ->select('*')->orderBy('name', 'asc')->paginate($this->pagination);
        } else {
            $data = User::select('*')->orderBy('name', 'asc')->paginate($this->pagination);
        }

       

        return view('livewire.users.component', [
            'data' => $data,
            'roles' => Role::orderBy('name', 'asc')->get()
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->status = 'Elegir';
        $this->image = '';
        $this->password = '';
        $this->selected_id = 0;
        $this->search = '';
        $this->resetValidation(); //borra los mensajes de validacion
        $this->resetPage(); //actualiza la pagina 
    }

    public function edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->profile = $this->profile;
        $this->email = $user->email;
        $this->status = $user->status;
        $this->password = '';

        $this->emit('show-modal', 'show modal!');

        
    }


    public function Active(User $user)
    {

        $this->selected_id = $user->id;
        $user = User::find($this->selected_id);

        $user->update([
            'status' => 'Active'
        ]);
        $this->resetUI();
        $this->emit('user-active-desactive', 'Usuario Activado');
    }

    public function Desactive(User $user)
    {

        $this->selected_id = $user->id;
        $user = User::find($this->selected_id);

        $user->update([
            'status' => 'Locked'
        ]);
        $this->resetUI();

        $this->emit('user-active-desactive', 'Usuario Bloqueado');
    }

    protected $listeners = [ //para escuchar los eventos
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI'
    ];

    public function Store()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:3'
        ];
        $messages = [
            'name.required' => 'Nombre de Usuario es requerido',
            'name.min' => 'El nombre de Usuario debe tener almenos 3 caracteres',
            'email.required' => 'Ingrese un correo',
            'email.email' => 'Ingrese un correo valido',
            'email.unique' => 'El Correo ya existe',
            'status.require' => 'Seleccione Estado para usuario',
            'status.not_in' => 'Seleccione el Estado diferente a Elegir',
            'profile.require' => 'Seleccione el perfil/role del usuario',
            'profile.not_in' => 'Seleccione el perfil diferente a Elegir',
            'password.requiere' => 'Ingrese el password',
            'password.min' => 'Ingrese el passwor debe tener al menos 3 caracteres',
        ];

        $this->validate($rules, $messages);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'profile' => $this->profile,
            'phone' => $this->phone,
            'status' => $this->status
        ]);

        $customFileName;

        if ($this->image) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $user->image = $customFileName;
            $user->save();
        }

        $this->resetUI();

        $this->emit('user-added', 'Usuario Registrado');
    }

    public function Update()
    {
        $rules = [
            'email' => "required|email|unique:users,email,{$this->selected_id}",
            'name' => 'required|min:3',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:3'
        ];
        $messages = [
            'name.required' => 'Nombre de Usuario es requerido',
            'name.min' => 'El nombre de Usuario debe tener almenos 3 caracteres',
            'email.required' => 'Ingrese un correo',
            'email.email' => 'Ingrese un correo valido',
            'email.unique' => 'El Correo ya existe',
            'status.require' => 'Seleccione Estado para usuario',
            'status.not_in' => 'Seleccione el Estado diferente a Elegir',
            'profile.require' => 'Seleccione el perfil/role del usuario',
            'profile.not_in' => 'Seleccione el perfil diferente a Elegir',
            'password.requiere' => 'Ingrese el password',
            'password.min' => 'Ingrese el passwor debe tener al menos 3 caracteres',
        ];

        $this->validate($rules, $messages);

        $user = User::find($this->selected_id);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'profile' => $this->profile,
            'phone' => $this->phone,
            'status' => $this->status
        ]);


        if ($this->image) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/users/', $customFileName);
            $imageName = $user->image; //guardamos la imagen actual
            $user->image = $customFileName;
            $user->save();

            if ($imageName != null) {
                if (file_exists('storage/users/' . $imageName)) {
                    unlink('storage/users/' . $imageName); // elimina la imagen
                }
            }
        }

        $this->resetUI();

        $this->emit('user-updated', 'Usuario Actualizado');
    }


    public function destroy(User $user)
    {


        if ($user) {
            /* $sales = Sale::where('user_id', $user->id)->count();
            if ($sales > 0) {
                $this->emit('user-withsales', 'No es posible eliminar el usuario, por que tiene ventas registradas');
            } else {*/
            $user->delete();
            $this->resetUI();
            $this->emit('user-deleted', 'Usuario Eliminado');
            $imageName =  $user->image;


            if ($imageName != null) {
                unlink('storage/categorias/' . $imageName);
            }
            /* }*/
        }
    }


   
}
