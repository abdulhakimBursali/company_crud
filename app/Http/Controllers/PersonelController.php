<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Personels;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PersonelController extends Controller
{
   /* Personel Add Page Method
   * @return object
   */
    public function personelAddPage():object  {
        $companies = Companies::all();
        return view('personel_page', compact('companies'));
    }

    /* Personel Add Method
     * @param Request Object
     * @return object
     */
    public function personelAdd(Request $request):object {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'surname' => 'required|max:20',
            'email' => 'required|email',
            'title' => 'required|max:30',
            'telephone' => 'required|max:20',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $personel = new Personels();
        $personel->company_id = $request->company;
        $personel->name = $request->name;
        $personel->surname = $request->surname;
        $personel->title = $request->title;
        $personel->email = $request->email;
        $personel->telephone = $request->telephone;
        $personel->save() == true ?
            Session::flash('didSave', '1') :
            Session::flash('didSave', '0');
        return back();
    }

    /* Personel Update-Delete Page Method
     * @return object
     */
    public function personelUpdateDelete():object {
        $personels = Personels::with('company')->get();
     return view('personel_update_delete', compact('personels'));
    }

    /* Personel Delete
    *  @param Request Object
     * @return string
    */
    public function personelDelete(Request $request):string {
        Personels::destroy($request->personelId);
        return "personel deleted";
    }

    /* Personel Update Page
     * @param int
     * @return object
     */
    public function personelUpdatePage($id):object {
        $personel = Personels::find($id);
        $companies = Companies::all();
        return view('personel_update', compact('personel','companies'));
    }

    /* Personel Data Update
     * @param Request object
     * @return object
     */
    public function personelUpdate(Request $request):object {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'surname' => 'required|max:20',
            'email' => 'required|email',
            'title' => 'required|max:30',
            'telephone' => 'required|max:20',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $personel = Personels::find($request->personelId);
        $personel->company_id = $request->company;
        $personel->name = $request->name;
        $personel->surname = $request->surname;
        $personel->title = $request->title;
        $personel->email = $request->email;
        $personel->telephone = $request->telephone;
        $personel->email = $request->email;
        if($personel->save()){
            return redirect()->route('personel.updateDelete')->with('status','Personel bilgileri güncellendi.');
        }else {
            return back()->with('status','Bilgiler güncellenemedi.');
        }
    }
}
