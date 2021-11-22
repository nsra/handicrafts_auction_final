@extends('layouts.main_layout')
@section('content')
<div class="sec-nav shadow-sm p-1">
    <div class="container-fluid">
      <header>
        <nav class="navbar navbar-expand-lg navbar-light">
          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#main-nav"
            aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="main-nav">
            <ul class="navbar-nav ">
              
              <li class="nav-item">
                <a class="nav-link" href="/category/1/products" style="margin-left: 40px;">Painting</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/2/products">Paper  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/3/products">Embroidery  &nbsp; </a>
              <li class="nav-item">
                <a class="nav-link" href="/category/4/products">Wool  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/5/products">Wood  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/6/products">Bead  &nbsp; </a>
              <li class="nav-item">
                <a class="nav-link" href="/category/7/products">NaturalResources  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/8/products">Leather  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/9/products">Plastic  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/10/products">Glass  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/11/products">Clay  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/12/products">Metals  &nbsp; </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    </div>
  </div>
<div class="RecentAuction">
    <div class="container">
      <div class="first-Auction-Recent">
        <input type="search" placeholder="Enter Product name" class="search">
        <select name="typeRecentAuction" id="">
          <option value="Painting">Painting</option>
          <option value="Paper">Paper</option>
          <option value="Embroidery">Embroidery</option>
          <option value="Wool">Wool</option>
          <option value="Bead">Bead</option>
          <option value="NaturalResources">NaturalResources</option>
          <option value="Leather">Leather</option>
          <option value="Glass">Glass</option>
          <option value="NaturalResources">Metals</option>
          <option value="Leather">Plastic</option>
          <option value="Glass">Clay</option>
        </select>
        <label>Price Range</label>
        <input type="number">
        <span>-</span>
        <input type="number">
        <i class="fas fa-search"></i>
      </div>
      <div class="RecentAuction-content">
        <br>
        <h2 class="p-2">{{$category->name}} products</h2>
        <div class="row">
          @foreach($products as $product)
          <div class="col-3">
            <div class="card">
              <div class="salse">Amany</div>
              <img src="{{asset('/HandicraftsAuction/image/wool.jpg')}}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="text-center">{{$product->title}}</h5>
                @if($product->bids->count() === 0) 
                  <p>StartingBid:{{$product->startingBidPrice()}}$</p>
                  @else
                  <p>MaxBid:{{$product->bids->max('price')}}$</p>
                @endif
                <div class="d-flex justify-content-between">
                  <span>${{$product->orderNowPrice}}</span>
                  <button class="btn btn-secondary btn-sm">Order Now</button>
                </div>
                <br>
                <button class="btn text-center btn-block btn-warning">
                  Place Bid
                </button>
              </div>
            </div>
          </div>
          @endforeach
      <br>
      <hr>
      <br>
        </div>
      </div>

    </div>

  </div>
@endsection

@section('script')
  AOS.init({duration:1200});
@endsection
