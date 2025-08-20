<?php

namespace App\Http\Controllers;

use App\Models\EmailList;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class SubscriberController extends Controller
{
    public function index(EmailList $emailList)
    {

        $search = request()->search;
        $showTrash = request()->get('showTrash', false);

        return view('subscribers.index', [
            'emailList' => $emailList,
            'subscribers' => $emailList->subscribers()
                ->when($showTrash, fn(Builder $query) => $query->withTrashed())
                ->when($search, 
                    fn(Builder $query) => $query
                        ->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('id', '=', $search))


                ->paginate(),
            'search' => $search,
            'showTrash' => $showTrash,
        ]);
    }

    public function destroy(mixed $list, Subscriber $subscriber)
    {
        $subscriber->delete();

        return back()->with('message', __('SUBSCRIBER DELETED FROM THE LIST!'));
    }
 
    public function create(EmailList $emailList)
    {
        return view('subscribers.create', compact('emailList'));
    }
    
    public function store(EmailList $emailList)
    {
        $data = request()->validate([

            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('subscribers')
                ->where('email_list_id', $emailList->id)],
        ]);

        $emailList->subscribers()->create($data);

        return to_route('subscribers.index', $emailList)->with('message', __('Subscriber successfully create'));
    }
}
