<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Location;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Middleware\ThrottleRequestsWithRedis;

class Registration extends Component
{
    use WithPagination;
    public $name, $email, $password, $level, $unit, $location_id, $role;
    public $show, $is_update, $id;


    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();
    }

    public function edit($id)
    {
        $this->id = $id;
        $this->show = true;
        $this->is_update = true;
        $data = User::find($this->id);
        $this->name = $data->name;
        $this->email = $data->email;
        // $this->password = $data->name;
        $this->level = $data->level;
        $this->unit = $data->unit;
        $this->location_id = $data->location_id;
        $this->role = $data->role;
    }

    public function update()
    {
        $this->validate();
        $data = User::find($this->id);
        $data->name = $this->name;
        $data->email = $this->email;
        // $data->password = Hash::make($this->password);
        $data->level = $this->level;
        $data->unit = $this->unit;
        $data->location_id = $this->location_id;
        $data->role = $this->role;
        $data->save();
        $this->reset();

        $this->show = false;
        $this->is_update = false;
    }
    public function cancel()
    {
        $this->clear_data();
        $this->show = false;
    }
    public function new()
    {
        $this->clear_data();
        $this->reset();
        $this->show = true;
    }

    public function clear_data()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->level = '';
        $this->unit = '';
        $this->location_id = '';
        $this->role = 0;
    }

    public function mount()
    {
        $this->reset();
        $this->show = false;
        $this->is_update = false;
        $this->clear_data();


        // $this->clear_data();
    }



    protected $rules = [
        'name' => 'required|min:3',
        'password' => 'nullable|min:8',
        'level' => 'required',
        'unit' => 'required_if:level,Agent',
        'email' => 'required|email',
        'role' => 'nullable',
        'location_id' => 'nullable'
    ];



    public function save()
    {
        $this->validate();
        $data = new User;
        $data->name = $this->name;
        $data->email = $this->email;
        $data->password = Hash::make($this->password);
        $data->level = $this->level;
        $data->unit = $this->unit;
        $data->save();
        $this->reset();
        $this->show = false;
    }


    public function render()
    {
        $units = User::whereIn('level', ['AAD', 'AD'])->get();
        $locations = Location::all();
        // $users = User::orderBy('id', 'desc')->paginate(5);

        $users = DB::table('users')->join('locations', 'locations.id', '=', 'users.location_id')
            ->select('users.*', 'locations.location_name')
            ->orderBy('users.id', 'desc')->paginate(5);

        // dd($users->all());
        return view('livewire.registration', [
            'users' => $users,
            'units' => $units,
            'locations' => $locations
        ]);
    }
}
