<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interface\LandingInterface;
use App\LandingModels;
use Illuminate\Http\Request;
use App\Repositories\v_1\LandingRepositories;

class LandingControllers extends Controller implements LandingInterface
{
    use LandingRepositories;
    /**
     * articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function articles(Request $request)
    {
        return $this->articlesView($request);
    }

    public function create_articles(Request $request)
    {
        return $this->ok($this->articlesStore($request));
    }

    /**
     *  kategori.
     *
     * @return \Illuminate\Http\Response
     */
    public function kategori(Request $request)
    {
        return $this->kategoriView($request);
    }

    public function create_kategori(Request $request)
    {
        return $this->ok($this->kategoriStore($request));
    }

    /**
     *  rekomendasi.
     *
     * @return \Illuminate\Http\Response
     */
    public function rekomendasi(Request $request)
    {
        return $this->rekomendasiView($request);
    }

    public function create_rekomendasi(Request $request)
    {
        return $this->ok($this->rekomendasiStore($request));
    }
    /**
     *  sponsor.
     *
     * @return \Illuminate\Http\Response
     */
    public function sponsor(Request $request)
    {
        return $this->sponsorView($request);
    }

    public function create_sponsor(Request $request)
    {
        return $this->ok($this->sponsorStore($request));
    }

    /**
     *  diskon.
     *
     * @return \Illuminate\Http\Response
     */

    public function diskon(Request $request)
    {
        return $this->diskonView($request);
    }

    public function create_diskon(Request $request)
    {
        return $this->ok($this->diskonStore($request));
    }
}
