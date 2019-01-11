<?php

namespace App\Http\Controllers;

use App\Ward;
use App\Center;
use App\Member;
use App\Partner;
use App\District;
use App\Conversation;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use Zttp\Zttp;

class CenterController extends Controller
{
    /**
     * Center Controller constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers = Center::paginate(10);

        return view('centers.index', ['centers' => $centers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wards = Ward::all('id', 'name');
        $partners = Partner::all('id', 'name');

        return view('centers.create', [
            'wards' => $wards,
            'partners' => $partners,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $thumbnail_path = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail_path = Storage::disk('s3')
                ->putFile('public/center-thumbnails', $request->file('thumbnail'), 'public');
        }

        Center::create([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnail_path,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'website' => $request->website,
            'ward_id' => $request->ward_id,
            'partner_id' => $request->partner_id,
            'created_by' => auth()->id()
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Center $center
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Center $center)
    {
        return view('centers.show', ['center' => $center]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Center $center
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Center $center)
    {
        $wards = Ward::all('id', 'name');
        $partners = Partner::all('id', 'name');

        return view('centers.edit', [
            'center' => $center,
            'wards' => $wards,
            'partners' => $partners,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Center $center
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Center $center)
    {
        $thumbnail_path = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail_path = Storage::disk('s3')
                ->putFile('public/center-thumbnails', $request->file('thumbnail'), 'public');
        }

        $center->update([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnail_path ? $thumbnail_path : $center->thumbnail,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'website' => $request->website,
            'ward_id' => $request->ward_id,
            'partner_id' => $request->partner_id,
            'updated_by' => auth()->id()
        ]);

        return redirect()->route('show-center', $center);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Center $center
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Center $center)
    {
        if (Storage::disk('s3')->exists($center->thumbnail))
            Storage::disk('s3')->delete($center->thumbnail);

        $center->delete();

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

        $name = $extras['apiParameters'][env('APP_ACTION') . '-centers'];


        $bot->typesAndWaits(1);
        $bot->reply($apiReply);

        $member = Member::where('user_platform_id', '=', $bot->getUser()->getId())->first();

        if(env('APP_NAME') == 'eShangazi') {
            $template_list = GenericTemplate::create()->addImageAspectRatio(GenericTemplate::RATIO_HORIZONTAL);
            $url = 'https://s3.us-east-2.amazonaws.com/eshangazi-bot/public/center-thumbnail/maps.jpg';

            if ($member) {
                $district = District::with('region')->where('id', $member->district_id)->first();

                $response = Zttp::get('http://opendata.go.tz/api/action/datastore_search?resource_id=1fbc4c63-9c74-4337-ba04-f52b3d6adb0e&q='. $district->region->name . '&limit=5');
                $centers = $response->json()['result']['records'];

                foreach ($centers as $center) {
                    $template_list->addElements([
                        Element::create($center['FACILITY_NAME'])
                            ->subtitle('Kituo hiki kipo ' . $center['COUNCIL'] . ' mkoani ' . $center['REGION'])
                            ->image($url)
                            ->addButton(ElementButton::create('Ona Ramani')
                                ->url('http://maps.google.com/?q=' . $center['LATITUDE'] . ',' . $center['LONGITUDE']))
                    ]);
                }
            } else {
                $response = Zttp::get('http://opendata.go.tz/api/action/datastore_search?resource_id=83b7cd61-0a03-4b9a-8572-7eb4eb2f3af7&limit=5');
                $centers = $response->json()['result']['records'];

                foreach ($centers as $center) {
                    $template_list->addElements([
                        Element::create($center['FACILITY_NAME'])
                            ->subtitle('Kituo hiki kipo ' . $center['COUNCIL'] . ' mkoani ' . $center['REGION'])
                            ->image($url)
                            ->addButton(ElementButton::create('Ona Ramani')
                                ->url('http://maps.google.com/?q=' . $center['LATITUDE'] . ',' . $center['LONGITUDE']))
                    ]);
                }
            }

            $bot->typesAndWaits(1);
            $bot->reply($template_list);
        } else {
            if ($name) {
                $center = Center::with('services')->where('name', '=', $name)->first();

                $bot->typesAndWaits(1);
                $bot->reply($center->description);
            } else {

                $centers = Center::inRandomOrder()->take(5)->get();

                $bot->typesAndWaits(1);

                if ($centers) {
                    $bot->reply($this->centers($centers));
                } else {
                    $bot->reply('Kumradhi, sijaweza pata vituo kwa sasa.');
                }
            }
        }

        if ($member) {
            Conversation::create([
                'intent' => 'Service delivery points',
                'member_id' => $member->id
            ]);
        }
    }

    /**
     * Show a list of Centers in a Generic Template.
     *
     * @param $centers
     *
     * @return \BotMan\Drivers\Facebook\Extensions\GenericTemplate
     *
     */
    public function centers($centers)
    {
        $template_list = GenericTemplate::create()->addImageAspectRatio(GenericTemplate::RATIO_HORIZONTAL);

        foreach ($centers as $center) {
            $url = null;

            if ($center->thumbnail) {
                $url = env('AWS_URL') . '/' . $center->thumbnail;
            } else {
                $url = env('APP_URL') . '/img/logo.jpg';
            }

            $template_list->addElements([
                Element::create($center->name)
                    ->subtitle($center->description)
                    ->image($url)
                    ->addButton(ElementButton::create('Fahamu zaidi')
                        ->payload($center->name)->type('postback'))
                    ->addButton(ElementButton::create('Piga Simu')
                        ->payload($center->phone)->type('phone_number'))
            ]);
        }

        return $template_list;
    }

    /**
     * Show a list of Services for a particular center in a Generic Template.
     *
     * @param $center
     *
     * @return \BotMan\Drivers\Facebook\Extensions\GenericTemplate
     *
     */
    public function services($center)
    {
        $template_list = GenericTemplate::create()->addImageAspectRatio(GenericTemplate::RATIO_HORIZONTAL);

        foreach ($center->services as $service) {
            $url = null;

            if ($service->thumbnail)
                $url = env('AWS_URL') . '/' . $service->thumbnail;
            else
                $url = env('APP_URL') . '/img/logo.jpg';

            $template_list->addElements([
                Element::create($service->name)
                    ->subtitle($service->description)
                    ->image($url)
                    ->addButton(ElementButton::create('Fahamu zaidi')
                        ->payload($service->name)->type('postback'))
            ]);
        }

        return $template_list;
    }
}
