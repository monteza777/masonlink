<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\lodge;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class lodgeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lodges = lodge::all();
        return view('lodge.index_lodge',compact('lodges'));

    }

    public function create()
    {
        return view('lodge.create_lodge');
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
            'lodge_name'=>'required | unique:lodges',
            'lodge_address'=>'required| unique:lodges',
            'contact_number'=>'required',
            
            ]);

        $lodgeName = $request['lodge_name'];
        $lodgeAddress = $request['lodge_address'];
        $contactNumber = $request['contact_number'];
        //$lodgeLogo = $request['image'];

        $lodge = new lodge();
        // db -> FORM NAME

        

        $lodge->lodge_name=$lodgeName;
        $lodge->lodge_address=$lodgeAddress;
        $lodge->contact_number=$contactNumber;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put($filename, File::get($image)); 

            $lodge->image = $filename;
        }
        $lodge->save();
        return redirect('/lodge');
    }

   
    public function show($id)
    {
        $lodges = lodge::findorFail($id);
        return view('lodge.show_lodge',compact('lodges'));
    }

   
    public function edit($id)
    {
        $lodges = lodge::findorFail($id);
        return view('lodge.edit_lodge',compact('lodges'));
    }

    
    public function update(Request $request, $id)
    {
        $lodgeUpdate = lodge::find($id);
        $this->validate($request,[
        	'lodge_name'=>'required',
        	'lodge_address'=>'required'
        	]);

        $lodgeUpdate->lodge_name = $request->lodge_name;
        $lodgeUpdate->lodge_address = $request->lodge_address;
        
        $lodgeUpdate->save();
        session()->flash('message','Updated Succesful');
        return redirect('/lodge');
    }
    
    public function destroy($id)
    {
        $userDelete = lodge::find($id);
        $userDelete->delete();
        return redirect('/lodge');
    }

    public function getLodgeLogo($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
}
