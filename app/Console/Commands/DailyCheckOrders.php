<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\User;
use App\Models\Bid;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class DailyCheckOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkOrders:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update products state daily';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

   
    public function handle()
    {
         
        $products = Product::all();
        foreach ($products as $product) {
            if($product->not_ordered() && $product->isExpired() && !$product->isAuctioned()){
                $product->end_auction = $product->end_auction->addDays(15);
                $product->save();
                $craftsman= $product->user;
                Mail::raw(trans("We have extended the auction of Your product: << ") . $product->title . trans(" >> because it hasnt achieved any bids yet!, you can update the product description to be more attractive or you can even delete the product."), function ($mail) use ($craftsman) {
                    $mail->from('laraveldemo2018@gmail.com', trans('Handicrafts Auction'));
                    $mail->to($craftsman->email)
                        ->subject(trans('Your Product Auction Has Been Extended Automatically'));
                });
            }
            else if($product->not_ordered() && $product->isAuctioned() && $product->isExpired()){
                $order= Order::create([
                    'price' => $product->maxBidPrice(),
                    'is-ordered-by-auction' => 1,
                    'user_id' => $product->maxBidder()->id,
                    'product_id' => $product->id,
                    'created_at' => Carbon::now()
                ]);
             
                if ($order->save()){
                    $product->is_delete = 1;
                    $product->update();
                    $user= Order::where('product_id', '=', $product->id)->first()->user;
                    $product= Order::where('product_id', '=', $product->id)->first()->product;

                    $otherBidders= User::where('id', '!=', $user->id)->whereIn('id', Bid::where('product_id', '=', $product->id)->pluck('user_id'))->get();
                    foreach($otherBidders as $otherBidder){
                        Mail::raw($otherBidder->username.trans(" had won the auction on: << ") . $product->title . trans(" >>."), function ($mail) use ($otherBidder) {
                            $mail->from('laraveldemo2018@gmail.com', trans('Handicrafts Auction'));
                            $mail->to($otherBidder->email)
                                ->subject(trans('Auction has finished'));
                        });
                    }

                    Mail::raw(trans("Congrats 🎉, You had won new auction, its for product: << ") . $product->title . trans(" >>, The product will deliver within 3 hours,")." \n \n" . trans("Please confirm the receipt from Your Orders Panel immediately as you receive your product:")."\n".route('buyer.ordered_products'), function ($mail) use ($user) {
                        $mail->from('laraveldemo2018@gmail.com', trans('Handicrafts Auction'));
                        $mail->to($user->email)
                            ->subject(trans('You had won new auction 🎉'));
                    });
                    $craftsman = $product->user;
                    Mail::raw(trans("Congrats 🎉, Your product: << ") . $product->title . trans(" >> has been ordered by the bidder auction winner:") . $user->username . trans(", You have 3 hours to deliver it to him,")." \n \n". trans(" Please check Your Ordered Products Panel to get the buyer address:")."\n".route('craftsman.ordered_products'). "\n". trans(" When you deliver buyer the product ask him to confirm the product delivery from the website immediately as he received it."), function ($mail) use ($craftsman) {
                        $mail->from('laraveldemo2018@gmail.com', trans('Handicrafts Auction'));
                        $mail->to($craftsman->email)
                            ->subject(trans('Your Have New Ordered Product'));
                    });

                    if (auth()->user() && $product->maxBidder()->id == auth()->user()->id) {
                        return redirect()->back()->with('success', 'Congrats 🎉, You win the acution on: << ' . $product->title . ' >> the product will deliver within 3 hours, please check Your Orders Panel.');
                    } else if (auth()->user() && $product->user_id == auth()->user()->id) {
                        return redirect()->back()->with('success', 'Congrats 🎉, ' . $product->maxBidder()->username . ' wins the acution on Your product: << ' . $product->title . ' >>, Check your Ordered Products panel, you have to deliver him the product within 3 hours');
                    } else {
                        return redirect()->back()->with('success', $product->maxBidder()->username . ' wins the acution on: << ' . $product->title . ' >> ');
                    }
                }
            }
        }
         
        $this->info('Successfully sent daily quote to everyone.');
    
    }
}
