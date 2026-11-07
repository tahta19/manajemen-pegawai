<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama_pegawai' => 'required|string|max:100',
            // Unique NIP, tapi abaikan NIP milik ID yang sedang diedit
            'nip' => [
                'required', 'string', 'max:30',
                Rule::unique('pegawai', 'nip')->ignore($this->route('pegawai'))
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pendidikan_terakhir' => 'required|in:SMA/SMK,D3,S1,S2',
            'jurusan' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'status' => 'required|in:Aktif,Cuti,Resign',
        ];
    }
    
    public function messages(): array
    {
        return [
            'nip.unique' => 'NIP ini sudah digunakan oleh pegawai lain.',
            'nip.required' => 'NIP wajib diisi.',
            'jurusan.required' => 'Jurusan wajib diisi.',
        ];
    }
}