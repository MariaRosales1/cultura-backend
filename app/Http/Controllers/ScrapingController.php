<?php

namespace App\Http\Controllers;
use Goutte\Client;
use Illuminate\Http\Request;

class ScrapingController extends Controller
{
    public function getInformation(Client $client){
        // $crawler = $client->request("GET", "https://colomboworld.com/cultura/cine/");
        $crawler = $client->request("GET", "https://www.teatropablotobon.com/programacion?isc=1&xf_8[0]=2");
        $nombreClase='ed-item s-100 l-1-3';
        //$filtroClase= $crawler->filter("[class='$nombreClase']")->first();
        //dd($crawler);
        //dd($filtroClase->html());
        $eventosTeatro=[];
        $crawler->filter("[class='$nombreClase']")->each(function( $nodoEvento){
            
            $nombreNodo=$nodoEvento->filter("[class='event-description']");
            $divs=$nombreNodo->children()->filter('div');
            $seccionFecha=$divs->eq(1);
        
            $seccionDescripcion=$divs->eq(2);
            $seccionDescripcionTexto=$seccionDescripcion->text();
            $parte= substr($seccionDescripcionTexto,15);
            $eventosTeatro['titulo']=$parte;
            $eventosTeatro['fecha']=$seccionFecha->text();
            dd($eventosTeatro);
            
            // $descripcion=$parte[1];
            //echo $seccionDescripcionTexto.'<br>';
        });
        //dd($eventosTeatro);
    }
}
