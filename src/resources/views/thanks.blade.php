@extends('layouts.app')

@section('css')
<style>
    .thanks-wrapper {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 20px;
        text-align: center;
        box-sizing: border-box;
        overflow: hidden;
    }
    .thanks-wrapper::before {
    content: "Thank You";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 250px;       
    color: rgba(0,0,0,0.05); 
    font-weight: bold;
    white-space: nowrap;
    pointer-events: none;   
    z-index: 0;
}

    .thanks-wrapper h2 {
        font-size: 24px;
        margin-bottom: 30px;
        line-height: 1.4;
        color: #52341fff;
        position: relative;
        z-index: 1; 
    }

    .btn-home {
        display: inline-block;
        padding: 12px 30px;
        background-color: #52341fff;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s;
        position: relative;
        z-index: 1; 
    }

    .btn-home:hover {
        background-color: #5a4a40;
    }

    @media (max-width: 600px) {
        .thanks-wrapper h2 { font-size: 20px; }
        .btn-home { width: 80%; font-size: 14px; }
    }
</style>
@endsection

@section('content')
<div class="thanks-wrapper">
    <h2>お問い合わせありがとうございました</h2>
    <a href="{{ url('/') }}" class="btn-home">HOME</a>
</div>
@endsection
