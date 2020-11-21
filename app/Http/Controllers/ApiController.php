<?php

namespace App\Http\Controllers;

use App\Models\Adresses;
use App\Models\Companies;
use App\Models\Personels;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function updateDeletePage(){
        $companies = Companies::with('adresses')->get();
        return $companies;
    }

    public function addCompany(Request $request):string{
        $company = new Companies();
        $company->name = $request->companyName;
        $company->internet_address = $request->webAdres;
        $company->web_page_source_code = 'will create';
        $company->save();
        // Insert Adresses
        $adresses = array_filter(explode('#',$request->companyAdresses));
        if (!empty($adresses)){
            foreach ($adresses as $adress){
                $insertArray[] = array('company_id' => $company->id, 'adress' => $adress);
            }
            Adresses::insert($insertArray);
        }
        return "company added";
    }

    public function getCompanyData($id){
        $companyData = Companies::with('adresses')->find($id);
        return $companyData;
    }

    public function deleteAdress(Request $request){
        Adresses::destroy($request->adressId);
        return "ok";
    }

    public function companyUpdate(Request $request){
        $company = Companies::find($request->companyId);
        $company->name = $request->companyName;
        $company->internet_address = $request->webAdres;
        $company->web_page_source_code = 'will create';
        $company->save();
        // Insert Adresses
        $adresses = array_filter(explode('#',$request->companyAdresses));
        if (!empty($adresses)){
            foreach ($adresses as $adress){
                $insertArray[] = array('company_id' => $company->id, 'adress' => $adress);
            }
            Adresses::insert($insertArray);
        }
        return "company updated";
    }


    public function deleteCompany(Request $request):string{
        Adresses::where('company_id', $request->companyId)->delete();
        Personels::where('company_id', $request->companyId)->delete();
        Companies::destroy($request->companyId);
        return "company deleted";
    }


    /* ------------------------------------------------------------------ */
    /* Personel Controller */

    /* Personel Add Page Method
     * @return object
     */
    public function getPersonelAdd()  {
        $companies = Companies::all();
        return $companies;
    }

    public function postPersonelAdd(Request $request) {
        $personel = new Personels();
        $personel->company_id = $request->company;
        $personel->name = $request->name;
        $personel->surname = $request->surname;
        $personel->title = $request->title;
        $personel->email = $request->email;
        $personel->telephone = $request->telephone;
        if ($personel->save()){
            return "ok";
        }else {
            return "error";
        }
    }


    /* Personel Update-Delete Page Method
    * @return object
    */
    public function getPersonelUpdateDelete() {
        $personels = Personels::with('company')->get();
        return $personels;
    }

    public function personelDelete($id) {
        Personels::destroy($id);
        return "ok";
    }

    /* Personel Update Page
     * @param int
     * @return object
     */
    public function personelData($id) {
        $personel = Personels::find($id);
        $companies = Companies::all();
        return $personel;
    }

    public function personelUpdate(Request $request){
        $personel = Personels::find($request->personelId);
        // $personel->company_id = $request->company;
        $personel->name = $request->name;
        $personel->surname = $request->surname;
        $personel->title = $request->title;
        $personel->email = $request->email;
        $personel->telephone = $request->telephone;
        $personel->email = $request->email;
        if($personel->save()){
            return "ok";
        }else {
            return "false";
        }
    }


}
