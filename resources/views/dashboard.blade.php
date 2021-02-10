@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid" id="content">

    @include('layouts.navigation')

    <div id="main">
        <div class="container-fluid">
            <div class="page-header">
                <div class="pull-left">
                    <h1>Blank page</h1>
                </div>
                <div class="pull-right">
                    <ul class="minitiles">
                        <li class='grey'>
                            <a href="#"><i class="icon-cogs"></i></a>
                        </li>
                        <li class='lightgrey'>
                            <a href="#"><i class="icon-globe"></i></a>
                        </li>
                    </ul>
                    <ul class="stats">
                        <li class='satgreen'>
                            <i class="icon-money"></i>
                            <div class="details">
                                <span class="big">$324,12</span>
                                <span>Balance</span>
                            </div>
                        </li>
                        <li class='lightred'>
                            <i class="icon-calendar"></i>
                            <div class="details">
                                <span class="big">February 22, 2013</span>
                                <span>Wednesday, 13:56</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="breadcrumbs">
                <ul>
                    <li>
                        <a href="more-login.html">Home</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="more-files.html">Pages</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="more-blank.html">Blank page</a>
                    </li>
                </ul>
                <div class="close-bread">
                    <a href="#"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="box">
                        <div class="box-title">
                            <h3>
                                <i class="icon-reorder"></i>
                                Basic Widget
                            </h3>
                        </div>
                        <div class="box-content">
                            Content
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
