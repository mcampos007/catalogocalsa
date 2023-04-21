<?php



namespace App\Http\Controllers\Admin;
use App\CartDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartDetailController extends Controller
{
    //
    public function editaritem($id)
    {
        //dd($id);
        $cartDetail = CartDetail::findOrfail($id);
       
        return view('admin.remitos.edititem')->with(compact('cartDetail'));
        //dd($item);

    }

    public function update(Request $request)
    {
       //dd($request->toArray());
        

        $id = $request->input('id');
        $item = CartDetail::findOrfail($id);
        if ($item)
        {
            $item->quantity = $request->input('quantity');
            $item->stocklocal = $request->input('stocklocal');
            $item->save();
            $notification='El item fué actualizado';

        }
        else
        {
            $notification='Hubo problemas para actualizar datos del item';
        }
        //return view('admin.remitos.index')->with(compact('remito','notification'));
        return redirect('/admin/remito/'.$item->cart_id)->with(compact('notification'));
    }
}
