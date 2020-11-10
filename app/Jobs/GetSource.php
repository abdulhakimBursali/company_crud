<?php

namespace App\Jobs;

use App\Models\Companies;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GetSource implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $webAdress;
    protected $companyId;

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
     */
    public function handle()
    {
        // Original
//        $company = Companies::find($this->companyId );
//        $company->web_page_source_code = file_get_contents($this->webAdress);
//        $company->save();




        $company = Companies::find($this->companyId );
        $string = file_get_contents($this->webAdress);
        $site = preg_replace('/\s\s+/', ' ', $string);


        $company->web_page_source_code=$site;




        $company->save();








//        Storage::put( 'file.txt',file_get_contents($this->webAdress));
    }
}
