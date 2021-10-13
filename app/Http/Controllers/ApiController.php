<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        /* Source File URL */
        $remote_file_url = 'https://jantungdesa.bunefit.com/public/img/penduduk/produk/1632216228_masker%20rabbit.jpg';
        
        fopen(public_path('img/test.jpg'),"w");
        /* New file name and path for this file */
        $local_file = public_path('img/test.jpg');
        
        /* Copy the file from source url to server */
        $copy = copy($remote_file_url, $local_file);
        
        /* Add notice for success/failure */
        if(!$copy) {
            echo "Doh! failed to copy $local_file \n";
        }else{
            echo "WOOT! success to copy $local_file \n";
        }

        die();
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://jantungdesa.bunefit.com/api/produk',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

        $response = json_decode($response);
        foreach ($response as $item) {
            echo $item->nama.' </br>';
            echo "<img src='https://jantungdesa.bunefit.com/public/img/penduduk/produk/".$item->gambar."' width='200px'> </br>";
        }
    }

    public function tambah()
    {
        return view('tambah');
    }

    public function simpan(Request $request)
    {
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('gambar');
           
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'https://jantungdesa.bunefit.com/public/img/penduduk/produk';
        // isi dengan nama folder tempat kemana file diupload
        $data = array(
            'lapak_id' => $request->lapak_id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'gambar' => $nama_file,
            'token' => $request->token,
        );
         
        $payload = json_encode($data);

         $file->move($tujuan_upload,$nama_file);


        $ch = curl_init('https://jantungdesa.bunefit.com/api/produk');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            
            // Set HTTP Header for POST request
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload))
            );
            
            // Submit the POST request
            $result = curl_exec($ch);
            
            // Close cURL session handle
            curl_close($ch);
            echo $result;

    }

    public function hapus($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://jantungdesa.bunefit.com/api/produk/'.$id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_POSTFIELDS => 'token=$2y$10$kIAxk2KCirEdUXMv8iuX6OkLHP6ha.XIbSkIrN1HcLga9zEi4/sLa',
          CURLOPT_CUSTOMREQUEST => 'DELETE',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;
        
    }
}
