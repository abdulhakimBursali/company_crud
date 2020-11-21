<?php

namespace App\Jobs;

use App\Models\Companies;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetSource implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $webAdress;
    protected $companyId;
    protected $userID = "4d2a5373-06ca-4d3e-9195-64131eb60e00";
    protected $apiKey = "756c8813-ac90-49d6-90f3-a720308824f6";

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($companyId, $webAdress)
    {
        //
        $this->companyId = $companyId;
        $this->webAdress = $webAdress;
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     */
    public function handle()
    {
        $company = Companies::find($this->companyId );
        $webPageSource = file_get_contents($this->webAdress);
        $company->web_page_source_code = $webPageSource;
        //
//        $data = array('html'=>$webPageSource);
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, "https://hcti.io/v1/image");
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//        curl_setopt($ch, CURLOPT_POST, 1);
//        // Retrieve your user_id and api_key from https://htmlcsstoimage.com/dashboard
//        curl_setopt($ch, CURLOPT_USERPWD, $this->userID . ":" . $this->apiKey);
//        $headers = array();
//        $headers[] = "Content-Type: application/x-www-form-urlencoded";
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//        $result = curl_exec($ch);
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        }
//        curl_close ($ch);
//        $res = json_decode($result,true);
//        $company->thumbnail = $res['url'];
        //
        $company->thumbnail = "will create";
        $company->save();
    }
}
