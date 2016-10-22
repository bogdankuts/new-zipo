<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Article;
use App\Client;
use App\Item;
use App\Order;
use App\Pdf;
use App\Rate;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {

	public function dashboard() {

		if (\Auth::guard('admin')->check()) {
			$rate = new Rate();
			$lastVisit = \Auth::guard('admin')->user()->last_visit;
			$notifications = $this->getNotifications($lastVisit);

			$this->updateLastAdminVisit();

			return view('admin.dashboard.dashboard')->with([
				'lastVisit'             => $lastVisit,
				'notifications'         => $notifications,
				'recentOrders'          => Order::getRecentOrders(),
				'recentDoneOrders'      => Order::getRecentDoneOrders(),
				'mostViewedItems'       => Item::getMostViewedItems(),
				'mostSellingItems'      => Item::getMostSellingItems(),
				'rate'                  => $rate->getRate(),
				'discount'              => Setting::getDiscount(),
				'allItems'              => Item::all()->count(),
				'allArticles'           => Article::all()->count(),
				'allPdfs'               => Pdf::all()->count(),
				'noMetaItems'           => $this->countIncorrectEnteties('items'),
				'noTitleItems'          => $this->countNoTitleEnteties('items'),
				'noDescriptionItems'    => $this->countNoDescriptionEnteties('items'),
				'noMetaArticles'        => $this->countIncorrectEnteties('articles'),
				'noTitleArticles'       => $this->countNoTitleEnteties('articles'),
				'noDescriptionArticles' => $this->countNoDescriptionEnteties('articles'),
			]);
		} else {

			return view('admin.login.login');
		}
	}

	public function newAdminsAfterVisit($lastVisit) {

		return view('admin.notifications.admins')->with([
			'newAdmins' => Admin::getNewAdmins($lastVisit),
		]);
	}

	public function newClientsAfterVisit($lastVisit) {

		return view('admin.notifications.clients')->with([
			'newClients' 	=> Client::getNewClients($lastVisit),
		]);
	}

	public function newOrdersAfterVisit($lastVisit) {

		return view('admin.notifications.orders')->with([
			'newOrders' => Order::getNewOrders($lastVisit),
		]);
	}

	public function newUsersAfterVisit($lastVisit) {

		return view('admin.notifications.users')->with([
			'newUsers' 	=> User::getNewUsers($lastVisit),
		]);
	}

	public function newArticlesAfterVisit($lastVisit) {

		return view('admin.notifications.articles')->with([
			'newArticles' 	=> Article::getNewArticles($lastVisit),
		]);
	}

	public function toggleItemHit($itemId) {
		$item = Item::find($itemId);
		if ($item->hit === 1) {
			$item->hit = 0;
		} else {
			$item->hit = 1;
		}
		$item->save();
	}

	public function markOrderAsDone($id) {
		$order = Order::find($id);
		$order->state = 3;
		$order->save();
	}

	public function setDiscount() {
		$discount = request()->get('discount');
		$changedBy = request()->get('changed_by');

		Setting::setDiscount($discount, $changedBy);

		return redirect()->route('dashboard')
						 ->with('message', 'Скидка для зарегестрированных пользователей: '.$discount.'%.');
	}

	public function setEurRate() {
		$rate = str_replace(',', '.', request()->get('rate'));
		Rate::setRate($rate, minutes_left());

		return redirect()->route('dashboard')
		               ->with('message', 'Курс евро на текущий день установлен: '.$rate.' рублей за 1 евро.');
	}

	public function import() {
		if (request()->hasFile('excel')) {
			$file = request()->file('excel');
			$extension = $file->getClientOriginalExtension();

			if ($extension != 'xlsx') {

				return redirect()->route('dashboard')->withErrors('Выбранный файл должен иметь формат .xlsx');
			}
			$fileName = 'excel.'.$extension;
			\Storage::putFileAs('excel', $file, $fileName);

			return \App::make('App\Http\Controllers\Admin\ParserController')->excelImport();
		} else {

			return redirect()->route('dashboard')->withErrors('Excel файл не выбран!');
		}
	}

	/**
	 * Count notification and add to array
	 *
	 * @param Carbon $lastVisit
	 *
	 * @return array
	 */
	private function getNotifications(Carbon $lastVisit) {
		$notifications = [];
		$notifications['newAdmins'] = count(Admin::getNewAdmins($lastVisit));
		$notifications['newDiscount'] = Setting::getDiscountWithUser($lastVisit);
		$notifications['newArticles'] = count(Article::getNewArticles($lastVisit));
		$notifications['newOrders'] = count(Order::getNewOrders($lastVisit));
		$notifications['newClients'] = count(Client::getNewClients($lastVisit));
		$notifications['newUsers'] = count(User::getNewUsers($lastVisit));

		return $notifications;
	}


	/**
	 * Count no meta
	 *
	 * @param $entity
	 *
	 * @return integer
	 */
	private function countIncorrectEnteties($entity) {

		return \DB::table($entity)
		         ->where('meta_title', '=', '')
		         ->orWhere('meta_description', '=', '')
		         ->count();
	}

	/**
	 * Count no title entity
	 *
	 * @param string $entity
	 *
	 * @return integer
	 */
	private function countNoTitleEnteties($entity) {

		return \DB::table($entity)
		         ->where('meta_title', '=', '')
		         ->count();
	}

	/**
	 * Count no description entity
	 *
	 * @param string $entity
	 *
	 * @return integer
	 */
	private function countNoDescriptionEnteties($entity) {

		return \DB::table($entity)
		         ->where('meta_description', '=', '')
		         ->count();
	}

	/**
	 * Update admin->last_visit in DB
	 */
	private function updateLastAdminVisit() {
		$cred = Admin::find(\Auth::guard('admin')->user()->cred_id);
		$cred->last_visit = Carbon::now();
		$cred->save();
	}
}