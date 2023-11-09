<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        //get movie
        $customer = Customer::latest()->paginate(5);
        //render view with posts
        return view('customer.index', compact('customer'));
    }
    
    /**
    * create
    *
    * @return void
    */
    public function create()
    {
        $user = Ticket::all();

        return view('customer.create', compact('user'));
    }

    /**
    * store
    *
    * @param Request $request
    * @return void
    */
    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'quantity' => 'required',
            'id_ticket'=> 'required'
        ]);
        //Fungsi Simpan Data ke dalam Database
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'quantity'=> $request->quantity,
            'id_ticket' => $request->id_ticket
        ]);

        try{
            return redirect()->route('customer.index');
        }catch(Exception $e){
            return redirect()->route('customer.index');
        }
    }

    /**
    * edit
    *
    * @param int $id
    * @return void
    */
    public function edit($id)
    {
        $user = Ticket::all();
        $customer =Customer::find($id);
        return view('customer.edit', compact('customer','user'));
    }

    /**
    * update
    *
    * @param mixed $request
    * @param int $id
    * @return void
    */
    public function update(Request $request, $id)
    {
        $customer =Customer::find($id);
        //validate form
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'quantity' => 'required',
            'id_ticket'=> 'required'
        ]);
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'quantity'=> $request->quantity,
            'id_ticket' => $request->id_ticket
        ]);
        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
    * destroy
    *
    * @param int $id
    * @return void
    */
    public function destroy($id)
    {
        $customer =Customer::find($id);
        $customer->delete();
        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
