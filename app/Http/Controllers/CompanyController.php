<?php

namespace App\Http\Controllers;

use App\Jobs\GetSource;
use App\Models\Adresses;
use App\Models\Companies;
use App\Models\Personels;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /* Add New Company
     * @param request object
     * @return string
     */
    public function addCompany(Request $request):string{
        $company = new Companies();
        $company->name = $request->companyName;
        $company->internet_address = $request->webAdres;
        $company->web_page_source_code = 'will create';
        $company->save();
        GetSource::dispatch($company->id, $request->webAdres); // JOB
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

    /* Show Company update delete page
    * @param
    * @return object
    */
    public function updateDeletePage():object{
        $companies = Companies::with('adresses')->get();
        return view('company_update_delete', compact('companies'));
    }

    /* Show Company update page
     * @param int(company id)
     * @return object
     */
    public function updatePage($id):object{
            $company = Companies::with('adresses')->find($id);
            return view('company_update', compact('company'));
    }

    /* Update Company Data
     * @param request object
     * @return string
     */
    public function updateCompanyData(Request $request):string{
        // Validate Request
        $company = Companies::find($request->companyId);
        $company->name = $request->companyName;
        $company->internet_address = $request->webAdres;
        $company->save();
        GetSource::dispatch($company->id, $request->webAdres);
        return "company updated";
    }

    /* Company adress data destroy
     * @param reques object
     * @return string
     *
     */
    public function deleteAdress(Request $request):string{
        Adresses::destroy($request->adressId);
        return "adress deleted";
    }

    /* Delete company
     * @param request object
     * @return string
     */
    public function deleteCompany(Request $request):string{
        Adresses::where('company_id', $request->companyId)->delete();
        Personels::where('company_id', $request->companyId)->delete();
        Companies::destroy($request->companyId);
        return "company deleted";
    }





















}



