<?php

namespace App\Http\Conversations;

use App\Ad;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use BotMan\BotMan\Messages\Conversations\Conversation;

class AdConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->startCov();
    }

    public function startCov(){
        $driver = $this->bot->getDriver()->getName();
        $ads = Ad::inRandomOrder()->take(1)->get();
        if($ads){
            if($driver == 'Facebook'){
                $this->say($this->toFacebook($ads));
            }
        }
    }

    /**
     * Show a list of other items.
     *
     * @param $bot->getUser()
     *
     * @return string
     */
    public function toFacebook($ads)
    {
        $ad = GenericTemplate::create()
            ->addImageAspectRatio(GenericTemplate::RATIO_HORIZONTAL)
            ->addElements([
                Element::create($ads->title)
                    ->subtitle($ads->description)
                    ->image(env('AWS_URL') . '/' . $ads->thumbnail)
            ]);

        return $ad;
    }
}
