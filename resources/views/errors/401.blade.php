@extends('errors::minimal')

@section('title', __('Oops! Unauthorized Access'))
@section('code', '401')
@section('message', __('You do not have permission to view this resource.'))
