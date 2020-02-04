<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{

    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //with Query Builder
        // $services = DB::table('services')->get();
        // return view('service.index', ['services' => $services]); 
        
        //with Eloquent
        $services = Service::where('status', '1')->get();
        return view('service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request;
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('image');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'image/service';
		$file->move($tujuan_upload,$nama_file);

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $nama_file,
            'status' => 1
        ]);

        return redirect('/service')->with('status', 'Data Layanan Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        
        $photo = Service::where('id', $service->id)->first();
        $gambar = $photo->image;
        
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $cek = $request->file('image');

        if ($cek != null) {

            $file = $request->file('image');
            // menyimpan data file yang diupload ke variabel $file
     
            $nama_file = time()."_".$file->getClientOriginalName();
     
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'image/service';
            $file->move($tujuan_upload,$nama_file);

            $gambar = $nama_file;
        }

        Service::where('id', $service->id)
                    ->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'image' => $gambar
                    ]);
        
        // echo $cek;
        return redirect('/service')->with('status', 'Data Layanan Berhasil Diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        Service::destroy($service->id);
        return redirect('/service')->with('status', 'Data Layanan Berhasil Dihapus!');
    }

    public function get_service()
    {
        $service = Service::where('status', '1')->get();
        return response()->json(['data' => $service], $this->successStatus);
    }

    public function add_service(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('image');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'image/service';
		$file->move($tujuan_upload,$nama_file);

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $nama_file,
            'status' => 1
        ]);

        return "Data Layanan Berhasil Ditambahkan!";
    }

}
