<?php

namespace App\Interface;

use Illuminate\Http\Request;


interface LandingInterface
{
    //articles
    public function articles(Request $request);
    public function create_articles(Request $request);
    //kategori
    public function kategori(Request $request);
    public function create_kategori(Request $request);
    //rekomendasi
    public function rekomendasi(Request $request);
    public function create_rekomendasi(Request $request);
    //sponsor
    public function sponsor(Request $request);
    public function create_sponsor(Request $request);
    //diskon
    public function diskon(Request $request);
    public function create_diskon(Request $request);
}
