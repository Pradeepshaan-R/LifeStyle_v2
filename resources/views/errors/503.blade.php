@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'The Application is temporary unavailable due to maintenance work. 
We will be back shortly. Sorry for the inconvenience.'))
