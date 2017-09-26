<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function redirect;
use Illuminate\Support\Facades\Auth;
use App\Employee;
use App\Customer;
use App\Cloth;
use App\Laundry;
use App\Pricelist;
use App\Expense;
use App\Sale;
use App\Order;
use Image;

class BackController extends Controller
{

    // ROUTES FOR ADMIN DASHBOARD
    public function adminHome(){

        $date1 = date_create(Carbon::today());
        $from = date_format($date1,"Y-m-d H:i:s");

        $todayOrders = Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->groupBy('customer_id')
            ->whereDate('orders.created_at', '=', $from)
            ->get();

        $pendingOrders = Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->groupBy('customer_id')
            ->where('orders.status','=', 'pending')
            ->get();



        return view('Admin.index',compact('todayOrders','pendingOrders'));
    }


    public function addClothType(Request $request){
        Cloth::create($request->all());
        Session::flash('message','Successfully added cloth type');
        return redirect('/Admin/viewCloth');
    }


    public function viewCloth(){
        $clothes = Cloth::latest('id')->get();

        return view('Admin.clothTypes',compact('clothes'));


    }

    public  function editCloth($id){

        $cloth = Cloth::findOrFail($id);

        return view('Admin.editCloth',compact('cloth'));
    }


    public function updateCloth($id, Request $request){

        $cloth = Cloth::findOrFail($id);

        $cloth->title =  $request->title;
        $cloth->save();

        Session::flash('message', 'Successfully updated');
        return redirect('/Admin/viewCloth');

    }


    public function addLaundryType(Request $request){
        Laundry::create($request->all());
        Session::flash('message','Successfully added laundry service');
        return redirect('/Admin/viewLaundry');
    }

    public function viewLaundry(){
        $laundries = Laundry::latest('id')->get();

        return view('Admin.laundrytypes',compact('laundries'));


    }

    public  function editLaundry($id){

        $laundry = Laundry::findOrFail($id);

        return view('Admin.editLaundry',compact('laundry'));
    }


    public function updateLaundry($id, Request $request){

        $laundry = Laundry::findOrFail($id);

        $laundry->name =  $request->name;
        $laundry->save();

        Session::flash('message', 'Successfully updated');
        return redirect('/Admin/viewLaundry');

    }


    public function getPrice(){
        $clothes = Cloth::latest('id')->get();
        $laundries = Laundry::latest('id')->get();

        return view('Admin.newprice',compact('clothes','laundries'));


    }


    public function addPrice(Request $request){
        Pricelist::create($request->all());
        Session::flash('message','Successfully added price for laundry service and cloth');
        return redirect('/Admin/viewPrice');
    }

    public function viewPrice(){
        $pricelists = Pricelist::select('pricelists.id as id','laundries.name as name','cloths.title as title','price')
            ->join('laundries','laundry_id','=', 'laundries.id')
            ->join('cloths','cloth_id','=', 'cloths.id')
            ->orderBy('pricelists.id','desc')
            ->get()->all();

        return view('Admin.pricelist',compact('pricelists'));


    }

    public  function editPrice($id){

        $pricelist = Pricelist::findOrFail($id);
        $clothes = Cloth::latest('id')->get();
        $laundries = Laundry::latest('id')->get();


        return view('Admin.editPrice',compact('pricelist','clothes','laundries'));
    }


    public function updatePrice($id, Request $request){

        $pricelist = Pricelist::findOrFail($id);

        $pricelist->laundry_id =  $request->laundry_id;
        $pricelist->cloth_id = $request->cloth_id;
        $pricelist->price = $request->price;
        $pricelist->save();

        Session::flash('message', 'Successfully updated');
        return redirect('/Admin/viewPrice');


    }


    public function addEmployee(Request $request){



        $file1 = $request->file('photo');
        $cphoto = time().$file1->getClientOriginalName();

        $imgUpload = Image::make($file1)->save(public_path('uploads/' . $cphoto));

        $request['photo'] = $cphoto;

        $user = new User;
        $user->email = $request['email'];
        $user->role = $request['position'];
        $user->password = bcrypt($request['password']);
        $user->save();

        $employee = new  Employee;
        $employee->fname = $request['fname'];
        $employee->lname = $request['lname'];
        $employee->contact = $request['contact'];
        $employee->position = $request['position'];
        $employee->address = $request['address'];
        $employee->gender  = $request['gender'];
        $employee->birthdate = $request['birthdate'];
        $employee->user_id = $user->id;
        $employee->photo = $cphoto;
        $employee->save();





        Session::flash('message','Successfully added new employee');
        return redirect('/Admin/viewEmployee');
    }


    public function viewEmployee(){
        $employees = Employee::latest('id')->get();

        return view('Admin.employeelist',compact('employees'));


    }

    public  function editEmployee($id){

        $employee = Employee::findOrFail($id);

        return view('Admin.editEmployee',compact('employee'));
    }


    public function updateEmployee($id,Request $request){

        $employee = Employee::find($id);

        $path = "";

        if (!empty($request->photo)){

            $file1 = $request->file('photo');
            $path = time().$file1->getClientOriginalName();

            $imagePath =  Image::make($file1)->save(public_path('uploads/' . $path));


        }

        else{
            $path = $employee->photo;
        }


        $employee->fname = $request['fname'];
        $employee->lname = $request['lname'];
        $employee->position = $request['position'];
        $employee->contact = $request['contact'];
        $employee->birthdate = $request['birthdate'];
        $employee->gender = $request['gender'];
        $employee->address = $request['address'];
        $employee->photo = $path;
        $employee->save();



        Session::flash('message', "Employee details successfully updated");
        return redirect('/Admin/viewEmployee');
    }


    public function launderers(){

        $launderers = Employee::latest('id')
                         ->where('position','=','launderer')
                          ->get();

        return view('Admin.launderers',compact('launderers'));
    }




    public function addCustomer(Request $request){



        $file1 = $request->file('photo');
        $cphoto = time().$file1->getClientOriginalName();

        $imgUpload = Image::make($file1)->save(public_path('uploads/' . $cphoto));

        $request['photo'] = $cphoto;

        $user = new User;
        $user->email = $request['email'];
        $user->role = 'customer';
        $user->password = bcrypt($request['password']);
        $user->save();

        $customer = new  Customer;
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->contact = $request->contact;
        $customer->address = $request->address;
        $customer->photo = $cphoto;
        $customer->user_id = $user->id;
        $customer->save();



        Session::flash('message','Successfully added new customer');
        return redirect('/Admin/viewCustomer');
    }



    public function viewCustomer(){
        $customers = Customer::latest('id')->get();

        return view('Admin.customerlist',compact('customers'));


    }


    public  function editCustomer($id){

        $customer = Customer::findOrFail($id);

        return view('Admin.editCustomer',compact('customer'));
    }


    public function updateCustomer($id,Request $request){

        $customer = Customer::findOrFail($id);

        $path = "";

        if (!empty($request->photo)){

            $file1 = $request->file('photo');
            $path = time().$file1->getClientOriginalName();

            $imagePath =  Image::make($file1)->save(public_path('uploads/' . $path));


        }

        else{
            $path = $customer->photo;
        }


        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->contact = $request->contact;
        $customer->address = $request->address;
        $customer->photo = $path;
        $customer->save();



        Session::flash('message', "Customer's details successfully updated");
        return redirect('/Admin/viewCustomer');
    }


    public function getJobOrderForm(){

        $clothes = Cloth::latest('id')->get();
        $laundries = Laundry::latest('id')->get();
        $customers = Customer::latest('id')->get();

        return view('Admin.neworder',compact('clothes','laundries','customers'));

    }


    public function getTotalPrice($cloth, $laundry){

        $price = Pricelist::select('price')
                           ->where('cloth_id', '=', $cloth)
                           ->where('laundry_id','=',$laundry)
                            ->get();

        return response()->json($price);

    }


    public function addOrders(Request $request){
        Order::create($request->all());
        Session::flash('message',"Successfully added customer's order");
        return redirect('/Admin/viewOrders');
    }


    public function viewOrders(){

        $orders = Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','cloths.title as title','laundries.name as name','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
                        ->join('cloths','orders.cloth_id','=','cloths.id')
                        ->join('laundries','orders.laundry_id','=','laundries.id')
                         ->join('customers','orders.customer_id','=','customers.id')
                      ->groupBy('customer_id')
                      ->get();


        return view('Admin.joborders', compact('orders'));
    }

    public function viewOrder($id){

        $order =  Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','cloths.title as title','laundries.name as name','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
            ->join('cloths','orders.cloth_id','=','cloths.id')
            ->join('laundries','orders.laundry_id','=','laundries.id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->groupBy('customer_id')
            ->where('orders.customer_id','=',$id)
            ->get();


        $allOrders =  Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','cloths.title as title','laundries.name as name','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id','total','quantity')
            ->join('cloths','orders.cloth_id','=','cloths.id')
            ->join('laundries','orders.laundry_id','=','laundries.id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->where('orders.customer_id','=',$id)
            ->get();



        return view('Admin.vieworder',compact('order','allOrders'));


    }


    public function assignLaunderer($id){
        $launderers = Employee::where('position','=','launderer')
                               ->where('status','=','inactive')
                               ->get();

        $customer_id = $id;

        return view('Admin.assignLaunderer',compact('launderers','customer_id'));
    }


    public function recordLaunderer(Request $request){

      $order = Order::Where('customer_id','=',$request->customer_id)
                     ->update(['launderer_id' => $request->launderer_id,'status' => 'in progress']);

        $launderer = Employee::where('id','=', $request->launderer_id)
            ->update(['status'=>'active']);


      Session::flash('message','Successfully assigned a launderer to job order');
      return redirect('/Admin/viewOrders');



    }


    public function markCompleted($id){

        $customer_id = $id;
        $launderer_id = Order::select('launderer_id as id')
                               ->where('customer_id','=', $id)
                                ->first()
                                  ->toArray();
              $launderer =    $launderer_id['id'];

        return view('Admin.markascomplete',compact('customer_id','launderer'));
    }

    public function recordCompleted(Request $request){

        $order = Order::Where('customer_id','=',$request->customer_id)
            ->update(['status' => 'completed','delivery_date' => $request->delivery_date]);

        $launderer = Employee::where('id','=', $request->launderer_id)
                                 ->update(['status'=>'inactive']);


        Session::flash('message','Successfully Completed job order and released launderer');
        return redirect('/Admin/viewOrders');


    }


    public function salesForm(){

        $customers = Order::select('customer_id','fname', 'lname')
                          ->where('status','=','completed')
                          ->join('customers','customer_id','=', 'customers.id')
                          ->groupBy('customer_id')
                           ->get();

        return view('Admin.addsales',compact('customers'));

    }

    public function recordSales(Request $request){

        Sale::create($request->all());

        $order = Order::Where('customer_id','=',$request->customer_id)
            ->update(['status' => 'delivered']);

        Session::flash('message','Successfully recorded sales');
        return redirect('/Admin/viewSales');

    }

    public function viewSales(){

        $sales = Sale::select('sales.id as id','paymentType','sales_date','amount','fname','lname')
                           ->join('customers','customer_id','=','customers.id')
                           ->latest('sales.id')
                           ->get();

        return view('Admin.sales',compact('sales'));

    }


    public function recordExpenses(Request $request){

        Expense::create($request->all());


        Session::flash('message','Successfully recorded expenses');
        return redirect('/Admin/viewExpenses');

    }

    public function viewExpenses()
    {

        $expenses = Expense::latest('id')
                            ->get();

        return view('Admin.expenses',compact('expenses'));

    }


    public function getReport(Request $request){


        $date1 = date_create($request->from);
        $from = date_format($date1,"Y-m-d H:i:s");

        $date2 = date_create($request->to);
        $to = date_format($date2,"Y-m-d H:i:s");





        $orders  =  Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->groupBy('customer_id')
            ->whereBetween('orders.created_at',[$from,$to])
            ->get();


        return view('Admin.reportstatistics',compact('orders'));


    }



    //ROUTES FOR CUSTOMERS DASHBOARD
    public function cusHome(){

        $userid = Customer::select('id')
                           ->where('user_id','=',Auth::user()->id)
                            ->get();



        $orders = Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->where('customer_id','=', $userid[0]->id)
            ->groupBy('customer_id')
            ->get();

        return view('Customer.index',compact('orders'));
    }


    public function cusViewOrder(){

        $userid = Customer::select('id')
            ->where('user_id','=',Auth::user()->id)
            ->get();



        $order =  Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','cloths.title as title','laundries.name as name','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
            ->join('cloths','orders.cloth_id','=','cloths.id')
            ->join('laundries','orders.laundry_id','=','laundries.id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->groupBy('customer_id')
            ->where('orders.customer_id','=',$userid[0]->id)
            ->get();


        $allOrders =  Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','cloths.title as title','laundries.name as name','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id','total','quantity')
            ->join('cloths','orders.cloth_id','=','cloths.id')
            ->join('laundries','orders.laundry_id','=','laundries.id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->where('orders.customer_id','=',$userid[0]->id)
            ->get();



        return view('Customer.vieworder',compact('order','allOrders'));
    }



    //ROUTES FOR QUALITY CONTROLLER DASHBOARD

    public function quaHome(){
        $orders = Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->groupBy('customer_id')
            ->get();
        return view('QualityControl.index',compact('orders'));
    }


    public function Qualaunderers(){

        $launderers = Employee::latest('id')
            ->where('position','=','launderer')
            ->get();

        return view('QualityControl.launderers',compact('launderers'));
    }


    public function viewQuaOrders(){

        $orders = Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','cloths.title as title','laundries.name as name','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
            ->join('cloths','orders.cloth_id','=','cloths.id')
            ->join('laundries','orders.laundry_id','=','laundries.id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->groupBy('customer_id')
            ->get();


        return view('QualityControl.joborders', compact('orders'));
    }

    public function viewQuaOrder($id){

        $order =  Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','cloths.title as title','laundries.name as name','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
            ->join('cloths','orders.cloth_id','=','cloths.id')
            ->join('laundries','orders.laundry_id','=','laundries.id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->groupBy('customer_id')
            ->where('orders.customer_id','=',$id)
            ->get();


        $allOrders =  Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','cloths.title as title','laundries.name as name','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id','total','quantity')
            ->join('cloths','orders.cloth_id','=','cloths.id')
            ->join('laundries','orders.laundry_id','=','laundries.id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->where('orders.customer_id','=',$id)
            ->get();



        return view('QualityControl.vieworder',compact('order','allOrders'));


    }


    public function assignQuaLaunderer($id){
        $launderers = Employee::where('position','=','launderer')
            ->where('status','=','inactive')
            ->get();

        $customer_id = $id;

        return view('QualityControl.assignLaunderer',compact('launderers','customer_id'));
    }


    public function recordQuaLaunderer(Request $request){

        $order = Order::Where('customer_id','=',$request->customer_id)
            ->update(['launderer_id' => $request->launderer_id,'status' => 'in progress']);

        $launderer = Employee::where('id','=', $request->launderer_id)
            ->update(['status'=>'active']);


        Session::flash('message','Successfully assigned a launderer to job order');
        return redirect('/QualityControl/viewOrders');



    }


    public function markQuaCompleted($id){

        $customer_id = $id;
        $launderer_id = Order::select('launderer_id as id')
            ->where('customer_id','=', $id)
            ->first()
            ->toArray();
        $launderer =    $launderer_id['id'];

        return view('QualityControl.markascomplete',compact('customer_id','launderer'));
    }

    public function recordQuaCompleted(Request $request){

        $order = Order::Where('customer_id','=',$request->customer_id)
            ->update(['status' => 'completed','delivery_date' => $request->delivery_date]);

        $launderer = Employee::where('id','=', $request->launderer_id)
            ->update(['status'=>'inactive']);


        Session::flash('message','Successfully Completed job order and released launderer');
        return redirect('/QualityControl/viewOrders');


    }





    //ROUTES FOR ACCOUNTANT DASHBOARD


    public function accHome(){

        $orders = Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->groupBy('customer_id')
            ->get();

        return view('Accountant.index',compact('orders'));
    }


    public function viewAccOrders(){

        $orders = Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','cloths.title as title','laundries.name as name','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
            ->join('cloths','orders.cloth_id','=','cloths.id')
            ->join('laundries','orders.laundry_id','=','laundries.id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->groupBy('customer_id')
            ->get();


        return view('Accountant.joborders', compact('orders'));
    }


    public function viewAccOrder($id){

        $order =  Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','cloths.title as title','laundries.name as name','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id')
            ->join('cloths','orders.cloth_id','=','cloths.id')
            ->join('laundries','orders.laundry_id','=','laundries.id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->groupBy('customer_id')
            ->where('orders.customer_id','=',$id)
            ->get();


        $allOrders =  Order::select('orders.id as id','orders.status as status','orders.delivery_date as delivery_date','cloths.title as title','laundries.name as name','fname','lname','orders.created_at as created_at','orders.customer_id as customer_id','total','quantity')
            ->join('cloths','orders.cloth_id','=','cloths.id')
            ->join('laundries','orders.laundry_id','=','laundries.id')
            ->join('customers','orders.customer_id','=','customers.id')
            ->where('orders.customer_id','=',$id)
            ->get();



        return view('Accountant.vieworder',compact('order','allOrders'));


    }


    public function recordAccExpenses(Request $request){

        Expense::create($request->all());


        Session::flash('message','Successfully recorded expenses');
        return redirect('/Accountant/viewExpenses');

    }

    public function viewAccExpenses()
    {

        $expenses = Expense::latest('id')
            ->get();

        return view('Accountant.expenses',compact('expenses'));

    }


    public function salesAccForm(){

        $customers = Order::select('customer_id','fname', 'lname')
            ->where('status','=','completed')
            ->join('customers','customer_id','=', 'customers.id')
            ->groupBy('customer_id')
            ->get();

        return view('Accountant.addsales',compact('customers'));

    }

    public function recordAccSales(Request $request){

        Sale::create($request->all());

        $order = Order::Where('customer_id','=',$request->customer_id)
            ->update(['status' => 'delivered']);

        Session::flash('message','Successfully recorded sales');
        return redirect('/Accountant/viewSales');

    }

    public function viewAccSales(){

        $sales = Sale::select('sales.id as id','paymentType','sales_date','amount','fname','lname')
            ->join('customers','customer_id','=','customers.id')
            ->latest('sales.id')
            ->get();

        return view('Accountant.sales',compact('sales'));

    }







    public function login(Request $request){

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            if(\Auth::user()->role == "admin"){
                return redirect('/Admin');

            }

            elseif(\Auth::user()->role == "accountant"){
                return redirect('/Accountant');
            }

            elseif(\Auth::user()->role == "quality control"){
                return redirect('/QualityControl');
            }
            elseif(\Auth::user()->role == "customer"){
                return redirect('/Customer');
            }
            else{
                Session::flash('message','Please you are not authorized to login');
                return redirect('/');
            }


        }
        else{
            Session::flash('message','Please ensure your login details are correct');
            return   redirect('/');
        }
    }




    public function logout(){

        Auth::logout();
        return redirect('/');
    }
}
