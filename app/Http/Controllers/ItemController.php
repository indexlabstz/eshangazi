<?php

namespace App\Http\Controllers;

use App\Item;
use App\Member;
use App\Conversation;
use App\ItemCategory;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;


class ItemController extends Controller
{
    /**
     * Item Controller constructor
     *
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
        $items = Item::paginate(10);

        return view('items.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all('id', 'title');
        $item_categories = ItemCategory::all('id', 'name');

        return view('items.create', [
            'items' => $items,
            'item_categories' => $item_categories
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
                ->putFile('public/item-thumbnails', $request->file('thumbnail'), 'public');
        }

        Item::create([
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $thumbnail_path,
            'gender' => $request->gender,
            'minimum_age' => $request->minimum_age,
            'display_title' => $request->display_title,
            'item_category_id' => $request->item_category_id,
            'item_id' => $request->item_id,
            'created_by' => auth()->id()
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {

        $items = Item::all('id', 'title');
        $item_categories = ItemCategory::all('id', 'name');

        return view('items.edit', [
            'item' => $item,
            'items' => $items,
            'item_categories' => $item_categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $thumbnail_path = null;

        if ($request->hasFile('thumbnail')) {
            if (Storage::disk('s3')->exists($item->thumbnail)) {
                Storage::disk('s3')->delete($item->thumbnail);
            }

            $thumbnail_path = Storage::disk('s3')
                ->putFile('public/item-thumbnails', $request->file('thumbnail'), 'public');
        }

        $item->update([
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $thumbnail_path ? $thumbnail_path : $item->thumbnail,
            'gender' => $request->gender,
            'minimum_age' => $request->minimum_age,
            'display_title' => $request->display_title,
            'item_category_id' => $request->item_category_id,
            'item_id' => $request->item_id,
            'updated_by' => auth()->id()
        ]);

        return redirect()->route('show-item', $item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return back();
    }

    /**
     * Display a listing of the deleted items.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDeleted()
    {
        $items = Item::onlyTrashed()->paginate(10);

        return view('items.trash', ['items' => $items]);
    }

    /**
     * Restore trashed Item.
     *
     * @param Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreTrashed($item)
    {
        Item::onlyTrashed()->find($item)->restore();

        return back();
    }

    /**
     * Permanent delete of trashed Item.
     *
     * @param Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyTrashed($item)
    {
        $item = Item::onlyTrashed()->find($item);

        if (Storage::disk('s3')->exists($item->thumbnail)) {
            Storage::disk('s3')->delete($item->thumbnail);
        }

        $item->forceDelete();

        return back();
    }

    /**
     * Show particular Item requested by a member.
     *
     * @param BotMan $bot
     *
     * @return void
     */
    public function showBotMan(BotMan $bot)
    {
        $extras = $bot->getMessage()->getExtras();
        $driver = $bot->getDriver()->getName();
        $user = $bot->getUser();

        $title = $extras['apiParameters'][env('APP_ACTION') . '-items'];

        $item = Item::where('title', 'ilike', $title)->first();

        $bot->typesAndWaits(1);

        if ($item) {
            $attachment = new Image(env('AWS_URL') . '/' . $item->thumbnail);
            $message = OutgoingMessage::create($item->description)->withAttachment($attachment);

            if ($item->items->isEmpty()) {
                if ($driver == 'Web') {
                    $bot->reply($item->description);
                    $bot->reply($this->customFeaturesSms());
                } else {
                    $bot->reply($message);

                    $bot->typesAndWaits(2);

                    $bot->reply($item->description);

                    $bot->typesAndWaits(2);

                    $bot->reply($this->customFeatures($user));
                }
            } else {
                if ($driver == 'Facebook') {
                    $bot->reply($message);

                    $bot->typesAndWaits(2);

                    $bot->reply($this->toFacebook($item));
                } elseif ($driver == 'Slack' || $driver == 'Telegram') {
                    $bot->reply($message);

                    $bot->typesAndWaits(2);

                    $bot->reply($this->toSlackTelegram($item));
                } else {
                    $bot->reply($this->toWebb($item));
                }
            }
        } else {
            $bot->reply('Naendelea kukusanya taarifa zaidi, kuhusu ' . $title);
        }


        $member = Member::where('user_platform_id', '=', $bot->getUser()->getId())->first();

        if ($member) {
            Conversation::create([
                'intent' => $title,
                'member_id' => $member->id
            ]);
        }
    }

    /**
     * Show a list of Items found for a particular category request from Slack or Telegram Driver.
     *
     * @param $item
     *
     * @return Question
     *
     */
    public function toSlackTelegram($item)
    {
        $child_items = $item->items()->inRandomOrder()->take(5)->get();

        $features = Question::create($item->description)
            ->fallback('Kumradhi, sijaweza pata taarifa zaidi kuhusu' . $item->title)
            ->callbackId('item');

        foreach ($child_items as $itemm) {
            $features->addButtons([
                Button::create($itemm->display_title)->value($itemm->title)
            ]);
        }

        return $features;
    }

    /**
     * Show a list of Items found for a particular category request from Facebook Driver.
     *
     * @param $item
     *
     * @return ButtonTemplate
     *
     */
    public function toFacebook($item)
    {
        $child_items = $item->items()->inRandomOrder()->take(3)->get();

        $template_list = ButtonTemplate::create($item->description);

        foreach ($child_items as $itemm) {
            $template_list->addButton(
                ElementButton::create($itemm->display_title)->type('postback')->payload($itemm->title)
            );
        }

        return $template_list;
    }

    /**
     * Show a list of Items found for a particular category request from Web Driver.
     *
     * @param $item
     *
     * @return string
     *
     */
    public function toWeb($item)
    {
        $child_items = $item->items()->inRandomOrder()->take(5)->get();

        $message = "";
        $count = 1;

        foreach ($child_items as $itemm) {
            if ($count == 1)
                $message .= $itemm->title;
            else {
                $message .= ", \n" . $itemm->title;
            }
            $count++;
        }

        return $message;
    }

    /**
     * Show a list of Items found for a particular item request from Web Driver.
     *
     * @param $item
     *
     * @return string
     */
    public function toWebb($item)
    {
        $child_items = $item->items()->inRandomOrder()->take(7)->get();

        $features = Question::create($item->description)
            ->fallback('Kumradhi, sijaweza pata taarifa zaidi kuhusu' . $item->title)
            ->callbackId('item');

        foreach ($child_items as $itemm) {
            $features->addButtons([
                Button::create($itemm->display_title)->value($itemm->title)
            ]);
        }

        return $features;
    }

    /**
     * Show a list of other items.
     *
     * @return string
     *
     */
    public function customFeaturesSms()
    {
        $features = Question::create('Pia unaweza angalia vitu hivi!')
            ->fallback('Kumradhi, sijaweza kuuliza')
            ->callbackId('item')
            ->addButtons([
                Button::create('Kwa msaada zaidi')->value('msaada wa mtaalamu'),
                Button::create('Vituo vya huduma')->value('Vituo vya huduma'),
                Button::create('Rudi mwanzo')->value('features'),
                Button::create('Asante inatosha')->value('asante')
            ]);

        return $features;
    }

    /**
     * Show a list of other items.
     *
     * @param $user
     *
     * @return string
     *
     */
    public function customFeatures($user)
    {
        $features = Question::create($user->getFirstName() . ' pia unaweza angalia vitu hivi!')
            ->fallback('Kumradhi, sijaweza kuuliza')
            ->callbackId('item')
            ->addButtons([
                Button::create('🏡 Vituo vya huduma')->value('Vituo vya huduma'),
                Button::create('🎮 Cheza gemu')->value('Maswali na majibu'),
                Button::create('🔁 Rudi mwanzo')->value('features')
            ]);

        return $features;
    }
}
