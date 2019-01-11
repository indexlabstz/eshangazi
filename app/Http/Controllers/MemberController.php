<?php

namespace App\Http\Controllers;

use App\Member;
use App\Platform;
use App\District;
use App\ItemCategory;
use App\Conversation;
use BotMan\BotMan\BotMan;
use BotMan\Drivers\Facebook\FacebookDriver;
use BotMan\Drivers\Slack\SlackDriver;
use BotMan\Drivers\Telegram\TelegramDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::paginate(10);

        return view('members.index', ['members' => $members]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BotMan $bot
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BotMan $bot)
    {
        $user = $bot->getUser();
        $driver = $bot->getDriver()->getName();
        $extras = $bot->getMessage()->getExtras();
        $apiReply = $extras['apiReply'];

        $bot->typesAndWaits(1);

        if (!$this->check($user)) {
            $incomplete = $extras['apiActionIncomplete'];

            if ($incomplete) {
                $bot->reply($apiReply);
            } else {
                $this->subscribe($user, $extras, $driver);

                if ($driver === 'Facebook') {
                    $bot->reply($apiReply);
                }

                $bot->reply($this->features($apiReply, $driver));
            }
        } else {
            $bot->reply($this->features($apiReply, $driver));
        }
    }

    /**
     * Reply to a member who reject ot give data
     *
     * @param BotMan $bot
     *
     * @return void
     */
    public function reject(BotMan $bot)
    {
        $driver = $bot->getDriver()->getName();
        $extras = $bot->getMessage()->getExtras();

        $apiReply = $extras['apiReply'];

        $bot->typesAndWaits(1);

        $bot->reply($apiReply);
        $bot->reply($this->features($apiReply, $driver));
    }

    /**
     * Check if Member exists.
     *
     * @return bool
     */
    public function check($user)
    {
        $member = Member::where('user_platform_id', '=', $user->getId())->first();

        return $member ? true : false;
    }

    /**
     * Listen for Get Started action for new Member.
     *
     * @param BotMan $bot
     *
     * @return void
     */
    public function started(BotMan $bot)
    {
        $user = $bot->getUser();
        $driver = $bot->getDriver()->getName();
        $extras = $bot->getMessage()->getExtras();

        $apiReply = $extras['apiReply'];

        $bot->typesAndWaits(1);

        if ($driver === 'Web') {
            $bot->reply($this->features($apiReply, $driver));
        } else {
            if ($this->check($user)) {
                $bot->reply('Karibu tena ' . $user->getFirstName());
                $bot->reply($this->features($apiReply, $driver));
            } else {
                $Question = Question::create('Ili niweze kukuhudumia kwa ufasaha, ningependa kukuuliza maswali mawili!')
                    ->fallback('Unable to ask question')
                    ->callbackId('confirm_subscribe')
                    ->addButtons([
                        Button::create('Sawa niulize')->value('sawa'),
                        Button::create('Baadae')->value('hapana')
                    ]);

                $bot->reply($apiReply);
                $bot->reply($Question);
            }
        }
    }

    /**
     * Subscribe new Member
     *
     * @param $user
     * @param $extras
     * @param $driver
     *
     * @return void
     */
    public function subscribe($user, $extras, $driver)
    {
        $age = $extras['apiParameters']['age'];
        $district = $extras['apiParameters']['district'];
        $born_year = date('Y') - $age;
        $platform_id = $this->getPlatformId($driver);
        $profile_pic = $this->getUserProfilePic($user, $driver);
        $gender = $this->getUserGender($user, $driver);

        $district = District::where('name', '=', $district)->first();
        if ($district) {
            $district_id = $district->id;
        } else {
            $district_id = null;
        }

        $member = Member::create([
            'user_platform_id' => $user->getId(),
            'name' => $user->getFirstName() . ' ' . $user->getLastName(),
            'avatar' => $profile_pic,
            'born_year' => $born_year,
            'gender' => $gender,
            'platform_id' => $platform_id,
            'district_id' => $district_id,
        ]);

        if ($member) {
            Conversation::create([
                'intent' => 'Subscribe',
                'member_id' => $member->id
            ]);
        }
    }

    /**
     * Unsubscribe Member from receiving updates from the System0
     * .
     * @param BotMan $bot
     *
     * @return void
     */
    public function unsubscribe(BotMan $bot)
    {
        $user = $bot->getUser();

        $member = Member::where('user_platform_id', '=', $user->getId());

        if ($member) {
            $extras = $bot->getMessage()->getExtras();

            $apiReply = $extras['apiReply'];

            $bot->typesAndWaits(1);
            $bot->reply($apiReply);

            $member->update([
                'status' => 0
            ]);

            Conversation::create([
                'intent' => 'Unsubscribe',
                'member_id' => $member->id
            ]);
        }
    }

    /**
     * Display a list of bot features in a Generic Template.
     *
     * @param $reply
     *
     * @return Question
     *
     */
    public function features($reply, $driver)
    {
        $categories = ItemCategory::inRandomOrder()->take(7)->get();

        if ($driver === 'Facebook') {
            $features = GenericTemplate::create()
                ->addImageAspectRatio(GenericTemplate::RATIO_HORIZONTAL);
            foreach ($categories as $category) {
                $features->addElements([
                    Element::create($category->name)
                        ->subtitle($category->description)
                        ->image(env('AWS_URL') . '/' . $category->thumbnail)
                        ->addButton(ElementButton::create('Fahamu Zaidi')
                            ->payload($category->name)->type('postback'))
                ]);
            }

            return $features;

        } else {
            $features = Question::create($reply)
                ->fallback('Unable to show  features')
                ->callbackId('features_list');

            foreach ($categories as $category) {
                $features->addButtons([
                    Button::create($category->display_title)->value($category->name)
                ]);
            }

            return $features;
        }
    }

    /**
     * Get platform id of user based on driver
     *
     * @param $driver
     *
     * @return int or null
     */
    public function getPlatformId($driver)
    {
        $platform = Platform::where('name', '=', $driver)->first();

        if (!$platform)
            $platform_id = null;
        else
            $platform_id = $platform->id;

        return $platform_id;
    }

    /**
     * return user profile pic based on driver
     *
     * @param $user
     * @param $driver
     *
     * @return string
     *
     */
    public function getUserProfilePic($user, $driver)
    {
        if ($driver === 'Facebook') {
            return $profile_pic = $user->getInfo()["profile_pic"];
        } elseif ($driver === 'Slack') {
            return $profile_pic = $user->getInfo()["profile"]["image_original"];
        }

        return null;
    }

    /**
     * return user gender based on driver
     *
     * @param $user
     * @param $driver
     *
     * @return string
     *
     */
    public function getUserGender($user, $driver)
    {
        if ($driver === 'Facebook') {
            return $gender = $user->getInfo()["gender"];
        }

        return null;
    }

    /**
     * Show list of all features
     *
     * @param BotMan $bot
     */
    public function showFeatures(BotMan $bot)
    {
        $user = $bot->getUser();
        $driver = $bot->getDriver()->getName();
        $extras = $bot->getMessage()->getExtras();

        $apiReply = $extras['apiReply'];

        if ($driver == 'Web') {
            $bot->reply($this->features($apiReply, $driver));
        } else {
            $bot->typesAndWaits(1);

            $bot->reply($user->getFirstName() . ' ' . $apiReply);

            $bot->typesAndWaits(2);
            $bot->reply($this->features($apiReply, $driver));
        }
    }

    /**
     * function to create a message to a single member
     * @param Member $member
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createMessage(Member $member)
    {
        return view('members.send', ['member' => $member]);
    }

    /**
     * function to send a message to a single member
     * @param Member $member
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Request $request, Member $member)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'thumbnail' => 'image'
        ]);

        $bot = app('botman');

        if ($request->hasFile('thumbnail')) {
            $thumbnail_path = Storage::disk('s3')
                ->putFile('public/member-message-thumbnails', $request->file('thumbnail'), 'public');

            $attachment = new Image(env('AWS_URL') . '/' . $thumbnail_path);

            $image_message = OutgoingMessage::create($request->title)->withAttachment($attachment);
        }

        $message = $request->title . "\n" . $request->description;
        $driver = "\BotMan\Drivers\\" . $member->platform->driver_class;

        if ($member->platform->name == 'Facebook') {
            if ($request->hasFile('thumbnail')) {
                $bot->say($image_message, $member->user_platform_id, FacebookDriver::class);
            }

            $bot->say($message, $member->user_platform_id, FacebookDriver::class);
        } elseif ($member->platform->name == 'Slack') {
            if ($request->hasFile('thumbnail')) {
                $bot->say($image_message, $member->user_platform_id, SlackDriver::class);
            }

            $bot->say($message, $member->user_platform_id, SlackDriver::class);
        } elseif ($member->platform->name == 'Telegram') {
            if ($request->hasFile('thumbnail')) {
                $bot->say($image_message, $member->user_platform_id, TelegramDriver::class);
            }

            $bot->say($message, $member->user_platform_id, TelegramDriver::class);
        }
        return back();
    }
}
