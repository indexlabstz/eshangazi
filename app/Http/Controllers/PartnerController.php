<?php

namespace App\Http\Controllers;

use App\Member;
use App\Partner;
use App\District;
use App\PartnerCategory;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;

class PartnerController extends Controller
{
    /**
     * Partner Category Controller constructor.
     *
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::paginate(10);
        
        return view('partners.index', ['partners' => $partners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partner_categories = PartnerCategory::all('id', 'name');

        $districts          = District::all();
        return view('partners.create', [
            'partner_categories' => $partner_categories,
            'districts'          => $districts
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Partner::create([
            'name'                  => $request->name,
            'bio'                   => $request->bio,
            'partner_category_id'   => $request->partner_category_id,
            'phone'                 => $request->phone,
            'email'                 => $request->email,
            'address'               => $request->address,
            'district_id'           => $request->district_id,
            'created_by'            => auth()->id()
        ]);
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Partner $partner
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        return view('partners.show', ['partner' => $partner]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Partner $partner
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        $partner_categories = PartnerCategory::all('id', 'name');
        $districts = District::all('id', 'name');

        return view('partners.edit', [
                'partner'               => $partner,
                'partner_categories'    => $partner_categories,
                'districts'             => $districts
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request     *
     * @param  Partner $partner
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {

        $partner->update([
            'name'                  => $request->name,
            'bio'                   => $request->bio,
            'partner_category_id'   => $request->partner_category_id,
            'phone'                 => $request->phone,
            'email'                 => $request->email,
            'address'               => $request->address,
            'district_id'           => $request->district_id,
            'updated_by'            => auth()->id()
        ]);

        return redirect()->route('show-partner', $partner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Partner $partner
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return back();
    }

    /**
     * Display Generic Template .
     *
     * @param  BotMan $bot
     * 
     * @return void
     */
    public function showBotMan(BotMan $bot)
    {
        $extras = $bot->getMessage()->getExtras();        
        $apiReply = $extras['apiReply'];
        $driver = $bot->getDriver()->getName();

        $bot->typesAndWaits(1);
        $bot->reply($apiReply);  

//        $user = $bot->getUser();

//        $member = Member::with('district')
//            ->where('user_platform_id', '=', $user->getId())->first();

        $partners = Partner::where('partner_category_id', 1)->take(5)->get();

        // foreach($partners as $partner)
        // {
        //     $bot->typesAndWaits(1);
        //     $bot->reply($partner->id);
        // }
            

        $bot->reply($this->partners($partners, $driver));

        //$this->getNearExperts($bot, $partners, $user, $member);
    }

    /**
     * Get a list of Experts based on District as Location for a Member..
     *
     * @param  BotMan $bot
     * 
     * @return void
     */
    public function showByDistrictBotMan(BotMan $bot)
    {
        $extras = $bot->getMessage()->getExtras();        
        $apiReply = $extras['apiReply'];
        $driver = $bot->getDriver()->getName();

        $district = $extras['apiParameters'][env('APP_ACTION') . '-districts'];

        $bot->typesAndWaits(1);
        $bot->reply($apiReply);

        if($district)
        {
            $district = District::with('centers')->where('name', '=', $district)->first();

            $partners = Partner::where('district_id', '=', $district->id)->inRandomOrder()->take(5)->get();

            $bot->typesAndWaits(2);
            $bot->reply($this->partners($partners,  $driver));
        } 
        else
        {           
            //$user = $bot->getUser();

//            $bot->reply('Hey ' . $user->getFirstName() .
//                ', I could not find Experts at ' . $district .
//                ', I have these suggestions.');

            $partners = Partner::where('district_id', '=', $district->id)->inRandomOrder()->take(5)->get();         
            
            $bot->typesAndWaits(1);
            $bot->reply($this->partners($partners,  $driver));                      
        }        
    }

    /**
     * Display a list of Experts near a particular Member in Generic Template.
     *
     * @param $partners
     *
     * @return \BotMan\Drivers\Facebook\Extensions\GenericTemplate
     */
    public function partners($partners, $driver)
    {
        if($driver === 'Web'){
            $template_list = Question::create('Wataalamu')
                ->fallback('Unable to show  features')
                ->callbackId('features_list');

            foreach ($partners as $partner) {
                $message = $partner->name.". namba ya simu ".$partner->phone;
                $template_list->addButtons([
                    Button::create($message)->value($partner->name)
                ]);
            }
        }else{                   
            $template_list = GenericTemplate::create()
                                ->addImageAspectRatio(GenericTemplate::RATIO_HORIZONTAL);
            
            $url = null;
            foreach($partners as $partner)
            {
                if ($partner->thumbnail)
                    $url = env('AWS_URL') . '/' . $partner->thumbnail;
                else
                    $url = env('AWS_URL') . '/public/experts-thumbnail/experts.jpg';
                $template_list->addElements([
                    Element::create($partner->name)
                        ->subtitle($partner->bio)
                        ->image($url)
                        ->addButton(ElementButton::create('Piga simu')
                            ->payload($partner->phone)->type('phone_number'))
                ]);
            }
        }

        return $template_list;
    }

    /**
     * Display a list of Experts found near particular Member.
     *
     * @param BotMan $bot
     * @param $partners
     * @param $user
     * @param $member
     *
     * @return void
     */
    public function getNearExperts(BotMan $bot, $partners, $user, $member)
    {
        $driver = $bot->getDriver()->getName();
        if (!$partners->isEmpty()) {
            $bot->reply($this->partners($partners, $driver));
        } else {
//            $bot->reply('Hey ' . $user->getFirstName() .
//                ', I could not find Experts at ' . $member->district->name .
//                ', I have these suggestions.');

            $partners = Partner::inRandomOrder()->take(5)->get();

            $bot->typesAndWaits(1);
            $bot->reply($this->partners($partners, $driver));
        }
    }
}
