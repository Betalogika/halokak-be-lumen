<?php

namespace App\Repositories\v_1;

use App\Models\Articles;
use App\Models\Diskon;
use App\Models\Kategori;
use App\Models\Rekomendasi;
use App\Models\Sponsor;


trait LandingRepositories
{

    //articles

    public function articlesView($request)
    {
        $limit = 50;
        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }

        return Articles::paginate($limit);
    }

    public function articlesStore($request)
    {
        return Articles::create($request->all());
    }

    //kategori

    public function kategoriView($request)
    {
        $limit = 50;
        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }

        return Kategori::paginate($limit);
    }

    public function kategoriStore($request)
    {
        return Kategori::create($request->all());
    }

    //rekomendasi

    public function rekomendasiView($request)
    {
        $limit = 50;
        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }

        return Rekomendasi::paginate($limit);
    }

    public function rekomendasiStore($request)
    {
        return Rekomendasi::create($request->all());
    }

    //sponsor

    public function sponsorView($request)
    {
        $limit = 50;
        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }

        return Sponsor::paginate($limit);
    }

    public function sponsorStore($request)
    {
        return Sponsor::create($request->all());
    }

    //diskon

    public function diskonView($request)
    {
        $limit = 50;
        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }

        return Diskon::paginate($limit);
    }

    public function diskonStore($request)
    {
        return Diskon::create($request->all());
    }
}
