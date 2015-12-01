<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class ApiController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return response()->json(['status'=>1]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function subscriptions()
	{
        $data = [
            [
                'id'=>1,
                'name'=>'Telephony',
                'status'=>'Active'
            ],
            [
                'id'=>2,
                'name'=>'Email',
                'status'=>'Active'
            ],
            [
                'id'=>3,
                'name'=>'SMS',
                'status'=>'Disabled'
            ],
             [
                'id'=>4,
                'name'=>'Video Call',
                'status'=>'Disabled'
            ]
            
        ];
        return response()->json(['status'=>1,'data'=>$data]);
		
	}
    public function available_apps(){
        $data = [
            [
                'id'=>1,
                'name'=>'Telephony',
                'status'=>'Subscribed'
            ],
            [
                'id'=>2,
                'name'=>'Email',
                'status'=>'Subscribed'
            ],
            [
                'id'=>3,
                'name'=>'SMS',
                'status'=>'Subscribed'
            ],
            [
                'id'=>4,
                'name'=>'CRM',
                'status'=>'Available'
            ],
            [
                'id'=>5,
                'name'=>'SimpleDB',
                'status'=>'Available'
            ]
            
        ];
        return response()->json(['status'=>1,'data'=>$data]);
    }
    public function plan($app_id){
        $data = [
            'app_id'=>$app_id,
            'plans'=>[
                [
                    'id'=>1,
                    'plan'=>'Free',
                    'descriptions'=>"gratisan bro",
                    'monthly_price'=>0
                ],
                [
                    'id'=>2,
                    'plan'=>'Starter',
                    'descriptions'=>"paket anak kos",
                    'monthly_price'=>33
                ],
                [
                    'id'=>3,
                    'plan'=>'Business',
                    'descriptions'=>"larang bro",
                    'monthly_price'=>99
                ]
            ]
        ];
        return response()->json(['status'=>1,'data'=>$data]);
    }
    public function activity($app_id){
        $daily = [
            [
                'date'=>'2015-01-01',
                'total'=>10
            ],
            [
                'date'=>'2015-01-02',
                'total'=>20
            ],
            [
                'date'=>'2015-01-03',
                'total'=>50
            ],
            [
                'date'=>'2015-01-04',
                'total'=>16
            ],
            [
                'date'=>'2015-01-05',
                'total'=>24
            ]
        ];
        $daily2 = [
            [
                'date'=>'2015-01-01',
                'total'=>30
            ],
            [
                'date'=>'2015-01-02',
                'total'=>70
            ],
            [
                'date'=>'2015-01-03',
                'total'=>60
            ],
            [
                'date'=>'2015-01-04',
                'total'=>26
            ],
            [
                'date'=>'2015-01-05',
                'total'=>4
            ]
        ];
        $daily3 = [
            [
                'date'=>'2015-01-01',
                'total'=>15
            ],
            [
                'date'=>'2015-01-02',
                'total'=>6
            ],
            [
                'date'=>'2015-01-03',
                'total'=>30
            ],
            [
                'date'=>'2015-01-04',
                'total'=>46
            ],
            [
                'date'=>'2015-01-05',
                'total'=>14
            ]
        ];
        $history = [
            ['date'=>'2015-01-01 10:15','message'=>'incoming call from +111222333'],
            ['date'=>'2015-01-01 10:20','message'=>'incoming call from +111222333'],
            ['date'=>'2015-01-01 10:21','message'=>'incoming call from +111222333'],
            ['date'=>'2015-01-01 10:23','message'=>'incoming call from +111222333'],
            ['date'=>'2015-01-01 10:24','message'=>'incoming call from +111222333'],
        ];
        $active_agents = [
            [
                'id'=>1,
                'name'=>'Jason',
                'idle'=>'10',
                'calls'=>'20',
                'hangup'=>'10',
                'durations'=>'156',
                'status'=>'onCall'
            ],
            [
                'id'=>1,
                'name'=>'Jason',
                'idle'=>'10',
                'calls'=>'20',
                'hangup'=>'10',
                'durations'=>'156',
                'status'=>'onCall'
            ],
            [
                'id'=>1,
                'name'=>'Jason',
                'idle'=>'10',
                'calls'=>'20',
                'hangup'=>'10',
                'durations'=>'156',
                'status'=>'onCall'
            ],
            [
                'id'=>1,
                'name'=>'Jason',
                'idle'=>'10',
                'calls'=>'20',
                'hangup'=>'10',
                'durations'=>'156',
                'status'=>'onCall'
            ],
            [
                'id'=>1,
                'name'=>'Jason',
                'idle'=>'10',
                'calls'=>'20',
                'hangup'=>'10',
                'durations'=>'156',
                'status'=>'onCall'
            ],
            [
                'id'=>1,
                'name'=>'Jason',
                'idle'=>'10',
                'calls'=>'20',
                'hangup'=>'10',
                'durations'=>'156',
                'status'=>'onCall'
            ]
        ];
        $data = [
            'daily'=>[
                'inbound'=>$daily,
                'outbound'=>$daily2,
                'answered'=>$daily3
            ],
            'history'=>$history,
            'summary'=>[
                'Inbound'=>99,
                'Outbound'=>5,
                'Answered'=>60,
                'Hangup'=>30,
                'Idle'=>10
            ],
            'active_agents'=>$active_agents,
            'app_id'=>$app_id,
            'last_update'=>date("Y-m-d H:i:s",time()-(60*60))
        ];
        
        return response()->json(['status'=>1,'data'=>$data]);
    }
    
    public function usage($app_id){
        $data = [
           [
                'date'=>'2015-01-01',
                'total'=>15
            ],
            [
                'date'=>'2015-02-02',
                'total'=>6
            ],
            [
                'date'=>'2015-03-03',
                'total'=>30
            ],
            [
                'date'=>'2015-04-04',
                'total'=>46
            ],
            [
                'date'=>'2015-05-05',
                'total'=>14
            ],
            [
                'date'=>'2015-06-05',
                'total'=>14
            ]
        ];
        return response()->json(['status'=>1,'data'=>$data]);
    }
    
    public function billing(){
        $data = [
          'next_due'=>date("Y-m-d",time()+(60*60*24*5)),
          'invoices'=>[
              ['id'=>1,'name'=>'January 2015','status'=>'paid','attachment'=>'invoicejanuari.pdf'],
              ['id'=>2,'name'=>'Februari 2015','status'=>'paid','attachment'=>'invoice2.pdf'],
              ['id'=>3,'name'=>'Maret 2015','status'=>'paid','attachment'=>'invoice3.pdf'],
          ],
          'owe'=>-45,
          'credits'=>15
        ];
        return response()->json(['status'=>1,'data'=>$data]);
    }

}