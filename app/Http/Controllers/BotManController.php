<?php

namespace App\Http\Controllers;

use App\Member;
use App\Conversation;
use App\Platform;
use BotMan\BotMan\BotMan;
use App\Http\Conversations\FeedbackConversation;
use App\Http\Conversations\QuizConversation;
use App\Http\Conversations\SmsQuizConversation;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->listen();
    }

    /**
     * @return Factory|View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     *
     * @param  BotMan $bot
     */
    public function quizConversation(BotMan $bot)
    {
        if($bot->getDriver()->getName() === 'Web'){
            $bot->startConversation(new SmsQuizConversation());
        }else{
            $bot->startConversation(new QuizConversation());
        }

        $member = Member::where('user_platform_id', '=', $bot->getUser()->getId())->first();

        if($member) {
            Conversation::create([
                'intent'    => 'Question and Answers',
                'member_id' => $member->id
            ]);
        }
    }

    /**
     * Loaded through routes/botman.php
     *
     * @param  BotMan $bot
     */
    public function feedback(BotMan $bot)
    {
        $member = Member::where('user_platform_id', '=', $bot->getUser()->getId())->first();

        if (! $member) {
            $user = $bot->getUser();
            $driver = $bot->getDriver()->getName();
            $age = null;
            $district_id = null;
            $born_year = null;
            $platform_id = $this->getPlatformId($driver);
            $profile_pic = $this->getUserProfilePic($user, $driver);
            $gender = $this->getUserGender($user, $driver);

            $member = Member::create([
                'user_platform_id' => $user->getId(),
                'name' => $user->getFirstName() . ' ' . $user->getLastName(),
                'avatar' => $profile_pic,
                'born_year' => $born_year,
                'gender' => $gender,
                'platform_id' => $platform_id,
                'district_id' => $district_id,
            ]);
        }

        $bot->startConversation(new FeedbackConversation());

        if($member)
        {
            Conversation::create([
                'intent'    => 'Feedback',
                'member_id' => $member->id
            ]);
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
            $gender = $user->getInfo()["gender"] ?? null;
            return $gender;
        }

        return null;
    }

    public function listener(BotMan $bot)
    {
        $extras = $bot->getMessage()->getExtras();

        $apiReply = $extras['apiReply'];

        $bot->typesAndWaits(1);

        $bot->reply($apiReply);
    }
}
