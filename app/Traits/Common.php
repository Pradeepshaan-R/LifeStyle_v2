<?php
namespace App\Traits;

use App\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
// use Auth;

/**
 * Common date related functions grouped as a Trait
 * Author: Azmeer (2020-05-17)
 *
 * USAGE: in the controller
 *
 * use App\Traits\Common;
 * class xController extends Controller
 * {
 *    use Common;
 *
 * within a function:
 *  $this->lk2db("17/5/2020");
 *
 * We need to honor tenants.financial_year to decide the starting month, ie: JAN or APRIL for calendar/financial period
 * calendar year = JAN to DEC
 * financial year = APR (this year) to MAR (next year)*
 */
trait Common
{
    /**
     * Converts LK date type to mysql type:
     * 17/05/2020 to 2020-05-17
     */
    public function lk2db(string $date)
    {
        $new_date = implode("-", array_reverse(explode("/", $date)));
        return $new_date;
    }

/**
 * Converts mysql date type to LK date:
 *  2020-05-17 to 17/05/2020
 */
    public function db2lk($date)
    {
        $new_date = implode("/", array_reverse(explode("-", $date)));
        return $new_date;
    }

/**
 * In order to re-use controllers for both web and mobile access
 * this function can be used, just before sending the output
 * if it's true we send JSON, else return to Blade
 */
    public function isApi()
    {
        if (\Request::is('api*')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sending SMS via AirTel using Guzzle > GET
     */
    public function sendSms($mobile, $message)
    {
        // $url = "https://secure.textware.lk/?username=ebaseasia&password=Ebay123&src=ACRM&dst=" . $mobile . "&msg=" . $message . "&dr=1";
        $url = "https://secure.textware.lk/?username=ebaseasia&password=Ebay123&src=ACRM&dst=" . $mobile . "&msg=" . $message . "&dr=1";
        $response = Http::get($url);

        return ($response->getBody());
    }
}
