<?php

namespace App\Livewire\RegisterApiKeys;

use App\Models\ApiKey;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TableDataApiKey extends Component
{
    use WithPagination;

    public $company_name, $project_name, $status_api;

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
        ];
    }

    public function render()
    {
        return view('livewire.register-api-keys.table-data-api-key', [
            'resultAPIKeys' => ApiKey::paginate(10),
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
                'user_id'           => 0, // Auth::user()->id,
                'company_name'      => $this->company_name,
                'project_name'      => $this->project_name,
                'key'               => $this->get_token(40), // $this->createToken('api-h2h')->plainTextToken,
                'status_api_key'    => $this->status_api_key,
            ]);
            return redirect()->route('registerAPIKeys')->with(['success' => 'Data berhasil di update.']);
        }
    }
}
