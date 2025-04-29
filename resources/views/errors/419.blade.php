@extends('errors::minimal')

@section('title', __('Oops! Page Expired'))
@section('code', '419')
@section('message', __('Your session has timed out. Please refresh the page and try again.'))
