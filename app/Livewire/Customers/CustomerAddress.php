<?php

namespace App\Livewire\Customers;

use App\Models\Region;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CustomerAddress extends Component
{ 
    public $street_name;
    public $province;
    public $regency;
    public $district;
    public $village;
    public $postal_code;

    public $provinces = [];
    public $regencies = [];
    public $districts = [];
    public $villages = []; 

    public function mount() {
        $this->provinces = $this->regions->provinces()->pluck('name', 'code')->toArray();
        
        $address = Auth::user()->address()->first();
        
        if($address) {
            $this->street_name = $address->street_name;
            $this->province = $this->regions->provinces()->where('name', $address->province)->first()->code;
            $this->regency = $this->regions->regencies()->where('name', $address->city)->first()->code;
            $this->district = $this->regions->districts()->where('name', $address->district)->first()->code;
            $this->village = $this->regions->villages()->where('name', $address->village)->first()->code;
            $this->postal_code = $this->regions->villages()->where('postal_code', $address->postal_code)->first()->postal_code;
            $this->loadData();
        }
        
    }


    
    public function rules() {
        return [
            'street_name' => ['required', 'string', 'min:5', 'max:255'],
            'province' => ['required', 'string', 'exists:regions,code'],
            'regency' => ['required', 'string', 'exists:regions,code', function($attribute, $value, $fail) {
                if($this->province && ! $this->regions->where('code', $value)->where('parent_code', $this->province)->exists()) {
                    $fail('Kabupaten/Kota tidak sesuai dengan Provinsi yang dipilih.');
                }
            }],
            'district' => ['required', 'string', 'exists:regions,code', function($attribute, $value, $fail) {
                if($this->regency && ! $this->regions->where('code', $value)->where('parent_code', $this->regency)->exists()) {
                    $fail('Kecamatan tidak sesuai dengan Kabupaten/kota yang dipilih.');
                }
            }],
            'village' => ['required', 'string', 'exists:regions,code', function($attribute, $value, $fail) {
                if($this->district && ! $this->regions->where('code', $value)->where('parent_code', $this->district)->exists()) {
                    $fail('Desa/Kelurahan  tidak sesuai dengan kecamatan yang dipilih.');
                }
            }],
            'postal_code' => ['required', 'string', 'exists:regions,postal_code', function($attribute, $value, $fail) {
                if($this->village && !$this->regions->where('postal_code', $value)->where('postal_code', $this->postal_code)->exists()) {
                    $fail('Kode Pos  tidak sesuai dengan Desa yang dipilih.');
                }
            }],
        ];
    }
    
    public function messages() {
        return [
            'street_name.required' => 'Mohon sertakan nama jalan serta RT/RW untuk alamat lebih spesifik',
            'street_name.min' => 'Minimal 5 karakter',
            'street_name.max' => 'Maksimal 255 karakter',
            'province.required' => 'Provinsi Belum di Pilih',
            'province.exists' => 'Provinsi Tidak Terdaftar',
            'regency.required' => 'Kota/Kabupaten Belum di Pilih',
            'regency.exists' => 'Kota/Kabupaten Tidak Terdaftar',
            'district.required' => 'Kecamatan Belum di Pilih',
            'district.exists' => 'Kecamatan Tidak Terdaftar',
            'village.required' => 'Desa/Kelurahan Belum di Pilih',
            'village.exists' => 'Desa/Kelurahan Tidak Terdaftar',
            'postal_code.required' => 'Kode Pos Belum di Pilih',
            'postal_code.exists' => 'Kode Pos Tidak Terdaftar',
        ];
    }

    public function  getRegionsProperty(Region $regions) : Region {
        return $regions;
    }

    public function loadData() {
        if($this->province) {
            $this->regencies = $this->regions->regencies()->where('parent_code', $this->province)->pluck('name', 'code')->toArray();
        }else{
            $this->regencies = [];
        }

        if($this->regency) {
            $this->districts = $this->regions->districts()->where('parent_code', $this->regency)->pluck('name', 'code')->toArray();
        } else {
            $this->districts = [];
        }

        if($this->district) {
            $this->villages = $this->regions->villages()->where('parent_code', $this->district)->pluck('name', 'code')->toArray();
        } else {
            $this->villages = [];
        }

        if($this->village) {
            $this->postal_code = $this->regions->villages()->where('code', $this->village)->pluck('postal_code')->first();
        } else {
            $this->postal_code = '';
        }
    }
    
    public function updated() {
        $this->resetValidation();
    }
    
    public function updatedProvince() {
        $this->reset(['regency','district' , 'village', 'postal_code']);
        $this->loadData();
    }

  

    public function updatedRegency() {
        $this->reset(['district','village', 'postal_code']);
        $this->loadData();
    }

    public function updatedDistrict() {
        $this->reset(['village','postal_code']);
        $this->loadData();
    }

    public function updatedVillage() {
        $this->loadData();
    }

    public function updateAddress() {
        $this->validate();

        $user = Auth::user();
        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'street_name' => $this->street_name,
                'province' => $this->regions->provinces()->where('code', $this->province)->first()->name,
                'city' => $this->regions->regencies()->where('code', $this->regency)->first()->name,
                'district' => $this->regions->districts()->where('code', $this->district)->first()->name,
                'village' => $this->regions->villages()->where('code', $this->village)->first()->name,
                'postal_code' => $this->regions->villages()->where('code', $this->village)->first()->postal_code
            ]
        );
        return redirect()->route('customer.address')->with('success', 'Alamat anda berhasil di edit.');
    }
    public function render()
    {   
        return view('livewire.customers.customer-address');
    }
}
