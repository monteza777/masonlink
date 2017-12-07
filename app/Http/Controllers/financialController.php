<?php


namespace App\Http\Controllers;
use App\financial_report;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PDF;
use Session;

class financialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function oindex()
    {
        $search = \Request::get('search');
        $reportsLists = financial_report::where([
            ['official','=','1'],
            ['report_title', 'like', '%'.$search.'%'],
            ])
        ->orderBy('created_at','desc')
        ->paginate(10);
        $fReportOnlyTrash = financial_report::onlyTrashed()->get();

        $data = [
            'reportsLists' => $reportsLists,
            'fReportOnlyTrash' => $fReportOnlyTrash,
        ];

        return view('financialReport.official_index_financial_report')->with($data);
    }

    public function uoindex()
    {
        $search = \Request::get('search');
        $reportsLists = financial_report::where([
            ['official','=','0'],
            ['report_title', 'like', '%'.$search.'%'],
            ])
        ->orderBy('created_at','desc')
        ->paginate(10);
        $finanOrOnlyTrashed = financial_report::onlyTrashed()->get();

        $data = [
            'reportsLists' => $reportsLists,
            'finanOrOnlyTrashed' => $finanOrOnlyTrashed,
        ];
        return view('financialReport.unofficial_index_financial_report')->with($data);
    }

    public function ocreate(){

        return view('financialReport.official_create_financial_report');
    }

    public function uocreate(){

        return view('financialReport.unofficial_create_financial_report');
    }

    public function ostore(Request $request)
    {
        // $resource = financial_report::create($request->all());

         $this->validate($request,
            [
            'report_content'=>'required|max:10000',
            'report_title'=>'required'
            ]);

        $rContent = $request['report_content'];
        $rTitle = $request['report_title'];
        $repId = $request['id'];

        $freport = new financial_report();
        // db -> FORM NAME
        $freport->report_content=$rContent;
        $freport->report_title=$rTitle;
        $freport->official=1;
        $freport->save();
        return redirect()->route('finanOfficialIndex');
    }

    public function uostore(Request $request)
    {
         $this->validate($request,
            [
            'report_content'=>'required|max:10000',
            'report_title'=>'required'
            ]);

        $rContent = $request['report_content'];
        $rTitle = $request['report_title'];
        $repId = $request['id'];

        $freport = new financial_report();
        // db -> FORM NAME
        $freport->report_content=$rContent;
        $freport->report_title=$rTitle;
        $freport->official=0;
        $freport->save();
        // return redirect()->route('finanReportShow', $resource->id);
        return redirect()->route('finanUoIndex');
    }
    public function deleteUo($id){
        $meeting = financial_report::find($id);
        $meeting->delete();
        return redirect()->route('finanUoIndex');
    }

    public function edit($id)
    {
        $fReport = financial_report::find($id);
        return view('financialReport.edit_financial_report',compact('fReport'));
    }

    public function update(Request $request, $id)
    {
        $fReportUpdate = financial_report::find($id);
        $fReportUpdate->report_title = $request->rTitle;
        $fReportUpdate->report_content = $request->rContent;
      
        $fReportUpdate->save();

        if($fReportUpdate->official == 1){
        return redirect()->route('finanOfficialIndex');
        }else{
        return redirect()->route('finanUoIndex');
        }

    }

    public function destroy($id)
    {
        $reportDelete = financial_report::find($id);
        $reportDelete->delete();
        return redirect()->route('financialController');
    }

    public function show($id){

        $showReport = financial_report::find($id);
        return view('financialReport.show_financial_report',compact('showReport'));
    }

    public function pdf($id){

        $clients = financial_report::find($id);
        $pdf = PDF::loadView('financialReport.pdf_financial_report',compact('clients'));
        return $pdf->download('Financial_Report.pdf');
    }

    public function archive($id){
        $fReport = financial_report::find($id);
        $fReport->delete();
        return redirect()->route('finanOfficialIndex');
    }

    public function trashes(){
        $reportsLists = financial_report::onlyTrashed()->get()
        ->where('official','1');
        return view('financialReport.trash_financial_report',compact('reportsLists'));
    }
    public function restore($id){
        financial_report::withTrashed()->find($id)->restore();
        return redirect()->route('finanOfficialIndex');
    }

    public function restoreall(){
        financial_report::onlyTrashed()->restore();
        return redirect()->route('finanOfficialIndex');
    }
}
