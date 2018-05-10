
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\select\Perumahan;
use App\select\Block;

use App\Model\Perum;
use App\Model\Unit;



class SelectCtrl extends Controller
{
    //
    public function index(){
    	
    }

    public function getperumahan()
    {
        return response()->json(Perumahan::orderBy('name', 'ASC')->get());
    }

   public function block()
    {
        $block = Block::whereHouseId(request('perumahan'))
            ->orderBy('name', 'ASC')
            ->get();

        return response()->json($block);
    }
    /**
     * Get cities based on selected province
     *
     * @return string JSON
     */
    

   
}
