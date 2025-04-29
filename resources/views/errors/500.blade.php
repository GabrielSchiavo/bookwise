@extends('errors::minimal')

@section('title', __('Oops! Internal Server Error'))
@section('code', '500')
@section('message', __("Something went wrong on our server. Don't worry, our team is already fixing it. Please try again later."))
