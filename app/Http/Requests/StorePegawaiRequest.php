<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ubah menjadi true agar diizinkan
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama_pegawai' => 'required|string|max:100',
            'nip' => 'required|string|max:30|unique:pegawai,nip',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pendidikan_terakhir' => 'required|in:SMA/SMK,D3,S1,S2',
            'jurusan' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'status' => 'required|in:Aktif,Cuti,Resign',
        ];
    }
    
    // Kustomisasi pesan error (Opsional agar lebih rapi)
    public function messages(): array
    {
        return [
            'nip.unique' => 'NIP ini sudah terdaftar di sistem.',
            'nip.required' => 'NIP wajib diisi.',
            'jurusan.required' => 'Jurusan wajib diisi.',
        ];
    }
}