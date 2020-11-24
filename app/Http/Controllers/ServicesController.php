<?php

namespace App\Http\Controllers;

use App\Message;
use App\Service;
use App\Upload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ServicesController extends Controller
{
    /**
     * This Controller to Handle All Processes that No one can see it
     *
     *      Main Functions
     *
     * 1- GetPageData : function is to retrieve content of any page Using CURL
     *
     * 2- MTSchedule : function is to broadcast all MTs to Aggregator to send it to end users
     *
     * 3- CheckAFContent : function is to check content of day after tomorrow
     *
     * 4- MailOfTomorrowContent : is to mail all content of tomrrow via E-mail
     *
     *
     *      Secondary Functions
     *
     *  1- SendMT : to send MT to Aggregator
     *
     */

    /**
     * @param URL you To Fetch
     * @return Entire Page data
     * This function calling any URL And returns all data as text
     */

    public static function GetPageData($URL)
    {
//        $ch = curl_init();
//        $timeout = 500;
//        curl_setopt($ch, CURLOPT_URL, $URL);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//        $data = curl_exec($ch);
//        curl_close($ch);
//        return $data;

        $data = file_get_contents($URL);
         return $data;
    }

    /**
     * this function is to send MT (Message) to Aggregator (Isys) by calling API of them and get response from them then update this process to database
     * @param $MTID integer (Message ID in database)
     * @return int
     */

    public function SendMT($MTID)
    {
      //  $oldUrl = "http://62.150.25.34:1001/afasycontentsending/Default.aspx" ;
        // $newUrl = "http://ikwm-appvas.isys.mobi:2007/AfasyContentSending/Default.aspx"

         $Message = Message::find($MTID);
         if($Message->service_id == 18){ // Flatter  korek - Iraq
            $sc= "739";
         }elseif($Message->service_id == 40){ // Flatter   Jawal - Palestine
            $sc= "835";
         }elseif($Message->service_id == 39){ // Greeting   korek - Iraq
            $sc= "834";
         }elseif($Message->service_id == 41){ // Flatter   Watanya  - Palestine
            $sc= "837";
         }else{
            $sc= "739";
         }

         $URL = "http://212.118.7.42/SMSRouting/MtInterface?uname=IVAS&pwd=IVAS@M95&sc={$sc}&lang=1&msisdn=962797040603&msgbody=".urlencode($Message->ShortnedURL);
         //// echo $URL ; die;
        $Message->update(['TaqarubURL'=>$URL, 'TaqarubResponse'=> $this->GetPageData($URL)]);

        //echo $URL.'<br>';
        //return 0;
    }


    /**
     * This function pushes Content that is supposed to be broadcasted to subscribers of all services.
     *      Note : Only Approved Mts will be pushed
     * @return string ()
     */



   public function MTSchedule() {
        $Messages = Message::where('status', '=', true)->where('date', '=', Carbon::now()->format('Y-m-d'))->where('TaqarubURL', '=', null)->whereNull('time')->orWhere('status', '=', true)->where('date', '=', Carbon::now()->format('Y-m-d'))->where('TaqarubResponse', '!=', 'Success.')->whereNull('time')->get();

        $will_sent_count = $Messages->count();
        // notification mail
        $subject = 'Taqarub Send Now';
       // $email = 'emad@ivas.com.eg';

       $recipients = array(
        "emad@ivas.com.eg",
        "dalia.soliman@ivas.com.eg",
        "sayed@ivas.com.eg",
        "raafat.ahmed@ivas.com.eg",
        "cr@ivas.com.eg",
        "saad@ivas.com.eg"
    );

     $email = implode(',', $recipients);


        if ($Messages->count() > 0) {
            foreach ($Messages as $Message) {
                // echo $Message->id . '-----------' . '<br>';
                echo $this->SendMT($Message->id) . '<br>';
            }


     //  $this->sendMail($subject, $email);

             $this->TodayMessagesStatus();

               // show statistic for send for today
        // $send_Messages = Message::where('status', '=', true)->where('date', '=', Carbon::now()->format('Y-m-d'))->where('TaqarubResponse', '=', 'Success.')->whereNull('time')->get();
        // $sent_count = $send_Messages->count();

        // if ($will_sent_count > $sent_count) {
        //     $diff = $will_sent_count - $sent_count;
        // } else {
        //     $diff = 0;
        // }


        //     $subject2 = 'Taqarub Content for :' . Carbon::now()->format('Y-m-d');
        //    $this->sendMailCount($subject2, $email,$Messages);

        return 'Done';
        }


        return 'Not found any messages for today';



    }



     public function MTSchedule12() {
        $Messages = Message::where('status', '=', true)->where('date', '=', Carbon::now()->format('Y-m-d'))->where('TaqarubURL', '=', null)->where('time', '=', '12:00')
                ->orWhere('status', '=', true)->where('date', '=', Carbon::now()->format('Y-m-d'))->where('TaqarubResponse', '!=', 'Success.')->where('time', '=', '12:00')->get();
        // notification mail
        $subject = 'Taqarub Send Now scheduling 12:00 pm';
        $email = 'emad@ivas.com.eg';

        $this->sendMail($subject, $email);

        if ($Messages->count() > 0) {
            foreach ($Messages as $Message) {
               //  echo $Message->id . '-----------' . '<br>';
                echo $this->SendMT($Message->id) . '<br>';
            }
        }


        return 'Done 12:00 pm';
    }


     public function MTSchedule6() {
        $Messages = Message::where('status', '=', true)->where('date', '=', Carbon::now()->format('Y-m-d'))->where('TaqarubURL', '=', null)->where('time', '=', '18:00')
                ->orWhere('status', '=', true)->where('date', '=', Carbon::now()->format('Y-m-d'))->where('TaqarubResponse', '!=', 'Success.')->where('time', '=', '18:00')->get();
        // notification mail
        $subject = 'Taqarub Send Now scheduling 06:00 pm';
        $email = 'emad@ivas.com.eg';

        $this->sendMail($subject, $email);

        if ($Messages->count() > 0) {
            foreach ($Messages as $Message) {
                // echo $Message->id . '-----------' . '<br>';
                echo $this->SendMT($Message->id) . '<br>';
            }
        }


        return 'Done 06:00 pm';
    }


      public function MTSchedule9() {
        $Messages = Message::where('status', '=', true)->where('date', '=', Carbon::now()->format('Y-m-d'))->where('TaqarubURL', '=', null)->where('time', '=', '21:00')
                ->orWhere('status', '=', true)->where('date', '=', Carbon::now()->format('Y-m-d'))->where('TaqarubResponse', '!=', 'Success.')->where('time', '=', '21:00')->get();
        // notification mail
        $subject = 'Taqarub Send Now scheduling 09:00 pm';
        $email = 'emad@ivas.com.eg';

        $this->sendMail($subject, $email);

        if ($Messages->count() > 0) {
            foreach ($Messages as $Message) {
               //  echo $Message->id . '-----------' . '<br>';
                 echo $this->SendMT($Message->id) . '<br>';
            }
        }


        return 'Done 09:00 pm';
    }


      public function sendMail($subject, $email ,$Message = NULL) {

        // send mail
        $message = '<!DOCTYPE html>
					<html lang="en-US">
						<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

						</head>
						<body>
							<h2>' . $subject . '</h2>



						</body>
					</html>';

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From:  ' . $email;
        @mail($email, $subject, $message, $headers);
    }



    public function sendMailCount($subject, $email,$messages) {

        $send_Messages = Message::where('status', '=', true)->where('date', '=', Carbon::now()->format('Y-m-d'))->where('TaqarubResponse', '=', 'Success.')->get();

        $sent_count = $send_Messages->count();

        $message = "" ;
        foreach($messages as $mes){
         $status =    $mes->TaqarubResponse == "Success." ? "Yes":"NO"  ;
            $mes .= '<tr>
            <td>'.$mes->MTBody .'</td>
            <td><a href="'. $mes->ShortnedURL.'"> {{ $message->ShortnedURL }}</a></td>
            <td>'. $mes->service->title . '|'. $mes->service->operator->title.' -'. $mes->service->operator->country->name. '</td>
            <td>'.$status.'
            </td>
             </tr>' ;
        }

        $subject2 = 'Taqarub Content for :' . Carbon::now()->format('Y-m-d');
        $message2 = '<!DOCTYPE html>
        <html lang="en">
            <head>

            </head>
                <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }

        tr:nth-child(even) {
          background-color: #dddddd;
        }


        </style>
            <body>
                <p><strong>Dears,</strong> <br>Kindly find Today Messages Status</p>
                <table cellpadding="10" >
                    <thead>
                        <tr>
                            <th>Message Body</th>
                            <th>Shorten URL</th>
                            <th>Service</th>
                            <th>Sent</th>
                        </tr>
                    </thead>
                    '.$message.'

            </table>

        </body>
        </html>';

        $headers2 = 'MIME-Version: 1.0' . "\r\n";
        $headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers2 .= 'From: ' . $email;

        @mail($email, $subject2, $message2, $headers2);
    }






    /**
     * This function originally created to be put on cron to resend failed MTs
     *
     * @return string
     */
    public function MTfailResend(){
        $Messages = Message::where('status', '=', true)->where('date', '=', Carbon::now()->format('Y-m-d'))->where('TaqarubResponse','!=',"Success.")->whereNotNull('TaqarubURL')->get();
        foreach ($Messages as $Message) {
            echo $this->SendMT($Message->id).'<br>';
            //echo $Message->id.'<br>';
        }
        return 'Done';
    }


    /**
     * This function sends Email to selected Users to notify them with Messages that supposed to be sent tomorrow for each service.
     * @return string
     */
    public function toSendTomorrow()
    {

        $messages = Message::where('date', '=', Carbon::tomorrow()->format('Y-m-d'))->where('status', '=', true)->get();
        $this->sendNormalEmailTomorrow($messages);
    }


    /**
     * This function sends Email to selected Users to notify them with Messages that won't be sent tomorrow for each service with reason.
     * @return string
     */
    public function notSendTomrrow()
    {
        $Services = Service::all();
        $NotSend = array();
        foreach ($Services as $Service) {
            $Messages = Message::where('date', '=', Carbon::tomorrow()->format('Y-m-d'))->where('status', '=', true)->where('service_id', '=', $Service->id)->get();
            if ($Messages->isEmpty()) {
                $MessagesNotApproved = Message::where('date', '=', Carbon::tomorrow()->format('Y-m-d'))->where('service_id', '=', $Service->id)->get();
                if ($MessagesNotApproved->isEmpty()) {
                    //No Messages
                    $NotSend1 = new \stdClass();
                    $NotSend1->service_id = $Service->id;
                    $NotSend1->reason = 'nomts';
                    array_push($NotSend, $NotSend1);
                } else {
                    $NotSend1 = new \stdClass();
                    $NotSend1->service_id = $Service->id;
                    $NotSend1->reason = 'notappvd';
                    array_push($NotSend, $NotSend1);
                }
            }
        }
        if (empty($NotSend)) {
        } else {
            $AllServices = Service::all();
            $ArrayServices = array();
            foreach ($AllServices as $OneService) {
                $ArrayServices[$OneService->id] = $OneService->title.' | '.$OneService->operator->title.' - '.$OneService->operator->country->name;
            }
            // Mail::send('emails.notsendtomorrow', ['messages'=>$NotSend, 'ArrayServices'=>$ArrayServices], function ($t) {
            //     $t->to('emad@ivas.com.eg', 'Emad')->cc('ahmed.hegazy@ivas.com.eg', 'Hegazy')->cc('Mohamed.aly@ivas.com.eg', 'Mohamed')->cc('abdallah.mahmoud@ivas.com.eg', 'abdalla')->cc('Bassant.Salah@ivas.com.eg', 'Passant')->cc('sayed@ivas.com.eg', 'Sayed')->subject('Taqarub Reminder Mail for not approved messages Or empty services tomorrow');
            // });
            // dd($NotSend);
            $this->test2($NotSend);
        }
        return 'Email sent !';
    }

    public function TodayMessagesStatus() {

        $messages = Message::where('date', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->sendNormalEmail($messages);

    }

    public function sendNormalEmail($messages){
        $message = "" ;
        foreach($messages as $mes){
            $status =    $mes->TaqarubResponse == "Success." ? "Yes":"NO"  ;
            $message .= '<tr>
            <td>'.$mes->MTBody .'</td>
            <td><a href="'. $mes->ShortnedURL.'"> '. $mes->ShortnedURL .'</a></td>
            <td>'. $mes->service->title . '|'. $mes->service->operator->title.' -'. $mes->service->operator->country->name. '</td>
            <td>'.$status.'
            </td>
            </tr>' ;
        }


        $subject2 = 'Taqarub Today Messages Status';
        $message2 = '<!DOCTYPE html>
        <html lang="en">
            <head>

            </head>
                <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }

        tr:nth-child(even) {
          background-color: #dddddd;
        }


        </style>
            <body>
                <p><strong>Dears,</strong> <br>Kindly find Today Messages Status</p>
                <table cellpadding="10" >
                    <thead>
                        <tr>
                            <th>Message Body</th>
                            <th>Shorten URL</th>
                            <th>Service</th>
                            <th>Sent</th>
                        </tr>
                    </thead>
                    '.$message.'

            </table>

        </body>
        </html>';


        $recipients = array(
            "emad@ivas.com.eg",
            "dalia.soliman@ivas.com.eg",
            "sayed@ivas.com.eg",
            "raafat.ahmed@ivas.com.eg",
            "cr@ivas.com.eg",
            "saad@ivas.com.eg"
        );


$email = implode(',', $recipients);
        $headers2 = 'MIME-Version: 1.0' . "\r\n";
        $headers2 .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers2 .= 'From: Taqraub';

        @mail($email, $subject2, $message2, $headers2);

    }


    public function sendNormalEmailTomorrow($messages){
        $message = "" ;
        foreach($messages as $mes){
            $status =    $mes->status == 1 ? "Yes":"NO"  ;
            $message .= '<tr>
            <td>'.$mes->MTBody .'</td>
            <td><a href="'. $mes->ShortnedURL.'"> '. $mes->ShortnedURL .'</a></td>
            <td>'. $mes->service->title . '|'. $mes->service->operator->title.' -'. $mes->service->operator->country->name. '</td>
            <td>'.$status.'
            </td>
            </tr>' ;
        }


        $subject2 = 'Taqarub Messages  that will sent tomorrow';
        $message2 = '<!DOCTYPE html>
        <html lang="en">
            <head>

            </head>
                <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }

        tr:nth-child(even) {
          background-color: #dddddd;
        }


        </style>
            <body>
                <p><strong>Dears,</strong> <br>Kindly find Tommorrow Messages </p>
                <table cellpadding="10" >
                    <thead>
                        <tr>
                            <th>Message Body</th>
                            <th>Shorten URL</th>
                            <th>Service</th>
                            <th>Approved</th>
                        </tr>
                    </thead>
                    '.$message.'

            </table>

        </body>
        </html>';


        $recipients = array(
            "emad@ivas.com.eg",
            "dalia.soliman@ivas.com.eg",
            "sayed@ivas.com.eg",
            "raafat.ahmed@ivas.com.eg",
            "cr@ivas.com.eg",
            "saad@ivas.com.eg"
        );


$email = implode(',', $recipients);
        $headers2 = 'MIME-Version: 1.0' . "\r\n";
        $headers2 .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers2 .= 'From: Taqraub';

        @mail($email, $subject2, $message2, $headers2);

    }


    public function test2($messages){

        $message = "" ;
        foreach($messages as $mes){
            $mes = get_object_vars($mes);
            $sTitle = Service::where('id', $mes['service_id'])->first();
            $message .= '<tr>
            <td>'.$sTitle->title.'</td>
            <td>'.$mes['reason'].'</td>
            </tr>';
        }
        // dd($message);

        $subject2 = "Taqarub Messages that Won't sent tomorrow with reason";
        $message2 = '<!DOCTYPE html>
        <html lang="en">
            <head>

            </head>
                <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }

        tr:nth-child(even) {
          background-color: #dddddd;
        }


        </style>
            <body>
                <p><strong>Dears,</strong> <br>Kindly check Taqarub Messages that Will not sent tomorrow with reason</p>
                <table cellpadding="10" >
                    <thead>
                        <tr>
                            <th>service id</th>
                            <th>reason</th>
                        </tr>
                    </thead>
                    '.$message.'

            </table>

        </body>
        </html>';


        $recipients = array(
            "emad@ivas.com.eg",
            "dalia.soliman@ivas.com.eg",
            "sayed@ivas.com.eg",
            "raafat.ahmed@ivas.com.eg",
            "cr@ivas.com.eg",
            "saad@ivas.com.eg"
        );


$email = implode(',', $recipients);

$headers2 = 'MIME-Version: 1.0' . "\r\n";
$headers2 .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers2 .= 'From: Taqarub';

 @mail($email, $subject2, $message2, $headers2);

    }


    public function checkDuplicated(){
        for($i= 1;$i<=90 ;$i++){
            $Date = Carbon::now()->addDays($i)->format('Y-m-d');
            $Service = Service::all();
            foreach($Service as $Ser){
                $Message = Message::where('service_id','=',$Ser->id)->where('date','=',$Date)->count();
                if($Message > 1){

                    echo $Date." on ".$Ser->id.'<br>';
                }
            }
        }
    }

    public function replaceURLS(){
        $Messages = Message::where('date','>',Carbon::now()->format('Y-m-d'))->get();
        foreach($Messages as $Message){
            $ID = $Message->id;
            $OldURL = $Message->MTURL;
            $newURL = str_replace('ivas.com.eg','cms.ivas.info',$OldURL);
            Message::find($ID)->update(['MTURL'=>$newURL]);
        }
    }

    public function ApproveAllTodayContent(Request $request) {

        if( $_REQUEST['date']!= ""){
            $date = $request->input('date') ;

        }else{
            $date = Carbon::now()->format('Y-m-d') ;
        }



        $Messages = Message::where('date', '=', $date)->where('TaqarubURL', '=', null)->whereNull('time')->orWhere('date', '=', $date)->where('TaqarubResponse', '!=', 'Success.')->whereNull('time')->get();
        $will_sent_count = $Messages->count();
        // notification mail
        $subject = 'Isys Make approve to all today content';
        $email = 'emad@ivas.com.eg';

        $this->sendMail($subject, $email);

        if ($Messages->count() > 0) {
            foreach ($Messages as $Message) {
                $Message->status = 1 ;
                $Message->save();

            }
        }


          //  return 'Approve All Today Content Is Done';
        $request->session()->flash('success', "Approve All Today Content Is Done");
        return back() ;

    }


    public function removeSpaces(Request $request){
        $Messages = Message::where('date','>',Carbon::now()->format('Y-m-d'))->get();
        foreach($Messages as $Message){

            $ID = $Message->id;
            $MTBody = rtrim($Message->MTBody);
            Message::find($ID)->update(['MTBody'=>$MTBody]);
        }
        $request->session()->flash('success', "Done removeSpaces");
        return back() ;
    }

    public function approveAllComing(Request $request){
        $Messages = Message::where('status',0)->get();
        foreach($Messages as $Message){
            $ID = $Message->id;
            Message::find($ID)->update(['status'=>1]);
        }

        $request->session()->flash('success', "Done approveAllComing");
        return back() ;
    }

}
