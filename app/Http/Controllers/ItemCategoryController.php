<?php

namespace App\Http\Controllers;

use App\Item;
use App\Member;
use App\Conversation;
use App\ItemCategory;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\FacebookDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;

class ItemCategoryController extends Controller
{
    /**
     * Item category constructor
     *
     */
    public function __construct()
    {
        $this->middleware('auth')->except('showBotMan');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item_categories = ItemCategory::paginate(10);

        return view('item-categories.index', [
            'item_categories' => $item_categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item-categories.create');
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
                ->putFile('public/item-category-thumbnails', $request->file('thumbnail'), 'public');

        }

        ItemCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnail_path,
            'display_title' => $request->display_title,
            'created_by' => auth()->id()
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  ItemCategory $item_category
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ItemCategory $item_category)
    {
        return view('item-categories.show', ['item_category' => $item_category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ItemCategory $item_category
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemCategory $item_category)
    {
        return view('item-categories.edit', ['item_category' => $item_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ItemCategory $item_category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemCategory $item_category)
    {
        $thumbnail_path = null;

        if ($request->hasFile('thumbnail')) {
            
            if(Storage::disk('s3')->exists($item_category->thumbnail)) Storage::disk('s3')->delete($item_category->thumbnail);
            
            $thumbnail_path = Storage::disk('s3')
                ->putFile('public/item-category-thumbnails', $request->file('thumbnail'), 'public');
        }

        $item_category->update([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnail_path ? $thumbnail_path : $item_category->thumbnail,
            'display_title' => $request->display_title,
            'updated_by' => auth()->id()
        ]);

        return redirect()->route('show-item-category', $item_category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ItemCategory $item_category
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemCategory $item_category)
    {
        $item_category->delete();

        return back();
    }

    /**
     * Display a listing of the deleted items.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDeleted()
    {

        $item_categories = ItemCategory::onlyTrashed()->paginate(10);

        return view('item-categories.trash', ['item_categories' => $item_categories ]);
    }

    /**
     * Restore trashed Item.
     *
     * @param ItemCategory $item_category
     * 
     * @return \Illuminate\Http\Response
     */
    public function restoreTrashed($item_category)
    {
        ItemCategory::onlyTrashed()->find($item_category)->restore();

        return back();
    }

    /**
     * Permanent delete of trashed Item category.
     *
     * @param ItemCategory $item_category
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroyTrashed($item_category)
    {
        $item_category = ItemCategory::onlyTrashed()->find($item_category);
        if(Storage::disk('s3')->exists($item_category->thumbnail))
            Storage::disk('s3')->delete($item_category->thumbnail);

        $item_category->forceDelete();

        return back();
    }

    /**
     * Shows a particular Item Category on Messenger Application
     *
     * @param BotMan $bot
     */
    public function showBotMan(BotMan $bot)
    {
        $extras = $bot->getMessage()->getExtras();
        $driver = $bot->getDriver()->getName();
        $name = $extras['apiParameters'][env('APP_ACTION') . '-item-categories'];

        $category = ItemCategory::where('name', '=', $name)->first();

        $bot->typesAndWaits(1);
        if ($category) {
            if ($driver == 'Facebook')
                $bot->reply($this->toFacebook($category));
            elseif ($driver == 'Slack' || $driver == 'Telegram')
                $bot->reply($this->toSlackTelegram($category));
            else {
                //$bot->reply($category->description);
                // $bot->reply('Unaweza jibu mojawapo kuendelea'
                //     . $this->toWeb($category));
                $bot->reply($this->toWebb($category));
            }
        } else {
            $bot->reply('Kuna tatizo la kiufundi, linafanyiwa kazi');
        }

        $user = $bot->getUser();
        $user_id = $user->getId();

        $member = Member::where('user_platform_id', '=', $user_id)->first();

        if ($member) {
            Conversation::create([
                'intent' => $name,
                'member_id' => $member->id
            ]);
        }
    }

    /**
     * Show a list of Items found for a particular category request from Slack or Telegram Driver.
     *
     * @param $category
     *
     * @return Question
     */
    public function toSlackTelegram($category)
    {
        $items = Item::where('item_category_id', $category->id)->where('item_id', NULL)->inRandomOrder()->take(5)->get();

        $features = Question::create($category->description)
            ->fallback('Kumradhi, sijaweza pata taarifa zaidi kuhusu' . $category->name)
            ->callbackId('item_category');

        foreach ($items as $item) {
            $features->addButtons([
                Button::create($item->display_title)->value($item->title)
            ]);
        }

        return $features;
    }

    /**
     * Show a list of Items found for a particular category request from Facebook Driver.
     *
     * @param $category
     *
     * @return ButtonTemplate
     */
    public function toFacebook($category)
    {
        $items = Item::where('item_category_id', $category->id)->where('item_id', NULL)->inRandomOrder()->take(3)->get();

        $template_list = ButtonTemplate::create($category->description);

        foreach ($items as $item) {
            $template_list->addButton(
                ElementButton::create($item->display_title)->type('postback')->payload($item->title)
            );
        }

        return $template_list;
    }

    /**
     * Show a list of Items found for a particular category request from Web Driver.
     *
     * @param $category
     *
     * @return string
     */
    public function toWeb($category)
    {
        $items = Item::where('item_category_id', $category->id)->where('item_id', NULL)->inRandomOrder()->take(5)->get();

        $message = '';
        $count = 1;

        foreach ($items as $item) {
            if($count == 1)
                $message .= $item->title;
            else
                $message .= ', ' . $item->title;
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
    public function toWebb($category)
    {
        $items = Item::where('item_category_id', $category->id)->where('item_id', NULL)->inRandomOrder()->take(7)->get();
        $features = Question::create($category->description)
            ->fallback('Kumradhi, sijaweza pata taarifa zaidi kuhusu' . $category->name)
            ->callbackId('item');

        foreach ($items as $itemm) {
            $features->addButtons([
                Button::create($itemm->display_title)->value($itemm->title)
            ]);
        }

        return $features;
    }
}
