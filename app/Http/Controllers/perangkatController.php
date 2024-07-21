<?php

namespace App\Http\Controllers;

use App\Models\Penetapan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class perangkatController extends Controller
{
    public function index()
    {
        $perangkat = Penetapan::where('level_penetapan', 'perangkatspmi')->get();

        return view('User.admin.Penetapan.perangkatspmi', compact('perangkat'));
    }

    public function show($id_penetapan)
    {
        $perangkat = Penetapan::findOrFail($id_penetapan);
    
        if ($perangkat->isPerangkatspmi()) {
            
            $create = function() { //closure
                return view('User.admin.Penetapan.tambah_perangkatspmi');
            };
            return $create(); //panggil closure
        
            $store = function(Request $request) {
                $request->validate([
                    'level_penetapan' => 'required|in:perangkatspmi,standarinstitusi',
                    'namaDokumen_penetapan' => 'required|string|max:1000',
                ]);
                
                $dataBaru = new Penetapan;
                $dataBaru->level_penetapan = $request['level_penetapan'];
                $dataBaru->namaDokumen_penetapan = $request['namaDokumen_penetapan'];
                $dataBaru->unggahDokumen_penetapan = $request['unggahDokumen_penetapan'];
                $dataBaru->save();
                
                //fungsi untuk upload file ektsensi (docx,doc,danseterusnya)
                //.......
            };
            return $store($request);

            $edit = function(String $id_penetapan) {
                $data = Penetapan::where('id', $id_penetapan)->first();
                return view('User.admin.Penetapan.edit_perangkatspmi', [
                    'oldData' => $data
                ]);
            };
            return $edit($id_penetapan);

            $update = function(Request $request, String $id_penetapan) {
                $dataUpdate = Penetapan::find($id_penetapan);
        
                $request->validate([
                    'level_penetapan' => 'required|in:perangkatspmi,standarinstitusi',
                    'namaDokumen_penetapan' => 'required|string|max:1000',
                    'unggahDokumen_penetapan' => 'require|string|max:1000'
                ]);
        
                $dataUpdate->level_penetapan = $request['level_penetapan'];
                $dataUpdate->namaDokumen_penetapan = $request['namaDokumen_penetapan'];
                $dataUpdate->unggahDokumen_penetapan = $request['unggahDokumen_penetapan'];
                $dataUpdate->save();
        
                Alert::success('success', 'dokumen berhasil diperbarui.');
                return redirect()->route('penetapan');
            };
            return $update($request, $id_penetapan);
    
        } else {
            // Logika untuk menonaktifkan submenu standarintitusi
        }
    }
    
}
