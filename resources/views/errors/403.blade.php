@extends('errors::minimal')

@section('title', __('Oops! Access Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: "You don't have permission to access this page."))
