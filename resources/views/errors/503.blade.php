@extends('errors::minimal')

@section('title', __('Oops! Service Unavailable'))
@section('code', '503')
@section('message', __('Our servers are temporarily down for maintenance. Please check back soon!'))
