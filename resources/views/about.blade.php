@extends('layouts.main')

@section('title', 'About Page')

@section('content')

<h3> Welcome to our website! </h3> 
<br>

<img class="img-thumbnail" src="{{ asset('images/1_bYAIrVBRWSCCKnbtST8XTw.jpeg') }}">

<br>
<br>

<p>We are students at the University of Plovdiv 'Paisii Hilendarski'. This is our project in the discipline Laravel,PHP, led by assistant Ivan Zhelev. We had a few weeks to do a simple laravel project, including:
<li>Self-made login and register using Laravel Auth class (not using php artisan make:auth !!!).</li>
<li>Two roles - Normal user and Administrator. </li>
<li>Naming routes, use route groups CRUD - Use GET, POST, PUT, DELETE methods.</li>
<li>Make Migrations and Seeds. Make Models. </li>
<li>Two Relationship Example: Post -> Comments.</li>
</p>

<br>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Faculty number
</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Niya</td>
      <td>Drqnkova</td>
      <td>1601681104</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Alex</td>
      <td>Draev</td>
      <td>1601681033</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Kiril</td>
      <td>Datkov</td>
      <td>1401561084</td>
    </tr>
  </tbody>
</table>

@endsection