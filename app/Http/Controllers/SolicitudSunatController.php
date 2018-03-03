<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tecactus\Sunat\RUC;
use Tecactus\Reniec\DNI;
use App\cliente;

class SolicitudSunatController extends Controller
{
    public function obtener_datos_con_ruc($ruc){
        $cliente = cliente::where('num_doc',$ruc)->get();
        if(count($cliente)==0){
            $sunatRuc = new RUC('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjEzODRkOTQ5M2Y4NzU4YTFjZTVmZTEwMjUzYjMyMTlkODI2ODI0ZjRiMTlmY2YyYmRjZjQxNGExOWIyNDc2ZmI1MDY4MzBjODM5NWYwOTBkIn0.eyJhdWQiOiIxIiwianRpIjoiMTM4NGQ5NDkzZjg3NThhMWNlNWZlMTAyNTNiMzIxOWQ4MjY4MjRmNGIxOWZjZjJiZGNmNDE0YTE5YjI0NzZmYjUwNjgzMGM4Mzk1ZjA5MGQiLCJpYXQiOjE1MTc0NTc4NDEsIm5iZiI6MTUxNzQ1Nzg0MSwiZXhwIjoxNTQ4OTkzODQxLCJzdWIiOiIxMzI3Iiwic2NvcGVzIjpbInVzZS1zdW5hdCJdfQ.v3mwrPtN-kdJY3kI3uphqRpuTXFDLiJLvBFg-lwsGSteHlg250eswI00s6UB5dCMYyRiWNr2d39-M9A51b8JKwN6X09rQNdURCgb6ZfOpCNw4Pi3Vpyw1_CvzznLMJTlihRViLj7bvJkvrzIujpWzriUXuFCjG7qq9_kKOscbQDnJu9O_zgyRi_b2kSJiqel-kQABdSD6iaLDvHawibHAIe86s304pRicYcafsxqdXgZXi2q4_3-5RaKcSlyc8ut5oQahosFLNmMEM-STIlU5eavl8L17blUbQwcs1kAIThw-pBqKqqOE0IGhlWyhZsUiAmmGBQYIaT_77GfY5ndD_gO5t7836OQu1dOLp3q_0ZPYMIlqIMW76ND7qdORTeZsd5KI0YTtxpUvVkYI15XZ-B6WAQ4GmBBQbH0JB1LzqO7Y0-E1cjTm1HQw6KXyKjDji9FivOjKb8YM9GHKVzvKMKuKWcHznR1eunax4hqLlSsELamroiKOyVBDXHq_xvwI3iMoninNSAtHKsmRpebgfNRTicoHtkJ5b_XsmCzwUpbvc82pHyGbGdVZvNWfO13icKvuQQMaCr7JGD_6Bp0sxHvlvlDXq03oTNcalgWd0Ei542YQ73AukVvE1UsMzUyfbXctFLTC6VLajFUFgmj_fWHY2C0mEhoapO9xwRQDTM');
        
        //'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImIzYzQzYzRhMTYzNWM5NGY0ODE0YzllODY4MzZiZTZmZWY3MjJhMTIyYjdiYTYzM2U0YjRhNjAwOTg2NGNkMzIyNjM4NDYxMGFhMmZkYjU4In0.eyJhdWQiOiIxIiwianRpIjoiYjNjNDNjNGExNjM1Yzk0ZjQ4MTRjOWU4NjgzNmJlNmZlZjcyMmExMjJiN2JhNjMzZTRiNGE2MDA5ODY0Y2QzMjI2Mzg0NjEwYWEyZmRiNTgiLCJpYXQiOjE1MTY4MzM4MjQsIm5iZiI6MTUxNjgzMzgyNCwiZXhwIjoxNTQ4MzY5ODI0LCJzdWIiOiIxMjgxIiwic2NvcGVzIjpbInVzZS1zdW5hdCJdfQ.GJnEQ5f3joBABfkZvm2SXVHAm-Zwxhhn65SKyi5X5mchKcR58T9XZGrpPpI2jRaD2dDi_WVE_wwY8lRtDClZ0Ss9FIJSzYDHt7I6veUSRi9dKyNeXVW0fS1U1BBlWfbgsnnApA0NVyrH91hdJjRvshiSJL3HStyKzuwQFbnKNZOH0RU4SJpPyXzrbjkV1VmHHURc0P0YFyy4Njr_MZ98uZleDr_S61ScK2VAsKO8ySsucqyTO-3xcLH9j2w2AiYxt0Y3ePE9Ja3bEl9l5uoVS-tZIFPLhXjLPV68Ckr1kKgHGYiQKlBPaY95Y78I63rlRioSAFtYHot2lPAVlem25721dRcauhTmOTtZMnXxbzEwtHG4PY3NK-VIHCA6lKjjvAhIoM7A4q_m7WnTzTOqRIxqMdzJGz4QDTPj1nJRVWKgzd-RIurLF0iZ0ewVMKPppshVM26J-5O8I51x3jdZ0_jvZYqR_1VXyUKg7TBAUFkAYjZOw4kARC8ZBZfr3wqOwjFuuqg9Sz2MzrO0i-4XM00bB0fMLaIFqEDfADlLP8K30TOTglekmEylFxHX9A-RXnYHF3mJY3WaDwYCrZT4UkI6wdr8yuhOFNI7QaaZZMQzcN7d9iBaZ69OBJ3zG_uPbfX_yvlU5M-Qhj8tRJsTnXLxGZVwpxdMK4tY7PiHyFU'
        
            return response($sunatRuc->getByRuc($ruc, true))
            ->withHeaders([
                'Content-Type' => 'text/json',
            ]);
        }
        else{
            return response(['ruc'=>$cliente->num_doc,'razon_social' => $cliente->razon_social,'direccion'=>$cliente->direccion])
            ->withHeaders([
                'Content-Type' => 'text/json',
            ]);
        }
         
        
    }
    
    public function obtener_datos_con_dni($dni){
        
        
        $reniecDni = new DNI('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjYyZWNkMGRjNjEyMzUzOWZmMzU2NjI2MmNhZmU1ZTA1ZDNhNzA1NDAzNWZlM2Y4ZGIyOWQ1NDNlZmNkMGU3NGVmMTE1MjRjNTM1NWFmOGZiIn0.eyJhdWQiOiIxIiwianRpIjoiNjJlY2QwZGM2MTIzNTM5ZmYzNTY2MjYyY2FmZTVlMDVkM2E3MDU0MDM1ZmUzZjhkYjI5ZDU0M2VmY2QwZTc0ZWYxMTUyNGM1MzU1YWY4ZmIiLCJpYXQiOjE1MTk5NjkxMjYsIm5iZiI6MTUxOTk2OTEyNiwiZXhwIjoxNTUxNTA1MTI2LCJzdWIiOiIxMjgxIiwic2NvcGVzIjpbInVzZS1yZW5pZWMiXX0.naB2D4cGFNsP8bF6_LSTWuAtjK43v8rBMAVT3YtHUuNSPtRkQbcIndCRj-_4iEL9jDcdSsBeyyX1Y82eJcpxUf7YCoD0NpLNvqwcuGkUK1I2YuOrUKQVJx9fo-nIAMJ-cRRMHkY__76dbIa0xO3r2VxZUyrfvkPMqkP9cvrsdS5DUSua_dsKit6yfK1jXw-VDj9nMaak4GHV2tg88JW3EKxXRC37CLmP1phkdpcDwCVzcYxItWHx5p62aukPpucfsHh__nB3U15m7iFMfvPYukkx8ZW1ckt7P4IeCu70VYXi4rAGwIUBLBHyPCr34mVFxc1xG4ns85qwAqxHTucgoYsa7kiGTDVGgvj0vA862WTQ9XQ0hPF0SW6Dibh3YaKBn8V6oRMTsgjGNxBRfYaYPVWEM8LXcIf22J8NAqxy7tguJzo5NPM_Nnuowwoy_E4pukB6l-UYgLRuQrqrRBUpGm4PswHoduvJvmnj8qlPM2SkAFMvxU3zxQyeu_MoXfUhoNBeqWAUbxFlz4beyF0hSyICcDwkwxEwIEyK7lVZCrfZfG5BLjv8OFEcapP0kfWdGkWsuWF9ztQqCPOc7qXHU7LYmOWndCQKcETA2BZhDzieb0X4mFE_btd3VOsjuWV_lcs0chZIEbYHb_CA35dhkHVMXLX4SHzPDz8uXEq02rg');

        return response($reniecDni->get($dni, true))
        ->withHeaders([
            'Content-Type' => 'text/json',
        ]);
    }
}
