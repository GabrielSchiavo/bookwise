@extends('errors::minimal')

@section('title', __('Oops! Too Many Requests'))
@section('code', '429')
@section('message', __("You've sent too many requests in a short time. Please slow down and try again later."))
