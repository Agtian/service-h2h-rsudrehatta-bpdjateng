<?php

namespace App\Livewire\RegisterApiKeys;

use App\Models\ApiKey;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TableDataApiKey extends Component
{
    use WithPagination;

    public $id, $user_id, $company_name, $project_name, $key, $status_api_key;

    function getToken($panjang)
    {
        $token = array(
            range(1, 9),
            range('a', 'z'),
            range('A', 'Z')
        );

        $karakter = array();
        foreach ($token as $key => $val) {
            foreach ($val as $k => $v) {
                $karakter[] = $v;
            }
        }

        $token = null;
        for ($i = 1; $i <= $panjang; $i++) {
            // mengambil array secara acak
            $token .= $karakter[rand($i, count($karakter) - 1)];
        }

        return $token;
    }

    public function rules()
    {
        return [
            'company_name'      => 'required',
            'project_name'      => 'required',
            'status_api_key'    => 'required',
            'user_id'           => 'required'
        ];
    }

    public function resetField()
    {
        return [
            'id'                => '',
            'company_name'      => '',
            'project_name'      => '',
            'key'               => '',
            'status_api_key'    => '',
            'user_id'    => '',
        ];
    }

    public function closeModal()
    {
        $this->resetField();
    }

    public function render()
    {
        return view('livewire.register-api-keys.table-data-api-key', [
            'resultAPIKeys' => ApiKey::paginate(10),
            'resultUser'    => User::all(),
        ]);
    }

    public function store()
    {
        $this->Validate();

        $createdToken = $this->getToken(40);
        $findKey = ApiKey::where('key', $createdToken)->get();

        if (count($findKey) >= 1) {
            $createdToken = $this->getToken(40);
        } else {
            ApiKey::create([
                'user_id'           => $this->user_id, // Auth::user()->id,
                'company_name'      => $this->company_name,
                'project_name'      => $this->project_name,
                'key'               => $this->getToken(40), // $this->createToken('api-h2h')->plainTextToken,
                'status_api_key'    => $this->status_api_key,
            ]);
            return redirect()->route('registerAPIKeys')->with(['success' => 'Data berhasil disimpan dan X-API-KEY sudah aktif.']);
        }
    }

    public function edit(Int $id)
    {
        $data = ApiKey::find($id);
        $this->id           = $data->id;
        $this->user_id      = $data->user_id;
        $this->company_name = $data->company_name;
        $this->project_name = $data->project_name;
        $this->key          = $data->key;
        $this->status_api_key = $data->status_api_key;
    }

    public function update(Int $id)
    {
        $this->Validate();

        $validateId = ApiKey::find($id);

        if ($validateId) {
            ApiKey::find($id)->update([
                'user_id'           => $this->user_id,
                'company_name'      => $this->company_name,
                'project_name'      => $this->project_name,
                'key'               => $this->key,
                'status_api_key'    => $this->status_api_key,
            ]);
            return redirect()->route('registerAPIKeys')->with(['success' => 'Data berhasil diperbarui.']);
        } else {
            return redirect()->route('registerAPIKeys')->with(['warning' => 'Key data tidak sesuai.']);
        }
    }
}
