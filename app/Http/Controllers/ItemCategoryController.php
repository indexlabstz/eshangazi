<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Item;
use App\ItemCategory;
use App\Member;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

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
     * @return Response
     */
    public function index()
    {
        return view('item-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('item-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $thumbnail_path = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail_path = Storage::disk('eShangazi')
                ->putFile('public/item-category-thumbnails', $request->file('thumbnail'));

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
     * @param ItemCategory $item_category
     *
     * @return Response
     */
    public function show(ItemCategory $item_category)
    {
        return view('item-categories.show', ['item_category' => $item_category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ItemCategory $item_category
     *
     * @return Response
     */
    public function edit(ItemCategory $item_category)
    {
        return view('item-categories.edit', ['item_category' => $item_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ItemCategory $item_category
     *
     * @return Response
     */
    public function update(Request $request, ItemCategory $item_category)
    {
        $thumbnail_path = null;

        if ($request->hasFile('thumbnail')) {

            if (Storage::disk('eShangazi')->exists($item_category->thumbnail)) Storage::disk('eShangazi')->delete($item_category->thumbnail);

            $thumbnail_path = Storage::disk('eShangazi')
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
     * @param ItemCategory $item_category
     *
     * @return Response
     * @throws \Exception
     */
    public function destroy(ItemCategory $item_category)
    {
        $item_category->delete();

        return back();
    }

    /**
     * Display a listing of the deleted items.
     *
     * @return Response
     */
    public function indexDeleted()
    {

        $item_categories = ItemCategory::onlyTrashed()->paginate(10);

        return view('item-categories.trash', ['item_categories' => $item_categories]);
    }

    /**
     * Restore trashed Item.
     *
     * @param ItemCategory $item_category
     *
     * @return Response
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
     * @return Response
     */
    public function destroyTrashed($item_category)
    {
        $item_category = ItemCategory::onlyTrashed()->find($item_category);
        if (Storage::disk('eShangazi')->exists($item_category->thumbnail))
            Storage::disk('eShangazi')->delete($item_category->thumbnail);

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

        $category = ItemCategory::where('name', '=', $name)->where('status', '=', 'publish')->first();

        $bot->typesAndWaits(1);

        if ($category) {
            if ($driver == 'Facebook') {
                //Iterating through description paragraphs
                $descriptions = array_values(array_filter(explode("\r\n", $category->description)));
                foreach ($descriptions as $paragraph) {
                    if ($paragraph === end($descriptions)) {
                        $bot->reply($this->toFacebook($category, $paragraph));
                    } else {
                        //$bot->typesAndWaits(1); 
                        $bot->reply($paragraph);
                    }
                }
            } elseif ($driver == 'Slack' || $driver == 'Telegram') {
                $bot->reply($this->toSlackTelegram($category));
            } else {
                $bot->reply($this->toWebb($category));
            }

            $count = $category->count + 1;

            $category->update([
                'count' => $count,
                'updated_at' => Carbon::now()
            ]);
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
    public function toFacebook($category, $paragraph)
    {
        $items = Item::where('item_category_id', $category->id)->where('item_id', NULL)->inRandomOrder()->take(3)->get();

        $template_list = ButtonTemplate::create($paragraph);

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
            if ($count == 1)
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
