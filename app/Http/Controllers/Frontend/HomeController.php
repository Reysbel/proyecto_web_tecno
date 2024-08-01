<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Promocion;
use Illuminate\Http\Request;
use App\Models\PageView;

class HomeController extends Controller
{
    public function index()
    {
        $productos = Producto::paginate(6); // Ajusta el número según sea necesario
        $categorias = Categoria::all();
        $promociones = Promocion::with('producto')->get(); // Obtén las promociones y sus productos asociados

        // Contador de visitas
        $pageUrl = request()->fullUrl();
        $pageView = PageView::firstOrCreate(['page_url' => $pageUrl]);
        $pageView->increment('views');
        $views = $pageView->views;

        return view('frontend.home.home', compact('productos', 'categorias', 'promociones', 'views'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $productos = Producto::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('autor', 'LIKE', "%{$query}%")
            ->orWhere('editorial', 'LIKE', "%{$query}%")
            ->paginate(10); // Pagina los resultados

        $categorias = Categoria::where('nombre', 'LIKE', "%{$query}%")->get();

        return view('frontend.catalogo.index', compact('productos', 'categorias'))
            ->with('selectedCategoryName', 'Resultados de búsqueda para: ' . $query);
    }

    public function nosotros()
    {
        return view('frontend.nosotros.index');
    }

    public function showPage()
    {
        $pageUrl = request()->fullUrl();
        $pageView = PageView::where('page_url', $pageUrl)->first();
        $views = $pageView ? $pageView->views : 0;

        return view('your-view', compact('views'));
    }
}
